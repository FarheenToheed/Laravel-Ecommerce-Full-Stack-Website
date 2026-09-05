<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Checkout page dikhana — logged in user ka cart data laa kar view ko bhejna
     */
    public function index()
    {
        $cart = Cart::with(['cart_items.product', 'cart_items.variant.product_size'])
            ->where('user_id', auth()->id())
            ->first();

        if (! $cart || $cart->cart_items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $subtotal = $cart->cart_items->sum('total_price');
        $user = auth()->user();

        return view('web.pages.checkout.index', compact('cart', 'subtotal','user'));
    }


    /**
     * "PLACE YOUR ORDER" dabane par ye chalega
     * Shipping + Order + Order Items + Payment — sab ek sath (transaction mein) save honge
     */
    public function placeOrder(Request $request)
    {
        // Step 1: Validation
        $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'address'        => 'required|string|max:255',
            'country'        => 'required|string',
            'province'       => 'required|string',
            'city'           => 'required|string',
            'postal_code'    => 'required|string',
            'phone_no'       => 'required|string|max:15',
            'payment_method' => 'required|in:cod,bank',
        ]);

        // Step 2: User ka cart laao
        $cart = Cart::with('cart_items')->where('user_id', auth()->id())->first();

        if (! $cart || $cart->cart_items->isEmpty()) {
            return response()->json([
                'status'  => false,
                'message' => 'Your cart is empty.',
            ]);
        }

        // Step 3: Sab kuch ek transaction mein save karo
        // (Beech mein error aaye to sab automatically cancel ho jayega)
        $order = DB::transaction(function () use ($request, $cart) {

            // 3.1 - Shipping address save karo
            $shipping = Shipping::create([
                'first_name'  => $request->first_name,
                'last_name'   => $request->last_name,
                'address'     => $request->address,
                'country'     => $request->country,
                'province'    => $request->province,
                'city'        => $request->city,
                'postal_code' => $request->postal_code,
                'phone_no'    => $request->phone_no,
            ]);

            // 3.2 - Amounts calculate karo
            $subtotal = $cart->cart_items->sum('total_price');
            $tax      = 0;
            $total    = $subtotal + $tax;

            // 3.3 - Order banao
            $order = Order::create([
                'user_id'  => auth()->id(),
                'ship_id'  => $shipping->id,
                'subtotal' => $subtotal,
                'tax'      => $tax,
                'total'    => $total,
                'status'   => 'pending',
            ]);

            // 3.4 - Cart items ko order_items mein copy karo
            foreach ($cart->cart_items as $item) {
                OrderItem::create([
                    'order_id'           => $order->id,
                    'product_id'         => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity'           => $item->quantity,
                ]);
            }

            // 3.5 - Payment record banao
            Payment::create([
                'order_id'     => $order->id,
                'pay_method'   => $request->payment_method,
                'pay_status'   => 'unpaid',
                'total_amount' => $total,
                'paid_amount'  => 0,
            ]);

            // 3.6 - Cart khali kar do
            $cart->cart_items()->delete();

            return $order;
        });

        // Step 4: Success response
        return response()->json([
            'status'   => true,
            'message'  => 'Order placed successfully!',
            'order_id' => $order->id,
        ]);
    }

    
    /**
 * Order Confirmation Page
 * Poori logic yahan handle hoti hai — Blade sirf display karta hai
 */
public function confirmation($id)
{
    $order = Order::with([
        'shipping',
        'payment',
        'order_items.product.product_images',
        'order_items.variant.product_size',
        'order_items.variant.product_color',
        'user',
    ])
    ->where('user_id', auth()->id())
    ->findOrFail($id);

    // ===== Customer Info =====
    $customerName  = $order->user->name ?? 'Customer';
    $customerEmail = $order->user->email ?? '';

    // ===== Order info =====
    $orderNumber = 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT);
    $orderDate   = $order->created_at->format('j/n/y');
    $orderStatus = strtoupper($order->status);

    // ===== Items List =====
    $items = $order->order_items->map(function ($item) {

        $image = $item->product && $item->product->product_images->isNotEmpty()
            ? asset('storage/' . $item->product->product_images->first()->image_path)
            : asset('products/no_image.jpg');

        $metaLines = [];

        if (optional($item->variant)->product_color) {
            $metaLines[] = 'Color: ' . $item->variant->product_color->name;
        }

        if (optional($item->variant)->product_size) {
            $metaLines[] = 'Size: ' . $item->variant->product_size->name;
        }

        $metaLines[] = 'Quantity: ' . $item->quantity;

        return [
            'image'      => $image,
            'name'       => $item->product->name ?? 'Product',
            'price'      => 'Rs. ' . number_format(optional($item->variant)->price ?? 0),
            'meta_lines' => $metaLines,
        ];

    });

    // ===== Shipping Address =====
    $addressLines = [
        $order->shipping->first_name . ' ' . $order->shipping->last_name,
        $order->shipping->address,
        $order->shipping->city . ', ' . $order->shipping->province . ', ' . $order->shipping->postal_code,
        $order->shipping->country,
    ];

    $billingLines  = array_merge($addressLines, [$customerEmail, $order->shipping->phone_no]);
    $shippingLines = array_merge($addressLines, [$order->shipping->phone_no]);

    // ===== Payment Info =====
    $paymentMethod = optional($order->payment)->pay_method === 'cod'
        ? 'Cash On Delivery'
        : 'Bank Transfer';

    // ===== Amount Summary (ab tax bhi shamil hai, jo orders table mein maujood hai) =====
    $amountSummary = [
        ['label' => 'Subtotal', 'value' => 'Rs. ' . number_format($order->subtotal)],
        ['label' => 'Tax',      'value' => 'Rs. ' . number_format($order->tax)],
        ['label' => 'Shipping', 'value' => 'Rs. 0'],
    ];

    $totalAmount = 'Rs. ' . number_format($order->total);

    return view('web.pages.checkout.confirmation', compact(
        'customerName',
        'customerEmail',
        'orderNumber',
        'orderDate',
        'orderStatus',
        'items',
        'billingLines',
        'shippingLines',
        'paymentMethod',
        'amountSummary',
        'totalAmount'
    ));
}
}

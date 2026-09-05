<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class SearchController extends Controller
{
    /**
     * Load products for search drawer.
     */
    public function drawerData()
    {
        $products = Product::query()
            ->with([
                'product_images',
                'product_variants',
            ])
            ->where('status', 'active')
            ->latest()
            ->take(4)
            ->get();

        return response()->json([
            'products' => $products,
        ]);
    }


    /**
     * Search products.
     *
     * Search locations:
     * - Product name
     * - SKU
     * - Description
     * - Details
     * - Sub category
     * - Child category
     * - Parent category
     */
    public function search(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Get Search Query
        |--------------------------------------------------------------------------
        */

        $search = trim($request->input('q', ''));


        /*
        |--------------------------------------------------------------------------
        | Empty Search
        |--------------------------------------------------------------------------
        */

        if ($search === '') {
            return response()->json([
                'products' => [],
                'total' => 0,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Clean Search
        |--------------------------------------------------------------------------
        |
        | Multiple spaces ko single space mein convert karta hai.
        |
        | Example:
        |
        | "  embroidered    lawn  "
        |
        | becomes:
        |
        | "embroidered lawn"
        |
        */

        $search = preg_replace('/\s+/', ' ', $search);


        /*
        |--------------------------------------------------------------------------
        | Convert Search Into Words
        |--------------------------------------------------------------------------
        |
        | "embroidered lawn suit"
        |
        | becomes:
        |
        | embroidered
        | lawn
        | suit
        |
        */

        $words = collect(
            preg_split('/\s+/', $search)
        )
            ->filter()
            ->unique()
            ->values();


        /*
        |--------------------------------------------------------------------------
        | Product Query
        |--------------------------------------------------------------------------
        */

        $products = Product::query()

            /*
            |--------------------------------------------------------------------------
            | Load Product Relationships
            |--------------------------------------------------------------------------
            */

            ->with([
                'product_images',
                'product_variants',
                'sub_category.category',
                'child_category.sub_category.category',
            ])


            /*
            |--------------------------------------------------------------------------
            | Only Active Products
            |--------------------------------------------------------------------------
            */

            ->where('products.status', 'active')


            /*
            |--------------------------------------------------------------------------
            | Search
            |--------------------------------------------------------------------------
            */

            ->where(function ($query) use ($words) {

                foreach ($words as $word) {

                    $keyword = '%' . $word . '%';


                    /*
                    |--------------------------------------------------------------------------
                    | Each Word Must Match Somewhere
                    |--------------------------------------------------------------------------
                    */

                    $query->where(function ($q) use ($keyword) {

                        /*
                        |--------------------------------------------------------------------------
                        | PRODUCT NAME
                        |--------------------------------------------------------------------------
                        */

                        $q->where(
                            'products.name',
                            'LIKE',
                            $keyword
                        )


                        /*
                        |--------------------------------------------------------------------------
                        | SKU
                        |--------------------------------------------------------------------------
                        */

                        ->orWhere(
                            'products.sku',
                            'LIKE',
                            $keyword
                        )


                        /*
                        |--------------------------------------------------------------------------
                        | DESCRIPTION
                        |--------------------------------------------------------------------------
                        */

                        ->orWhere(
                            'products.description',
                            'LIKE',
                            $keyword
                        )


                        /*
                        |--------------------------------------------------------------------------
                        | DETAILS
                        |--------------------------------------------------------------------------
                        */

                        ->orWhere(
                            'products.details',
                            'LIKE',
                            $keyword
                        )


                        /*
                        |--------------------------------------------------------------------------
                        | SUB CATEGORY
                        |--------------------------------------------------------------------------
                        */

                        ->orWhereHas(
                            'sub_category',
                            function ($subCategory) use ($keyword) {

                                $subCategory->where(
                                    'name',
                                    'LIKE',
                                    $keyword
                                );
                            }
                        )


                        /*
                        |--------------------------------------------------------------------------
                        | CHILD CATEGORY
                        |--------------------------------------------------------------------------
                        */

                        ->orWhereHas(
                            'child_category',
                            function ($childCategory) use ($keyword) {

                                $childCategory->where(
                                    'name',
                                    'LIKE',
                                    $keyword
                                );
                            }
                        )


                        /*
                        |--------------------------------------------------------------------------
                        | PARENT CATEGORY
                        |
                        | Product
                        |    ↓
                        | SubCategory
                        |    ↓
                        | Category
                        |--------------------------------------------------------------------------
                        */

                        ->orWhereHas(
                            'sub_category.category',
                            function ($category) use ($keyword) {

                                $category->where(
                                    'name',
                                    'LIKE',
                                    $keyword
                                );
                            }
                        )


                        /*
                        |--------------------------------------------------------------------------
                        | PARENT CATEGORY THROUGH CHILD CATEGORY
                        |
                        | Product
                        |    ↓
                        | ChildCategory
                        |    ↓
                        | SubCategory
                        |    ↓
                        | Category
                        |--------------------------------------------------------------------------
                        */

                        ->orWhereHas(
                            'child_category.sub_category.category',
                            function ($category) use ($keyword) {

                                $category->where(
                                    'name',
                                    'LIKE',
                                    $keyword
                                );
                            }
                        );

                    });
                }
            })


            /*
            |--------------------------------------------------------------------------
            | Search Ranking
            |--------------------------------------------------------------------------
            |
            | Exact product name sabse upar.
            |
            */

            ->orderByRaw(
                "
                CASE

                    WHEN LOWER(products.name) = LOWER(?) THEN 1

                    WHEN LOWER(products.name) LIKE LOWER(?) THEN 2

                    WHEN LOWER(products.sku) = LOWER(?) THEN 3

                    WHEN LOWER(products.sku) LIKE LOWER(?) THEN 4

                    ELSE 5

                END
                ",
                [
                    $search,
                    $search . '%',
                    $search,
                    $search . '%',
                ]
            )


            /*
            |--------------------------------------------------------------------------
            | Latest Products
            |--------------------------------------------------------------------------
            */

            ->latest()


            /*
            |--------------------------------------------------------------------------
            | Get Results
            |--------------------------------------------------------------------------
            */

            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return JSON
        |--------------------------------------------------------------------------
        */

        return response()->json([
            'products' => $products,
            'total' => $products->count(),
        ]);
    }
}
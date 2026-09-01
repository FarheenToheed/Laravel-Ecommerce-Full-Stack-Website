@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">

            <div class="col-md-10">

                <div class="card">

                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h5 class="mb-0">Orders</h5>

                    </div>

                    <div class="card-body">

                        {{-- SUCCESS MESSAGE --}}
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- ERROR MESSAGE --}}
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- ORDERS TABLE --}}
                        <div class="table-responsive">

                            <table class="table table-bordered align-middle">

                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Order ID
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Customer
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Order Date
                                        </th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse($orders as $order)

                                        <tr class="text-sm">

                                            {{-- ORDER ID --}}
                                            <td>
                                                #{{ $order->id }}
                                            </td>

                                            {{-- CUSTOMER --}}
                                            <td>
                                                {{ $order->user->name }}
                                            </td>

                                            {{-- TOTAL --}}
                                            <td>
                                                Rs. {{ number_format($order->total, 2) }}
                                            </td>

                                            {{-- STATUS --}}
                                            {{-- <td>

                                                <button type="button" class="btn btn-xs btn-warning editStatusBtn"
                                                    data-id="{{ $order->id }}" data-status="{{ $order->status }}"
                                                    data-bs-toggle="modal" data-bs-target="#statusModal">

                                                    {{ ucfirst($order->status) }}

                                                </button>

                                            </td> --}}
                                            {{-- STATUS --}}
<td>

    @if(in_array($order->status, ['delivered', 'cancelled']))

        <span class="badge bg-{{ $order->status === 'delivered' ? 'success' : 'danger' }}">
            {{ ucfirst($order->status) }}
        </span>

    @else

        <button type="button" class="btn btn-xs btn-warning editStatusBtn"
            data-id="{{ $order->id }}" data-status="{{ $order->status }}"
            data-bs-toggle="modal" data-bs-target="#statusModal">

            {{ ucfirst($order->status) }}

        </button>

    @endif

</td>

                                            {{-- ORDER DATE --}}
                                            <td>
                                                {{ $order->created_at->diffForHumans() }}
                                            </td>

                                            {{-- VIEW BUTTON --}}
                                            <td>

                                                <a href="{{ route('admin.orderdetails.show', $order->id) }}"
                                                    class="btn btn-xs btn-primary">

                                                    View

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="6" class="text-center text-muted">
                                                No orders found
                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                        {{-- PAGINATION --}}
                        <div class="mt-3">

                            {{ $orders->links() }}

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="statusModal" tabindex="-1" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title">
                            Change Order Status
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <form id="statusForm" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="form-group">

                                <label>Status</label>

                                <select name="status" id="status" class="form-control">

                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="shipped">Shipped</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>

                                </select>

                            </div>

                        </form>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">

                            Close

                        </button>

                        <button type="submit" form="statusForm" class="btn btn-primary">

                            Update Status

                        </button>

                    </div>

                </div>

            </div>

        </div>
        {{-- End Modals --}}

    </div>

@endsection
@push('js')

    <script>

        const updateOrderBaseUrl = "{{ url('/admin/orderdetails') }}";

        document.addEventListener('DOMContentLoaded', function () {

            const buttons = document.querySelectorAll('.editStatusBtn');
            const form = document.getElementById('statusForm');
            const status = document.getElementById('status');

            buttons.forEach(button => {

                button.addEventListener('click', function () {

                    const id = this.dataset.id;
                    const currentStatus = this.dataset.status;

                    status.value = currentStatus;

                    form.action = `${updateOrderBaseUrl}/${id}`;

                });

            });

        });

    </script>

@endpush
@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Coupons</h5>

                        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                            + Create Coupon
                        </a>
                    </div>

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="50">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Value</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Max Discount</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Limit</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expiry</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" width="100">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->id }}</td>
                                            <td><strong>{{ $coupon->coupon_code }}</strong></td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $coupon->type)) }}</td>
                                            <td>
                                                {{ $coupon->type === 'percentage' ? $coupon->value.'%' : 'Rs. '.$coupon->value }}
                                            </td>
                                            <td>Rs. {{ $coupon->max_discount }}</td>
                                            <td>{{ $coupon->limit ?? 'Unlimited' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($coupon->exp_date)->format('d M, Y') }}</td>
                                            <td>
                                                <span style="font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px;
                                                    background: {{ $coupon->status === 'active' ? '#EAF3DE' : '#FCEBEB' }};
                                                    color: {{ $coupon->status === 'active' ? '#3B6D11' : '#A32D2D' }};">
                                                    {{ ucfirst($coupon->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1 justify-content-center">
                                                    <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-xs btn-warning">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-xs btn-danger" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center text-muted">No coupons found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $coupons->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
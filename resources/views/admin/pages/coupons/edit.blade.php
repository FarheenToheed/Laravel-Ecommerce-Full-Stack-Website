@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Coupon</h5>
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST" class="d-flex flex-column gap-3">
                            @csrf
                            @method('PUT')

                            <div>
    <label class="form-label">Assign to User (optional)</label>

    <select name="user_id" class="form-control form-select">
        <option value="">-- All Users (General Coupon) --</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}" @selected(in_array($user->id, $assignedUserIds))>
                {{ $user->name }} ({{ $user->email }})
            </option>
        @endforeach
    </select>

    <small class="text-muted">Select no user if coupon is for all users.</small>
    @error('user_id')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

                            <div>
                                <label class="form-label">Coupon Code</label>
                                <input type="text" name="coupon_code" value="{{ old('coupon_code', $coupon->coupon_code) }}" class="form-control">
                                @error('coupon_code')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Discount Type</label>
                                    <select name="type" class="form-control form-select">
                                        <option value="total_amount" @selected(old('type', $coupon->type) == 'total_amount')>Fixed Amount</option>
                                        <option value="percentage" @selected(old('type', $coupon->type) == 'percentage')>Percentage</option>
                                    </select>
                                    @error('type')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Value</label>
                                    <input type="number" step="0.01" name="value" value="{{ old('value', $coupon->value) }}" class="form-control">
                                    @error('value')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Max Discount (Rs.)</label>
                                    <input type="number" step="0.01" name="max_discount" value="{{ old('max_discount', $coupon->max_discount) }}" class="form-control">
                                    @error('max_discount')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Usage Limit (optional)</label>
                                    <input type="number" name="limit" value="{{ old('limit', $coupon->limit) }}" class="form-control">
                                    @error('limit')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Expiry Date</label>
                                    <input type="date" name="exp_date" value="{{ old('exp_date', \Carbon\Carbon::parse($coupon->exp_date)->format('Y-m-d')) }}" class="form-control">
                                    @error('exp_date')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control form-select">
                                        <option value="active" @selected(old('status', $coupon->status) == 'active')>Active</option>
                                        <option value="inactive" @selected(old('status', $coupon->status) == 'inactive')>Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Update Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
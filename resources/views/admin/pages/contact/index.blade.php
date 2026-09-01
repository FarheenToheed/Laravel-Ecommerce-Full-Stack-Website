@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">

                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">User's Inquiries</h5>

                    </div>

                    <div class="card-body">

                        {{-- SUCCESS MESSAGE (FIXED) --}}
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

                        {{-- TABLE --}}
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                

                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                        </th>
                                         <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Phone</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Subject</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($inquiries as $inq)
                                        <tr class="text-sm">
                                            <td>{{ $inq->id }}</td>
                                            <td>{{ $inq->name }}</td>
                                            <td>{{ $inq->email }}</td>
                                            <td>{{ $inq->phone }}</td>
                                            <td>{{ $inq->subject }}</td>
                                            <td>{{ $inq->message }}</td>
                                            <td>{{ $inq->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach 
                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
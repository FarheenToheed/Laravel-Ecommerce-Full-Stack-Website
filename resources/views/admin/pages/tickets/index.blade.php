@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Support Tickets</h5>
                    </div>

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" style="table-layout: fixed; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%;">ID</th>
                                        <th class="text-center" style="width: 13%;">Subject</th>
                                        <th class="text-center" style="width: 10%;">User</th>
                                        <th class="text-center" style="width: 15%;">Email</th>
                                        <th class="text-center" style="width: 15%;">Message</th>
                                        <th class="text-center" style="width: 10%;">Status</th>
                                        <th class="text-center" style="width: 12%;">Created At</th>
                                        <th class="text-center" style="width: 10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tickets as $ticket)
                                            <tr>
                                                <td class="text-center">{{ $ticket->id }}</td>
                                                <td class="text-truncate" style="max-width: 100%;">{{ $ticket->subject }}</td>
                                                <td class="text-truncate" style="max-width: 100%;">{{ $ticket->user->name ?? '-' }}
                                                </td>
                                                <td class="text-truncate" style="max-width: 100%;">{{ $ticket->email }}</td>
                                                <td>
                                                    <span class="viewMessageBtn text-truncate d-block"
                                                        style="cursor: pointer; color: #797575; max-width: 100%;"
                                                        data-message="{{ $ticket->message }}" data-bs-toggle="modal"
                                                        data-bs-target="#viewMessageModal">
                                                        {{ $ticket->message }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span
                                                        style="font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px; white-space: nowrap;
                                        background: {{ $ticket->status === 'open' ? '#FCEBEB' : ($ticket->status === 'pending' ? '#FFF4DE' : '#EAF3DE') }};
                                        color: {{ $ticket->status === 'open' ? '#A32D2D' : ($ticket->status === 'pending' ? '#8A6D0F' : '#3B6D11') }};">
                                                        {{ strtoupper($ticket->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-truncate text-center" style="max-width: 100%;">
                                                    {{ $ticket->created_at->diffForHumans() }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-warning updateStatusBtn"
                                                        data-id="{{ $ticket->id }}" data-status="{{ $ticket->status }}"
                                                        data-bs-toggle="modal" data-bs-target="#updateStatusModal">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No tickets found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $tickets->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- View Full Message Modal --}}
        <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="viewMessageLabel">Full Message</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="fullMessageText" style="white-space: pre-line;"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Update Status Modal --}}
        <div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateStatusLabel">Update Ticket Status</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="updateStatusForm" class="d-flex flex-column gap-3" method="post">
                            @csrf
                            @method('PUT')

                            <select name="status" id="status_select" class="form-control form-select">
                                <option value="open">Open</option>
                                <option value="pending">Pending</option>
                                <option value="closed">Closed</option>
                            </select>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="updateStatusForm" class="btn btn-primary">Update Status</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const updateTicketBaseUrl = "{{ url('/admin/tickets') }}";

            const updateButtons = document.querySelectorAll('.updateStatusBtn');
            const updateForm = document.getElementById('updateStatusForm');
            const statusSelect = document.getElementById('status_select');

            updateButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const status = this.getAttribute('data-status');

                    statusSelect.value = status;
                    updateForm.action = `${updateTicketBaseUrl}/${id}`;
                });
            });

            const messageButtons = document.querySelectorAll('.viewMessageBtn');
            const fullMessageText = document.getElementById('fullMessageText');

            messageButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const message = this.getAttribute('data-message');
                    fullMessageText.textContent = message;
                });
            });

        });
    </script>
@endpush
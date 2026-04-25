<div class="table-responsive">
    <table class="table table-hover mb-0 support-table">
        <thead>
            <tr style="background: #FFF5F5;">
                <th class="py-3">Date & Time</th>
                <th class="py-3">Ticket ID</th>
                <th class="py-3">Passenger Name</th>
                <th class="py-3">Complaint Type</th>
                <th class="py-3">Status</th>
                <th class="py-3 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
            @php
                $ticketData = [
                    'id' => $ticket->id,
                    'ticket_id' => $ticket->ticket_id,
                    'user_name' => $ticket->user_name,
                    'user_email' => $ticket->user_email,
                    'user_phone' => $ticket->user_phone,
                    'booking_id' => $ticket->booking_id,
                    'complaint_type' => $ticket->complaint_type,
                    'description' => $ticket->description,
                    'status' => $ticket->status,
                    'user_type' => $ticket->user_type
                ];
            @endphp
            <tr>
                <td style="font-weight: 500;">{{ $ticket->created_at->format('d F Y g:i a') }}</td>
                <td style="font-weight: 700; color: #000;">{{ $ticket->ticket_id }}</td>
                <td style="font-weight: 500;">{{ $ticket->user_name }}</td>
                <td style="font-weight: 500;">{{ $ticket->complaint_type }}</td>
                <td>
                    <span class="status-badge status-{{ $ticket->status }}">
                        {{ ucfirst($ticket->status) }}
                    </span>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-light shadow-sm" onclick='viewTicket(@json($ticketData))' style="border-radius: 8px; border: 1px solid #ddd;">
                        <i class="bi bi-eye-fill text-danger"></i>
                    </button>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5 text-muted">No passenger tickets found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Support Pagination -->
<div class="mt-4">
    {{ $tickets->appends(request()->query())->links('vendor.pagination.riden') }}
</div>

<div class="support-table-container">
    <table class="table support-table">
        <thead>
            <tr>
                <th style="border-top-left-radius: 30px;">Date & Time</th>
                <th>Ticket ID</th>
                <th>Booking ID</th>
                <th>Driver Name</th>
                <th>Complaint Type</th>
                <th style="border-top-right-radius: 30px;">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $complaints = [
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Theresa Webb', 'type' => 'Type 1', 'status' => 'Resolved'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Ralph Edwards', 'type' => 'Type 2', 'status' => 'Pending'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Dianne Russell', 'type' => 'Type 3', 'status' => 'Resolved'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Esther Howard', 'type' => 'Type 1', 'status' => 'Pending'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Darlene Robertson', 'type' => 'Type 2', 'status' => 'Resolved'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Cody Fisher', 'type' => 'Type 3', 'status' => 'Pending'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Ronald Richards', 'type' => 'Type 1', 'status' => 'Resolved'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Floyd Miles', 'type' => 'Type 2', 'status' => 'Pending'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Albert Flores', 'type' => 'Type 3', 'status' => 'Resolved'],
                    ['date' => '22 March 2025 9:00pm', 'id' => '#34567', 'booking' => '#34567', 'name' => 'Marvin McKinney', 'type' => 'Type 1', 'status' => 'Pending'],
                ];
            @endphp

            @foreach($complaints as $row)
            <tr onclick="window.location='{{ route('admin.support.complaints.detail', ['id' => 123456]) }}'" style="cursor: pointer;">
                <td style="font-weight: 500;">{{ $row['date'] }}</td>
                <td style="font-weight: 500;">{{ $row['id'] }}</td>
                <td style="font-weight: 500;">{{ $row['booking'] }}</td>
                <td style="font-weight: 500;">{{ $row['name'] }}</td>
                <td style="font-weight: 500;">{{ $row['type'] }}</td>
                <td>
                    <span class="status-badge {{ strtolower($row['status']) }}">
                        {{ $row['status'] }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Support Pagination -->
<ul class="pagination-support">
    <li><a href="#" class="page-btn-support"><i class="bi bi-chevron-left"></i></a></li>
    <li><a href="#" class="page-btn-support active">1</a></li>
    <li><a href="#" class="page-btn-support">2</a></li>
    <li><a href="#" class="page-btn-support">3</a></li>
    <li><span class="px-1 text-muted">...</span></li>
    <li><a href="#" class="page-btn-support">5</a></li>
    <li><a href="#" class="page-btn-support arrow-next"><i class="bi bi-chevron-right"></i></a></li>
</ul>

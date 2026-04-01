<div class="driver-info-card rides-info-card">
    <div class="driver-info-card-header rides-header-style">
        <i class="bi bi-truck"></i>
        <h5>All Rides</h5>
    </div>
    
    <div class="rides-table-wrapper p-4">
        <table class="table rides-mini-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Booking ID</th>
                    <th>Customer</th>
                    <th>Pickup</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $rides = [
                        ['date' => '22 March 2025', 'id' => '#34565', 'customer' => 'Jesse Showalter', 'pickup' => '123 Main Street, Suite 405, Toronto'],
                        ['date' => '22 March 2025', 'id' => '#34565', 'customer' => 'Jesse Showalter', 'pickup' => '123 Main Street, Suite 405, Toronto'],
                        ['date' => '22 March 2025', 'id' => '#34565', 'customer' => 'Jesse Showalter', 'pickup' => '123 Main Street, Suite 405, Toronto'],
                        ['date' => '22 March 2025', 'id' => '#34565', 'customer' => 'Jesse Showalter', 'pickup' => '123 Main Street, Suite 405, Toronto'],
                        ['date' => '22 March 2025', 'id' => '#34565', 'customer' => 'Jesse Showalter', 'pickup' => '123 Main Street, Suite 405, Toronto'],
                    ];
                @endphp

                @foreach($rides as $ride)
                <tr>
                    <td>{{ $ride['date'] }}</td>
                    <td>{{ $ride['id'] }}</td>
                    <td>{{ $ride['customer'] }}</td>
                    <td class="pickup-cell">{{ $ride['pickup'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            <a href="#" class="view-all-rides-link">View All</a>
        </div>
    </div>
</div>

<style>
.rides-header-style {
    background: #D10000 !important;
    color: white !important;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.rides-header-style i {
    color: white !important;
}

.rides-mini-table {
    border-collapse: separate;
    border-spacing: 0;
    width: 100%;
    margin-bottom: 0;
}

.rides-mini-table thead th {
    background: #FFF1F2 !important; /* Very light red/pink */
    color: #111;
    font-weight: 600;
    font-size: 13px;
    padding: 12px 15px;
    border: none;
}

/* Rounded corners for thead */
.rides-mini-table thead tr th:first-child { border-top-left-radius: 8px; border-bottom-left-radius: 8px; }
.rides-mini-table thead tr th:last-child { border-top-right-radius: 8px; border-bottom-right-radius: 8px; }

.rides-mini-table tbody td {
    padding: 18px 15px;
    font-size: 13px;
    color: #111;
    font-weight: 500;
    border-bottom: 1px solid #F3F4F6;
    vertical-align: middle;
}

.rides-mini-table tbody tr:last-child td {
    border-bottom: none;
}

.pickup-cell {
    max-width: 200px;
    line-height: 1.4;
    color: #4B5563 !important;
}

.view-all-rides-link {
    color: #D10000;
    font-weight: 600;
    font-size: 14px;
    text-decoration: underline;
    transition: opacity 0.2s;
}
.view-all-rides-link:hover {
    opacity: 0.8;
    color: #D10000;
}
</style>

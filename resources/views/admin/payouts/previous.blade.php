<table class="table payouts-table">
    <thead>
        <tr>
            <th style="border-top-left-radius: 20px;">Name</th>
            <th>Unique ID</th>
            <th>Total Rides</th>
            <th>Total Amount</th>
            <th>Payout Date</th>
            <th style="border-top-right-radius: 20px;">Receipt</th>
        </tr>
    </thead>
    <tbody>
        @php
            $previousDrivers = [
                ['name' => 'Wade Warren', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=1'],
                ['name' => 'Jacob Jones', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=2'],
                ['name' => 'Bessie Cooper', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=3'],
                ['name' => 'Theresa Webb', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=4'],
                ['name' => 'Jerome Bell', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=5'],
                ['name' => 'Robert Fox', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=6'],
                ['name' => 'Kathryn Murphy', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=7'],
                ['name' => 'Savannah Nguyen', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=8'],
                ['name' => 'Floyd Miles', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=9'],
                ['name' => 'Devon Lane', 'id' => '#34567', 'rides' => '45', 'amount' => '$50.00', 'date' => '22 March 2025', 'img' => 'https://i.pravatar.cc/100?img=10'],
            ];
        @endphp

        @foreach($previousDrivers as $driver)
        <tr>
            <td>
                <div class="driver-info">
                    <img src="{{ $driver['img'] }}" class="driver-avatar" alt="{{ $driver['name'] }}">
                    <span>{{ $driver['name'] }}</span>
                </div>
            </td>
            <td class="unique-id">{{ $driver['id'] }}</td>
            <td>{{ $driver['rides'] }}</td>
            <td class="amount">{{ $driver['amount'] }}</td>
            <td>
                <span>{{ $driver['date'] }}</span>
                @if(in_array($loop->index, [0, 5]))
                    <span class="paid-badge">Paid</span>
                @endif
            </td>
            <td class="text-center">
                <i class="bi bi-file-earmark-pdf receipt-icon"></i>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

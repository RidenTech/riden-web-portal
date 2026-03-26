<div class="d-flex align-items-center gap-2 mb-4">
    <a href="{{ route('commission.index', ['section' => 'index']) }}" class="commission-back-arrow">
        <i class="bi bi-chevron-left"></i>
    </a>
    <h2 class="commission-setup-title">Set Commission</h2>
</div>

<div class="setup-table-container">
    <table class="setup-table">
        <thead>
            <tr>
                <th style="width: 30%;">Car Types</th>
                <th style="width: 50%;">Commission % per ride</th>
                <th style="width: 20%;"></th>
            </tr>
        </thead>
        <tbody>
            @php
                $carTypes = [
                    ['type' => 'Standard', 'percent' => '10%'],
                    ['type' => 'SUV', 'percent' => '20%'],
                    ['type' => 'Van', 'percent' => '30%'],
                    ['type' => 'Premium', 'percent' => '40%'],
                    ['type' => 'Wheelchair Accessible', 'percent' => '50%'],
                ];
            @endphp

            @foreach($carTypes as $car)
            <tr>
                <td class="car-type-cell">{{ $car['type'] }}</td>
                <td class="percent-cell">{{ $car['percent'] }}</td>
                <td class="text-end action-cell">
                    <button class="btn-save">Save Changes</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

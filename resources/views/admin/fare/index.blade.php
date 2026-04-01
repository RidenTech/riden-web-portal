@extends('admin.layout.master')

@section('title', 'Fare Management')

@section('no-sidebar')
    true
@endsection

@section('body-class', 'no-sidebar')

@push('styles')
    <link href="{{ asset('assets/css/fare.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 fare-wrapper">

        

  <!-- Main Content Layout -->
        <div class="fare-content-layout">
            
           
            <!-- Right Content Area -->
            <div class="fare-table-container">
                
                <div class="car-type-dropdown-wrapper">
                    <select class="car-type-select">
                        <option value="standard">Select Car Type</option>
                        <option value="suv">SUV</option>
                        <option value="van">Van</option>
                        <option value="premium">Premium</option>
                        <option value="wheelchair">Wheelchair Accessible</option>
                    </select>
                </div>

                <div class="table-responsive">
                    <table class="table fare-table">
                        <thead>
                            <tr>
                                <th>Days</th>
                                <th>Base Fare</th>
                                <th>Per KM Fare</th>
                                <th>Waiting (min/charges)</th>
                                <th>Night Time (From-To)</th>
                                <th>Night Charges</th>
                                <th>Peak Charges</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            @endphp
                            @foreach ($days as $day)
                            <tr>
                                <td>{{ $day }}</td>
                                <td>$200.00</td>
                                <td>$15.00</td>
                                <td>2 min / $3.00</td>
                                <td>10:00 PM - 6:00 AM</td>
                                <td>$50.00</td>
                                <td>$50.00</td>
                                <td>
                                    <button class="btn-save-changes">Save Changes</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

</div>
@endsection

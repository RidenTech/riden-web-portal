@extends('admin.layout.master')

@section('title', 'Manage Notifications')

@push('styles')
    <link href="{{ asset('assets/css/alerts.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 alerts-wrapper">
    <!-- Alerts Header -->
    <div class="alerts-header riden-list-header justify-content-between align-items-center">
        <div class="riden-search-bar">
            <div class="riden-search-icon">
                <i class="bi bi-search"></i>
            </div>
            <input type="text" placeholder="Search alerts...">
        </div>
        
        <div class="header-actions">
            <a href="{{ route('admin.alerts.send') }}" class="btn btn-send-alert text-decoration-none">
                <i class="bi bi-plus-square-fill"></i> Send Alert
            </a>
            <div class="date-picker-alerts">
                <i class="bi bi-calendar3"></i>
                <span>23/04/2025 - 23/04/2025</span>
            </div>
        </div>
    </div>

    <!-- Alerts Table -->
    <div class="alerts-table-container">
        <table class="table alerts-table">
            <thead>
                <tr>
                    <th style="border-top-left-radius: 30px;">Date</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th style="border-top-right-radius: 30px;">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $alerts = [
                        ['date' => '22 March 2025', 'title' => 'App Update', 'message' => 'Update your app for new features...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'Maintenance', 'message' => 'Scheduled maintenance tonight at...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'New Driver', 'message' => 'Welcome our newest driver to the...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'System Alert', 'message' => 'Server optimization process started...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'App Update', 'message' => 'Update your app for new features...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'Maintenance', 'message' => 'Scheduled maintenance tonight at...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'New Driver', 'message' => 'Welcome our newest driver to the...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'System Alert', 'message' => 'Server optimization process started...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'App Update', 'message' => 'Update your app for new features...', 'status' => 'Sent'],
                        ['date' => '22 March 2025', 'title' => 'Maintenance', 'message' => 'Scheduled maintenance tonight at...', 'status' => 'Sent'],
                    ];
                @endphp

                @foreach($alerts as $alert)
                <tr>
                    <td style="font-weight: 500;">{{ $alert['date'] }}</td>
                    <td style="font-weight: 500;">{{ $alert['title'] }}</td>
                    <td style="font-weight: 500;">{{ $alert['message'] }}</td>
                    <td>
                        <span class="status-badge sent">{{ $alert['status'] }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <ul class="pagination-alerts">
        <li><a href="#" class="page-btn-alerts"><i class="bi bi-chevron-left"></i></a></li>
        <li><a href="#" class="page-btn-alerts active">1</a></li>
        <li><a href="#" class="page-btn-alerts">2</a></li>
        <li><a href="#" class="page-btn-alerts">3</a></li>
        <li><span class="px-1 text-muted">...</span></li>
        <li><a href="#" class="page-btn-alerts">5</a></li>
        <li><a href="#" class="page-btn-alerts arrow-next"><i class="bi bi-chevron-right"></i></a></li>
    </ul>

</div>
@endsection

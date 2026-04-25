@extends('admin.layout.master')

@section('title', 'Support Ticket')

@push('styles')
    <link href="{{ asset('assets/css/support.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .riden-support-wrapper {
            padding: 20px;
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .support-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        .support-title {
            font-size: 24px;
            font-weight: 800;
            color: #000;
        }
        .riden-tabs-container {
            display: flex;
            background: #fff;
            border: 1px solid #FF2E2E;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 30px;
        }
        .riden-tab-item {
            flex: 1;
            text-align: center;
            padding: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: #FF2E2E;
        }
        .riden-tab-item.active {
            background: #FF2E2E;
            color: #fff;
        }
        .ticket-id {
            color: #000;
            font-weight: 700;
        }
        .status-badge {
            padding: 6px 15px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-transform: capitalize;
            border: none;
        }
        .status-pending {
            background: #FFEBEB;
            color: #FF2E2E;
        }
        .status-resolved, .status-solved {
            background: #EBFBF5;
            color: #2ED47E;
        }
        .status-rejected {
            background: #FFF0F0;
            color: #FF2E2E;
        }
        /* Detail Modal Info Cards */
        .info-card-riden {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #eee;
        }
        .info-card-title {
            font-size: 13px;
            text-transform: uppercase;
            font-weight: 800;
            color: #999;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            border-bottom: 1px dashed #eee;
            padding-bottom: 5px;
        }
        .info-row:last-child { border-bottom: none; }
        .info-key { color: #666; font-weight: 500; }
        .info-val { color: #000; font-weight: 800; }
        /* Modal Styles */
        .modal-riden .modal-content {
            border-radius: 20px;
            border: none;
            overflow: hidden;
        }
        .modal-riden .modal-header {
            background: #000;
            color: #fff;
            padding: 20px;
        }
        .modal-riden .modal-title {
            font-weight: 800;
        }
        .form-label-riden {
            font-weight: 700;
            color: #333;
            margin-bottom: 8px;
        }
        .form-control-riden {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #eee;
            background: #fcfcfc;
        }
        .btn-save-ticket {
            background: #FF2E2E;
            color: #fff;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 800;
            border: none;
            width: 100%;
        }
    </style>
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="col-12">
    <div class="riden-support-wrapper">
        
        <!-- Header Section -->
        <div class="support-header">
            <h2 class="support-title">Support Ticket</h2>
            <div class="header-actions d-flex align-items-center">
                <div class="riden-global-search mr-3" style="width: 300px;">
                    <form action="{{ route('admin.support.complaints.index') }}" method="GET">
                        <input type="hidden" name="tab" value="{{ $activeTab }}">
                        <div class="input-group-riden" style="background: #f5f5f5; border-radius: 50px; padding: 5px 20px; display: flex; align-items: center;">
                            <i class="bi bi-search text-muted mr-2"></i>
                            <input type="text" name="search" value="{{ request('search') }}" style="border:none; background:transparent; width: 100%; outline:none;" placeholder="Search by name, ID or phone">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- NEW HIGH-VISIBILITY BUTTON POSITION -->
        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-danger btn-lg shadow-sm" style="background: #FF2E2E; border: none; border-radius: 12px; font-weight: 800; padding: 15px 40px;" data-bs-toggle="modal" data-bs-target="#addTicketModal">
                <i class="bi bi-plus-circle-fill mr-2"></i> CREATE NEW TICKET
            </button>
        </div>

        <!-- Tabs -->
        <div class="riden-tabs-container">
            <a href="{{ route('admin.support.complaints.index', ['tab' => 'drivers']) }}" 
               class="riden-tab-item {{ $activeTab === 'drivers' ? 'active' : '' }}">
                Driver Complaints
            </a>
            <a href="{{ route('admin.support.complaints.index', ['tab' => 'passengers']) }}" 
               class="riden-tab-item {{ $activeTab === 'passengers' ? 'active' : '' }}">
                Passenger Complaints
            </a>
        </div>

        <!-- Table Area -->
        <div class="mt-2">
            @if($activeTab === 'drivers')
                @include('admin.support.complaints.drivers')
            @else
                @include('admin.support.complaints.passengers')
            @endif
        </div>

    </div>
</div>

<!-- Add Ticket Modal -->
<div class="modal fade modal-riden" id="addTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Support Ticket</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.support.complaints.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label-riden">Ticket For (Category)</label>
                            <select name="user_type" class="form-select form-control-riden" id="userTypeSelect" required>
                                <option value="driver" {{ $activeTab === 'drivers' ? 'selected' : '' }}>Driver Support</option>
                                <option value="passenger" {{ $activeTab === 'passengers' ? 'selected' : '' }}>Passenger Support</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label-riden">Complaint Type</label>
                            <select name="complaint_type" class="form-select form-control-riden" required>
                                <option value="Behavior Issue">Behavior Issue</option>
                                <option value="Fare Issue">Fare Issue</option>
                                <option value="Technical Problem">Technical Problem</option>
                                <option value="Safety Concern">Safety Concern</option>
                            </select>
                        </div>
                        
                        <div class="col-12 mb-3" id="driverSelectGroup">
                            <label class="form-label-riden">Select Driver Name</label>
                            <select name="driver_id" class="form-select form-control-riden">
                                <option value="">-- Search and Select Driver --</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->first_name }} {{ $driver->last_name }} (ID: {{ $driver->id }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-3 d-none" id="passengerSelectGroup">
                            <label class="form-label-riden">Select Passenger Name</label>
                            <select name="passenger_id" class="form-select form-control-riden">
                                <option value="">-- Search and Select Passenger --</option>
                                @foreach($passengers as $passenger)
                                    <option value="{{ $passenger->id }}">{{ $passenger->first_name }} {{ $passenger->last_name }} (ID: {{ $passenger->id }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label-riden">Support Content / Description</label>
                            <textarea name="description" class="form-control form-control-riden" rows="6" placeholder="Type the complaint or support request details here..."></textarea>
                        </div>

                        <input type="hidden" name="status" value="pending">
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="submit" class="btn-save-ticket">Save Ticket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Ticket Modal -->
<div class="modal fade modal-riden" id="viewTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ticket Details: <span id="view_ticket_id"></span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateTicketStatusForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body p-4">
                    <div class="row">
                        <!-- Driver/Passenger Profile Card -->
                        <div class="col-md-5">
                            <div class="info-card-riden h-100">
                                <div class="info-card-title" id="profile_title">User Profile</div>
                                <div class="info-row"><span class="info-key">Name:</span> <span class="info-val" id="view_user_name"></span></div>
                                <div class="info-row"><span class="info-key">Email:</span> <span class="info-val" id="view_user_email"></span></div>
                                <div class="info-row"><span class="info-key">Phone:</span> <span class="info-val" id="view_user_phone"></span></div>
                                <div class="info-row"><span class="info-key">Booking:</span> <span class="info-val" id="view_booking_id"></span></div>
                            </div>
                        </div>

                        <!-- Complaint Details -->
                        <div class="col-md-7">
                            <div class="info-card-riden h-100">
                                <div class="info-card-title">Complaint Details</div>
                                <div class="mb-3">
                                    <span class="badge bg-light text-dark p-2" id="view_complaint_type"></span>
                                </div>
                                <div id="view_description" style="max-height: 200px; overflow-y: auto; background: #fff; padding: 10px; border-radius: 8px; border: 1px solid #eee;"></div>
                            </div>
                        </div>

                        <!-- Status Update Section -->
                        <div class="col-12 mt-4">
                            <div class="p-3" style="background: #FFF5F5; border-radius: 15px;">
                                <label class="form-label-riden">Resolution Status</label>
                                <select name="status" id="view_status" class="form-select form-control-riden">
                                    <option value="pending">Pending</option>
                                    <option value="solved">Solved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4">
                    <button type="submit" class="btn-save-ticket">Update & Save Status</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<!-- Summernote JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote
        $('textarea[name="description"]').summernote({
            placeholder: 'Enter complaint details here...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        // Handle User Type Selection
        const userTypeSelect = document.getElementById('userTypeSelect');
        const driverGroup = document.getElementById('driverSelectGroup');
        const passengerGroup = document.getElementById('passengerSelectGroup');

        if(userTypeSelect) {
            userTypeSelect.addEventListener('change', function() {
                if (this.value === 'driver') {
                    driverGroup.classList.remove('d-none');
                    passengerGroup.classList.add('d-none');
                } else {
                    driverGroup.classList.add('d-none');
                    passengerGroup.classList.remove('d-none');
                }
            });
            userTypeSelect.dispatchEvent(new Event('change'));
        }

        // View Ticket Logic
        window.viewTicket = function(ticketData) {
            $('#view_ticket_id').text(ticketData.ticket_id);
            $('#view_user_name').text(ticketData.user_name);
            $('#view_user_email').text(ticketData.user_email);
            $('#view_user_phone').text(ticketData.user_phone);
            $('#view_booking_id').text('#' + (ticketData.booking_id || 'N/A'));
            $('#view_complaint_type').text(ticketData.complaint_type);
            $('#view_description').html(ticketData.description);
            $('#view_status').val(ticketData.status);
            $('#profile_title').text(ticketData.user_type === 'driver' ? 'Driver Profile' : 'Passenger Profile');
            
            // Set Form Action
            $('#updateTicketStatusForm').attr('action', '/admin/support-tickets/' + ticketData.id + '/status');
            
            // Show Modal
            $('#viewTicketModal').modal('show');
        };
    });
</script>
@endpush

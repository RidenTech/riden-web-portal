@extends('admin.layout.master')

@section('title', 'Complaint Detail')

@push('styles')
    <link href="{{ asset('assets/css/support.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 support-wrapper">
    <div class="support-main-card">
        
        <!-- Detail Header -->
        <div class="support-detail-header mb-4">
            <div class="d-flex align-items-center gap-3">
                <a href="{{ route('admin.support.complaints.index') }}" class="support-back-arrow text-decoration-none">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <h1 class="support-title mb-0">Complaint Type 1</h1>
            </div>
            
            <div class="d-flex align-items-center gap-3">
                <span class="status-label-top">Ticket ID: #123456</span>
                <button class="btn btn-mark-resolved">Mark as Resolved</button>
                <span class="status-badge resolved">Resolved</span>
            </div>
        </div>

        <div class="complaint-detail-container">
            <!-- User Message Section -->
            <div class="message-card user-message">
                <div class="message-header">
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://i.pravatar.cc/80?img=12" class="message-avatar" alt="User">
                        <div>
                            <h5 class="message-author">Alex Jhonas</h5>
                            <span class="message-time">22 March 2025 9:00pm</span>
                        </div>
                    </div>
                </div>
                <div class="message-body">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    
                    <div class="message-attachments mt-4">
                        <img src="{{ asset('assets/images/commission/rides.png') }}" class="attachment-img" alt="Attachment">
                        <img src="{{ asset('assets/images/commission/commission.png') }}" class="attachment-img" alt="Attachment">
                    </div>
                </div>

                <div class="message-footer text-end mt-3">
                    <button class="btn btn-reply-custom">Reply</button>
                </div>
            </div>

            <!-- Admin Response Section -->
            <div class="admin-response-section mt-5">
                <h4 class="section-title-custom mb-3"><i class="bi bi-reply-fill me-2"></i>Admin Response</h4>
                
                <div class="response-input-container">
                    <textarea class="form-control response-textarea" rows="6" placeholder="Write your response here..."></textarea>
                    
                    <div class="response-toolbar">
                        <div class="toolbar-icons">
                            <i class="bi bi-type-bold"></i>
                            <i class="bi bi-type-italic"></i>
                            <i class="bi bi-link-45deg"></i>
                            <i class="bi bi-card-image"></i>
                            <i class="bi bi-paperclip"></i>
                            <i class="bi bi-emoji-smile"></i>
                        </div>
                        <div class="toolbar-actions">
                            <button class="btn btn-send-custom">Send</button>
                            <button class="btn btn-cancel-custom">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@extends('admin.layout.master')

@section('title', 'CMS Management')

@push('styles')
    <link href="{{ asset('assets/css/cms.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12 cms-wrapper">
    <div class="cms-container">
       
        <!-- Top Actions -->
        <div class="cms-top-actions">
            <div class="dropdown">
                <button class="btn btn-select-page dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Select Page
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Legal</a></li>
                    <li><a class="dropdown-item" href="#">Help</a></li>
                    <li><a class="dropdown-item" href="#">FAQ's</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item btn-add-page-dropdown" href="#" data-bs-toggle="modal" data-bs-target="#addNewPageModal">
                            +Add New Page
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Page Title -->
        <input type="text" class="cms-page-title-input" placeholder="Page Title" value="Legal">

        <!-- Action Toolbar -->
        <button class="btn btn-add-media">
            <i class="bi bi-file-earmark-plus-fill"></i> Add Media
        </button>

        <!-- Rich Text Editor -->
        <div class="cms-editor-container">
            <div class="cms-editor-toolbar">
                <div class="toolbar-left">
                    <select class="paragraph-dropdown">
                        <option>Paragraph</option>
                    </select>
                    <div class="toolbar-item"><b>B</b></div>
                    <div class="toolbar-item"><i>I</i></div>
                    <div class="toolbar-item"><i class="bi bi-list-ul"></i></div>
                    <div class="toolbar-item"><i class="bi bi-list-ol"></i></div>
                    <div class="toolbar-item"><i class="bi bi-quote"></i></div>
                    <div class="toolbar-item"><i class="bi bi-text-left"></i></div>
                    <div class="toolbar-item"><i class="bi bi-text-center"></i></div>
                    <div class="toolbar-item"><i class="bi bi-text-right"></i></div>
                    <div class="toolbar-item"><i class="bi bi-link-45deg"></i></div>
                </div>
                <button class="btn btn-toolbar-edit">Edit</button>
            </div>

            <div class="cms-editor-body" contenteditable="true">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                <br>
                <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
            </div>
        </div>

        <!-- Bottom Actions -->
        <div class="editor-footer-actions">
            <button class="btn btn-editor-save">Save</button>
            <a href="#" class="btn btn-editor-cancel">Cancel</a>
        </div>

    </div>
</div>

<!-- Add New Page Modal -->
<div class="modal fade" id="addNewPageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-custom">
            <div class="modal-header modal-header-red">
                <h5 class="modal-title">Add New Page</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-custom">
                <div class="mb-3">
                    <label class="form-label fw-semibold small text-dark mb-2">Page Title</label>
                    <input type="text" class="form-control cms-page-title-input mb-0" placeholder="Enter Page Title" style="background-color: #f3f4f6; border: 1px solid #ddd;">
                </div>
            </div>
            <div class="modal-footer modal-footer-custom">
                <button type="button" class="btn btn-modal-save">Save</button>
                <button type="button" class="btn btn-modal-cancel" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

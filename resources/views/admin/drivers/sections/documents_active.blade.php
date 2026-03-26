<div class="driver-info-card documents-info-card">
    <div class="driver-info-card-header documents-header-style">
        <i class="bi bi-file-earmark-text-fill"></i>
        <h5>Documents</h5>
    </div>
    
    <div class="documents-list-container">
        @php
            $docs = [
                'Proof of work Eligibility',
                'Profile Photo',
                'Class 1, 2 or 4 Driver\'s Licence',
                'ICBC Commercial driving record',
                'Owner\'s certificate of insurance and vehicle registration',
                'Vehicle Inspection',
                'Legal Agreements'
            ];
        @endphp

        @foreach($docs as $doc)
        <div class="doc-item" onclick="openDocument('{{ $doc }}')">
            <div class="doc-info">
                <span class="doc-name">{{ $doc }}</span>
                <span class="doc-status status-approved-green">(Approved)</span>
            </div>
            <i class="bi bi-chevron-right doc-chevron"></i>
        </div>
        @endforeach
    </div>
</div>

<style>
.documents-header-style {
    background: #FF161F !important;
    color: white !important;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.documents-header-style i {
    color: white !important;
}

.documents-list-container {
    padding: 10px 0;
}

.doc-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 16px 25px;
    border-bottom: 1px solid #F3F4F6;
    cursor: pointer;
    transition: background 0.2s;
}

.doc-item:last-child {
    border-bottom: none;
}

.doc-item:hover {
    background: #F9FAFB;
}

.doc-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.doc-name {
    font-size: 15px;
    font-weight: 700;
    color: #111;
}

.doc-status {
    font-size: 14px;
    font-weight: 500;
}

.status-approved-green {
    color: #28a745 !important;
}

.doc-chevron {
    color: #9CA3AF;
    font-size: 14px;
}
</style>

<div class="driver-info-card">
    <div class="driver-info-card-header">
        <i class="bi bi-file-earmark-text-fill"></i>
        <h5>Documents</h5>
    </div>
    <div class="driver-documents-list">
        @php
            $docs = [
                'Proof of work Eligibility',
                'Profile Photo',
                'Class 1, 2 or 4 Driver’s Licence',
                'ICBC Commercial driving record',
                'Owner’s certificate of insurance and vehicle registration',
                'Vehicle Inspection',
                'Legal Agreements'
            ];
        @endphp

        @foreach($docs as $doc)
        <div class="doc-item" onclick="openDocument('{{ $doc }}')">
            <div class="doc-info">
                <span class="doc-name">{{ $doc }}</span>
                <span class="doc-status">(Pending)</span>
            </div>
            <i class="bi bi-chevron-right doc-chevron"></i>
        </div>
        @endforeach
    </div>
</div>

<style>
/* Original styles below */
.driver-documents-list {
    padding: 10px 0;
}
.doc-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 22px 30px;
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
.doc-name {
    font-size: 15px;
    font-weight: 700;
    color: #111;
}
.doc-status {
    font-size: 14px;
    color: #FF161F;
    margin-left: 5px;
    font-weight: 500;
}
.doc-chevron {
    color: #9CA3AF;
    font-size: 14px;
}
</style>

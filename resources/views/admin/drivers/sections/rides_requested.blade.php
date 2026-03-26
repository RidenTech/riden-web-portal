<div class="driver-info-card rides-info-card">
    <div class="driver-info-card-header rides-header-style">
        <i class="bi bi-truck"></i>
        <h5>All Rides</h5>
    </div>
    
    <div class="rides-content-container d-flex flex-column align-items-center justify-content-center p-5">
        <!-- No Data Illustration -->
        <div class="no-data-illustration-box mb-4">
            <img src="{{ asset('assets/images/no-data.png') }}?v={{ time() }}" 
                 class="no-data-img" alt="No Data">
        </div>

        <!-- No Data Text -->
        <div class="no-data-text text-center">
            <h5 class="text-muted fw-bold">No Data</h5>
        </div>
    </div>
</div>

<style>
.rides-header-style {
    background: #FF161F !important;
    color: white !important;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.rides-header-style i {
    color: white !important;
}

.rides-content-container {
    min-height: 400px;
}

.no-data-illustration-box {
    max-width: 400px;
    width: 100%;
}

.no-data-img {
    width: 100%;
    height: auto;
    object-fit: contain;
}

.no-data-text h5 {
    font-size: 22px;
    color: #9CA3AF !important;
}
</style>

<div class="driver-info-card vehicle-info-card">
    <div class="driver-info-card-header vehicle-header-style">
        <i class="bi bi-truck"></i>
        <h5>Vehicle Information</h5>
    </div>
    
    <div class="vehicle-profile-container">
        <!-- Vehicle Profile Image with Overlay -->
        <div class="vehicle-image-profile">
            <img src="{{ asset('assets/images/vehicle-alto.png') }}?v={{ time() }}" 
                 class="vehicle-img" alt="Black Suzuki Alto">
            <div class="vehicle-overlay-text">
                <h3>Black Suzuki Alto, (BKG-220)</h3>
            </div>
        </div>

        <!-- Vehicle Detailed Information -->
        <div class="vehicle-details-list">
            <div class="vehicle-detail-item">
                <div class="vehicle-detail-icon">
                    <i class="bi bi-car-front-fill"></i>
                </div>
                <div class="vehicle-detail-data">
                    <label>Vehicle Type</label>
                    <div class="value">Standard</div>
                </div>
            </div>
            
            <!-- Additional rows if needed for premium feel -->
            <div class="vehicle-detail-item">
                <div class="vehicle-detail-icon">
                    <i class="bi bi-palette-fill"></i>
                </div>
                <div class="vehicle-detail-data">
                    <label>Vehicle Color</label>
                    <div class="value">Black</div>
                </div>
            </div>

            <div class="vehicle-detail-item">
                <div class="vehicle-detail-icon">
                    <i class="bi bi-card-text"></i>
                </div>
                <div class="vehicle-detail-data">
                    <label>Registration Number</label>
                    <div class="value">BKG-220</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.vehicle-header-style {
    background: #D10000 !important;
    color: white !important;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.vehicle-header-style i {
    color: white !important;
}

.vehicle-profile-container {
    padding: 0;
}

.vehicle-image-profile {
    position: relative;
    width: 100%;
    height: 300px;
    overflow: hidden;
}

.vehicle-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.vehicle-overlay-text {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 40px 30px 20px 30px;
    background: linear-gradient(transparent, rgba(0,0,0,0.8));
    color: white;
}

.vehicle-overlay-text h3 {
    font-size: 24px;
    font-weight: 600;
    margin: 0;
}

.vehicle-details-list {
    padding: 20px 30px;
}

.vehicle-detail-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #F3F4F6;
}

.vehicle-detail-item:last-child {
    border-bottom: none;
}

.vehicle-detail-icon {
    width: 35px;
    height: 35px;
    background: #FFECEC;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.vehicle-detail-icon i {
    color: #D10000;
    font-size: 18px;
}

.vehicle-detail-data label {
    display: block;
    font-size: 12px;
    color: #6B7280;
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 2px;
}

.vehicle-detail-data .value {
    font-size: 15px;
    font-weight: 600;
    color: #111;
}
</style>

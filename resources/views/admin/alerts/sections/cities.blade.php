<div class="alert-section-card">
    <div class="section-title-bar">Select Cities</div>
    
    <div class="row">
        <div class="col-12 mb-3">
            <label class="form-label-custom">Select Cities</label>
            <div class="search-input-wrapper">
                <input type="text" class="form-control form-control-custom" placeholder="Select">
                <i class="bi bi-search search-icon-right"></i>
            </div>
        </div>
        
        <div class="col-12">
            <label class="form-label-custom">Selected Cities</label>
            <div class="city-checkbox-container">
                <div class="row">
                    @php
                        $cities = ['Vancouver', 'Richmond', 'Burnaby', 'New Westminster', 'Coquitlam', 'Delta'];
                    @endphp
                    @foreach($cities as $city)
                    <div class="col-md-4 mb-2">
                        <div class="city-checkbox-item">
                            <input class="form-check-input-custom" type="checkbox" value="{{ $city }}" id="city-{{ strtolower(str_replace(' ', '-', $city)) }}" checked>
                            <label class="form-check-label-custom" for="city-{{ strtolower(str_replace(' ', '-', $city)) }}">
                                {{ $city }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

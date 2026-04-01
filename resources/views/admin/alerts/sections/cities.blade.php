<div class="riden-addadmin-section my-2">Select Cities</div>

<div class="row g-2 mb-2">
    <div class="col-12">
        <label class="riden-field-label">Select Cities</label>
        <div class="position-relative">
            <input type="text" class="form-control riden-input pe-5" placeholder="Select">
            <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3 opacity-50"></i>
        </div>
    </div>
    
    <div class="col-12">
        <label class="riden-field-label">Selected Cities</label>
        <div class="riden-modules-grid mt-2">
            @php
                $cities = ['Vancouver', 'Richmond', 'Burnaby', 'New Westminster', 'Coquitlam', 'Delta'];
            @endphp
            @foreach($cities as $city)
            <div class="form-check custom-module-check">
                <input class="form-check-input" type="checkbox" value="{{ $city }}" id="city-{{ strtolower(str_replace(' ', '-', $city)) }}" checked>
                <label class="form-check-label ms-2" for="city-{{ strtolower(str_replace(' ', '-', $city)) }}">
                    {{ $city }}
                </label>
            </div>
            @endforeach
        </div>
    </div>
</div>

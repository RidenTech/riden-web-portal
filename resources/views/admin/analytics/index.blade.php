@extends('admin.layout.master')

@section('title', 'Analytics')

@push('styles')
    <link href="{{ asset('assets/css/analytics.css') }}?v={{ time() }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="col-12">

    <!-- Header & Filters (Using Bootstrap Flex Utilities) -->
    <div class="d-flex flex-wrap justify-start align-items-center py-2 gap-3">
        <div class="d-flex align-items-center gap-3">
            <select class="form-select border-1" style="border-radius: 8px; font-weight: 500; font-size: 13px; width: auto; color: #111;">
                <option>This Week</option>
                <option>This Month</option>
                <option>Last Year</option>
            </select>

            <div class="d-flex align-items-center gap-2">
                <span style="font-size: 13px; font-weight: 600; color: #000;">Custom</span>
                <div class="position-relative">
                    <i class="bi bi-calendar-event position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #D10000; font-size: 14px;"></i>
                    <input type="text" class="form-control" placeholder="From" style="padding-left: 36px; border-radius: 8px; font-size: 12px; width: 130px;">
                </div>
                <div class="position-relative">
                    <i class="bi bi-calendar-event position-absolute" style="left: 12px; top: 50%; transform: translateY(-50%); color: #D10000; font-size: 14px;"></i>
                    <input type="text" class="form-control" placeholder="To" style="padding-left: 36px; border-radius: 8px; font-size: 12px; width: 130px;">
                </div>
            </div>
        </div>
    </div>

    <!-- 4-Column KPI Row (Using Bootstrap Row/Col) -->
    <div class="row mx-0 mb-4 align-items-center" style="background: #FDF2F2; border-radius: 20px; padding: 24px 15px;">
        
        <div class="col-12 col-md-3 d-flex align-items-center position-relative">
            <div class="metric-icon-circle shadow-sm me-3 bg-white d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; border-radius: 50%;">
                <svg xmlns="http://www.w3.org/.svg" width="24" height="24" fill="#D10000" viewBox="0 0 16 16"><path d="M4 9a1 1 0 1 1-2 0 1 1 0 0 1 2 0m10 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0M1.5 14h13a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.16-.36l-3-2.73A1.5 1.5 0 0 0 10.82 5H5.18a1.5 1.5 0 0 0-1.02.46l-3 2.73a.5.5 0 0 0-.16.36V13.5a.5.5 0 0 0 .5.5m3.18-8h6.64l2.2 2H2.48z"/></svg>
            </div>
            <div>
                <div class="text-dark mb-1" style="font-size: 13px; font-weight: 500;">Total Rides</div>
                <div class="text-dark" style="font-size: 26px; font-weight: 600; line-height: 1;">243</div>
            </div>
            <!-- Bootstrap visual divider -->
            <div class="d-none d-md-block position-absolute" style="right: 0; top: 10%; height: 80%; width: 2px; background-color: #D10000;"></div>
        </div>

        <div class="col-12 col-md-3 d-flex align-items-center position-relative mt-3 mt-md-0">
            <div class="metric-icon-circle shadow-sm me-3 bg-white d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; border-radius: 50%;">
                <svg xmlns="http://www.w3.org/.svg" width="24" height="24" fill="#D10000" viewBox="0 0 16 16"><path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/></svg>
            </div>
            <div>
                <div class="text-dark mb-1" style="font-size: 13px; font-weight: 500;">Total Drivers</div>
                <div class="text-dark" style="font-size: 26px; font-weight: 600; line-height: 1;">243</div>
            </div>
            <div class="d-none d-md-block position-absolute" style="right: 0; top: 10%; height: 80%; width: 2px; background-color: #D10000;"></div>
        </div>

        <div class="col-12 col-md-3 d-flex align-items-center position-relative mt-3 mt-md-0">
            <div class="metric-icon-circle shadow-sm me-3 bg-white d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; border-radius: 50%;">
                <svg xmlns="http://www.w3.org/.svg" width="24" height="24" fill="#D10000" viewBox="0 0 16 16"><path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/><path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2z"/></svg>
            </div>
            <div>
                <div class="text-dark mb-1" style="font-size: 13px; font-weight: 500;">Total Revenue</div>
                <div class="text-dark" style="font-size: 26px; font-weight: 600; line-height: 1;">$1023.00</div>
            </div>
            <div class="d-none d-md-block position-absolute" style="right: 0; top: 10%; height: 80%; width: 2px; background-color: #D10000;"></div>
        </div>

        <div class="col-12 col-md-3 d-flex align-items-center mt-3 mt-md-0">
            <div class="metric-icon-circle shadow-sm me-3 bg-white d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; border-radius: 50%;">
                <svg xmlns="http://www.w3.org/.svg" width="24" height="24" fill="#D10000" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>
            </div>
            <div>
                <div class="text-dark mb-1" style="font-size: 13px; font-weight: 500;">Satisfaction Rate</div>
                <div class="text-dark" style="font-size: 26px; font-weight: 600; line-height: 1;">93%</div>
            </div>
        </div>

    </div>

    <!-- Red Tab Navigation (Fixing Bootstrap Style Overrides) -->
    <div class="analytics-nav-pill">
        <button id="btn-driver" onclick="switchTab('driver')" class="analytics-nav-item active-pill">Driver Analytics</button>
        <button id="btn-passenger" onclick="switchTab('passenger')" class="analytics-nav-item">Passengers Insights</button>
        <button id="btn-ride" onclick="switchTab('ride')" class="analytics-nav-item">Ride Analytics</button>
        <button id="btn-financial" onclick="switchTab('financial')" class="analytics-nav-item">Financial Metrics</button>
    </div>

    <!-- DRIVER ANALYTICS TAB CONTENT -->
    <div id="driver-analytics-tab">
        <!-- Driver Status Cards (Bootstrap Row/Col) -->
        <div class="row mb-4">
            <div class="col-12 col-md-6 mb-3 mb-md-0">
                <div class="card h-100 border-1 border-danger" style="border-radius: 20px; border-color: #D10000 !important; padding: 30px; position: relative; overflow: hidden; min-height: 150px;">
                    <h4 class="text-dark mb-2" style="font-size: 20px; font-weight: 500; position: relative; z-index: 2;">Active Drivers</h4>
                    <p class="text-dark m-0" style="font-size: 44px; font-weight: 600; line-height: 1; position: relative; z-index: 2;">210</p>
                    <img src="https://images.unsplash.com/photo-1552519507-da3b142c6e3d?q=80&w=300&auto=format&fit=crop" alt="Active Driver" class="position-absolute shadow" style="right: -10px; bottom: -10px; height: 110px; width: 140px; object-fit: cover; border-radius: 12px; z-index: 1;">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100 border-1 border-danger" style="border-radius: 20px; border-color: #D10000 !important; padding: 30px; position: relative; overflow: hidden; min-height: 150px;">
                    <h4 class="text-dark mb-2" style="font-size: 20px; font-weight: 500; position: relative; z-index: 2;">Offline Drivers</h4>
                    <p class="text-dark m-0" style="font-size: 44px; font-weight: 600; line-height: 1; position: relative; z-index: 2;">33</p>
                    <img src="https://images.unsplash.com/photo-1494976388531-d1058494cdd8?q=80&w=300&auto=format&fit=crop" alt="Offline Driver" class="position-absolute shadow" style="right: -10px; bottom: -10px; height: 110px; width: 140px; object-fit: cover; border-radius: 12px; z-index: 1;">
                </div>
            </div>
        </div>

        <!-- Charts Row (Bootstrap Row/Col) -->
        <div class="row">
            
            <!-- Avg. Driver Hours -->
            <div class="col-12 col-md-8 mb-4 mb-md-0">
                <div class="card h-100 border p-4 shadow-sm" style="border-radius: 20px;">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-dark m-0" style="font-size: 16px; font-weight: 600;">Avg. Driver Hours</h4>
                        <select class="form-select border-1" style="border-radius: 8px; width: 120px; font-size: 13px;">
                            <option>This Week</option>
                        </select>
                    </div>
                    
                    <div class="css-bar-chart">
                        <!-- Y-Axis -->
                        <div class="y-axis">
                            <span>10.0 hrs</span>
                            <span>7.5 hrs</span>
                            <span>5.0 hrs</span>
                            <span>2.5 hrs</span>
                            <span>0</span>
                        </div>
                        <div class="grid-lines">
                            <div class="grid-line"></div>
                            <div class="grid-line"></div>
                            <div class="grid-line"></div>
                            <div class="grid-line"></div>
                            <div class="grid-line"></div>
                        </div>
                        
                        <!-- X-Axis Bars -->
                        <div class="x-axis-bar" style="margin-left: 10px;">
                            <div class="bar-track"><div class="bar-column" style="height: 60%;"></div></div>
                            <span class="x-label">Monday</span>
                        </div>
                        <div class="x-axis-bar">
                            <div class="bar-track" style="position: relative;">
                                <div class="chart-tooltip">
                                    Tuesday<br><span style="color: #10B981">Driver Hours: 7 Hrs</span>
                                </div>
                                <div class="bar-column" style="height: 70%;"></div>
                            </div>
                            <span class="x-label">Tuesday</span>
                        </div>
                        <div class="x-axis-bar">
                            <div class="bar-track"><div class="bar-column" style="height: 55%;"></div></div>
                            <span class="x-label">Wednesday</span>
                        </div>
                        <div class="x-axis-bar">
                            <div class="bar-track"><div class="bar-column" style="height: 30%;"></div></div>
                            <span class="x-label">Thursday</span>
                        </div>
                        <div class="x-axis-bar">
                            <div class="bar-track"><div class="bar-column" style="height: 65%;"></div></div>
                            <span class="x-label">Friday</span>
                        </div>
                        <div class="x-axis-bar" style="margin-right: 15px;">
                            <div class="bar-track"><div class="bar-column" style="height: 70%;"></div></div>
                            <span class="x-label">Saturday</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ratings & Complaints Bubble Chart -->
            <div class="col-12 col-md-4">
                <div class="card h-100 border p-4 shadow-sm" style="border-radius: 20px;">
                    <h4 class="text-dark mb-4" style="font-size: 16px; font-weight: 600;">Ratings & Complaints</h4>
                    
                    <div class="ratings-legend mb-4">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <div class="rounded" style="width: 32px; height: 6px; background: #60A5FA;"></div>
                            <span style="font-size: 12px; font-weight: 600; color: #111;">Complaints <span style="font-weight: 600; color: #D10000;">25</span></span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded" style="width: 32px; height: 6px; background: #EC4899;"></div>
                            <span style="font-size: 12px; font-weight: 600; color: #111;">Ratings <span style="font-weight: 600; color: #10B981;">75%</span> (45)</span>
                        </div>
                    </div>

                    <div class="bubble-chart-area w-100" style="position: relative; height: 160px;">
                        <div class="bubble bubble-1"></div>
                        <div class="bubble bubble-2"></div>
                        <div class="bubble bubble-3"></div>
                        <div class="bubble bubble-4"></div>
                        <div class="bubble bubble-5"></div>
                        <div class="bubble bubble-6"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END DRIVER ANALYTICS TAB CONTENT -->

    <!-- PASSENGERS INSIGHTS TAB CONTENT -->
    @include('admin.analytics.passenger')
    <!-- END PASSENGERS INSIGHTS TAB CONTENT -->

    <!-- RIDE ANALYTICS TAB CONTENT -->
    @include('admin.analytics.ride')
    <!-- END RIDE ANALYTICS TAB CONTENT -->

    <!-- FINANCIAL METRICS TAB CONTENT -->
    @include('admin.analytics.financial')
    <!-- END FINANCIAL METRICS TAB CONTENT -->

</div>

@endsection

@push('scripts')
<script>
    /**
     * Analytics Tab Switcher
     * Toggles tab content without any route change.
     * @param {string} tabName - 'driver' | 'passenger' | 'ride'
     */
    function switchTab(tabName) {
        const tabs = {
            driver:    document.getElementById('driver-analytics-tab'),
            passenger: document.getElementById('passengers-insights-tab'),
            ride:      document.getElementById('ride-analytics-tab'),
            financial: document.getElementById('financial-metrics-tab'),
        };
        const buttons = {
            driver:    document.getElementById('btn-driver'),
            passenger: document.getElementById('btn-passenger'),
            ride:      document.getElementById('btn-ride'),
            financial: document.getElementById('btn-financial'),
        };

        // Hide all tabs & deactivate all buttons
        Object.values(tabs).forEach(tab => { if (tab) tab.style.display = 'none'; });
        Object.values(buttons).forEach(btn => { if (btn) btn.classList.remove('active-pill'); });

        // Show the requested tab & activate its button
        if (tabs[tabName])    tabs[tabName].style.display = 'block';
        if (buttons[tabName]) buttons[tabName].classList.add('active-pill');
    }
</script>
@endpush

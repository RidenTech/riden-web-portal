{{-- Ride Analytics Tab Content --}}
<div id="ride-analytics-tab" style="display: none;">

    {{-- =====================================================================
         ROW 1 – Three Metric Cards
    ====================================================================== --}}
    <div class="row mb-4 g-3">

        {{-- Ongoing Rides --}}
        <div class="col-12 col-md-4">
            <div class="ride-metric-card">
                <div class="ride-metric-text">
                    <span class="ride-metric-label">Ongoing Rides</span>
                    <span class="ride-metric-value">35</span>
                </div>
                <div class="ride-metric-icon">
                    {{-- Inline SVG: car with motion lines --}}
                    <svg viewBox="0 0 100 80" xmlns="http://www.w3.org/2000/svg" width="90" height="72">
                        {{-- Motion lines --}}
                        <line x1="0" y1="35" x2="22" y2="35" stroke="#FCA5A5" stroke-width="3" stroke-linecap="round"/>
                        <line x1="0" y1="46" x2="18" y2="46" stroke="#FCA5A5" stroke-width="3" stroke-linecap="round"/>
                        {{-- Car body --}}
                        <rect x="24" y="32" width="66" height="26" rx="7" fill="#D10000"/>
                        {{-- Roof --}}
                        <path d="M 40 32 Q 43 18 53 15 L 72 15 Q 82 18 84 32 Z" fill="#CC0008"/>
                        {{-- Windows --}}
                        <rect x="46" y="19" width="16" height="12" rx="3" fill="#BAE6FD" opacity="0.9"/>
                        <rect x="65" y="19" width="16" height="12" rx="3" fill="#BAE6FD" opacity="0.9"/>
                        {{-- Wheels --}}
                        <circle cx="40" cy="58" r="10" fill="#1F2937"/>
                        <circle cx="40" cy="58" r="5" fill="#6B7280"/>
                        <circle cx="76" cy="58" r="10" fill="#1F2937"/>
                        <circle cx="76" cy="58" r="5" fill="#6B7280"/>
                        {{-- Headlight --}}
                        <rect x="87" y="40" width="8" height="6" rx="2" fill="#FEF9C3"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Completed Rides --}}
        <div class="col-12 col-md-4">
            <div class="ride-metric-card">
                <div class="ride-metric-text">
                    <span class="ride-metric-label">Completed Rides</span>
                    <span class="ride-metric-value">1023</span>
                </div>
                <div class="ride-metric-icon">
                    {{-- Inline SVG: car with checkmark --}}
                    <svg viewBox="0 0 100 80" xmlns="http://www.w3.org/2000/svg" width="90" height="72">
                        {{-- Car body --}}
                        <rect x="8" y="32" width="66" height="26" rx="7" fill="#D10000"/>
                        {{-- Roof --}}
                        <path d="M 24 32 Q 27 18 37 15 L 56 15 Q 66 18 68 32 Z" fill="#CC0008"/>
                        {{-- Windows --}}
                        <rect x="30" y="19" width="16" height="12" rx="3" fill="#BAE6FD" opacity="0.9"/>
                        <rect x="49" y="19" width="16" height="12" rx="3" fill="#BAE6FD" opacity="0.9"/>
                        {{-- Wheels --}}
                        <circle cx="24" cy="58" r="10" fill="#1F2937"/>
                        <circle cx="24" cy="58" r="5" fill="#6B7280"/>
                        <circle cx="60" cy="58" r="10" fill="#1F2937"/>
                        <circle cx="60" cy="58" r="5" fill="#6B7280"/>
                        {{-- Green check badge --}}
                        <circle cx="82" cy="22" r="14" fill="#10B981"/>
                        <polyline points="74,22 80,29 92,15" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Cancelled Rides --}}
        <div class="col-12 col-md-4">
            <div class="ride-metric-card">
                <div class="ride-metric-text">
                    <span class="ride-metric-label">Cancelled Rides</span>
                    <span class="ride-metric-value">27</span>
                </div>
                <div class="ride-metric-icon">
                    {{-- Inline SVG: car with cancel/no-entry circle --}}
                    <svg viewBox="0 0 100 80" xmlns="http://www.w3.org/2000/svg" width="90" height="72">
                        {{-- Car body --}}
                        <rect x="8" y="32" width="66" height="26" rx="7" fill="#D10000"/>
                        {{-- Roof --}}
                        <path d="M 24 32 Q 27 18 37 15 L 56 15 Q 66 18 68 32 Z" fill="#CC0008"/>
                        {{-- Windows --}}
                        <rect x="30" y="19" width="16" height="12" rx="3" fill="#BAE6FD" opacity="0.9"/>
                        <rect x="49" y="19" width="16" height="12" rx="3" fill="#BAE6FD" opacity="0.9"/>
                        {{-- Wheels --}}
                        <circle cx="24" cy="58" r="10" fill="#1F2937"/>
                        <circle cx="24" cy="58" r="5" fill="#6B7280"/>
                        <circle cx="60" cy="58" r="10" fill="#1F2937"/>
                        <circle cx="60" cy="58" r="5" fill="#6B7280"/>
                        {{-- Red no-entry badge --}}
                        <circle cx="82" cy="22" r="14" fill="#D10000" stroke="#fff" stroke-width="2"/>
                        <line x1="72" y1="22" x2="92" y2="22" stroke="#fff" stroke-width="3.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- =====================================================================
         ROW 2 – Line Chart + Right Column (Peak Times + Cancellation)
    ====================================================================== --}}
    <div class="row g-3">

        {{-- Ride Volume Over Time (Line Chart) --}}
        <div class="col-12 col-md-8">
            <div class="card h-100 border shadow-sm p-4" style="border-radius: 20px;">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="m-0" style="font-size: 15px; font-weight: 600; color: #111;">Ride Volume Over Time</h4>
                    <select class="form-select" style="width: 120px; font-size: 12px; border-radius: 8px; border-color: #e5e7eb;">
                        <option>This Week</option>
                        <option>This Month</option>
                    </select>
                </div>

                {{-- Chart Wrapper --}}
                <div style="position: relative; height: 230px; padding-left: 48px;">

                    {{-- Y-Axis Values --}}
                    <div style="position:absolute;left:0;top:0;bottom:32px;width:40px;display:flex;flex-direction:column;justify-content:space-between;text-align:right;font-size:10px;color:#9CA3AF;">
                        <span>230</span>
                        <span>185</span>
                        <span>185</span>
                        <span>210</span>
                        <span>160</span>
                        <span>135</span>
                        <span>100</span>
                    </div>

                    {{-- SVG Line Chart --}}
                    <svg style="position:absolute;left:48px;right:0;top:0;bottom:32px;width:calc(100% - 48px);height:calc(100% - 32px);"
                         preserveAspectRatio="none" viewBox="0 0 700 190" xmlns="http://www.w3.org/2000/svg">

                        {{-- Horizontal Grid Lines --}}
                        <line x1="0" y1="0"   x2="700" y2="0"   stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="32"  x2="700" y2="32"  stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="64"  x2="700" y2="64"  stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="95"  x2="700" y2="95"  stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="127" x2="700" y2="127" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="160" x2="700" y2="160" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="190" x2="700" y2="190" stroke="#F3F4F6" stroke-width="1"/>

                        {{-- Filled area under curve --}}
                        <path d="M 10,80 C 50,60 80,130 150,90 C 220,50 260,100 330,120
                                   C 400,140 440,70 510,95 C 560,112 600,80 690,100
                                   L 690,190 L 10,190 Z"
                              fill="url(#rideGrad)" opacity="0.25"/>

                        {{-- Gradient definition --}}
                        <defs>
                            <linearGradient id="rideGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#D10000" stop-opacity="0.6"/>
                                <stop offset="100%" stop-color="#D10000" stop-opacity="0"/>
                            </linearGradient>
                        </defs>

                        {{-- Main Red Line --}}
                        <path d="M 10,80 C 50,60 80,130 150,90 C 220,50 260,100 330,120
                                   C 400,140 440,70 510,95 C 560,112 600,80 690,100"
                              fill="none" stroke="#D10000" stroke-width="3"
                              stroke-linecap="round" stroke-linejoin="round"
                              class="ride-chart-line"/>

                        {{-- Tooltip vertical dashed line at ~10 Aug --}}
                        <line x1="330" y1="0" x2="330" y2="190" stroke="#D1D5DB" stroke-width="1" stroke-dasharray="5,4"/>

                        {{-- Dot at peak (10 Aug) --}}
                        <circle cx="330" cy="120" r="5" fill="#D10000" stroke="#fff" stroke-width="2.5"/>
                    </svg>

                    {{-- Floating Tooltip (10 Aug) --}}
                    <div style="position:absolute;left:47%;top:10px;transform:translateX(-50%);
                                background:#fff;border:1px solid #FCA5A5;border-radius:10px;
                                padding:7px 12px;font-size:11px;box-shadow:0 4px 14px rgba(255,22,31,0.12);
                                white-space:nowrap;z-index:10;">
                        <div style="color:#6B7280;font-weight:600;">10 Aug</div>
                        <div style="color:#D10000;font-weight: 600;">Rides: <strong>143</strong></div>
                        {{-- Arrow --}}
                        <div style="position:absolute;bottom:-7px;left:50%;transform:translateX(-50%);
                                    width:0;height:0;border-left:7px solid transparent;
                                    border-right:7px solid transparent;border-top:7px solid #FCA5A5;"></div>
                    </div>

                    {{-- X-Axis Labels --}}
                    <div style="position:absolute;left:48px;right:0;bottom:0;
                                display:flex;justify-content:space-between;
                                font-size:11px;font-weight:500;color:#9CA3AF;">
                        <span>8 Aug</span>
                        <span>9 Aug</span>
                        <span>10 Aug</span>
                        <span>11 Aug</span>
                        <span>12 Aug</span>
                        <span>13 Aug</span>
                        <span>14 Aug</span>
                    </div>

                </div>
            </div>
        </div>

        {{-- Right Column: Peak Ride Times + Cancellation Rates --}}
        <div class="col-12 col-md-4">
            <div class="d-flex flex-column gap-3 h-100">

                {{-- Peak Ride Times --}}
                <div class="card border shadow-sm p-4" style="border-radius: 20px;">
                    <h4 class="m-0 mb-3" style="font-size: 15px; font-weight: 600; color: #111;">Peak Ride Times</h4>
                    <ul class="list-unstyled m-0" style="display:flex;flex-direction:column;gap:12px;">
                        <li class="d-flex align-items-center gap-3">
                            <span class="ride-peak-dot" style="background:#D10000;"></span>
                            <span style="font-size:13px;font-weight:600;color:#374151;">8–9 AM <span style="font-weight:400;color:#6B7280;">(Mon–Fri)</span></span>
                        </li>
                        <li class="d-flex align-items-center gap-3">
                            <span class="ride-peak-dot" style="background:#D10000;"></span>
                            <span style="font-size:13px;font-weight:600;color:#374151;">5–7 PM <span style="font-weight:400;color:#6B7280;">(All Days)</span></span>
                        </li>
                        <li class="d-flex align-items-center gap-3">
                            <span class="ride-peak-dot" style="background:#D10000;"></span>
                            <span style="font-size:13px;font-weight:600;color:#374151;">9–10 PM <span style="font-weight:400;color:#6B7280;">(Weekends)</span></span>
                        </li>
                    </ul>
                </div>

                {{-- Ride Cancellation Rates --}}
                <div class="card border shadow-sm p-4" style="border-radius: 20px; flex: 1;">
                    <h4 class="m-0 mb-4" style="font-size: 15px; font-weight: 600; color: #111;">Ride Cancellation Rates</h4>

                    {{-- By Passengers --}}
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span style="font-size:12px;font-weight:600;color:#374151;">By Passengers</span>
                            <span style="font-size:12px;font-weight: 600;color:#3B82F6;">75%</span>
                        </div>
                        <div style="height:8px;background:#EFF6FF;border-radius:99px;overflow:hidden;">
                            <div class="ride-bar-blue" style="width:75%;"></div>
                        </div>
                    </div>

                    {{-- By Drivers --}}
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span style="font-size:12px;font-weight:600;color:#374151;">By Drivers</span>
                            <span style="font-size:12px;font-weight: 600;color:#EC4899;">25%</span>
                        </div>
                        <div style="height:8px;background:#FDF2F8;border-radius:99px;overflow:hidden;">
                            <div class="ride-bar-pink" style="width:25%;"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</div>

{{-- ====================================================================
     Ride Analytics Styles (scoped, appended inline)
==================================================================== --}}
<style>
/* Metric Cards */
.ride-metric-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #fff;
    border: 1.5px solid #D10000;
    border-radius: 20px;
    padding: 22px 20px 10px 24px;
    min-height: 110px;
    overflow: hidden;
    position: relative;
}
.ride-metric-text {
    display: flex;
    flex-direction: column;
    gap: 6px;
    z-index: 2;
    position: relative;
}
.ride-metric-label {
    font-size: 14px;
    font-weight: 500;
    color: #374151;
}
.ride-metric-value {
    font-size: 40px;
    font-weight: 600;
    color: #111;
    line-height: 1;
}
.ride-metric-icon {
    flex-shrink: 0;
}

/* Peak dot bullet */
.ride-peak-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
    display: inline-block;
}

/* Progress bars */
.ride-bar-blue {
    height: 100%;
    border-radius: 99px;
    background: linear-gradient(90deg, #3B82F6 0%, #60A5FA 100%);
    animation: rideBarGrow 1s ease forwards;
    transform-origin: left;
}
.ride-bar-pink {
    height: 100%;
    border-radius: 99px;
    background: linear-gradient(90deg, #EC4899 0%, #F472B6 100%);
    animation: rideBarGrow 1s ease forwards 0.3s;
    transform-origin: left;
}
@keyframes rideBarGrow {
    from { width: 0 !important; }
}

/* Line chart animation */
.ride-chart-line {
    stroke-dasharray: 2000;
    stroke-dashoffset: 2000;
    animation: rideDash 2s ease forwards 0.2s;
}
@keyframes rideDash {
    to { stroke-dashoffset: 0; }
}
</style>

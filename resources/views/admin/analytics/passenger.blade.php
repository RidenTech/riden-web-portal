<div id="passengers-insights-tab" style="display: none;">

    <!-- Passenger Status Cards -->
    <div class="row mb-4">
        <!-- Total Passengers Card -->
        <div class="col-12 col-md-6 mb-3 mb-md-0">
            <div class="card h-100" style="border-radius: 20px; border: 1.5px solid #D10000; padding: 28px 28px 0 28px; position: relative; overflow: hidden; min-height: 155px; background: #fff;">
                <h4 style="font-size: 18px; font-weight: 600; color: #111; margin-bottom: 6px; position: relative; z-index: 2;">Total Passengers</h4>
                <p style="font-size: 44px; font-weight: 600; color: #111; line-height: 1; margin: 0; position: relative; z-index: 2;">1024</p>
                <!-- Inline SVG: Car with passengers (matches Figma vector style) -->
                <div class="position-absolute" style="right: 0; bottom: 0; width: 160px; height: 130px; z-index: 1;">
                    <svg viewBox="0 0 200 160" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <!-- Road -->
                        <rect x="0" y="120" width="200" height="40" fill="#FFF5F5" rx="0"/>
                        <!-- Car body -->
                        <rect x="20" y="78" width="140" height="48" rx="10" fill="#D10000"/>
                        <!-- Car roof -->
                        <path d="M 60 78 Q 65 50 85 46 L 125 46 Q 145 50 148 78 Z" fill="#E0000A"/>
                        <!-- Windows -->
                        <rect x="70" y="52" width="28" height="24" rx="4" fill="#B3E5FC" opacity="0.9"/>
                        <rect x="105" y="52" width="28" height="24" rx="4" fill="#B3E5FC" opacity="0.9"/>
                        <!-- Wheels -->
                        <circle cx="55" cy="126" r="18" fill="#222"/>
                        <circle cx="55" cy="126" r="10" fill="#bbb"/>
                        <circle cx="55" cy="126" r="4" fill="#444"/>
                        <circle cx="145" cy="126" r="18" fill="#222"/>
                        <circle cx="145" cy="126" r="10" fill="#bbb"/>
                        <circle cx="145" cy="126" r="4" fill="#444"/>
                        <!-- Headlight -->
                        <rect x="155" y="88" width="14" height="10" rx="3" fill="#FFF9C4"/>
                        <!-- Tail light -->
                        <rect x="10" y="88" width="14" height="10" rx="3" fill="#FF8A80"/>
                        <!-- Person 1 (driver silhouette) -->
                        <circle cx="84" cy="55" r="7" fill="#fff" opacity="0.7"/>
                        <path d="M78 62 Q84 56 90 62" stroke="#fff" stroke-width="2" fill="none" opacity="0.7"/>
                        <!-- Person 2 (passenger) -->
                        <circle cx="119" cy="55" r="7" fill="#fff" opacity="0.7"/>
                        <path d="M113 62 Q119 56 125 62" stroke="#fff" stroke-width="2" fill="none" opacity="0.7"/>
                    </svg>
                </div>
            </div>
        </div>
        <!-- Active Passengers Card -->
        <div class="col-12 col-md-6">
            <div class="card h-100" style="border-radius: 20px; border: 1.5px solid #D10000; padding: 28px 28px 0 28px; position: relative; overflow: hidden; min-height: 155px; background: #fff;">
                <h4 style="font-size: 18px; font-weight: 600; color: #111; margin-bottom: 6px; position: relative; z-index: 2;">Active Passengers</h4>
                <p style="font-size: 44px; font-weight: 600; color: #111; line-height: 1; margin: 0; position: relative; z-index: 2;">848</p>
                <!-- Inline SVG: Two people hailing a ride (Figma style) -->
                <div class="position-absolute" style="right: 0; bottom: 0; width: 160px; height: 130px; z-index: 1;">
                    <svg viewBox="0 0 200 160" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <!-- Ground -->
                        <rect x="0" y="130" width="200" height="30" fill="#FFF5F5"/>
                        <!-- Person 1 (woman, pink) -->
                        <circle cx="80" cy="48" r="18" fill="#FFCCBC"/>
                        <!-- Hair -->
                        <path d="M62 48 Q63 30 80 28 Q97 30 98 48" fill="#5D4037"/>
                        <!-- Body -->
                        <rect x="64" y="66" width="32" height="40" rx="10" fill="#EC407A"/>
                        <!-- Legs -->
                        <rect x="68" y="102" width="10" height="28" rx="5" fill="#FFCCBC"/>
                        <rect x="82" y="102" width="10" height="28" rx="5" fill="#FFCCBC"/>
                        <!-- Raised arm -->
                        <line x1="96" y1="72" x2="120" y2="55" stroke="#FFCCBC" stroke-width="8" stroke-linecap="round"/>
                        <!-- Hand -->
                        <circle cx="120" cy="54" r="6" fill="#FFCCBC"/>

                        <!-- Person 2 (man, darker) -->
                        <circle cx="140" cy="55" r="16" fill="#FFCCBC"/>
                        <!-- Hair -->
                        <path d="M124 55 Q126 39 140 37 Q154 39 156 55" fill="#333"/>
                        <!-- Body -->
                        <rect x="126" y="71" width="28" height="36" rx="10" fill="#1565C0"/>
                        <!-- Legs -->
                        <rect x="130" y="104" width="9" height="26" rx="5" fill="#37474F"/>
                        <rect x="143" y="104" width="9" height="26" rx="5" fill="#37474F"/>

                        <!-- Phone / App icon -->
                        <rect x="90" y="78" width="22" height="32" rx="4" fill="#fff" stroke="#D10000" stroke-width="2"/>
                        <circle cx="101" cy="94" r="8" fill="#D10000" opacity="0.2"/>
                        <circle cx="101" cy="94" r="4" fill="#D10000"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">

        <!-- Repeat Ride Ratio Line Chart -->
        <div class="col-12 col-md-8 mb-4 mb-md-0">
            <div class="card h-100 border shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="d-flex align-items-center gap-4">
                        <h4 class="text-dark m-0" style="font-size: 15px; font-weight: 600;">Repeat Ride Ratio</h4>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <div style="width: 28px; height: 3px; background: #3B82F6; border-radius: 2px;"></div>
                                <span style="font-size: 11px; font-weight: 600; color: #6B7280;">1 Time Ride</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <div style="width: 28px; height: 3px; background: #10B981; border-radius: 2px;"></div>
                                <span style="font-size: 11px; font-weight: 600; color: #6B7280;">Repeat Ride</span>
                            </div>
                        </div>
                    </div>
                    <select class="form-select" style="border-radius: 8px; width: 120px; font-size: 12px; border-color: #e5e7eb;">
                        <option>This Week</option>
                    </select>
                </div>

                <div style="position: relative; height: 230px; padding-left: 48px;">
                    <!-- Y-Axis Labels -->
                    <div style="position: absolute; left: 0; top: 0; bottom: 32px; width: 40px; display: flex; flex-direction: column; justify-content: space-between; text-align: right; font-size: 10px; color: #9CA3AF;">
                        <span>190</span>
                        <span>170</span>
                        <span>150</span>
                        <span>135</span>
                        <span>120</span>
                    </div>

                    <!-- SVG Chart Area -->
                    <svg style="position: absolute; left: 48px; right: 0; top: 0; bottom: 32px; width: calc(100% - 48px); height: calc(100% - 32px);" preserveAspectRatio="none" viewBox="0 0 700 190" xmlns="http://www.w3.org/2000/svg">
                        <!-- Grid Lines -->
                        <line x1="0" y1="0" x2="700" y2="0" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="47" x2="700" y2="47" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="95" x2="700" y2="95" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="142" x2="700" y2="142" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="190" x2="700" y2="190" stroke="#F3F4F6" stroke-width="1"/>

                        <!-- Blue Line (1 Time Ride) - animates in -->
                        <path d="M 10,130 C 60,130 90,30 170,50 C 250,70 280,140 350,135 C 420,130 460,40 550,55 C 600,62 640,140 690,20"
                              fill="none" stroke="#3B82F6" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                              class="passenger-chart-line-blue"/>

                        <!-- Green Line (Repeat Ride) -->
                        <path d="M 10,170 C 80,168 120,155 200,160 C 280,165 310,150 380,145 C 450,140 490,165 570,130 C 630,115 660,135 690,140"
                              fill="none" stroke="#10B981" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"
                              class="passenger-chart-line-green"/>

                        <!-- Tooltip vertical dashed line at ~Aug position -->
                        <line x1="350" y1="0" x2="350" y2="190" stroke="#D1D5DB" stroke-width="1" stroke-dasharray="5,4"/>

                        <!-- Dot on blue line at Aug -->
                        <circle cx="350" cy="135" r="5" fill="#3B82F6" stroke="#fff" stroke-width="2"/>
                        <!-- Dot on green line at Aug -->
                        <circle cx="380" cy="145" r="5" fill="#10B981" stroke="#fff" stroke-width="2"/>
                    </svg>

                    <!-- Floating Tooltip (Aug) -->
                    <div style="position: absolute; left: 50%; top: 20px; transform: translateX(-50%); background: #fff; border: 1px solid #FCA5A5; border-radius: 10px; padding: 8px 12px; font-size: 11px; box-shadow: 0 4px 14px rgba(255,22,31,0.12); white-space: nowrap; z-index: 10;">
                        <div style="color: #3B82F6; font-weight: 600;">1 Time Ride: <strong>215</strong></div>
                        <div style="color: #10B981; font-weight: 600;">Repeat Ride: <strong>340</strong></div>
                        <div style="color: #D10000; font-weight: 600;">Ratio: <strong>41.3%</strong></div>
                        <!-- Arrow -->
                        <div style="position: absolute; bottom: -7px; left: 50%; transform: translateX(-50%); width: 0; height: 0; border-left: 7px solid transparent; border-right: 7px solid transparent; border-top: 7px solid #FCA5A5;"></div>
                    </div>

                    <!-- X-Axis Labels -->
                    <div style="position: absolute; left: 48px; right: 0; bottom: 0; display: flex; justify-content: space-between; font-size: 11px; font-weight: 500; color: #9CA3AF;">
                        <span>June</span>
                        <span>July</span>
                        <span>Aug</span>
                        <span>Sep</span>
                        <span>Oct</span>
                        <span>Nov</span>
                        <span>Dec</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ratings & Complaints Bubble Chart -->
        <div class="col-12 col-md-4">
            <div class="card h-100 border shadow-sm p-4" style="border-radius: 20px;">
                <h4 class="text-dark mb-3" style="font-size: 15px; font-weight: 600;">Ratings &amp; Complaints</h4>

                <div class="d-flex align-items-center gap-3 mb-2">
                    <div style="width: 28px; height: 4px; background: #60A5FA; border-radius: 2px;"></div>
                    <span style="font-size: 12px; font-weight: 600; color: #111;">Complaints <span style="color: #D10000; font-weight: 600;">25</span></span>
                </div>
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div style="width: 28px; height: 4px; background: #EC4899; border-radius: 2px;"></div>
                    <span style="font-size: 12px; font-weight: 600; color: #111;">Ratings <span style="color: #10B981; font-weight: 600;">75%</span> (45)</span>
                </div>

                <div class="bubble-chart-area w-100" style="position: relative; height: 180px;">
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

<style>
/* Passenger line chart animation */
.passenger-chart-line-blue {
    stroke-dasharray: 1200;
    stroke-dashoffset: 1200;
    animation: passengerDash 1.8s ease forwards 0.3s;
}
.passenger-chart-line-green {
    stroke-dasharray: 1200;
    stroke-dashoffset: 1200;
    animation: passengerDash 1.8s ease forwards 0.6s;
}
@keyframes passengerDash {
    to { stroke-dashoffset: 0; }
}
</style>

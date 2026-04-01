{{-- Financial Metrics Tab Content --}}
<div id="financial-metrics-tab" style="display: none;">

    {{-- =====================================================================
         ROW 1 – Refunds/Chargebacks  |  Commission
    ====================================================================== --}}
    <div class="row mb-4 g-3">

        {{-- Refunds / Chargebacks --}}
        <div class="col-12 col-md-6">
            <div class="fin-card" style="min-height: 140px;">
                <div style="flex: 1; z-index: 2; position: relative;">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        {{-- Refund icon (inline SVG) --}}
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 14l-4-4 4-4" stroke="#D10000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M5 10h11a4 4 0 0 1 0 8h-1" stroke="#D10000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="fin-card-title">Refunds / Chargebacks</span>
                    </div>
                    <div style="color: #D10000; font-size: 15px; font-weight: 600; margin-bottom: 4px;">32 Rides Refunded</div>
                    <div style="color: #6B7280; font-size: 13px; font-weight: 500;">2.3% of Total Rides</div>
                </div>
                {{-- Inline SVG illustration: refund/money --}}
                <div style="position: absolute; right: 0; bottom: 0; width: 130px; height: 110px; z-index: 1;">
                    <svg viewBox="0 0 140 120" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        {{-- Background circle --}}
                        <circle cx="95" cy="65" r="45" fill="#FFF5F5"/>
                        {{-- Money bag --}}
                        <ellipse cx="88" cy="80" rx="26" ry="22" fill="#D10000"/>
                        <rect x="78" y="58" width="20" height="16" rx="6" fill="#CC0008"/>
                        {{-- $ sign --}}
                        <text x="82" y="85" font-size="22" fill="#fff" font-weight="600" font-family="Arial">$</text>
                        {{-- Arrow back --}}
                        <path d="M 50 55 C 50 35 75 30 90 42" stroke="#D10000" stroke-width="3" fill="none" stroke-dasharray="5,3" marker-end="url(#arr)"/>
                        <defs>
                            <marker id="arr" markerWidth="8" markerHeight="8" refX="4" refY="4" orient="auto">
                                <path d="M0,0 L8,4 L0,8 Z" fill="#D10000"/>
                            </marker>
                        </defs>
                        {{-- Small x badge --}}
                        <circle cx="55" cy="42" r="12" fill="#FEE2E2" stroke="#D10000" stroke-width="1.5"/>
                        <line x1="50" y1="37" x2="60" y2="47" stroke="#D10000" stroke-width="2.5" stroke-linecap="round"/>
                        <line x1="60" y1="37" x2="50" y2="47" stroke="#D10000" stroke-width="2.5" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Commission Breakdown --}}
        <div class="col-12 col-md-6">
            <div class="fin-card" style="min-height: 140px;">
                <div style="flex: 1; z-index: 2; position: relative;">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        {{-- Commission icon --}}
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2" y="7" width="20" height="14" rx="3" stroke="#D10000" stroke-width="2"/>
                            <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2" stroke="#D10000" stroke-width="2"/>
                            <line x1="12" y1="12" x2="12" y2="16" stroke="#D10000" stroke-width="2" stroke-linecap="round"/>
                            <line x1="10" y1="14" x2="14" y2="14" stroke="#D10000" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                        <span class="fin-card-title">Commission</span>
                    </div>
                    <div class="fin-commission-row">
                        <span class="fin-commission-label">Revenue</span>
                        <span class="fin-commission-amount">$1,200,000</span>
                    </div>
                    <div class="fin-commission-row">
                        <span class="fin-commission-label">Drivers</span>
                        <span class="fin-commission-amount">$870,000</span>
                    </div>
                    <div class="fin-commission-row">
                        <span class="fin-commission-label">Commission</span>
                        <span class="fin-commission-amount" style="color: #10B981;">$330,000 <span style="font-size: 12px; font-weight: 600;">(27.5%)</span></span>
                    </div>
                </div>
                {{-- Inline SVG illustration: person with coins --}}
                <div style="position: absolute; right: 0; bottom: 0; width: 120px; height: 120px; z-index: 1;">
                    <svg viewBox="0 0 130 130" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%">
                        <circle cx="90" cy="70" r="40" fill="#FFF5F5"/>
                        {{-- Person --}}
                        <circle cx="80" cy="45" r="16" fill="#FFCCBC"/>
                        <path d="M64 45 Q65 32 80 30 Q95 32 96 45" fill="#5D4037"/>
                        <rect x="66" y="61" width="28" height="35" rx="10" fill="#D10000"/>
                        {{-- Coins floating --}}
                        <circle cx="106" cy="50" r="10" fill="#FCD34D" stroke="#F59E0B" stroke-width="1.5"/>
                        <text x="101" y="54" font-size="10" fill="#92400E" font-weight="600">$</text>
                        <circle cx="118" cy="68" r="8" fill="#FCD34D" stroke="#F59E0B" stroke-width="1.5"/>
                        <text x="114" y="72" font-size="9" fill="#92400E" font-weight="600">$</text>
                        <circle cx="108" cy="85" r="7" fill="#FCD34D" stroke="#F59E0B" stroke-width="1.5"/>
                        <text x="104" y="89" font-size="8" fill="#92400E" font-weight="600">$</text>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- =====================================================================
         ROW 2 – Commission Trend Line Chart  |  Payment Method Donut
    ====================================================================== --}}
    <div class="row g-3">

        {{-- Commission Trend (Line Chart) --}}
        <div class="col-12 col-md-8">
            <div class="card h-100 border shadow-sm p-4" style="border-radius: 20px;">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="m-0" style="font-size: 15px; font-weight: 600; color: #111;">Commission Trend</h4>
                    <select class="form-select" style="width: 120px; font-size: 12px; border-radius: 8px; border-color: #e5e7eb;">
                        <option>This Week</option>
                        <option>This Month</option>
                    </select>
                </div>

                <div style="position: relative; height: 220px; padding-left: 58px;">

                    {{-- Y-Axis --}}
                    <div style="position:absolute;left:0;top:0;bottom:28px;width:52px;display:flex;flex-direction:column;justify-content:space-between;text-align:right;font-size:10px;color:#9CA3AF;">
                        <span>$50,000</span>
                        <span>$20,000</span>
                        <span>$10,000</span>
                        <span>$0.00</span>
                    </div>

                    {{-- SVG Line Chart --}}
                    <svg style="position:absolute;left:58px;right:0;top:0;bottom:28px;width:calc(100% - 58px);height:calc(100% - 28px);"
                         preserveAspectRatio="none" viewBox="0 0 700 180" xmlns="http://www.w3.org/2000/svg">

                        {{-- Grid Lines --}}
                        <line x1="0" y1="0"   x2="700" y2="0"   stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="60"  x2="700" y2="60"  stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="120" x2="700" y2="120" stroke="#F3F4F6" stroke-width="1"/>
                        <line x1="0" y1="180" x2="700" y2="180" stroke="#F3F4F6" stroke-width="1"/>

                        {{-- Area fill under line --}}
                        <path d="M 10,160 C 60,140 100,60 170,80 C 240,100 280,50 360,70
                                   C 430,88 480,130 550,100 C 600,80 640,120 690,110
                                   L 690,180 L 10,180 Z"
                              fill="url(#finGrad)" opacity="0.25"/>

                        <defs>
                            <linearGradient id="finGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#D10000" stop-opacity="0.7"/>
                                <stop offset="100%" stop-color="#D10000" stop-opacity="0"/>
                            </linearGradient>
                        </defs>

                        {{-- Main Red Line --}}
                        <path d="M 10,160 C 60,140 100,60 170,80 C 240,100 280,50 360,70
                                   C 430,88 480,130 550,100 C 600,80 640,120 690,110"
                              fill="none" stroke="#D10000" stroke-width="3"
                              stroke-linecap="round" stroke-linejoin="round"
                              class="fin-chart-line"/>

                        {{-- Tooltip dashed line at Tuesday peak --}}
                        <line x1="170" y1="0" x2="170" y2="180" stroke="#D1D5DB" stroke-width="1" stroke-dasharray="5,4"/>

                        {{-- Dot at Tuesday --}}
                        <circle cx="170" cy="80" r="5" fill="#D10000" stroke="#fff" stroke-width="2.5"/>
                    </svg>

                    {{-- Floating Tooltip --}}
                    <div style="position:absolute;left:24%;top:16px;transform:translateX(-50%);
                                background:#fff;border:1px solid #FCA5A5;border-radius:10px;
                                padding:6px 12px;font-size:11px;box-shadow: 0 4px 14px rgba(255,22,31,0.12);
                                white-space:nowrap;z-index:10;">
                        <div style="color:#D10000;font-weight: 600;">$23,000</div>
                        <div style="position:absolute;bottom:-7px;left:50%;transform:translateX(-50%);
                                    width:0;height:0;border-left:7px solid transparent;
                                    border-right:7px solid transparent;border-top:7px solid #FCA5A5;"></div>
                    </div>

                    {{-- X-Axis Labels --}}
                    <div style="position:absolute;left:58px;right:0;bottom:0;
                                display:flex;justify-content:space-between;
                                font-size:11px;font-weight:500;color:#9CA3AF;">
                        <span>Monday</span>
                        <span>Tuesday</span>
                        <span>Wednesday</span>
                        <span>Thursday</span>
                        <span>Friday</span>
                        <span>Saturday</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Payment Method (Donut Chart) --}}
        <div class="col-12 col-md-4">
            <div class="card h-100 border shadow-sm p-4 d-flex flex-column" style="border-radius: 20px;">
                <h4 class="m-0 mb-4" style="font-size: 15px; font-weight: 600; color: #111;">Payment Method</h4>

                {{-- Legend --}}
                <div class="d-flex flex-column gap-2 mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <span class="fin-legend-dot" style="background: #D10000;"></span>
                        <span style="font-size: 13px; font-weight: 600; color: #374151;">Card <span style="color: #6B7280; font-weight: 500;">65%</span></span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="fin-legend-dot" style="background: #1F2937;"></span>
                        <span style="font-size: 13px; font-weight: 600; color: #374151;">Wallet <span style="color: #6B7280; font-weight: 500;">20%</span></span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="fin-legend-dot" style="background: #D1D5DB;"></span>
                        <span style="font-size: 13px; font-weight: 600; color: #374151;">Apple Pay <span style="color: #6B7280; font-weight: 500;">10%</span></span>
                    </div>
                </div>

                {{-- Donut Chart (Pure SVG) --}}
                <div class="d-flex justify-content-center align-items-center flex-grow-1">
                    <svg width="160" height="160" viewBox="0 0 160 160" xmlns="http://www.w3.org/2000/svg">
                        {{--
                            Circle circumference = 2 * π * 54 ≈ 339.3
                            Card 65%    → dash: 220.5  offset: 0
                            Wallet 20%  → dash: 67.9   offset: 220.5  (gap = 339.3 - 220.5 = 118.8)
                            ApplePay10% → dash: 33.9   offset: 220.5 + 67.9 = 288.4
                        --}}
                        {{-- Background ring --}}
                        <circle cx="80" cy="80" r="54" fill="none" stroke="#F3F4F6" stroke-width="22"/>

                        {{-- Segment: Card 65% (Red) --}}
                        <circle cx="80" cy="80" r="54"
                                fill="none" stroke="#D10000" stroke-width="22"
                                stroke-dasharray="220.5 339.3"
                                stroke-dashoffset="0"
                                stroke-linecap="butt"
                                transform="rotate(-90 80 80)"
                                class="fin-donut-seg"/>

                        {{-- Segment: Wallet 20% (Dark) --}}
                        <circle cx="80" cy="80" r="54"
                                fill="none" stroke="#1F2937" stroke-width="22"
                                stroke-dasharray="67.9 339.3"
                                stroke-dashoffset="-220.5"
                                stroke-linecap="butt"
                                transform="rotate(-90 80 80)"
                                class="fin-donut-seg"/>

                        {{-- Segment: Apple Pay 10% (Light gray) --}}
                        <circle cx="80" cy="80" r="54"
                                fill="none" stroke="#D1D5DB" stroke-width="22"
                                stroke-dasharray="33.9 339.3"
                                stroke-dashoffset="-288.4"
                                stroke-linecap="butt"
                                transform="rotate(-90 80 80)"
                                class="fin-donut-seg"/>

                        {{-- Centre label --}}
                        <text x="80" y="76" text-anchor="middle" font-size="13" font-weight="600" fill="#111" font-family="Inter,Arial,sans-serif">Total</text>
                        <text x="80" y="92" text-anchor="middle" font-size="11" fill="#6B7280" font-family="Inter,Arial,sans-serif">Payments</text>
                    </svg>
                </div>

            </div>
        </div>

    </div>

</div>

{{-- ====================================================================
     Financial Metrics Styles (scoped, inline)
==================================================================== --}}
<style>
/* Shared card base */
.fin-card {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    background: #fff;
    border: 1.5px solid #D10000;
    border-radius: 20px;
    padding: 24px 24px 14px 24px;
    position: relative;
    overflow: hidden;
    height: 100%;
}
.fin-card-title {
    font-size: 16px;
    font-weight: 600;
    color: #111;
}

/* Commission breakdown rows */
.fin-commission-row {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 6px;
}
.fin-commission-label {
    font-size: 13px;
    font-weight: 500;
    color: #6B7280;
    width: 80px;
}
.fin-commission-amount {
    font-size: 14px;
    font-weight: 600;
    color: #111;
}

/* Legend dots */
.fin-legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    flex-shrink: 0;
    display: inline-block;
}

/* Animated line chart */
.fin-chart-line {
    stroke-dasharray: 2000;
    stroke-dashoffset: 2000;
    animation: finDash 2s ease forwards 0.2s;
}
@keyframes finDash {
    to { stroke-dashoffset: 0; }
}

/* Animated donut segments */
.fin-donut-seg {
    transition: stroke-dasharray 1s ease;
    animation: finDonut 1.2s ease forwards;
}
@keyframes finDonut {
    from { opacity: 0; }
    to   { opacity: 1; }
}
</style>

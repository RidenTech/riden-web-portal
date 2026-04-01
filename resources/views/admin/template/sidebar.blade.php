@php
    $menu = [
        ['label' => 'Dashboard', 'icon' => 'bi bi-house-door', 'url' => route('dashboard')],
        ['label' => 'Analytics/Stats', 'icon' => 'bi bi-bar-chart', 'url' => route('analytics.index')],
        ['label' => 'Admin Roles', 'icon' => 'bi bi-person', 'url' => route('admin.roles.index')],
        ['label' => 'Driver Management', 'icon' => 'bi bi-person-badge', 'url' => route('drivers.directory')],
        ['label' => 'Passenger Management', 'icon' => 'bi bi-people', 'url' => route('passenger.management')],
        ['label' => 'Vehicle Management', 'icon' => 'bi bi-truck', 'url' => '#'],
        ['label' => 'Booking Management', 'icon' => 'bi bi-calendar-check', 'url' => route('booking.management')],
        ['label' => 'Reviews & Ratings', 'icon' => 'bi bi-star', 'url' => route('reviews.ratings')],
        ['label' => 'Promo code Management', 'icon' => 'bi bi-tag', 'url' => route('promo.index')],
        ['label' => 'Fare Management', 'icon' => 'bi bi-cash-coin', 'url' => route('fare.management')],
        ['label' => 'Commission Management', 'icon' => 'bi bi-percent', 'url' => route('commission.index')],
        ['label' => 'Payments', 'icon' => 'bi bi-credit-card', 'url' => route('payouts.drivers')],
        ['label' => 'Report Management', 'icon' => 'bi bi-file-earmark-text', 'url' => '#'],
        ['label' => 'Reports', 'icon' => 'bi bi-file-earmark-text', 'url' => '#'],
        ['label' => 'Support Ticket', 'icon' => 'bi bi-life-preserver', 'url' => route('support.complaints.index')],
        ['label' => 'Manage Notifications', 'icon' => 'bi bi-bell', 'url' => route('alerts.index')],
        ['label' => 'CMS Management', 'icon' => 'bi bi-window', 'url' => route('cms.index')],
    ];
@endphp

<!-- Desktop / Tablet sidebar -->
<aside class="riden-sidebar d-none d-md-flex" aria-label="Sidebar navigation">
    <div class="riden-sidebar__inner">
        <button type="button" class="riden-sidebar__collapsebtn" aria-label="Collapse sidebar" data-riden-sidebar-toggle>
                <i class="bi bi-list"></i>
            </button>
        <div class="riden-sidebar__top">
            <a href="{{ url('/') }}" class="riden-sidebar__brand" aria-label="Riden">
                <span class="riden-sidebar__brand-text font-500">RIDEN</span>
            </a>
            
        </div>

        <nav class="riden-sidebar__nav">
            @foreach ($menu as $item)
                @php
                    $isActive = $item['url'] !== '#' && (
                        $item['label'] === 'Dashboard' 
                        ? request()->url() == $item['url'] 
                        : (request()->url() == $item['url'] || str_starts_with(request()->url(), $item['url'] . '/'))
                    );
                @endphp
                <a href="{{ $item['url'] }}"
                   class="riden-sidebar__link {{ $isActive ? 'is-active' : '' }}"
                   title="{{ $item['label'] }}"
                   {{ $item['url'] === '#' ? 'aria-disabled=true' : '' }}>
                    <i class="{{ $item['icon'] }} riden-sidebar__icon" aria-hidden="true"></i>
                    <span class="riden-sidebar__label">{{ $item['label'] }}</span>
                </a>
            @endforeach
        </nav>

        <div class="riden-sidebar__footer mt-auto">
            <a href="#"
               class="riden-sidebar__link riden-sidebar__logout"
               title="Logout">
                <i class="bi bi-box-arrow-right riden-sidebar__icon" aria-hidden="true"></i>
                <span class="riden-sidebar__label">Logout</span>
            </a>
        </div>
    </div>
</aside>

{{-- <!-- Mobile offcanvas sidebar -->
<div class="offcanvas offcanvas-start riden-sidebar__offcanvas d-md-none" tabindex="-1" id="ridenSidebarOffcanvas" aria-labelledby="ridenSidebarOffcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="ridenSidebarOffcanvasLabel">RIDEN</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0">
        <nav class="riden-sidebar__nav p-3">
            @foreach ($menu as $item)
                <a href="{{ $item['url'] }}"
                   class="riden-sidebar__link"
                   {{ $item['url'] === '#' ? 'aria-disabled=true' : '' }}>
                    <i class="{{ $item['icon'] }} riden-sidebar__icon" aria-hidden="true"></i>
                    <span class="riden-sidebar__label">{{ $item['label'] }}</span>
                </a>
            @endforeach
            <div class="mt-3 pt-3 border-top border-light-subtle">
                <a href="#" class="riden-sidebar__link riden-sidebar__logout">
                    <i class="bi bi-box-arrow-right riden-sidebar__icon" aria-hidden="true"></i>
                    <span class="riden-sidebar__label">Logout</span>
                </a>
            </div>
        </nav>
    </div>
</div> --}}

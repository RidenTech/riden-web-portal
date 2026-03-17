@php
    $menu = [
        ['label' => 'Dashboard', 'icon' => 'bi bi-house-door', 'url' => url('/')],
        ['label' => 'Analytics/Stats', 'icon' => 'bi bi-bar-chart', 'url' => '#'],
        ['label' => 'Admin Roles', 'icon' => 'bi bi-person', 'url' => '#'],
        ['label' => 'Driver Management', 'icon' => 'bi bi-person-badge', 'url' => '#'],
        ['label' => 'Passenger Management', 'icon' => 'bi bi-people', 'url' => '#'],
        ['label' => 'Vehicles Type Management', 'icon' => 'bi bi-truck', 'url' => '#'],
        ['label' => 'Booking Management', 'icon' => 'bi bi-calendar-check', 'url' => '#'],
        ['label' => 'Reviews & Ratings', 'icon' => 'bi bi-star', 'url' => '#'],
        ['label' => 'Promo code Management', 'icon' => 'bi bi-tag', 'url' => '#'],
        ['label' => 'Fare Management', 'icon' => 'bi bi-cash-coin', 'url' => '#'],
        ['label' => 'Commission Management', 'icon' => 'bi bi-percent', 'url' => '#'],
        ['label' => 'Payment', 'icon' => 'bi bi-credit-card', 'url' => '#'],
        ['label' => 'Advertising Management', 'icon' => 'bi bi-megaphone', 'url' => '#'],
        ['label' => 'Report Management', 'icon' => 'bi bi-file-earmark-text', 'url' => '#'],
        ['label' => 'Reports', 'icon' => 'bi bi-file-earmark-text', 'url' => '#'],
        ['label' => 'Support Ticket', 'icon' => 'bi bi-life-preserver', 'url' => '#'],
        ['label' => 'Manage Notifications', 'icon' => 'bi bi-bell', 'url' => '#'],
        ['label' => 'CMS Management', 'icon' => 'bi bi-window', 'url' => '#'],
    ];
@endphp

<!-- Desktop / Tablet sidebar -->
<aside class="riden-sidebar d-none d-md-flex" aria-label="Sidebar navigation">
    <div class="riden-sidebar__inner">
        <div class="riden-sidebar__top">
            <a href="{{ url('/') }}" class="riden-sidebar__brand" aria-label="Riden">
                <span class="riden-sidebar__brand-text" style="font-family:Audiowide">RIDEN</span>
            </a>
            <button type="button" class="riden-sidebar__collapsebtn" aria-label="Collapse sidebar" data-riden-sidebar-toggle>
                <i class="bi bi-list"></i>
            </button>
        </div>

        <nav class="riden-sidebar__nav">
            @foreach ($menu as $item)
                @php
                    $isActive = $item['url'] !== '#' && request()->fullUrlIs($item['url']);
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

<!-- Mobile offcanvas sidebar -->
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
</div>
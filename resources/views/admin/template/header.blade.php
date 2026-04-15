@php
    $path = request()->path();
    $headerTitle = 'Profile';
    $showHeaderSearch = false;
    $headerSearchPlaceholder = 'Search by name, email, phone number';

    if (str_contains($path, 'roles')) {
        $headerTitle = 'Admin Roles';
        $showHeaderSearch = true;
    } elseif (str_contains($path, 'profile')) {
        $headerTitle = 'Profile';
    } elseif (str_contains($path, 'promocode')) {
        $headerTitle = 'Promo Code Management';
        $showHeaderSearch = true;
        $headerSearchPlaceholder = 'Search by code and date';
    } elseif (str_contains($path, 'passenger-management')) {
        $headerTitle = 'Passenger Management';
        $showHeaderSearch = false;
        $headerSearchPlaceholder = 'Search by name, email, phone number';
    } elseif (str_contains($path, 'driver-management')) {
        $headerTitle = 'Driver Management';
        $showHeaderSearch = false;
        $headerSearchPlaceholder = 'Search by name, email, phone number';
    }
@endphp

<div class="navbar-custom riden-topbar">
    <div class="container-fluid riden-topbar__inner">
        <div class="d-flex align-items-center gap-3 flex-grow-1">
            {{-- Header sidebar toggle button (disabled for now)
            <button class="button-menu-mobile waves-effect waves-light riden-sidebar-toggle"
                    type="button"
                    aria-label="Toggle sidebar"
                    data-riden-sidebar-toggle>
                <i class="bi bi-list"></i>
            </button>
            --}}

            <div class="riden-topbar__title flex-grow-1 d-none d-sm-block">
                
                    <div class="riden-topbar__h1">
                        @hasSection('title')
                            @yield('title')
                        @else
                            {{ $headerTitle }}
                        @endif
                    </div>
              
            </div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="button" class="riden-topbar__iconbtn" aria-label="Notifications">
                <i class="bi bi-bell"></i>
            </button>

            <img src="https://i.pravatar.cc/80?img=5" class="riden-topbar__avatar" alt="Avatar">
        </div>
    </div>
</div>

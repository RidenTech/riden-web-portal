@php
    $path = request()->path();
    $headerTitle = 'Profile';
    $showHeaderSearch = false;

    if ($path === 'adminprofile') {
        $headerTitle = 'Admin Roles';
        $showHeaderSearch = true;
    } elseif ($path === 'profile') {
        $headerTitle = 'Profile';
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
                @if(!$showHeaderSearch)
                    <div class="riden-topbar__h1">
                        {{ $headerTitle }}
                    </div>
                @else
                    <div class="mt-1">
                        <form class="riden-header-search">
                            <span class="riden-header-search-icon-circle">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text"
                                   class="form-control form-control-sm"
                                   placeholder="Search by name, email, phone number">
                        </form>
                    </div>
                @endif
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
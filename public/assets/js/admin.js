// Sidebar: mobile offcanvas + tablet/desktop collapse
(function () {
    function toggleCollapsed() {
        document.body.classList.toggle('riden-sidebar-collapsed');
        try {
            localStorage.setItem(
                'riden_sidebar_collapsed',
                document.body.classList.contains('riden-sidebar-collapsed') ? '1' : '0'
            );
        } catch (e) {
            // ignore
        }
    }

    function restoreCollapsed() {
        try {
            var v = localStorage.getItem('riden_sidebar_collapsed');
            if (v === '1') document.body.classList.add('riden-sidebar-collapsed');
        } catch (e) {
            // ignore
        }
    }

    function bindToggle() {
        var btns = document.querySelectorAll('[data-riden-sidebar-toggle]');
        if (!btns.length) return;

        btns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                if (e && typeof e.preventDefault === 'function') e.preventDefault();

            // Mobile: open offcanvas
            if (window.matchMedia('(max-width: 767.98px)').matches) {
                var el = document.getElementById('ridenSidebarOffcanvas');
                if (!el || !window.bootstrap || !window.bootstrap.Offcanvas) return;
                window.bootstrap.Offcanvas.getOrCreateInstance(el).show();
                return;
            }

            // Tablet/Desktop: collapse
            toggleCollapsed();
            });
        });
    }

    restoreCollapsed();
    bindToggle();
})();





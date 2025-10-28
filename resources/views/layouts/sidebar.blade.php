<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" style="background-color: white;">
    <div class="app-brand demo">
        <a href="{{ url('/') }}" class="app-brand-link">
            {{-- (Kode SVG logo dihilangkan untuk keringkasan) --}}
            <img src="{{ asset('materio/assets/img/illustrations/cin1.png') }}" alt="" width="50">
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Wedding</span>
        </a>
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="menu-toggle-icon d-xl-inline-block align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">

        {{-- Logika: Tambahkan 'open' jika URL saat ini dimulai dengan '/dashboard' atau salah satu submenu-nya aktif --}}
        {{-- <li class="menu-item {{ request()->is('dashboard/*') || request()->is('dashboard') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-home-smile-line"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <div class="badge text-bg-danger rounded-pill ms-auto">5</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('dashboard') }}" class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('dashboard/ecommerce') ? 'active' : '' }}">
                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-ecommerce-dashboard.html"
                        target="_blank" class="menu-link">
                        <div data-i18n="eCommerce">eCommerce</div>
                        <div class="badge rounded-pill bg-label-primary fs-tiny ms-auto">Pro</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('dashboard/logistics') ? 'active' : '' }}">
                    <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-logistics-dashboard.html"
                        target="_blank" class="menu-link">
                        <div data-i18n="Logistics">Logistics</div>
                        <div class="badge rounded-pill bg-label-primary fs-tiny ms-auto">Pro</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        {{-- Logika: Hanya butuh 'active' jika URL-nya persis /coba --}}
        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ url('dashboard') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-home-smile-line"></i>
                <div data-i18n="Basic">Dashboard</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('planings*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-calendar-todo-fill"></i>
                <div data-i18n="Planing">Planing</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item {{ request()->is('planings') ? 'active' : '' }}">
                    <a href="{{ url('planings') }}" class="menu-link">
                        <div data-i18n="Planing Kegiatan">Planing Kegiatan</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('calendar') ? 'active' : '' }}">
                    <a href="{{ url('calendar') }}" class="menu-link">
                        <div data-i18n="Kalender Kegiatan">Kalender Kegiatan</div>
                    </a>
                </li>

                {{-- <li class="menu-item {{ request()->is('laporan') ? 'active' : '' }}">
                    <a href="{{ url('laporan') }}" class="menu-link">
                        <div data-i18n="Laporan">Laporan</div>
                    </a>
                </li> --}}
            </ul>
        </li>
        <li class="menu-item {{ request()->is('ms') ? 'active' : '' }}">
            <a href="{{ url('ms') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-diamond-ring-line"></i>
                <div data-i18n="Basic">Mahar & Seserahan</div>
            </a>
        </li>
        {{-- <li class="menu-item {{ request()->is('planings') ? 'active' : '' }}">
            <a href="{{ url('planings') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-calendar-todo-fill"></i>
                <div data-i18n="Basic">Planing</div>
            </a>
        </li> --}}
        <li class="menu-item {{ request()->is('laporan') ? 'active' : '' }}">
            <a href="{{ url('laporan') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-bar-chart-box-ai-line"></i>
                <div data-i18n="Basic">Laporan & Anggaran</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('tamus') ? 'active' : '' }}">
            <a href="{{ url('tamus') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-file-list-3-line"></i>
                <div data-i18n="Basic">Daftar Tamu</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('kategoris') ? 'active' : '' }}">
            <a href="{{ url('kategoris') }}" class="menu-link">
                <i class="menu-icon icon-base ri ri-folder-6-line"></i>
                <div data-i18n="Basic">Kategori</div>
            </a>
        </li>

        {{-- Logika: Tambahkan 'open' jika URL saat ini dimulai dengan 'pages-account-settings*' --}}
        {{-- <li class="menu-item {{ request()->is('pages-account-settings*') ? 'open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ri ri-layout-left-line"></i>
                <div data-i18n="Account Settings">Account Settings</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item {{ request()->is('pages-account-settings-account.html') ? 'active' : '' }}">
                    <a href="{{ url('pages-account-settings-account.html') }}" class="menu-link">
                        <div data-i18n="Account">Account</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('pages-account-settings-notifications.html') ? 'active' : '' }}">
                    <a href="{{ url('pages-account-settings-notifications.html') }}" class="menu-link">
                        <div data-i18n="Notifications">Notifications</div>
                    </a>
                </li>

                <li class="menu-item {{ request()->is('pages-account-settings-connections.html') ? 'active' : '' }}">
                    <a href="{{ url('pages-account-settings-connections.html') }}" class="menu-link">
                        <div data-i18n="Connections">Connections</div>
                    </a>
                </li>
            </ul>
        </li> --}}
    </ul>
</aside>

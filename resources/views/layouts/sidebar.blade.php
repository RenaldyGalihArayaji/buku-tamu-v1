<nav class="main-sidebar ps-menu">
    <div class="sidebar-header">
        <div class="text">Yuk Nikah</div>
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            <li class="{{ Request::segment(1) == 'dashboard' ? 'active open' : '' }}">
                <a href="{{ route('dashboard') }}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-category">
                <span class="text-uppercase">User Interface</span>
            </li>

            <li class="{{ Request::segment(1) == 'master' ? 'active open' : '' }}">
                <a href="#" class="main-menu has-dropdown">
                    <i class="ti-server"></i>
                    <span>Master</span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ Request::segment(2) == 'acara' ? 'active open' : '' }}">
                        <a href="{{ route('acara.index') }}" class="link"><span>Data Acara</span></a>
                    </li>
                    <li class="{{ Request::segment(2) == 'detail-acara' ? 'active open' : '' }}">
                        <a href="{{ route('detail-acara.index') }}" class="link"><span>Data Detail Acara</span></a>
                    </li>
                    <li class="{{ Request::segment(2) == 'orang-tua' ? 'active open' : '' }}">
                        <a href="{{ route('orang-tua.index') }}" class="link"><span>Data Orang Tua</span></a>
                    </li>
                    <li class="{{ Request::segment(2) == 'galeri' ? 'active open' : '' }}">
                        <a href="{{ route('galeri.index') }}" class="link"><span>Data Galeri</span></a>
                    </li>
                    <li class="{{ Request::segment(2) == 'rekening' ? 'active open' : '' }}">
                        <a href="{{ route('rekening.index') }}" class="link"><span>Data Rekening</span></a>
                    </li>
                    <li>
                        <a href="" class="link"><span>Data Love Story</span></a>
                    </li>
                    <li>
                        <a href="" class="link"><span>Data Quotes</span></a>
                    </li>
                </ul>
            </li>
             <li class="{{ Request::segment(1) == 'tamu' ? 'active open' : '' }}">
                <a href="{{ route('tamu.index') }}" class="link">
                    <i class="ti-id-badge"></i>
                    <span>Data Tamu</span>
                </a>
            </li>
             <li class="{{ Request::segment(1) == 'check-in-tamu' ? 'active open' : '' }}">
                <a href="{{ route('checkin.index') }}" class="link">
                    <i class="ti-id-badge"></i>
                    <span>Check In Tamu</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

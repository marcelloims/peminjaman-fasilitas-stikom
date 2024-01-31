<nav class="navbar navbar-expand">
    <div class="collapse navbar-collapse justify-content-between">
        <div class="header-left">
            <div class="dashboard_bar">
                {{ $title }}
            </div>
        </div>
        <ul class="navbar-nav header-right">
            <li class="nav-item">
                <div class="input-group search-area d-xl-inline-flex d-none">
                </div>
            </li>
            <li class="nav-item dropdown notification_dropdown">
                <div class="input-group search-area d-xl-inline-flex d-none">
                </div>
            </li>
            <li class="nav-item dropdown header-profile">
                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">
                    <img src="{{ asset('assets/images/user.png') }}" width="20" alt="" />
                    <div class="header-info">
                        <span class="text-black"><strong>{{ Auth::user()->name }}</span>
                        <p class="fs-12 mb-0">{{ Auth::user()->email }}</p>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ url('mahasiswa/ubahpassword/' . Auth::user()->id, []) }}" class="dropdown-item ai-icon">
                        <span class="ml-2">Ganti Kata Sandi</span>
                    </a>
                    <a href="{{ url('logout') }}" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12">
                            </line>
                        </svg>
                        <span class="ml-2">Logout </span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

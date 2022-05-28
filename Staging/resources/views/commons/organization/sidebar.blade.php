<div class="nk-sidebar nk-sidebar-fixed is-white " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
        <div class="nk-menu-trigger">
            <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
        </div>
        <div class="nk-sidebar-brand">
            <a href="{{ route('org.dashboard') }}" class="logo-link nk-sidebar-logo">
                <img class="logo-light logo-img" src="{{ asset('theme/images/logo.png') }}" srcset="{{ asset('theme/images/logo.png') }} 2x" alt="logo">
                <img class="logo-dark logo-img" src="{{ asset('theme/images/logo.png') }}" srcset="{{ asset('theme/images/logo.png') }} 2x" alt="logo-dark">
            </a>
        </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
        <div class="nk-sidebar-content">
            <div class="nk-sidebar-menu" data-simplebar>
                <ul class="nk-menu">
                    <li class="nk-menu-item">
                        <a href="{{ route('org.dashboard') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-home"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Management Area</h6>
                    </li><!-- .nk-menu-heading -->
                    <li class="nk-menu-item has-sub">
                        <a href="{{ route('org.sites.index') }}" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                            <span class="nk-menu-text">Sites</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('org.sites.index') }}" class="nk-menu-link"><span class="nk-menu-text">Sites List</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('org.clients') }}" class="nk-menu-link"><span class="nk-menu-text">Clients</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="{{ route('org.guards-list') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                            <span class="nk-menu-text">Guards</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-location"></em></span>
                            <span class="nk-menu-text">Live Tracking</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('org.sites-map') }}" class="nk-menu-link"><span class="nk-menu-text">Map View</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="/tracking/history" class="nk-menu-link"><span class="nk-menu-text">Tracking History</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-file-docs"></em></span>
                            <span class="nk-menu-text">Manage Team</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('org.team.index') }}" class="nk-menu-link"><span class="nk-menu-text">Members</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('org.invitations') }}" class="nk-menu-link"><span class="nk-menu-text">Invitation List</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Askari Area</h6>
                    </li><!-- .nk-menu-heading -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-signin"></em></span>
                            <span class="nk-menu-text">Visitor Management</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('org.visitors-list') }}" class="nk-menu-link"><span class="nk-menu-text">Visitors</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('org.visitors-log') }}" class="nk-menu-link"><span class="nk-menu-text">Visitor Log</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="/app/dashboard" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-calendar-alt"></em></span>
                            <span class="nk-menu-text">Scheduler</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-growth"></em></span>
                            <span class="nk-menu-text">Reports</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="{{ route('org.patrol-reports') }}" class="nk-menu-link"><span class="nk-menu-text">Patrol Reports</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('org.attendance-reports') }}" class="nk-menu-link"><span class="nk-menu-text">Attendance Reports</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('org.visitor-reports') }}" class="nk-menu-link"><span class="nk-menu-text">Visitor Reports</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="{{ route('org.task-reports') }}" class="nk-menu-link"><span class="nk-menu-text">Task Reports</span></a>
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-heading">
                        <h6 class="overline-title text-primary-alt">Admin Area</h6>
                    </li><!-- .nk-menu-heading -->
                    <li class="nk-menu-item">
                        <a href="{{ route('org.roles.index') }}" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dot-box"></em></span>
                            <span class="nk-menu-text">Acess and Roles</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="/settings" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                            <span class="nk-menu-text">Company Settings</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-sidebar-menu -->
        </div><!-- .nk-sidebar-content -->
    </div><!-- .nk-sidebar-element -->
</div>
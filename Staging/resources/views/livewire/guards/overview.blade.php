<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between g-3">
                        <div class="nk-block-head-content">
                            <div class="nk-block-des text-soft">
                                <ul class="list-inline">
                                    <li>User ID: <span class="text-base">ASK-00{{ $guard->id }}</span></li>
                                    <li>Last Login:
                                        @if (!empty($guard->last_login_at))
                                        <span class="text-base">{{ date('d-m-Y H:s', strtotime($guard->last_login_at)) }}</span>
                                        @else
                                            <span class="text-base"></span>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nk-block-head-content">
                            <a href="{{ route('org.guards-list') }}"
                                class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                    class="icon ni ni-arrow-left"></em><span>Back</span></a>
                            <a href="{{ route('org.guards-list') }}"
                                class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em
                                    class="icon ni ni-arrow-left"></em></a>
                        </div>
                    </div>
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-content">
                                <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#"><em
                                                class="icon ni ni-user-circle"></em><span>Overview</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><em
                                                class="icon ni ni-activity"></em><span>Latest Activities</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><em
                                                class="icon ni ni-repeat"></em><span>Availability</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><em
                                                class="icon ni ni-file-text"></em><span>Licenses</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#"><em
                                                class="icon ni ni-setting"></em><span>Settings</span></a>
                                    </li>
                                </ul><!-- .nav-tabs -->
                                <div class="card-inner">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card card-bordered">
                                                <div class="card-inner-group" data-simplebar>
                                                    <div class="card-inner">
                                                        <div class="user-card user-card-s2">
                                                            <div class="user-avatar lg bg-primary">
                                                                <span>AB</span>
                                                            </div>
                                                            <div class="user-info">
                                                                <div class="badge badge-outline-warning badge-pill ucap">
                                                                    Guard</div>
                                                                <h5>{{ $guard->name }}</h5>
                                                                <span class="sub-text">{{ $guard->email }}</span>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                    <div class="card-inner card-inner-sm">
                                                        <ul class="btn-toolbar justify-center gx-1">
                                                            <li><a href="#" class="btn btn-trigger btn-icon"><em
                                                                        class="icon ni ni-edit-fill"></em></a></li>
                                                            <li><a href="#" class="btn btn-trigger text-danger btn-icon"><em
                                                                        class="icon ni ni-trash"></em></a></li>
                                                            <li>
                                                                <a wire:click.prevent='suspendGuard({{ $guard->id }})' href="#suspendGuard"
                                                                    class="btn btn-trigger btn-icon {{ $guard->is_active == true ? 'text-danger' : 'text-success' }}"><em
                                                                        class="icon ni ni-na"></em></a>
                                                            </li>
                                                        </ul>
                                                    </div><!-- .card-inner -->
                                                    <div class="card-inner">
                                                        <h6 class="overline-title-alt mb-2">Additional</h6>
                                                        <div class="row g-3">
                                                            <div class="col-6">
                                                                <span class="sub-text">User ID:</span>
                                                                <span>ASK-00{{ $guard->id }}</span>
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="sub-text">Last Login:</span>
                                                                @if (!empty($guard->last_login_at))
                                                                    <span>{{ date('d-m-Y H:s', strtotime($guard->last_login_at)) }}</span>
                                                                @else
                                                                    <span></span>
                                                                @endif
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="sub-text">Status:</span>
                                                                @if (!$guard->is_active)
                                                                <span class="lead-text text-danger">Suspended</span>
                                                                @else
                                                                <span class="lead-text text-success">Active</span>
                                                                @endif
                                                            </div>
                                                            <div class="col-6">
                                                                <span class="sub-text">Register At:</span>
                                                                <span>{{ date('d-m-Y H:s', strtotime($guard->created_at)) }}</span>
                                                            </div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .card-aside -->
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card card-bordered">
                                                <ul class="data-list is-compact">
                                                    <div class="card-header border-bottom">Overview</div>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Site</div>
                                                            <div class="data-value">
                                                                @if (!empty($guard->site_id))
                                                                    <a href="{{ route('org.site-overview', $guard->site->id) }}">
                                                                        <div class="user-card">
                                                                            <div
                                                                                class="user-avatar sm user-avatar-xs bg-orange-dim">
                                                                                <img src="{{ url('storage/'.$guard->site->logo) }}"
                                                                                    alt="">
                                                                            </div>
                                                                            <div class="user-name">
                                                                                <span class="tb-lead">{{ $guard->site->name }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                @else
                                                                    <div class="data-value">
                                                                        <p>Not asigned to Site</p>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @if (!empty($guard->site_id) and !empty($guard->site->user_id) )
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Client Name</div>
                                                            <div class="data-value">
                                                                <a href="#">{{ $guard->site->owner->name }}</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Contact No</div>
                                                            <div class="data-value">
                                                                <p>No Added</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Status</div>
                                                            <div class="data-value">
                                                                @if (!$guard->is_active)
                                                                <span class="badge badge-dot badge-danger">Suspended</span>
                                                                @else
                                                                <span class="badge badge-dot badge-success">Active</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card card-bordered">
                                                <div class="card-header border-bottom">Stats</div>
                                                <div class="card-inner">
                                                    <div class="row text-center">
                                                        <div class="col-3">
                                                            <div class="profile-stats">
                                                                <span class="amount">23</span>
                                                                <span class="sub-text">Tours Completed</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="profile-stats">
                                                                <span class="amount">20</span>
                                                                <span class="sub-text">Tasks Completed</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="profile-stats">
                                                                <span class="amount">3</span>
                                                                <span class="sub-text">Hours Worked</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="profile-stats">
                                                                <span class="amount">3</span>
                                                                <span class="sub-text">Reports Submitted</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .card-inner -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .card-content -->
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>

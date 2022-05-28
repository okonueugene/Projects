<div class="container-fluid">
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between g-3">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Users / <strong class="text-warning small">{{ $user->name }}</strong></h3>
                        <div class="nk-block-des text-soft">
                            <ul class="list-inline">
                                <li>User ID: <span class="text-base">ASK-00{{ $user->id }}</span></li>
                                <li>Last Login:
                                    @if (!empty($user->last_login_at))
                                        <span class="text-base">{{ date('d-m-Y H:s', strtotime($user->last_login_at)) }}</span>
                                    @else
                                        <span class="text-base">N/A</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="nk-block-head-content">
                        <a href="{{ route('org.team.index') }}" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                        <a href="{{ route('org.team.index') }}" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>
            </div><!-- .nk-block-head -->
            <div class="nk-block">
                <div class="card card-bordered">
                    <div class="card-aside-wrap">
                        <div class="card-content">
                            <ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#"><em class="icon ni ni-user-circle"></em><span>Personal</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><em class="icon ni ni-bell"></em><span>Notifications</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><em class="icon ni ni-activity"></em><span>Activities</span></a>
                                </li>
                                <li class="nav-item nav-item-trigger d-xxl-none">
                                    <a href="#" class="toggle btn btn-outline-secondary" data-target="userAside"><span>Actions</span><em class="icon ni ni-arrow-right"></em></a>
                                </li>
                            </ul><!-- .nav-tabs -->
                            <div class="card-inner">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <h5 class="title">Personal Information</h5>
                                        <p>Basic info, like user name and address.</p>
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Full Name</span>
                                                <span class="profile-ud-value">{{ $user->name }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Joining Date</span>
                                                <span class="profile-ud-value">{{ date('d-m-Y H:s', strtotime($user->created_at)) }}</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Mobile Number</span>
                                                <span class="profile-ud-value">
                                                    @if (!empty($user->phone))
                                                    {{ $user->phone }}
                                                    @else
                                                        Not Added
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Email Address</span>
                                                <span class="profile-ud-value">{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-line">
                                        <h6 class="title overline-title text-base">Additional Information</h6>
                                    </div><!-- .nk-block-head -->
                                    <div class="profile-ud-list">
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">User Role</span>
                                                <span class="profile-ud-value">
                                                    @if ($user->user_type == 'admin')
                                                        <span class="badge badge-dim badge-sm badge-outline-success">Admin</span>
                                                    @elseif ($user->user_type == 'client')
                                                        <span class="badge badge-dim badge-sm badge-outline-warning">Client</span>
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Reg Method</span>
                                                <span class="profile-ud-value">Invited</span>
                                            </div>
                                        </div>
                                        <div class="profile-ud-item">
                                            <div class="profile-ud wider">
                                                <span class="profile-ud-label">Country</span>
                                                <span class="profile-ud-value">{{ $user->country }}</span>
                                            </div>
                                        </div>
                                        @if ($user->user_type == 'client')
                                            <div class="profile-ud-item">
                                                <div class="profile-ud wider">
                                                    <span class="profile-ud-label">Site</span>
                                                    <span class="profile-ud-value">United State</span>
                                                </div>
                                            </div>
                                        @endif
                                    </div><!-- .profile-ud-list -->
                                </div><!-- .nk-block -->
                                <div class="nk-divider divider md"></div>
                                @if ($user->user_type == 'client')
                                <div class="nk-block">
                                    <div class="nk-block-head nk-block-head-sm nk-block-between">
                                        <h5 class="title">Billing Cycle</h5>
                                    </div><!-- .nk-block-head -->
                                    <div class="card card-bordered">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                    <div class="nk-block-text">
                                                        <h6>Yearly Subscription</h6>
                                                        <ul class="list-inline list-col2 text-soft">
                                                            <li>Subscription <strong class="text-base">Started</strong> on <strong class="text-base">Jan 28, 2020</strong></li>
                                                            <li>You have full-acces to all Askari features</li>
                                                        </ul>
                                                    </div>
                                                    <div class="nk-block-actions">
                                                        <ul class="align-center gx-3">
                                                            <li class="order-md-last">
                                                                <a href="#" class="link link-warning">View Features</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div><!-- .nk-card-inner -->
                                        </div>
                                    </div>
                                </div><!-- .nk-block -->
                                @endif
                            </div><!-- .card-inner -->
                        </div><!-- .card-content -->
                        <div class="card-aside card-aside-right user-aside toggle-slide toggle-slide-right toggle-break-xxl" data-content="userAside" data-toggle-screen="xxl" data-toggle-overlay="true" data-toggle-body="true">
                            <div class="card-inner-group" data-simplebar>
                                <div class="card-inner">
                                    <div class="user-card user-card-s2">
                                        <div class="user-avatar lg bg-primary">
                                            <img src="{{ Gravatar::get($user->email) }}" alt="">
                                        </div>
                                        <div class="user-info">
                                            @if ($user->user_type == 'admin')
                                                <div class="badge badge-success badge-pill ucap">Admin</div>
                                            @elseif ($user->user_type == 'client')
                                                <div class="badge badge-warning badge-pill ucap">Client</div>
                                            @endif
                                            <h5>{{ $user->name }}</h5>
                                            <span class="sub-text">{{ $user->email }}</span>
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                                <div class="card-inner card-inner-sm">
                                    <ul class="btn-toolbar justify-center gx-1">
                                        <li><a href="#suspendUser" wire:click.prevent='suspendUser({{ $user->id }})' data-toggle="tooltip" data-placement="top" title="{{ $user->is_active ? 'Suspend User' : 'Activate User' }}" class="btn btn-trigger btn-icon {{ $user->is_active ? 'text-danger' : 'text-success' }}"><em class="icon ni ni-shield-off"></em></a></li>
                                        <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-mail"></em></a></li>
                                        <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-download-cloud"></em></a></li>
                                        <li><a href="#" class="btn btn-trigger btn-icon"><em class="icon ni ni-bookmark"></em></a></li>
                                        <li><a href="#" class="btn btn-trigger btn-icon text-danger"><em class="icon ni ni-na"></em></a></li>
                                    </ul>
                                </div><!-- .card-inner -->
                                <div class="card-inner">
                                    <h6 class="overline-title-alt mb-2">Additional</h6>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <span class="sub-text">User ID:</span>
                                            <span>ASK-00{{ $user->id }}</span>
                                        </div>
                                        <div class="col-6">
                                            <span class="sub-text">Account Status:</span>
                                            @if ($user->is_active == true)
                                                <span class="lead-text text-success">Active</span>
                                            @else
                                                <span class="lead-text text-danger">Inactive</span>
                                            @endif
                                            
                                        </div>
                                        <div class="col-12">
                                            
                                        </div>
                                        <div class="col-12">
                                            
                                        </div>
                                    </div>
                                </div><!-- .card-inner -->
                            </div><!-- .card-inner -->
                        </div><!-- .card-aside -->
                    </div><!-- .card-aside-wrap -->
                </div><!-- .card -->
            </div><!-- .nk-block -->
        </div>
    </div>
</div>
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Users Lists</h3>
                    <div class="nk-block-des text-soft">
                        <p>You have total {{ $total }} users.</p>
                    </div>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li><a href="#" class="btn btn-white btn-outline-light"><em class="icon ni ni-download-cloud"></em><span>Export</span></a></li>
                                <li class="nk-block-tools-opt">
                                    <div class="drodown">
                                        <a href="#" class="dropdown-toggle btn btn-icon btn-secondary" data-toggle="dropdown"><em class="icon ni ni-plus"></em></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <ul class="link-list-opt no-bdr">
                                                <li><a href="{{ route('org.invitations') }}"><span>Add User</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="card card-bordered card-stretch">
                <div class="card-inner-group">
                    <div class="card-inner p-0">
                        <div class="nk-tb-list nk-tb-ulist">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="uid">
                                        <label class="custom-control-label" for="uid"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col"><span class="sub-text">User</span></div>
                                <div class="nk-tb-col tb-col-mb"><span class="sub-text">Role</span></div>
                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></div>
                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">Verified</span></div>
                                <div class="nk-tb-col tb-col-lg"><span class="sub-text">Last Login</span></div>
                                <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                                <div class="nk-tb-col nk-tb-col-tools text-right">
                                    <div class="dropdown">
                                        <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                            <ul class="link-tidy sm no-bdr">
                                                <li>
                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" checked="" id="bl">
                                                        <label class="custom-control-label" for="bl">Balance</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" checked="" id="ph">
                                                        <label class="custom-control-label" for="ph">Phone</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="vri">
                                                        <label class="custom-control-label" for="vri">Verified</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="st">
                                                        <label class="custom-control-label" for="st">Status</label>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .nk-tb-item -->
                            @foreach ($users as $user)
                            <div class="nk-tb-item">
                                <div class="nk-tb-col nk-tb-col-check">
                                    <div class="custom-control custom-control-sm custom-checkbox notext">
                                        <input type="checkbox" class="custom-control-input" id="{{ $user->id }}">
                                        <label class="custom-control-label" for="{{ $user->id }}"></label>
                                    </div>
                                </div>
                                <div class="nk-tb-col">
                                    <a href="{{ route('org.team.show', $user->id) }}">
                                        <div class="user-card">
                                            <div class="user-avatar bg-primary">
                                                <img src="{{ Gravatar::get($user->email) }}" alt="">
                                            </div>
                                            <div class="user-info">
                                                <span class="tb-lead">{{ $user->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                                <span>{{ $user->email }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="nk-tb-col tb-col-mb">
                                    @if ($user->user_type == 'admin')
                                        <span class="badge badge-dot badge-warning">Admin</span>
                                    @elseif ($user->user_type == 'client')
                                        <span class="badge badge-dot badge-success">Client</span>
                                    @endif
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    @if (!empty($user->phone))
                                        <span>{{ $user->phone }}</span>
                                    @else
                                        <span>Not Added</span>
                                    @endif
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    <ul class="list-status">
                                        @if (!empty($user->email_verified_at))
                                            <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                                        @else
                                            <li><em class="icon text-danger ni ni-cross-circle"></em> <span>Email</span></li>
                                        @endif
                                        
                                        @if (!empty($user->phone))
                                            <li><em class="icon text-success ni ni-check-circle"></em> <span>Phone</span></li>
                                        @else
                                            <li><em class="icon text-danger ni ni-check-circle"></em> <span>Phone</span></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="nk-tb-col tb-col-lg">
                                    @if (!empty($user->last_login_at))
                                        <span>{{ date('d-m-Y H:s', strtotime($user->last_login_at)) }}</span>
                                    @else
                                        <span></span>
                                    @endif
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    @if ($user->is_active == true)
                                        <span class="tb-status text-success">Active</span>
                                    @else
                                        <span class="tb-status text-danger">Inactive</span>
                                    @endif
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools">
                                    <ul class="nk-tb-actions gx-1">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-activity-round"></em><span>Activity Log</span></a></li>
                                                        <li class="divider"></li>
                                                        <li wire:loading.remove>
                                                            <a wire:click.prevent='suspendUser({{ $user->id }})' href="#suspendUser">
                                                            <em class="icon ni ni-shield-off"></em><span>{{ $user->is_active == false ? 'Activate User' : 'Deactivate User'}}</span></a>
                                                        </li>
                                                        <li><a wire:click.prevent='deleteUser({{ $user->id }})' href="#deleteUser"><em class="icon ni ni-na"></em><span>Delete User</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- .nk-tb-item -->   
                            @endforeach
                        </div><!-- .nk-tb-list -->
                    </div><!-- .card-inner -->
                    <div class="card-inner">
                        <div class="nk-block-between-md g-3">
                            <div class="g">
                               {{ $users->links() }}
                            </div>
                        </div><!-- .nk-block-between -->
                    </div><!-- .card-inner -->
                </div><!-- .card-inner-group -->
            </div><!-- .card -->
        </div><!-- .nk-block -->
    </div>
</div>
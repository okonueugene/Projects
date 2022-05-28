<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Guards</h3>
                            <div class="nk-block-des text-soft">
                                <p>You have total {{ $total }} guards.</p>
                                
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="more-options"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="more-options">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-search"></em>
                                                </div>
                                                <input type="text" class="form-control" id="default-04" placeholder="Search by name">
                                            </div>
                                        </li>
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-toggle="dropdown">Status</a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Actived</span></a></li>
                                                        <li><a href="#"><span>Suspended</span></a></li>
                                                        <li><a href="#"><span>Archived</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt">
                                            <a href="#" class="btn btn-icon btn-primary d-md-none" data-toggle="modal" data-target="#addModal"><em class="icon ni ni-plus"></em></a>
                                            <a href="#" class="btn btn-primary d-none d-md-inline-flex" data-toggle="modal" data-target="#addModal"><em class="icon ni ni-plus"></em><span>Add Guard</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="nk-tb-list is-separate mb-3">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="uid">
                                    <label class="custom-control-label" for="uid"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col"><span class="sub-text">Guard Name</span></div>
                            <div class="nk-tb-col tb-col-mb"><span class="sub-text">Email</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></div>
                            <div class="nk-tb-col tb-col-lg"><span class="sub-text">Last Online</span></div>
                            <div class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1 my-n1">
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger mr-n1" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="#"><em class="icon ni ni-mail"></em><span>Send Email to All</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend Selected</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-trash"></em><span>Remove Seleted</span></a></li>
                                                    <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Password</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-tb-item -->
                        @foreach ($guards as $guard)
                        <div class="nk-tb-item">
                            <div class="nk-tb-col nk-tb-col-check">
                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                    <input type="checkbox" class="custom-control-input" id="{{ $guard->id }}">
                                    <label class="custom-control-label" for="{{ $guard->id }}"></label>
                                </div>
                            </div>
                            <div class="nk-tb-col">
                                <a href="{{ route('org.guard-overview', $guard->id) }}">
                                    <div class="user-card">
                                        <div class="user-avatar bg-primary">
                                            <span> <?php
                                                    $words = explode(" ", "$guard->name");
                                                      $acronym = "";

                                                    foreach ($words as $w) {
                                                     $acronym .= $w[0];
                                                             }
                                                           echo $acronym; ?></span>
                                        </div>
                                        <div class="user-info">
                                            <span class="tb-lead"> {{ $guard->name }}<span class="dot dot-success d-md-none ml-1"></span></span>
                                            @if (!empty($guard->site_id))
                                                <span class="text-success">Site: {{ $guard->site->name }}</span>
                                            @else
                                                <span class="badge badge-dot badge-warning">Not assigned to site</span>
                                            @endif
                                        </div> 
                                    </div>
                                </a>
                            </div>
                            <div class="nk-tb-col tb-col-mb">
                                <span class="tb-amount">{{ $guard->email }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span>{{ $guard->phone }}</span>
                            </div>
                            <div class="nk-tb-col tb-col-lg">
                                @if (!empty($guard->last_login_at))
                                    <span>{{ date('d-m-Y H:s', strtotime($guard->last_login_at)) }}</span>
                                @else
                                    <span></span>
                                @endif
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                @if (!$guard->is_active)
                                    <span class="badge badge-dot badge-danger">Suspended</span>
                                @else
                                    <span class="badge badge-dot badge-success">Active</span>
                                @endif
                            </div>
                            <div class="nk-tb-col nk-tb-col-tools">
                                <ul class="nk-tb-actions gx-1">
                                    <li class="nk-tb-action-hidden">
                                        <a href="{{ route('org.guard-overview', $guard->id) }}" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="View Details">
                                            <em class="icon ni ni-eye"></em>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="drodown">
                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <ul class="link-list-opt no-bdr">
                                                    <li><a href="{{ route('org.guard-overview', $guard->id) }}"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .nk-tb-item -->
                        @endforeach
                    </div><!-- .nk-tb-list -->
                    @if ($total < 1)
                    <div class="card text-center">
                        <div class="card-inner">
                            <p>No data available</p>
                        </div>
                    </div>
                    @endif

                    <div class="card">
                        <div class="card-inner">
                            <div class="nk-block-between-md g-3">
                                <div class="g">
                                    {{ $guards->links() }}
                                    <!-- .pagination -->
                                </div>
                            </div><!-- .nk-block-between -->
                        </div>
                    </div>
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>


    <div  wire:ignore.self class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Add Guard</h5>
                    <form wire:submit.prevent='addGuard' class="mt-2">
                        <div class="row g-gs">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="oder-id">Guard Name</label>
                                    <div class="form-control-wrap">
                                        <input wire:model.lazy='name' type="text" class="form-control" id="oder-id" placeholder="Enter Guards name">
                                    </div>
                                    @error('name')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="item-code">Email</label>
                                    <div class="form-control-wrap">
                                        <input wire:model.lazy='email' type="email" class="form-control" id="item-code" placeholder="guard@example.com">
                                    </div>
                                    @error('email')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="price">Phone</label>
                                    <div class="form-control-wrap">
                                        <input wire:model.lazy='phone' type="phone" class="form-control" id="phone" placeholder="25474534221">
                                    </div>
                                    @error('phone')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="tax">ID/SIA No</label>
                                    <div class="form-control-wrap">
                                        <input wire:model.lazy='id_no' type="number" class="form-control" id="tax" placeholder="2325435364575633">
                                    </div>
                                    @error('id_no')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="password">Passcode</label>
                                        <a class="link link-warning link-sm" tabindex="-1">Guards will use this password to access the patrol dashboard.</a>
                                    </div>
                                    <div class="form-control-wrap">
                                        <a tabindex="-1" href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                        </a>
                                        <input wire:model.lazy='password' autocomplete="new-password" type="password" class="form-control form-control-lg" id="password" placeholder="Enter guard passcode">
                                    </div>
                                    @error('password')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button data-dismiss="modal" type="submit" class="btn btn-secondary">Close</button>
                                <button class="btn btn-warning" type="submit">
                                    <div wire:loading wire:target='addGuard'>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </div>
                                    <div>
                                        <span> Add Guard</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- .Add Modal-Content -->
</div>
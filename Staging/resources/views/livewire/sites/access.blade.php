<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Site access and previleges</h5>
                                            <div class="nk-block-des">
                                                <p>Grant and Revoke access to client portal. Official use only.</p>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <h6 class="lead-text">Portal Access</h6>
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                <div class="media media-center gx-3 wide-xs">
                                                    <div class="media-object">
                                                        <div class="user-avatar">
                                                            @if (!empty($site->owner->name))
                                                                <img data-toggle="tooltip" data-placement="top" title="{{ $site->owner->name }}" src="{{ Gravatar::get($site->owner->email) }}" alt="">
                                                            @else
                                                                AS
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="media-content">
                                                        <p>Allow client to access portal to view and manage reports for their site.</p>
                                                    </div>
                                                </div>
                                                <div class="nk-block-actions flex-shrink-0">
                                                    <a class="btn btn-lg {{ $site->portal_access == false ? 'btn btn-success' : 'btn btn-danger' }}"
                                                        href="#portalAccess"
                                                        wire:click.prevent="portalAccess({{ $site->id }})">
                                                            <div wire:loading wire:target="portalAccess" >
                                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                            </div>
                                                        <span>{{ $site->portal_access == false ? 'Grant Access' : 'Revoke Access' }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><!-- .nk-card-inner -->
                                    </div><!-- .nk-card -->
                                    <h6 class="lead-text">Site Status</h6>
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                <div class="media media-center gx-3 wide-xs">
                                                    <div class="media-object">
                                                        <em class="icon icon-circle icon-circle-lg ni {{ $site->is_active == false ? 'bg-danger ni-cross' : 'bg-success ni-check' }}"></em>
                                                    </div>
                                                    <div class="media-content">
                                                        <p>Activate site to receive activities from the patrol devices, manage patrols and all the other features.
                                                            <em class="d-block text-soft">{{ $site->is_active == false ? 'Not Activated' : 'Activated' }}</em></p>
                                                    </div>
                                                </div>
                                                <div class="nk-block-actions flex-shrink-0">
                                                    <a class="btn btn-lg {{ $site->is_active == false ? 'btn btn-success' : 'btn btn-danger' }}"
                                                        href="#activateSite"
                                                        wire:click.prevent="activateSite({{ $site->id }})">
                                                            <div wire:loading wire:target="activateSite" >
                                                                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                                                            </div>
                                                            <em
                                                                wire:loading.class.remove="{{ $site->is_active == false ? 'icon ni ni-check' : 'icon ni ni-cross' }}" class="{{ $site->is_active == false ? 'icon ni ni-check' : 'icon ni ni-cross' }}">
                                                            </em>
                                                        <span>{{ $site->is_active == false ? 'Activate' : 'Deactivate' }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div><!-- .nk-card-inner -->
                                    </div><!-- .nk-card -->

                                    <h6 class="lead-text">Report Mailing</h6>
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                <div class="nk-block-text">
                                                    <h6>Send automated report to client</h6>
                                                </div>
                                                <div class="nk-block-actions">
                                                    <ul class="align-center gx-3">
                                                        <li class="order-md-last">
                                                            @livewire('toggle-settings', [
                                                                'model' => $site,
                                                                'field' => 'autoReports'
                                                            ])
                                                        </li>
                                                    </ul>
                                                </div>
                                                {{ $site->settings }}
                                            </div>

                                            <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                <div class="nk-block-text">
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-sm btn-warning" data-toggle="dropdown">Set Frequency</a>
                                                        <div class="dropdown-menu">
                                                            <ul class="link-tidy">
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" value="0" id="0">
                                                                        <label class="custom-control-label" for="0">Sunday</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" value="1" checked="" id="1">
                                                                        <label class="custom-control-label" for="1">Monday</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" value="2" id="2">
                                                                        <label class="custom-control-label" for="2">Tuesday</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" value="3" id="3">
                                                                        <label class="custom-control-label" for="3">Wednesday</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" value="4" id="4">
                                                                        <label class="custom-control-label" for="4">Thursday</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" value="5" id="5">
                                                                        <label class="custom-control-label" for="5">Friday</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" value="6" id="6">
                                                                        <label class="custom-control-label" for="6">Saturday</label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-block-actions">
                                                    <ul class="align-center gx-3">
                                                        <li class="order-md-last">
                                                            <p>Select the type of reports to send to client.</p>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="mailing-list mt-3">
                                                <table class="table">
                                                    <thead class="thead-light">
                                                      <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Report Type</th>
                                                        <th scope="col">Action</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                        <th scope="row">1</th>
                                                        <td>Attendance Report</td>
                                                        <td>
                                                            <div class="custom-control custom-switch mr-n2">
                                                                <input type="checkbox" class="custom-control-input" checked="" id="at-repo">
                                                                <label class="custom-control-label" for="at-repo"></label>
                                                            </div>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">2</th>
                                                        <td>Patrol Report</td>
                                                        <td>
                                                            <div class="custom-control custom-switch mr-n2">
                                                                <input type="checkbox" class="custom-control-input" checked="" id="at-repo">
                                                                <label class="custom-control-label" for="at-repo"></label>
                                                            </div>
                                                        </td>
                                                      </tr>
                                                      <tr>
                                                        <th scope="row">3</th>
                                                        <td>Task Report</td>
                                                        <td>
                                                            <div class="custom-control custom-switch mr-n2">
                                                                <input type="checkbox" class="custom-control-input" id="at-repo">
                                                                <label class="custom-control-label" for="at-repo"></label>
                                                            </div>
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                  
                                            </div>
                                            
                                        </div><!-- .card-inner -->
                                    </div><!-- .nk-card -->
                    
                                </div>
                            </div>
                            @include('livewire.sites.navigation')
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
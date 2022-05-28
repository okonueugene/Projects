<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Team Manage</h3>
                    <div class="nk-block-des text-soft">
                        <p>You can add and remove team member.</p>
                    </div>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                                class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li><a href="#" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em
                                            class="icon ni ni-arrow-left"></em><span>Go Back</span></a></li>
                                {{-- <li><a href="#" class="btn btn-warning"><em class="icon ni ni-plus"></em><span>Add Member</span></a></li> --}}
                                <li><button class="btn btn-secondary" data-toggle="modal" data-target="#addModal"><em
                                            class="icon ni ni-link"></em><span>Invite New Member</span></button></li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
                @if (count($invitations) > 0)
                    <table class="table table-tranx">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th class="tb-tnx-info">
                                    <span class="tb-tnx-desc d-none d-sm-inline-block">
                                        <span>Invitation Link</span>
                                    </span>
                                </th>
                                <th class="tb-tnx-id"><span class="">User Email</span></th>
                                <th class="tb-tnx-amount">
                                    <span class="tb-tnx-total">Created At</span>
                                    <span class="tb-tnx-status d-none d-md-inline-block">User Type</span>
                                </th>
                                <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
                        </thead>
                        <tbody>
                            @foreach ($invitations as $invitation)
                                <tr class="tb-tnx-item">
                                    <td class="tb-tnx-info">
                                        <div class="">
                                            <span
                                                class="title"><kbd>{{ $invitation->getLink() }}</kbd></span>
                                        </div>
                                    </td>
                                    <td class="tb-tnx-id">
                                        <span>{{ $invitation->email }}</span>
                                    </td>
                                    <td class="tb-tnx-amount">
                                        <div class="tb-tnx-total">
                                            <span
                                                class="amount">{{ date('d-m-Y', strtotime($invitation->created_at)) }}</span>
                                        </div>
                                        <div class="tb-tnx-status">
                                            @if ($invitation->is_admin == true)
                                                <span class="badge badge-dot badge-warning">Admin</span>
                                            @else
                                                <span class="badge badge-dot badge-success">Client</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="tb-col-action">
                                        <a wire:loading.remove href="#deleteInvite"
                                            wire:click.prevent='deleteInvite({{ $invitation->id }})'
                                            class="link-cross mr-sm-n1"><em class="icon ni ni-cross"></em></a>

                                        <div wire:loading wire:target="deleteInvite" class="spinner-border spinner-border-sm text-danger" role="status">  <span class="sr-only">Loading...</span></div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-fill alert-icon alert-gray" role="alert">
                        <em class="icon ni ni-alert-circle"></em> 
                        No Team pending invitations available, invite clients and your teammates to start collaborating. 
                    </div>
                @endif
            </div><!-- .card-preview -->
            @if (!empty($invitations))
                <div class="card card-preview">
                    <div class="card-inner">
                        {{ $invitations->links() }}
                    </div>
                </div>
            @endif
        </div><!-- nk-block -->
    </div>


    <!-- Invite user Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="addModal">
        <div class="modal-dialog modal-lg modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Invite teammate to {{ Auth::user()->company->company_name }}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="alert alert-icon alert-success" role="alert">
                                <em class="icon ni ni-alert-circle"></em>
                                Toggle the admin switch to invite a client, default role is client.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Enter Member Email</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-mail"></em>
                                    </div>
                                    <input wire:model="email" type="email" class="form-control email" name="email"
                                        id="default-04" placeholder="Enter email address">
                                </div>
                                @error('email')
                                    <div class="form-note text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">Role</label>
                                <div class="form-control-wrap">
                                    <div class="custom-control custom-switch mt-1">
                                        <input type="checkbox" wire:model='role' class="custom-control-input"
                                            id="customSwitch1">
                                        <label class="custom-control-label" for="customSwitch1">Admin User</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button wire:click='inviteMember' class="btn btn-warning inviteMember"><em
                                    class="icon ni ni-mail"></em><span>Send Invitation</span></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Askari Technologies</span>
                </div>
            </div>
        </div>
    </div>
</div>

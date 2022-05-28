<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block nk-block-lg">
                                    <div class="card card-bordered card-full">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h6 class="title">{{ $total }} Guards posted in {{ $site->name }} 
                                                        </h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="#" class="btn btn-primary" data-toggle="modal"
                                                            data-target="#taskCreate"><em class="icon ni ni-plus"></em>
                                                            <span>Assign Guard</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($total > 0)
                                                @foreach ($guardsAssigned as $guard)
                                                    <div class="card-inner card-inner-md">
                                                        <div class="user-card">
                                                            <div class="user-avatar bg-primary-dim">
                                                                <span> <?php
                                                    $words = explode(" ", "$guard->name");
                                                      $acronym = "";

                                                    foreach ($words as $w) {
                                                     $acronym .= $w[0];
                                                             }
                                                           echo $acronym; ?></span>
                                                            </div>
                                                            <div class="user-info">
                                                                <span class="lead-text">{{ $guard->name }}</span>
                                                                <span
                                                                    class="sub-text">{{ $guard->phone }}</span>
                                                            </div>
                                                            <div class="user-action">
                                                                <a href="#deleteSite" wire:click.prevent='deleteConfirm({{ $guard->id }})' class="btn btn-round btn-icon btn-sm btn-outline-primary"><em class="icon ni ni-trash"></em></a>
                                                                {{-- <a href="#deleteSite" wire:click.prevent='addtoSite({{ $guard->id }})' class="btn btn-round btn-icon btn-sm btn-outline-primary"><em class="icon ni ni-trash"></em></a> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="card">
                                                    <div class="card-inner">
                                                        <div class="nk-block-between-md g-3">
                                                            <div class="g">
                                                                {{ $guardsAssigned->links() }}
                                                                <!-- .pagination -->
                                                            </div>
                                                        </div><!-- .nk-block-between -->
                                                    </div>
                                                </div>
                                            @else
                                                <div class="card-inner card-inner-md">
                                                    <p class="text-center">No guards assined to this site</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div><!-- .card -->
                                </div><!-- nk-block -->
                            </div>
                            @include('livewire.sites.navigation')
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>

    {{-- Select Guard --}}
    <div class="modal fade" wire:ignore.self id="taskCreate">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-top modal-md" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Assign Guards to {{ $site->name }}</h5>
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <p>Only guards who are not assigned to a site will be visible in this window.</p>
                            </div>
                        </div>
                        <div class="form-control-wrap mb-3">
                            <div class="form-icon form-icon-right">
                                <em class="icon ni ni-search"></em>
                            </div>
                            <input wire:model.debounce.350ms='search' type="text" class="form-control" id="default-04" placeholder="Search by name">
                        </div>
                        <div class="card card-bordered card-preview">
                            <table class="table table-ulogs">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="tb-col-os"><span class="overline-title">Guard Name <span
                                                    class="d-sm-none">/ IP</span></span></th>
                                        <th class="tb-col-ip"><span class="overline-title">Phone</span></th>
                                        <th class="tb-col-action"><span class="overline-title">&nbsp;</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($allGuards as $siteguard)
                                    <tr>
                                        <td class="tb-col-os">
                                            <div class="user-card">
                                                <div class="user-avatar sm bg-warning">
                                                    <span>AB</span>
                                                </div>
                                                <div class="user-name">
                                                    <span class="tb-lead">{{ $siteguard->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="tb-col-ip"><span class="sub-text">{{ $siteguard->phone }}</span>
                                        </td>
                                        <td class="tb-col-action">
                                            <a href="#addtoSite" wire:click.prevent='addtoSite({{ $siteguard->id }})' class="link-cross mr-sm-n1"><em
                                                    class="icon ni {{ !empty($siteguard->site_id) && $siteguard->site_id == $site->id ? 'ni-cross text-danger' : 'ni-check text-success' }}"></em></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center w-100">
                                        <td class="w-100">
                                            <p>No records found</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div><!-- .card-preview -->
                    </div><!-- nk-block -->
                </div>
            </div>
        </div>
    </div><!-- .Edit Modal-Content -->
</div>

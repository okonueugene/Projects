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
                                                        <h6 class="title">{{ count($patrols) }} Patrols :
                                                            {{ $site->name }}
                                                        </h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="{{ route('org.site-create-patrol', $site->id) }}" class="btn btn-sm btn-secondary"><em class="icon ni ni-plus"></em>
                                                            <span>Add Patrol</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card -->
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="d-flex align-items-center">
                                                
                                                <button onclick="confirm('Are you sure you want to delete these records?') || event.stopImmediatePropagation()" wire:click.prevent='deletePatrols' class="btn mr-2 btn-round btn-sm btn-danger"><span>Selected ({{ count($checked) }})</span><em class="icon ni ni-trash"></em></button>
                                                
                                                
                                                <div class="form-control-wrap ml-auto">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="default-04" placeholder="Search by name">
                                                </div>

                                            </div>
                                        </div><!-- .card-inner -->
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="card-inner p-0">
                                            @if (count($patrols) > 0)
                                            <div class="nk-tb-list nk-tb-ulist is-compact">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col nk-tb-col-check">
                                                        <div
                                                            class="custom-control custom-control-sm custom-checkbox notext">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="uid">
                                                            <label class="custom-control-label" for="uid"></label>
                                                        </div>
                                                    </div>
                                                    <div class="nk-tb-col"><span class="sub-text">Guard</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span
                                                            class="sub-text">Round Name</span></div>
                                                    <div class="nk-tb-col"><span
                                                            class="sub-text">Timing</span>
                                                    </div>
                                                    <div class="nk-tb-col nk-tb-col-tools text-right">
                                                        <span>Actions</span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                @foreach ($patrols as $patrol)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input wire:loading.attr='disabled' wire:model='checked' value="{{ $patrol->id }}" type="checkbox" class="custom-control-input"
                                                                    id="{{ $patrol->id }}">
                                                                <label class="custom-control-label" for="{{ $patrol->id }}"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <div class="user-card">
                                                                    <div class="user-avatar xs bg-warning">
                                                                        <span>NFC</span>
                                                                    </div>
                                                                <div class="user-name">
                                                                    @if ($patrol->owner)
                                                                        <span class="tb-lead">{{ $patrol->owner->name }} {{ $patrol->id }}</span>
                                                                    @else
                                                                        <span class="tb-lead">No Guard Attached</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>{{ $patrol->name }}</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <span>{{ date('H:i', strtotime($patrol->start)) }} - {{ date('H:i', strtotime($patrol->end)) }}</span>
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools text-center">
                                                            <button wire:click="showPatrolDetails({{ $patrol->id }})" class="btn btn-icon btn-sm btn-warning" data-toggle="modal" data-target="#addModal"><em class="icon ni ni-eye"></em></button>
                                                            <button wire:click="deletePatrol({{ $patrol->id }})" class="btn btn-icon btn-sm btn-danger"><em class="icon ni ni-trash"></em></button>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                @endforeach
                                            </div>
                                            @else
                                                <div class="text-center p-2">
                                                    <p>No patrols available</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <ul class="pagination justify-content-center justify-content-md-start">
                                                
                                            </ul><!-- .pagination -->
                                        </div><!-- .card-inner -->
                                    </div>
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
    <div class="modal fade" wire:ignore.self id="addModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-top modal-md" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title text-center">Patrol Details</h5>
                    <div class="team">
                        <div class="user-card user-card-s2">
                            <div class="user-avatar md bg-primary">
                                <span>AB</span>
                            </div>
                            <div class="user-info">
                                <h6>{{ $guard }}</h6>
                                <span class="sub-text">Askari Tech Ltd</span>
                            </div>
                        </div>
                        <ul class="team-info">
                            <li><span>Patrol Name</span><span>{{ $name }}</span></li>
                            <li><span>Patrol Start</span><span>{{ $start }}</span></li>
                            <li><span>Patrol End</span><span>{{ $end }}</span></li>
                        </ul>
                    </div><!-- .team -->
                    <div class="description1">
                        <div class="title text-center text-muted mb-2">
                            <h6 class="text-muted">Checkpoints</h6>
                        </div>
                        <div class="d-flex bg-light">
                            <div class="p-2 bg-light">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <div class="d-flex align-items-center">
                        <div class="ml-auto">
                            <span>Askari Technologies</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div><!-- .Edit Modal-Content -->
</div>

@push('styles')
    <style>
        #single {
            display: none;
        }

        #multiple {
            display: none;
        }

    </style>
@endpush

@push('scripts')
    <script type="text/javascript">
        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            if (inputValue == "single") {
                $("#single").show();
                $("#multiple").hide();
            } else {
                $("#multiple").show();
                $("#single").hide();
            }
        });
    </script>

    <script>
        window.addEventListener('swal:confirm', event => {
            Swal.fire({
                title: event.detail.title,
                text: event.detail.message,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonText: event.detail.confirmButtonText
            }).then(function (result) {
                if (result.value) {
                    window.livewire.emit('deleteCSingleRecord', event.detail.id);
            }
        });
        e.preventDefault();
        });
    </script>
@endpush

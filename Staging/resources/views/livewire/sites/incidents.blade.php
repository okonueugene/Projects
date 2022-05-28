<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner bg-lighter card-inner-lg">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title"></h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-search"></em>
                                                                </div>
                                                                <input type="text" class="form-control" id="default-04" placeholder="Quick search by id">
                                                            </div>
                                                        </li>
                                                        <div class="card-tools">
                                                        <a href="#" class="btn btn-md btn-primary" data-toggle="modal"
                                                            data-target="#addModal"><em class="icon ni ni-plus"></em>
                                                            <span>Add Incident</span>
                                                        </a>
                                                    </div>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="nk-tb-list is-separate is-medium mb-3">
                                        <div class="nk-tb-item nk-tb-head">
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="oid">
                                                    <label class="custom-control-label" for="oid"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col"><span>Incident No</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Police Ref</span></div>
                                            <div class="nk-tb-col tb-col-sm"><span>Title</span></div>
                                            <div class="nk-tb-col">Date</div>
                                            <div class="nk-tb-col tb-col-md"><span>Reported By</span></div>
                                            <div class="nk-tb-col tb-col-md"><span>Status</span></div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                         @foreach ($incidences as $incidence)
                                        <div class="nk-tb-item">
                                           
                                            <div class="nk-tb-col nk-tb-col-check">
                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                    <input type="checkbox" class="custom-control-input" id="oid01">
                                                    <label class="custom-control-label" for="oid01"></label>
                                                </div>
                                            </div>
                                            <div class="nk-tb-col">
                                                <span class="tb-lead"><a href="#">{{$incidence->incident_no}}</a></span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-lead">{{$incidence->police_ref}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-sm">
                                                <span class="tb-lead">{{$incidence->title}}</span>
                                            </div>
                                            <div class="nk-tb-col">
                                            <span class="tb-sub">{{$incidence->date}}</span>
                                            </div>
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="tb-sub">{{$incidence->reported_by}}</span>
                                            </div>
                                        
                                            <div class="nk-tb-col tb-col-md">
                                                <span class="badge badge-success">Closed</span>
                                                <!-- <span class="badge badge-danger">Open</span> -->
                                            </div>
                                            <div class="nk-tb-col nk-tb-col-tools">
                                                <ul class="nk-tb-actions gx-1">
                                                     <div class="drodown mr-n1">
                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a href="#"  class="icon ni ni-eye" data-toggle="modal"
                                                                        data-target="#viewModal"><span>View Details</span></a></li>
                                                                    <li><a href="#deleteIncident" wire:click.prevent="deleteIncident(1)">Delete</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .nk-tb-item -->
                                        @endforeach
                                    </div><!-- .nk-tb-list -->
                                    <div class="card">
                                        <div class="card-inner">
                                            <div class="nk-block-between-md g-3">
                                                <div class="g">
                                                    <ul class="pagination justify-content-center justify-content-md-start">
                                                        <li class="page-item"><a class="page-link" href="#"><em class="icon ni ni-chevrons-left"></em></a></li>
                                                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                        <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                                                        <li class="page-item"><a class="page-link" href="#">7</a></li>
                                                        <li class="page-item"><a class="page-link" href="#"><em class="icon ni ni-chevrons-right"></em></a></li>
                                                    </ul><!-- .pagination -->
                                                </div>
                                            </div><!-- .nk-block-between -->
                                        </div>
                                    </div>
                                </div><!-- .nk-block -->
                                
                            </div>
                            @include('livewire.sites.navigation')
                        </div><!-- .card-aside-wrap -->
                    </div><!-- .card -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
    {{-- Add Incident Modal --}}
    <div  wire:ignore.self class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg modal-dialog-top" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Add Incident</h5>
                    <form wire:submit.prevent="addIncident" class="mt-2">
                        @csrf
                        <div class="row g-gs">
                
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="incident_no">Incident No</label>
                                    <div class="form-control-wrap">
                                        <input wire:model="incident_no" type="text" class="form-control" id="incident_no" placeholder="Enter Incident No">
                                    </div>
                                    @error('incident_no')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="police_ref">Police Ref</label>
                                    <div class="form-control-wrap">
                                        <input wire:model="police_ref" type="text" class="form-control" id="police_ref" placeholder="Enter Police Ref">
                                    </div>
                                    @error('police_ref')
                                    <div class="form-note text-danger mt-1">{{ $message }}</div>
                                @enderror
                                </div>
                                
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="title">Title</label>
                                    <div class="form-control-wrap">
                                        <input wire:model="title" type="text" class="form-control" id="title" placeholder="Enter Title">
                                    </div>
                                    @error('title')
                                    <div class="form-note text-danger mt-1">{{ $message }}</div>
                                @enderror
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="date">Date</label>
                                    <div class="form-control-wrap">
                                        <input wire:model="date" type="date" class="form-control" id="date" placeholder="Enter Police Ref">
                                    </div>
                                    @error('date')
                                    <div class="form-note text-danger mt-1">{{ $message }}</div>
                                @enderror
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="order-id">Reported By</label>
                                    <div class="form-control-wrap">
                                        <input wire:model="reported_by" type="text" class="form-control" id="order-id" placeholder="Enter Guard Name">
                                    </div>
                                    @error('reported_by')
                                    <div class="form-note text-danger mt-1">{{ $message }}</div>
                                @enderror
                                </div>
                                
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-secondary">
                                    <div wire:loading wire:target='addIncident'>
                                        
                                    </div>Add
                                </button>
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- .Add Modal-Content -->

<div class="modal fade" id="viewModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-top modal-md" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body modal-body-md">
                <h5 class="modal-title text-center">Incident Details</h5>
                <div class="team">
                    <div class="user-card user-card-s2">
                        <div class="user-avatar md bg-primary">
                            <span></span>
                        </div>
                        <div class="user-info">
                            <h6></h6>
                            <span class="sub-text">Askari Tech Ltd</span>
                        </div>
                    </div>
                    <ul class="team-info">
                        <li><span>Incident Title</span><span>{{$incidence->title}}</span></li>
                        <li><span>Incident No</span><span>{{$incidence->incident_no}}</span></li>
                        <li><span>Police_Ref_No</span><span>{{$incidence->police_ref}}</span></li>
                        <li><span>Date Occured</span><span>{{$incidence->date}}</span></li>
                        <li><span>Reported By</span><span>{{$incidence->reported_by}}</span></li>
                        <li><span>Incident Status</span>{{$incidence->status}}<span></span></li>
                    </ul>
                </div><!-- .team -->
            
                <div class="description1">
                    <div class="title text-center text-muted mb-2">
                        <h6 class="text-muted">Description</h6>
                    </div>
                    <div class="d-flex bg-light">
                        <div class="p-2 bg-light">{{$incidence->description}}</div>
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

@push('scripts')
    
@endpush

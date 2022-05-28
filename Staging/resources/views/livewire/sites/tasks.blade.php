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
                                                        <h6 class="title">Tasks
                                                        </h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="#" class="btn btn-sm btn-secondary" data-toggle="modal"
                                                            data-target="#addModal"><em class="icon ni ni-plus"></em>
                                                            <span>Add Task</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card -->
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="d-flex align-items-center">
                                            
                                                <button onclick="confirm('Are you sure you want to delete these records?') || event.stopImmediatePropagation()" wire:click.prevent='deleteRecords' class="btn mr-2 btn-round btn-sm btn-danger"><span>Selected 1</span><em class="icon ni ni-trash"></em></button>
                                               
                                                <button class="btn btn-icon btn-sm btn-circle btn-dark" data-toggle="modal" data-target="#printPDF"><em class="icon ni ni-printer"></em></button>
                                                <div class="form-control-wrap ml-auto">
                                                    <div class="form-icon form-icon-right">
                                                        <em class="icon ni ni-search"></em>
                                                    </div>
                                                    <input type="text" class="form-control" id="default-04" placeholder="Search by title or guard">
                                                </div>

                                            </div>
                                        </div><!-- .card-inner -->
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="card-inner p-0">
                                            @if (count($tasks) > 0)
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
                                                    <div class="nk-tb-col"><span class="sub-text">Guard
                                                            Name</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span
                                                            class="sub-text">Title</span></div>
                                                    <div class="nk-tb-col"><span
                                                            class="sub-text">Status</span></div>
                                                    <div class="nk-tb-col nk-tb-col-tools text-right">
                                                        <span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                @foreach ($tasks as $task)
                                                    <div class="nk-tb-item">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input wire:loading.attr='disabled' wire:model="checked" value="{{ $task->id }}" type="checkbox" class="custom-control-input"
                                                                    id="{{ $task->id }}">
                                                                <label class="custom-control-label" for="{{ $task->id }}"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <div class="user-card">
                                                                <div class="user-avatar xs bg-primary">
                                                                    <span><?php
                                                                    
                                                    $words = explode(" ", $task->owner->name);
                                                      $acronym = "";

                                                    foreach ($words as $w) {
                                                     $acronym .= $w[0];
                                                             }
                                                           echo $acronym; ?></span>
                                                                </div>  
                                                                <div class="user-name">
                                                                    <span class="tb-lead">{{ $task->owner->name }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>{{ $task->title }}</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            @if ($task->status == 'pending')
                                                                <span class="badge badge-warning">{{ $task->status }}</span>
                                                            @else
                                                                <span class="badge badge-success">{{ $task->status }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools text-center">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown" aria-expanded="false"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-xs" style="">
                                                                    <ul class="link-list-plain">
                                                                        <li> <a href="#" data-toggle="modal"
                                                            data-target="#viewModal">
                                                            <span>View</span>
                                                        </a></li>
                                                                        <li><a href="#updateTask" wire:click.prevent="updateTask({{ $task->id }})">{{ $task->status == 'pending' ? 'Complete' : 'Pending' }}</a></li>
                                                                        <li><a href="#deleteTask" wire:click.prevent="deleteTask({{ $task->id }})">Delete</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- .nk-tb-item -->
                                                @endforeach
                                            </div>
                                            @else
                                                <div class="text-center p-2">
                                                    <p>No data available</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <ul class="pagination justify-content-center justify-content-md-start">
                                                {{ $tasks->links() }}
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

    {{-- Add Task Modal --}}
    <div  wire:ignore.self class="modal fade" id="addModal">
        <div class="modal-dialog modal-lg modal-dialog-top" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title">Create Task</h5>
                    <form wire:submit.prevent='createTask' class="mt-2">
                        <div class="row g-gs">
                            <div class="col-md-12">
                                @error('oops')
                                    <div class="alert alert-icon alert-danger" role="alert">    
                                        <em class="icon ni ni-alert-circle"></em>     
                                        <strong>Error!</strong> From should not be greater than to. 
                                    </div>
                                @enderror
                            </div>
                            <div @if ($diff) style="display: none" @endif class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="full-name-1">Select
                                        Guard</label>
                                    <div class="form-control-wrap">
                                        <div wire:ignore>
                                            <select class="custom-select form-select"
                                                data-search="on">
                                                <option>Select Guard</option>
                                                @foreach ($siteguards as $siteguard)
                                                    <option value="{{ $siteguard->id }}">
                                                        {{ $siteguard->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="oder-id">Title</label>
                                    <div class="form-control-wrap">
                                        <input wire:model.lazy='title' type="text" class="form-control" id="oder-id" placeholder="Enter task title">
                                    </div>
                                    @error('title')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="from">From</label>
                                    <div class="form-control-wrap">
                                        <input wire:model.lazy='from' type="time" class="form-control" id="from" placeholder="">
                                    </div>
                                    @error('from')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="to">To</label>
                                    <div class="form-control-wrap">
                                        <input wire:model.lazy='to' type="time" class="form-control" id="to" placeholder="">
                                    </div>
                                    @error('to')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">    
                                    <label class="form-label">From {{ $pick_from }}</label>
                                        <div class="form-control-wrap">        
                                            <input wire:model="pick_from" type="text" class="form-control pick-from time-picker" placeholder="Input placeholder">    
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">    
                                    <label class="form-label">To</label>
                                        <div class="form-control-wrap">        
                                            <input type="text" class="form-control time-picker" placeholder="Input placeholder">    
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-label-group">
                                        <label class="form-label" for="description">Description</label>
                                    </div>
                                    <div class="form-control-wrap">
                                        <textarea wire:model.lazy="description" class="form-control" name="description" id="decription" cols="10" rows="3"></textarea>
                                    </div>
                                    @error('description')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <button data-dismiss="modal" type="submit" class="btn btn-secondary">Close</button>
                                @if ($guard)
                                    <button class="btn btn-warning" type="submit">
                                        <div wire:loading wire:target='createTask'>
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        </div>
                                        <div>
                                            <span> Create Task</span>
                                        </div>
                                    </button>
                                @endif
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
                    <h5 class="modal-title text-center">Task Details</h5>
                    <div class="team">
                        <div class="user-card user-card-s2">
                            <div class="user-avatar md bg-primary">
                                <span><?php
                                                                    
                                                                    $words = explode(" ", $task->owner->name);
                                                                      $acronym = "";
                
                                                                    foreach ($words as $w) {
                                                                     $acronym .= $w[0];
                                                                             }
                                                                           echo $acronym; ?></span>
                            </div>
                            <div class="user-info">
                                <h6>{{ $task->owner->name }}</h6>
                                <span class="sub-text">Askari Tech Ltd</span>
                            </div>
                        </div>
                        <ul class="team-info">
                            <li><span>Task Title</span><span>{{ $task->title }}</span></li>
                            <li><span>Task Status</span><span>{{ $task->status }}</span></li>
                        </ul>
                    </div><!-- .team -->
                    <div class="description1">
                        <div class="title text-center text-muted mb-2">
                            <h6 class="text-muted">Description</h6>
                        </div>
                        <div class="d-flex bg-light">
                            <div class="p-2 bg-light">{{$task->description}}</div>
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
    <script>
        $(document).ready(function() {
            $('.custom-select').select2();

            $('.custom-select').on('change', function(e) {
                @this.set('guard', e.target.value);
            });
        });
    </script>
@endpush

@push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {
            $(document).ready(function(){
                $('.timepicker').timepicker({ 
                    timeFormat: 'h:mm'
                });

                $('.timepicker').on('change', function (e) {
                    
                    @this.set('pick_from', e.target.value);

                    console.log("Hi there");
                });
            });
        });  
    </script>
@endpush


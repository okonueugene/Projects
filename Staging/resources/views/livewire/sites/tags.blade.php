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
                                                        <h6 class="title">{{ $total }} Tags associated
                                                            to
                                                            {{ $site->name }}
                                                        </h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="#" class="btn btn-sm btn-primary" data-toggle="modal"
                                                            data-target="#addModal"><em class="icon ni ni-plus"></em>
                                                            <span>Add QR Tag</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card -->
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="d-flex align-items-center">
                                                @if ($checked)
                                                    <button onclick="confirm('Are you sure you want to delete these records?') || event.stopImmediatePropagation()" wire:click.prevent='deleteRecords' class="btn mr-2 btn-round btn-sm btn-danger"><span>Selected ({{ count($checked) }})</span><em class="icon ni ni-trash"></em></button>
                                                @endif
                                                <button class="btn btn-icon btn-sm btn-circle btn-dark" data-toggle="modal" data-target="#printPDF"><em class="icon ni ni-printer"></em></button>
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
                                            @if (count($tags) > 0)
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
                                                    <div class="nk-tb-col"><span class="sub-text">Tag
                                                            ID</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span
                                                            class="sub-text">Location</span></div>
                                                    <div class="nk-tb-col"><span
                                                            class="sub-text">Type</span></div>
                                                    <div class="nk-tb-col nk-tb-col-tools text-right">
                                                        <span></span>
                                                    </div>
                                                </div><!-- .nk-tb-item -->
                                                @foreach ($tags as $tag)
                                                    <div class="nk-tb-item @if ($this->isChecked($tag->id)) bg-warning-dim @endif">
                                                        <div class="nk-tb-col nk-tb-col-check">
                                                            <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                <input wire:loading.attr='disabled' wire:model='checked' value="{{ $tag->id }}" type="checkbox" class="custom-control-input"
                                                                    id="{{ $tag->id }}">
                                                                <label class="custom-control-label" for="{{ $tag->id }}"></label>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            <div class="user-card">
                                                                @if ($tag->type == 'qr')
                                                                    <div class="user-avatar xs bg-primary">
                                                                        <span>{!! QrCode::size(50)->generate($tag->code); !!}</span>
                                                                    </div>
                                                                @elseif($tag->type == 'nfc')
                                                                    <div class="user-avatar xs bg-warning">
                                                                        <span>NFC</span>
                                                                    </div>
                                                                @elseif ($tag->type == 'virtual')
                                                                    <div class="user-avatar xs bg-secondary">
                                                                        <span>VT</span>
                                                                    </div>
                                                                @endif
                                                                <div class="user-name">
                                                                    <span class="tb-lead">{{ $tag->code }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="nk-tb-col tb-col-md">
                                                            <span>{{ $tag->location }}</span>
                                                        </div>
                                                        <div class="nk-tb-col">
                                                            @if ($tag->type == 'nfc')
                                                                <span class="tb-status text-success">NFC Tag</span>
                                                            @elseif($tag->type == 'qr')
                                                                <span class="tb-status text-warning">QR Tag</span>
                                                            @else
                                                                <span class="tb-status text-danger">VT Tag</span>
                                                            @endif
                                                        </div>
                                                        <div class="nk-tb-col nk-tb-col-tools text-center">
                                                            <button wire:click='deleteSingleRecord({{ $tag->id }})' class="btn btn-icon btn-sm btn-danger"><em class="icon ni ni-trash"></em></button>
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
                                                {{ $tags->links() }}
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
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross-sm"></em>
                </a>
                <div class="modal-body modal-body-md">
                    <h5 class="modal-title text-center">Create a Tag</h5>
                    <div class="row mt-2">
                        <div class="col-md-12 text-center">
                            <div class="custom-control custom-checkbox custom-control-pro no-control">
                                <input type="radio" value="single" class="custom-control-input" name="btnIconRadio"
                                    id="btnIconRadio1">
                                <label class="custom-control-label" for="btnIconRadio1"><em
                                        class="icon ni ni-tag-alt"></em><span>Single</span></label>
                            </div>
                            <div class="custom-control custom-checkbox custom-control-pro no-control">
                                <input type="radio" value="multiple" class="custom-control-input" name="btnIconRadio"
                                    id="btnIconRadio2">
                                <label class="custom-control-label" for="btnIconRadio2"><em
                                        class="icon ni ni-tags"></em><span>Multiple</span></label>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self id="multiple">
                        <div class="mt-4">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-control-wrap">
                                        <div class="input-group">
                                            <input wire:model='number' type="number" class="form-control"
                                                placeholder="Number of tags">
                                            <div class="input-group-append">
                                                <button wire:click.prevent='addMultipleTags'
                                                    class="btn btn-secondary">Generate</button>
                                            </div>
                                        </div>
                                        @error('number')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-danger mt-1 text-muted">Only QR codes will be generated</p>
                                </div>
                                <div wire:loading wire:target='addMultipleTags' class="col-md-12">
                                    <div class="d-flex align-items-center">
                                        <strong>Generating {{ $number }} Tag(s).....</strong>
                                        <div class="spinner-border text-warning ml-auto" role="status"
                                            aria-hidden="true"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self id="single">
                        <form wire:submit.prevent='addSingleTag' class="mt-2">
                            <div class="row g-gs">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="oder-id">Tag Name</label>
                                        <div class="form-control-wrap">
                                            <input wire:model.lazy='name' type="text" class="form-control"
                                                id="oder-id" placeholder="Enter tag name">
                                        </div>
                                        @error('name')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="item-code">Location</label>
                                        <div class="form-control-wrap">
                                            <input wire:model.lazy='location' type="text" class="form-control"
                                                id="item-code" placeholder="Main Entrance">
                                        </div>
                                        @error('location')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="form-label" for="item-code">Code</label>
                                        <div class="form-control-wrap">
                                            <p>{{ $value }}</p>
                                            <div class="input-group">
                                                <input wire:model='code' type="number"
                                                    value="{{ $this->code == $value }}" class="form-control"
                                                    placeholder="{{ $value }}">
                                                <div class="input-group-append">
                                                    <button wire:click.prevent='generateCode'
                                                        class="btn btn-outline-secondary">Generate</button>
                                                </div>
                                            </div>
                                        </div>
                                        @error('code')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="price">Latitude</label>
                                        <div class="form-control-wrap">
                                            <input wire:model.lazy='lat' type="text" class="form-control" id="phone"
                                                placeholder="23.464546">
                                        </div>
                                        @error('latitude')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="tax">Longititude</label>
                                        <div class="form-control-wrap">
                                            <input wire:model.lazy='long' type="text" class="form-control" id="tax"
                                                placeholder="-12.353533">
                                        </div>
                                        @error('longititude')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button data-dismiss="modal" type="submit" class="btn btn-secondary">Close</button>
                                    <button class="btn btn-warning" type="submit">
                                        <div wire:loading wire:target='addSingleTag'>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                        </div>
                                        <div>
                                            <span> Add Tag</span>
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .Edit Modal-Content -->

    <!-- Print Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="printPDF">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-top modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-header">
                    <h5 class="modal-title">Print Selected</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($checked)
                            @foreach ($this->getDetails() as $print)
                            <div class="p-2">
                                {!! QrCode::size(75)->generate($print->code); !!}
                                <p class="text-center">{{ $print->id }}</p>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button class="btn btn-secondary btn-round"><em class="icon ni ni-download-cloud"></em><span>Export PDF</span></button>
                </div>
            </div>
        </div>
    </div>
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

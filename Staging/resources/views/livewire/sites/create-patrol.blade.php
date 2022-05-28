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
                                                        <h6 class="title">Create Patrol
                                                        </h6>
                                                    </div>
                                                    <div class="card-tools">
                                                        <a href="{{ route('org.site-patrols', $site->id) }}"
                                                            class="btn btn-sm btn-secondary"><em
                                                                class="icon ni ni-arrow-left"></em>
                                                            <span>Go Back</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-inner">
                                                <div class="alert alert-icon alert-success" role="alert">
                                                    <em class="icon ni ni-alert-circle"></em>
                                                    <strong>Please</strong> fill in the information below to continue.
                                                </div>
                                                <form action="#">
                                                    <div class="row g-4">
                                                        <div class="col-lg-6">
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
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="full-name-1">Round
                                                                    Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input wire:model='round_name' type="text"
                                                                        class="form-control" id="round_name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Start Time</label>
                                                                <div class="form-control-wrap">
                                                                    <div wire:ignore>
                                                                        <input wire:model='start_time' type="time"
                                                                            class="start-time form-control"
                                                                            placeholder="Patrol Start time">
                                                                    </div>
                                                                </div>
                                                                <div class="form-note">Tmme format
                                                                    <code>H:mm</code>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label">End Time</label>
                                                                <div class="form-control-wrap">
                                                                    <div wire:ignore>
                                                                        <input wire:model='end_time' type="time"
                                                                            class="end-time form-control"
                                                                            placeholder="Patrol end time">
                                                                    </div>
                                                                </div>
                                                                <div class="form-note">Time format
                                                                    <code>H:mm</code>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if ($guard && $round_name && $start_time && $end_time)
                                                            <div class="col-lg-12">
                                                                <div class="card card-preview">
                                                                    <div class="card-inner">
                                                                        <h6 class="title mb-3">Select Checkpoints</h6>
                                                                        <ul class="custom-control-group">
                                                                            @foreach ($sitetags as $tag)
                                                                            <li>
                                                                                <div
                                                                                    class="custom-control custom-control-sm custom-checkbox custom-control-pro">
                                                                                    <input type="checkbox" wire:model='tags' value="{{ $tag->id }}" class="custom-control-input" name="btnCheckControl"
                                                                                        id="{{ $tag->id }}"><label class="custom-control-label"
                                                                                        for="{{ $tag->id }}">{{ $tag->name == null ? $tag->code : $tag->location }}</label></div>
                                                                            </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-group">
                                                                    <button type="button" wire:click="createPatrol"
                                                                        class="btn btn btn-secondary">Add Patrol</button>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </form>
                                            </div>
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
            }).then(function(result) {
                if (result.value) {
                    window.livewire.emit('deleteCSingleRecord', event.detail.id);
                }
            });
            e.preventDefault();
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.custom-select').select2();

            $('.custom-select').on('change', function(e) {
                @this.set('guard', e.target.value);
            });
        });
    </script>

    {{-- //Date --}}
    {{-- <script>
        $('#datepicker').on('change', function (e) {
            @this.set('date', e.target.value);
        });
    </script>
    <script>
        ('#datepicker').datepicker({
           dateFormat: 'dd-mm-yy',
        });
        
        $('#datepicker').on('change', function (e) {
               @this.set('date', e.target.value);
        });
    </script> --}}
@endpush

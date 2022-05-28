@push('styles')
    <style>
        .pac-container {
            z-index: 1051 !important;
        }

    </style>
@endpush
<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Sites List</h3>
                    <div class="nk-block-des text-soft">
                        <p>You have total {{ $total }} sites(s).</p>
                    </div>
                </div><!-- .nk-block-head-content -->
                <div class="nk-block-head-content">
                    <div class="toggle-wrap nk-block-tools-toggle">
                        <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em
                                class="icon ni ni-menu-alt-r"></em></a>
                        <div class="toggle-expand-content" data-content="pageMenu">
                            <ul class="nk-block-tools g-3">
                                <li><button class="btn btn-secondary" data-toggle="modal" data-target="#addModal"><em
                                            class="icon ni ni-link"></em><span>Add new Site</span></button></li>
                            </ul>
                        </div>
                    </div><!-- .toggle-wrap -->
                </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            @if ($sites->count() > 0)
                <div class="row g-gs">
                    @foreach ($sites as $site)
                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <div class="team">
                                        @if ($site->is_active == true)
                                            <div class="team-status bg-success text-white"><em
                                                    class="icon ni ni-check-thick"></em></div>
                                        @else
                                            <div class="team-status bg-danger text-white"><em
                                                    class="icon ni ni-na"></em></div>
                                        @endif

                                        <div class="team-options">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-sm btn-icon btn-trigger"
                                                    data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="{{ route('org.site-overview', $site->id) }}"><em class="icon ni ni-eye"></em><span>View
                                                                    Details</span></a></li>
                                                        <li class="divider"></li>
                                                        <li><a href="#editModal" data-toggle="modal"><em class="icon ni ni-edit"></em><span>Edit
                                                                    Site</span></a></li>
                                                        <li><a href="#"
                                                                wire:click.prevent="activateSite({{ $site->id }})"><em
                                                                    class="{{ $site->is_active == false ? 'icon ni ni-check' : 'icon ni ni-cross' }}"></em><span>{{ $site->is_active == false ? 'Activate Site' : 'Deactivate Site' }}</span></a>
                                                        </li>
                                                        <li><a href="#"
                                                                wire:click.prevent="deleteSite({{ $site->id }})"><em
                                                                    class="icon ni ni-trash"></em><span>Delete
                                                                    Site</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="user-card user-card-s2">
                                            <div class="user-avatar sq md bg-primary">
                                                <img src="{{ url('storage/' . $site->logo) }}" alt="" title="">
                                            </div>
                                            <div class="user-info">
                                                @if (!empty($site->owner->name))
                                                    {{ $site->owner->name }}
                                                @else
                                                    <p>No Associated Client</p>
                                                @endif
                                            </div>
                                        </div>
                                        <ul class="team-statistics">
                                            <li><span>{{ count($site->guards) }}</span><span>Guards</span></li>
                                            <li><span>{{ count($site->patrols) }}</span><span>Patrols</span></li>
                                            <li><span>{{ count($site->tags) }}</span><span>Tags</span></li>
                                        </ul>
                                        <div class="team-view">
                                            <a href="{{ route('org.site-overview', $site->id) }}"
                                                class="btn btn-round btn-outline-light w-150px"><span>View
                                                    Site</span></a>
                                        </div>
                                    </div><!-- .team -->
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                    @endforeach
                    <div class="col-md-12">
                        {{ $sites->links() }}
                    </div>
                </div>
            @else
                <div class="row g-gs">
                    <div class="col-md-12">
                        <div class="alert alert-pro alert-warning">
                            <div class="alert-text">
                                <h6>No sites onboarded!</h6>
                                <p>Click on the <strong>Add New Site</strong> button to configure a site. </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div><!-- .nk-block -->
    </div>


    <!-- Add Site Modal -->
    <div wire:ignore.self class="modal fade" tabindex="-1" id="addModal">
        <div class="modal-dialog modal-lg modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Site to {{ Auth::user()->company->company_name }}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent='addSite'>
                        <div class="row gy-4">
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address_address">Address</label>
                                    <input wire:ignore type="text" id="address-input" name="address_address"
                                        class="form-control map-input">
                                    <input type="hidden" name="address_latitude" id="address-latitude" value="0" />
                                    <input type="hidden" name="address_longitude" id="address-longitude" value="0" />
                                </div>
                                <div wire:ignore class="card card-bordered" id="address-map-container"
                                    style="width:100%;height:150px; ">
                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Enter Site Address</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-location"></em>
                                        </div>
                                        <input type="name" wire:model='location' class="form-control location"
                                            name="name" id="default-04" placeholder="Enter site location">
                                        <input type="hidden" name="lat" id="address-latitude" />
                                        <input type="hidden" name="long" id="address-longitude"/>
                                    </div>
                                    @error('location')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="form-label" for="customFileLabel">Select Logo</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" wire:model='logo' class="custom-file-input"
                                                id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('logo')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 justify-content-center text-center">
                                <div class="form-group">
                                    <div class="logo-preview text-center">
                                        <div class="user-avatar lg bg-info">
                                            @if ($logo)
                                                <img src="{{ $logo->temporaryUrl() }}">
                                            @else
                                                <span>AS</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Enter Site Name</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-mail"></em>
                                        </div>
                                        <input type="text" wire:model='name' class="form-control" name="name"
                                            id="default-04" placeholder="Enter site name">
                                    </div>
                                    @error('name')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Timezone</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-location"></em>
                                        </div>
                                        <input type="timezone" wire:model='timezone' class="form-control location"
                                            name="name" id="default-04" placeholder="Africa/Nairobi">
                                    </div>
                                    @error('timezone')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 justify-content-center mx-auto">
                                <button class="btn btn-primary" type="submit">
                                    <div wire:loading wire:target="addSite">
                                        <span class="spinner-grow spinner-grow-sm" role="status"
                                            aria-hidden="true"></span>
                                    </div>
                                    <span> Add Site </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Askari Technologies</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Site Modal -->

     <!-- Edit Site Modal -->
     <div class="modal fade" tabindex="-1" id="editModal">
        <div class="modal-dialog modal-lg modal-dialog-top" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Site {{ $site->name }}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form action="{{ route('org.update-site', $site->id) }}" method="POST">
                    @csrf
                        <div class="row gy-4">
                           
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Enter Site Name</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-location"></em>
                                        </div>
                                        <input type="text"  class="form-control location"
                                            name="name" id="name" placeholder="Enter site location">
                                        
                                    </div>
                                    @error('location')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="form-label" for="customFileLabel">Select Logo</label>
                                    <div class="form-control-wrap">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="customFile"
                                                id="customFile">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                        @error('logo')
                                            <div class="form-note text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 justify-content-center text-center">
                                <div class="form-group">
                                    <div class="logo-preview text-center">
                                        <div class="user-avatar lg bg-info">
                                            @if ($logo)
                                                <img src="{{ $logo->temporaryUrl() }}">
                                            @else
                                                <span>
                                                    <?php
                                                    $words = explode(" ", "$site->name");
                                                      $acronym = "";

                                                    foreach ($words as $w) {
                                                     $acronym .= $w[0];
                                                             }
                                                           echo $acronym; ?>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="form-label">Timezone</label>
                                    <div class="form-control-wrap">
                                        <div class="form-icon form-icon-right">
                                            <em class="icon ni ni-clock"></em>
                                        </div>
                                        <input type="timezone"  class="form-control location"
                                            name="time" id="time" placeholder="Africa/Nairobi">
                                    </div>
                                    @error('timezone')
                                        <div class="form-note text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 justify-content-center mx-auto">
                                <button class="btn btn-primary" type="submit">
                                    <span> Edit Site </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Askari Technologies</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Site Modal -->
</div>

@push('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize"
        async defer></script>
    {{-- <script src="{{ asset('theme/assets/js/addsite.js?ver=2.9.0') }}"></script> --}}
    <script>
        function initialize() {

            $('form').on('keyup keypress', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 13) {
                    e.preventDefault();
                    return false;
                }
            });
            const locationInputs = document.getElementsByClassName("map-input");

            const autocompletes = [];
            const geocoder = new google.maps.Geocoder;
            for (let i = 0; i < locationInputs.length; i++) {

                const input = locationInputs[i];
                const fieldKey = input.id.replace("-input", "");
                const isEdit = document.getElementById(fieldKey + "-latitude").value != '' && document.getElementById(
                    fieldKey + "-longitude").value != '';

                const latitude = parseFloat(document.getElementById(fieldKey + "-latitude").value) || -1.2936290729512252;
                const longitude = parseFloat(document.getElementById(fieldKey + "-longitude").value) || 36.81134053509082;

                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {
                        lat: latitude,
                        lng: longitude
                    },
                    zoom: 13
                });

                const marker = new google.maps.Marker({
                    map: map,
                    position: {
                        lat: latitude,
                        lng: longitude
                    },
                });

                marker.setVisible(isEdit);

                const autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.key = fieldKey;
                autocompletes.push({
                    input: input,
                    map: map,
                    marker: marker,
                    autocomplete: autocomplete
                });
            }

            for (let i = 0; i < autocompletes.length; i++) {
                const input = autocompletes[i].input;
                const autocomplete = autocompletes[i].autocomplete;
                const map = autocompletes[i].map;
                const marker = autocompletes[i].marker;

                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    marker.setVisible(false);
                    const place = autocomplete.getPlace();

                    geocoder.geocode({
                        'placeId': place.place_id
                    }, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            const lat = results[0].geometry.location.lat();
                            const lng = results[0].geometry.location.lng();
                            setLocationCoordinates(autocomplete.key, lat, lng);
                        }
                    });

                    if (!place.geometry) {
                        window.alert("No details available for input: '" + place.name + "'");
                        input.value = "";
                        return;
                    }

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker.setPosition(place.geometry.location);
                    marker.setVisible(true);

                });
            }
        }

        function setLocationCoordinates(key, lat, lng) {
            const latitudeField = document.getElementById(key + "-" + "latitude");
            const longitudeField = document.getElementById(key + "-" + "longitude");
            latitudeField.value = lat;
            longitudeField.value = lng;
        }
    </script>
@endpush

<div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
    <div class="card-inner-group" data-simplebar>
        <div class="card-inner">
            <div class="user-card">
                <div class="user-avatar sq bg-primary">
                    <img src="{{ url('storage/' . $site->logo) }}" alt="" title="">
                </div>
                <div class="user-info">
                    <span class="lead-text">{{ $site->name}}</span>
                    <span class="sub-text">info@softnio.com</span>
                </div>
                @if (request()->routeIs('org.site-overview'))
                <div class="user-action">
                    <div class="dropdown">
                        <a class="btn btn-icon btn-trigger mr-n2" data-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <ul class="link-list-opt no-bdr">
                                <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                <li><a data-toggle="modal" data-target="#addModal1"><em class="icon ni ni-location"></em><span>Update Location</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
            </div><!-- .user-card -->
        </div><!-- .card-inner -->
        <div class="card-inner">
            @if ($site->owner)
                <div class="user-account-info py-0">
                    <h6 class="overline-title-alt">Site Owner</h6>
                    <div class="user-card">
                        <div class="user-avatar bg-primary">
                            <a href="{{ route('org.team.show', $site->owner->id) }}">
                                <img src="{{ Gravatar::get($site->owner->email) }}" alt="User">
                            </a>
                        </div>
                        <div class="user-info">
                            <a href="{{ route('org.team.show', $site->owner->id) }}"><span class="lead-text">{{ $site->owner->name }}</span></a>
                            <span class="sub-text">j{{ $site->owner->email }}</span>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-icon alert-gray" role="alert">    
                    <em class="icon ni ni-alert-circle"></em>     
                    <strong>No active client</strong>.
                </div>
            @endif
        </div><!-- .card-inner -->
        <div class="card-inner p-0">
            <ul class="link-list-menu">
                <li><a class="{{ request()->routeIs('org.site-overview') ? 'active' : '' }}" href="{{ route('org.site-overview', $site->id) }}"><em class="icon ni ni-user-fill-c"></em><span>Overview</span></a></li>
                <li><a class="{{ request()->routeIs('org.site-latestactivity') ? 'active' : '' }}" href="{{ route('org.site-latestactivity', $site->id) }}"><em class="icon ni ni-user-fill-c"></em><span>Latest Activity</span></a></li>
                <li><a class="{{ request()->routeIs('org.site-guards') ? 'active' : '' }}" href="{{ route('org.site-guards', $site->id) }}"><em class="icon ni ni-users-fill"></em><span>Guards</span></a></li>
                <li><a class="{{ request()->routeIs('org.site-tags') ? 'active' : '' }}" href="{{ route('org.site-tags', $site->id) }}"><em class="icon ni ni-map-pin-fill"></em><span>Tour Tags</span></a></li>
                <li><a class="{{ request()->routeIs(['org.site-patrols', 'org.site-create-patrol']) ? 'active' : '' }}" href="{{ route('org.site-patrols', $site->id) }}"><em class="icon ni ni-list-check"></em><span>Patrols and Tours</span></a></li>
                <li><a class="{{ request()->routeIs('org.site-tasks') ? 'active' : '' }}" href="{{ route('org.site-tasks', $site->id) }}"><em class="icon ni ni-todo-fill"></em><span>Tasks and Post Orders</span></a></li>
                <li><a class="{{ request()->routeIs('org.site-dobs') ? 'active' : '' }}" href="{{ route('org.site-dobs', $site->id) }}"><em class="icon ni ni-book-fill"></em><span>DOB's</span></a></li>
                <li><a class="{{ request()->routeIs('org.site-incidents') ? 'active' : '' }}" href="{{ route('org.site-incidents', $site->id) }}"><em class="icon ni ni-report-fill"></em><span>Incidents</span></a></li>
                <li><a class="{{ request()->routeIs('org.site-notifications') ? 'active' : '' }}" href="{{ route('org.site-notifications', $site->id) }}"><em class="icon ni ni-bell-fill"></em><span>Notifications</span></a></li>
                <li><a class="{{ request()->routeIs('org.site-access') ? 'active' : '' }}" href="{{ route('org.site-access', $site->id) }}"><em class="icon ni ni-grid-add-fill-c"></em><span>Security and User Access</span></a></li>
            </ul>
        </div><!-- .card-inner -->
    </div><!-- .card-inner-group -->
</div><!-- card-aside -->


<!-- Add Site Modal -->
<div class="modal fade" tabindex="-1" id="addModal1">
    <div class="modal-dialog modal-lg modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update {{ $site->name }} location</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                <form action="{{ route('org.update-location', $site->id) }}" method="POST">
                    @csrf
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="address_address">Address</label>
                                <input type="text" id="address-input" name="address_address"
                                    class="form-control map-input">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Latitude</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-location"></em>
                                    </div>
                                    <input type="text" class="form-control"name="address_latitude" id="address-latitude" value="0" placeholder="-1.46473453453">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Longitude</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-right">
                                        <em class="icon ni ni-location"></em>
                                    </div>
                                    <input type="text" class="form-control" name="address_longitude" id="address-longitude" value="0" placeholder="36.45456467">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div>
                                <div class="card card-bordered" id="address-map-container"
                                    style="width:100%;height:150px; ">
                                    <div style="width: 100%; height: 100%" id="address-map"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 justify-content-center mx-auto">
                            <button type="submit" class="btn btn-secondary">Update Location</button>
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


@push('scripts')
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
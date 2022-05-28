<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block">
                                    <div class="card card-bordered" id="sitemap" style="width:100%;height:150px; ">
                                        <div style="width: 100%; height: 100%" id="sitemap"></div>
                                    </div><!-- .card-preview -->
                                </div><!-- nk-block -->
                                <div class="nk-block">
                                    <div class="row gy-5">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="d-flex">
                                                        <div class="user-avatar bg-success mr-3">
                                                            <span>{{ $total }}</span>
                                                        </div>
                                                        <div class="fake-class mt-2">
                                                            <h6 class="mt-0 d-flex align-center"><span>Guards</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="d-flex border-dark">
                                                        <div class="user-avatar bg-warning mr-3">
                                                            <span>{{ count($site->tags) }}</span>
                                                        </div>
                                                        <div class="fake-class mt-2">
                                                            <h6 class="mt-0 d-flex align-center"><span>Tour Tags</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="d-flex border-dark">
                                                        <div class="user-avatar bg-dark mr-3">
                                                            <span>{{ count($site->patrols) }}</span>
                                                        </div>
                                                        <div class="fake-class mt-2">
                                                            <h6 class="mt-0 d-flex align-center"><span>Patrols</span>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="d-flex border-dark">
                                                        <div class="user-avatar bg-info mr-3">
                                                            <span>{{ count($site->tasks) }}</span>
                                                        </div>
                                                        <div class="fake-class mt-2">
                                                            <h6 class="mt-0 d-flex align-center"><span>Tasks</span></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card card-bordered">
                                                <ul class="data-list is-compact">
                                                    <div class="card-header border-bottom">Overview</div>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Client</div>
                                                            <div class="data-value">
                                                                <div class="user-card">
                                                                    @if ($site->owner)
                                                                        <div
                                                                            class="user-avatar sm user-avatar-xs bg-orange-dim">
                                                                            <img src="{{ Gravatar::get($site->owner->email) }}"
                                                                                alt="">
                                                                        </div>
                                                                        <div class="user-name">
                                                                            <span
                                                                                class="tb-lead">{{ $site->owner->name }}</span>
                                                                        </div>
                                                                    @else
                                                                        <span>No Client Added</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Site</div>
                                                            <div class="data-value">{{ $site->name }}</div>
                                                        </div>
                                                    </li>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Contact No</div>
                                                            <div class="data-value">
                                                                @if (!empty($site->owner->phone))
                                                                    {{ $site->owner->phone }}
                                                                @else
                                                                    <p>No Added</p>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Status</div>
                                                            <div class="data-value">
                                                                @if ($site->is_active == true)
                                                                    <span
                                                                        class="badge badge-dot badge-success">Active</span>
                                                                @else
                                                                    <span
                                                                        class="badge badge-dot badge-danger">Inactive</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div><!-- .card -->
                                        </div><!-- .col -->
                                        <div class="col-lg-6">
                                            <div class="card card-bordered">
                                                <ul class="data-list is-compact">
                                                    <div class="card-header border-bottom">Address</div>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Full Address</div>
                                                            <div class="data-value">{{ $site->location }}</div>
                                                        </div>
                                                    </li>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Country</div>
                                                            <div class="data-value"></div>
                                                        </div>
                                                    </li>
                                                    <li class="data-item">
                                                        <div class="data-col">
                                                            <div class="data-label">Timezone</div>
                                                            <div class="data-value text-break">{{ $site->timezone }}
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div><!-- .col -->
                                    </div><!-- .row -->
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

@push('scripts')
    <script>
        "use strict";
        let lat = @js($site->lat);
        let long = @js($site->long);

        console.log(lat);
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 14,
                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(lat, long),
                // New York
                // How you would like to style the map. 
                // This is where you would paste any style found on Snazzy Maps.
                styles: []
            }; // Get the HTML DOM element that will contain your map 
            // We are using a div with id="gMap" seen below in the <body>

            var mapElement = document.getElementById('sitemap');
            var map = new google.maps.Map(mapElement, mapOptions); // Let's also add a marker while we're at it

            var marker = new google.maps.Marker({
                map: map,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: new google.maps.LatLng(lat, long),
                // Change those co-ordinates to yours, to change your location with given location.
                icon: '' // null = default icon
            });
            console.log(err);
        }
    </script>
@endpush

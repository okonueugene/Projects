<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-aside-wrap">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block">
                                    <div class="card">
                                        <div class="card-aside-wrap">
                                            <div class="card-inner card-inner-lg">
                                                <div class="nk-block-head nk-block-head-lg">
                                                    <div class="nk-block-between">
                                                        <div class="nk-block-head-content">
                                                            <h4 class="nk-block-title">Notification Settings</h4>
                                                            <div class="nk-block-des">
                                                                <p>You will only get notifications that have been enabled.</p>
                                                            </div>
                                                        </div>
                                                        <div class="nk-block-head-content align-self-start d-lg-none">
                                                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-block-head -->
                                                <div class="nk-block-head nk-block-head-sm">
                                                    <div class="nk-block-head-content">
                                                        <h6>Security Alerts</h6>
                                                        <p>Security related alerts and violations.</p>
                                                    </div>
                                                </div><!-- .nk-block-head -->
                                                <div class="nk-block-content">
                                                    <div class="gy-3">
                                                        <div class="g-item">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" checked id="unusual-activity">
                                                                <label class="custom-control-label" for="unusual-activity">Send a notification when an incident report is created</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-block-content -->
                                                <div class="nk-block-head nk-block-head-sm">
                                                    <div class="nk-block-head-content">
                                                        <h6>Events and Broadcasts</h6>
                                                        <p>Broadcasted events from the post site.</p>
                                                    </div>
                                                </div><!-- .nk-block-head -->
                                                <div class="nk-block-content">
                                                    <div class="gy-3">
                                                        <div class="g-item">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" checked id="latest-sale">
                                                                <label class="custom-control-label" for="latest-sale">Notify when a guard clocks in and out</label>
                                                            </div>
                                                        </div>
                                                        <div class="g-item">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" id="feature-update">
                                                                <label class="custom-control-label" for="feature-update">Notify when a guard starts a patrol</label>
                                                            </div>
                                                        </div>
                                                        <div class="g-item">
                                                            <div class="custom-control custom-switch">
                                                                <input type="checkbox" class="custom-control-input" checked id="account-tips">
                                                                <label class="custom-control-label" for="account-tips">Notify when a guard completes a task</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-block-content -->
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-aside-wrap -->
                                </div><!-- .nk-block -->
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
    
@endpush

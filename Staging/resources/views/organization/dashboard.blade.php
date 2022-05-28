@extends('layouts.organization')

@section('title')
    {{ Auth::user()->roles->pluck('name')[0] ?? '' }} Panel 
@endsection

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">{{ Auth::user()->company->company_name }} Dashboard</h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome back, {{ Auth::user()->name }}.</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div class="nk-block-head-content">
                            <div class="toggle-wrap nk-block-tools-toggle">
                                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                <div class="toggle-expand-content" data-content="pageMenu">
                                    <ul class="nk-block-tools g-3">
                                        <li>
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-toggle="dropdown"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><span>Last 30 Days</span></a></li>
                                                        <li><a href="#"><span>Last 6 Months</span></a></li>
                                                        <li><a href="#"><span>Last 1 Years</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div><!-- .nk-block-head-content -->
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="nk-block">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content">
                            <h5 class="nk-block-title">Dispatch Map</h5>
                        </div>
                    </div>
                    <div class="card card-preview">
                        <div id="gMap" class="card card-bordered google-map w-100"></div>
                    </div><!-- .card-preview -->
                </div><!-- nk-block -->
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-lg-8">
                            <div class="card card-bordered h-100">
                                <div class="card-inner">
                                    <div class="card-title-group align-start mb-3">
                                        <div class="card-title">
                                            <h6 class="title">Overview</h6>
                                            <p>Today's Guards Attendance. <a href="#" class="link link-sm">Detailed Stats</a></p>
                                        </div>
                                        <div class="card-tools mt-n1 mr-n1">
                                            <div class="drodown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#" class="active"><span>15 Days</span></a></li>
                                                        <li><a href="#"><span>30 Days</span></a></li>
                                                        <li><a href="#"><span>3 Months</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-title-group -->
                                    <div class="nk-order-ovwg">
                                        <div class="row g-4 align-end">
                                            <div class="col-xxl-8">
                                                <div class="nk-ck-sm">
                                                    <canvas class="polar-chart" id="polarChartData"></canvas>
                                                </div>
                                            </div><!-- .col -->
                                            <div class="col-xxl-4">
                                                <div class="row g-4">
                                                    <div class="col-sm-6 col-xxl-12">
                                                        <div class="nk-order-ovwg-data buy">
                                                            <div class="amount">18 <small class="currenct currency-usd">Sites</small></div>
                                                            <div class="info">Sites under <strong>{{ Auth::user()->company->company_name }} </strong></div>
                                                            <div class="title"><em class="icon ni ni-location"></em> Total Sites </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 col-xxl-12">
                                                        <div class="nk-order-ovwg-data sell">
                                                            <div class="amount">124 <small class="currenct currency-usd">Guards</small></div>
                                                            <div class="info">Total Guards <strong>{{ Auth::user()->company->company_name }} </strong></div>
                                                            <div class="title"><em class="icon ni ni-users"></em> Total Guards</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- .col -->
                                        </div>
                                    </div><!-- .nk-order-ovwg -->
                                </div><!-- .card-inner -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                        <div class="col-lg-4">
                            <div class="card card-bordered h-100">
                                <div class="card-inner-group">
                                    <div class="card-inner card-inner-md">
                                        <div class="card-title-group">
                                            <div class="card-title">
                                                <h6 class="title">Action Center</h6>
                                            </div>
                                            <div class="card-tools mr-n1">
                                                <div class="drodown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-setting"></em><span>Action Settings</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-notify"></em><span>Push Notification</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <div class="nk-wg-action">
                                            <div class="nk-wg-action-content">
                                                <em class="icon ni ni-cc-alt-fill"></em>
                                                <div class="title">App settings</div>
                                                <p>Manage your organization setting from here.</p>
                                            </div>
                                            <a href="#" class="btn btn-icon btn-trigger mr-n2"><em class="icon ni ni-forward-ios"></em></a>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <div class="nk-wg-action">
                                            <div class="nk-wg-action-content">
                                                <em class="icon ni ni-help-fill"></em>
                                                <div class="title">Support Messages</div>
                                                <p>Here is <strong>18 new</strong> support message. </p>
                                            </div>
                                            <a href="#" class="btn btn-icon btn-trigger mr-n2"><em class="icon ni ni-forward-ios"></em></a>
                                        </div>
                                    </div><!-- .card-inner -->
                                    <div class="card-inner">
                                        <div class="nk-wg-action">
                                            <div class="nk-wg-action-content">
                                                <em class="icon ni ni-wallet-fill"></em>
                                                <div class="title">Upcoming Patrols</div>
                                                <p>View Upcoming <strong>Rounds</strong> and site activities.</p>
                                            </div>
                                            <a href="#" class="btn btn-icon btn-trigger mr-n2"><em class="icon ni ni-forward-ios"></em></a>
                                        </div>
                                    </div><!-- .card-inner -->
                                </div><!-- .card-inner-group -->
                            </div><!-- .card -->
                        </div><!-- .col -->
                    </div><!-- .row -->
                </div><!-- .nk-block -->
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('theme/assets/js/example-chart.js?ver=2.4.0') }}"></script>
@endsection

@push('scripts')
    <script src="{{ asset('theme/assets/js/example-map.js?ver=2.9.0') }}"></script>
@endpush
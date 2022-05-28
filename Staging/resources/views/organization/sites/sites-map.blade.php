@extends('layouts.organization')

@section('title')
    Sites Map
@endsection

@section('header')

@endsection

@section('content')

    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <h5 class="nk-block-title">Live Tracking</h5>
                                <p>Click on a site any icon to see site details including location, guards, timezone etc</p>
                            </div>
                        </div>
                        <div class="card card-preview">
                            <div id="gMap" class="card card-bordered google-map w-100"></div>
                        </div><!-- .card-preview -->
                    </div><!-- nk-block -->
                    <div class="nk-block nk-block-lg">
                        <div class="nk-block-head">
                            <div class="nk-block-head-content">
                                <div class="d-flex align-items-center">
                                    <strong>Updating...</strong>
                                    <div class="spinner-grow spinner-grow-sm text-danger" role="status">
                                        <span class="sr-only">Loading...</span>
                                      </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-bordered card-preview">
                            <table class="table table-tranx is-compact">
                                <thead>
                                    <tr class="tb-tnx-head">
                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                        <th class="tb-tnx-info">
                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                <span>Guard</span>
                                            </span>
                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                <span class="d-md-none">Date</span>
                                                <span class="d-none d-md-block">
                                                    <span>Last Location</span>
                                                    <span>Last Updated</span>
                                                </span>
                                            </span>
                                        </th>
                                        <th class="tb-tnx-amount">
                                            <span class="tb-tnx-total">Battery Status</span>
                                        </th>
                                </thead>
                                <tbody>
                                    <tr class="tb-tnx-item">
                                        <td class="tb-tnx-id">
                                            <a href="#"><span>4947</span></a>
                                        </td>
                                        <td class="tb-tnx-info">
                                            <div class="tb-tnx-desc">
                                                <span class="title">Brown Otieno (Haringey Sixth Form)</span>
                                            </div>
                                            <div class="tb-tnx-date">
                                                <span class="date"></span>
                                                <span class="date">10-13-2019</span>
                                            </div>
                                        </td>
                                        <td class="tb-tnx-amount">
                                            <div class="tb-tnx-total">
                                                {{-- <span class="amount">$599.00</span> --}}
                                                <div class="progress">
                                                    <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" data-progress="75"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- .card-preview -->
                    </div><!-- nk-block -->
                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')



@endsection

@push('scripts')
    <script src="{{ asset('theme/assets/js/example-map.js?ver=2.9.0') }}"></script>
@endpush
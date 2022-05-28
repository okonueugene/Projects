

@extends('layouts.organization')

@section('title')
    Client List
@endsection

@section('header')

@endsection

@section('content')

    <div class="nk-content ">
                                
    <div class="nk-block-head">
        <div class="float-right">
            <button class="btn btn-warning" type="submit">
                                    <div wire:loading wire:target='#'>
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    </div>
                                    <div>
                                        <span> Add Client</span>
                                    </div>
                                </button>
                            </div>
                                  <div class="nk-block-head-content">
                                      
                                                <h4 class="nk-block-title">Clients List</h4>
                                              
                                            </div>
                                        </div>
                                        <div class="card card-preview">
                                            <div class="card-inner">
                                                <table class="datatable-init nk-tb-list nk-tb-ulist" data-auto-responsive="false">
                                                    <thead>
                                                        <tr class="nk-tb-item nk-tb-head">
                                                            <th class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid">
                                                                    <label class="custom-control-label" for="uid"></label>
                                                                </div>
                                                            </th>

                                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Name</span></th>
                                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Email</span></th>
                                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Phone</span></th>
                                                            <th class="nk-tb-col tb-col-lg"><span class="sub-text">Country</span></th>
                                                            <th class="nk-tb-col tb-col-md"><span class="sub-text">Status</span></th>
                                                            <th class="nk-tb-col nk-tb-col-tools text-right">
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($students as $student)
                                                        <tr class="nk-tb-item">
                                                            <td class="nk-tb-col nk-tb-col-check">
                                                                <div class="custom-control custom-control-sm custom-checkbox notext">
                                                                    <input type="checkbox" class="custom-control-input" id="uid1">
                                                                    <label class="custom-control-label" for="uid1"></label>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col">
                                                                <div class="user-card">
                                                                    <div class="user-avatar bg-dim-primary d-none d-sm-flex">
                                                                        <span>
                                                                            <?php
                                                    $words = explode(" ", "$student->name");
                                                      $acronym = "";

                                                    foreach ($words as $w) {
                                                     $acronym .= $w[0];
                                                             }
                                                           echo $acronym; ?>
                                                                        </span>
                                                                    </div>
                                                                    <div class="user-info">
                                                                        <span class="tb-lead"> {{ $student->name }} <span class="dot dot-success d-md-none ml-1"></span></span>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-mb" data-order="35040.34">
                                                                <span class="tb-amount"> {{ $student->email }} </span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-md">
                                                                <span>{{ $student->phone }}</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-lg" data-order="Email Verified - Kyc Unverified">
                                                            <span>{{ $student->country }}</span>
                                                            </td>
                                                            <td class="nk-tb-col tb-col-lg">
                                                                <span>{{ $student->status }}</span>
                                                            </td>
                                                            <td class="nk-tb-col nk-tb-col-tools">
                                                                <ul class="nk-tb-actions gx-1">
                                                                   
                                                                    <li class="nk-tb-action-hidden">
                                                                        <a href="#" class="btn btn-trigger btn-icon" data-toggle="tooltip" data-placement="top" title="Suspend">
                                                                            <em class="icon ni ni-user-cross-fill"></em>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <div class="drodown">
                                                                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                                <ul class="link-list-opt no-bdr">
                                                                                    <li><a href="#"><em class="icon ni ni-focus"></em><span>Quick View</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View Details</span></a></li>
                                                                                    <li><a href="#"><em class="icon ni ni-na"></em><span>Remove Client</span></a></li>
                                                                             </ul>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr><!-- .nk-tb-item  -->
                                                    </tbody>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div> <!-- nk-block -->
                                    
   
                                      
                                </div>


@endsection

@section('scripts')

    

@endsection
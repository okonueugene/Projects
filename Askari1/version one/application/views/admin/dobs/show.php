<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Askari Report Software</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/theme/dark/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/apps/invoice.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/elements/avatar.css" rel="stylesheet" type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
    
</head>
<body>
    
    <!--  BEGIN NAVBAR  -->
    <?php  $this->load->view("admin/common/header"); ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Invoice</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php  $this->load->view("admin/common/sidebar"); ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="row invoice layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="app-hamburger-container">
                            <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
                        </div>
                        <div class="doc-container">
                        <div class="tab-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12">
                                        
                                        <ul class="nav nav-pills inv-list-container d-block" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <div class="nav-link list-actions" id="invoice-00001" data-invoice-id="00001">
                                                    <a href="<?php echo base_url('admin/dobs/'); ?>" class="btn btn-primary btn-block btn-rounded mb-2">Go Back</a>
                                                    <button class="btn btn-outline-warning btn-block btn-rounded mb-2">Update</button>
                                                    <?php
                                                        if($dob->confirmed == 0)
                                                        { ?>
                                                        <form action="<?php echo base_url('dob/confirm/' . $dob->id); ?>" method="POST">
                                                            <!-- Submit -->
                                                            <button type="submit" class="btn btn-outline-success btn-block btn-rounded mb-2 bs-popover rounded" data-container="body" data-trigger="hover" data-content="Approve report to be visible to client">
                                                            Approve
                                                            </button>
                                                        </form>
                                                    <?php } ?>
                                                    <form action="<?php echo base_url('dob/delete/' . $dob->id); ?>" method="DELETE">
                                                        <button type="submit" class="btn btn-outline-danger btn-block btn-rounded mb-2">Delete</button>
                                                    </form>
                                                </div>
                                            </li>
                                            <li class="nav-item">
                                                <div class="nav-link text-center list-actions" id="invoice-00001" data-invoice-id="00001">
                                                    <div class="avatar avatar-xl">
                                                        <img alt="avatar" src="<?php echo $this->db->where('id',$dob->submitted_by)->get('guards')->row()->profilepic; ?>" class="rounded-circle" height="100px"/>
                                                    </div>
                                                    <p class="text-muted mt-2"><?php echo $this->db->where('id',$dob->submitted_by)->get('guards')->row()->name; ?></p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-container">
                                <div class="invoice-inbox">
                                    <div class="invoice-header-section">
                                        <h4 class="inv-number"></h4>
                                        <div class="invoice-action">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer action-print" data-toggle="tooltip" data-placement="top" data-original-title="Print"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                                        </div>
                                    </div>
                                    
                                    <div style="display: block;" class="active">
                                        
                                        <div class="invoice-00001">
                                            <div class="content-section  animated animatedFadeInUp fadeInUp">

                                                <div class="row inv--head-section">

                                                    <div class="col-sm-6 col-12">
                                                        <h3 class="in-heading text-white">16813</h3>
                                                    </div>
                                                    <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                                        <div class="company-info">
                                                            <h5 class="inv-brand-name">ASKARI</h5>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                                <div class="row inv--detail-section">
                                                    <div class="col-sm-7 align-self-center">
                                                        <p class="inv-customer-name">Duty Date : <?php echo date('d/m/Y',strtotime($dob->date)); ?></p>
                                                        <p class="inv-street-addr">Serial NO :</p>
                                                    </div>
                                                    <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                                        <p class="inv-list-number"><span class="inv-title">Time Duty Start : </span> <span class="inv-date"><?php echo $dob->time ?></span></p>
                                                        <p class="inv-created-date"><span class="inv-title">Time Duty Finish : </span> <span class="inv-date">20 Aug 2019</span></p>
                                                    </div>
                                                </div>

                                                <div class="row inv--product-table-section">
                                                    <div class="col-12">
                                                        <div class="table-responsive">
                                                            <table class="table">
                                                                <thead class="active">
                                                                    <tr>
                                                                        <th scope="col">Check Calls</th>
                                                                        <th scope="col">Details of Event</th>
                                                                        <th class="text-right" scope="col">Patrol In</th>
                                                                        <th class="text-right" scope="col">Patrol Out</th>
                                                                        <th class="text-right" scope="col">Signature</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>1</td>
                                                                        <td><?php echo $dob->nature?></td>
                                                                        <td class="text-right"><?php echo $dob->time ?></td>
                                                                        <td class="text-right">19:00:00</td>
                                                                        <td class="text-right">VN</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-sm-12 col-12 order-sm-0 order-1">
                                                        <div class="inv--payment-info">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-12">
                                                                    <h6 class=" inv-title">Receipt Log:</h6>
                                                                    <div class="row inv--product-table-section">
                                                                        <div class="col-12">
                                                                            <div class="table-responsive">
                                                                                <table class="table">
                                                                                    <thead class="active">
                                                                                        <tr>
                                                                                            <th scope="col">Item</th>
                                                                                            <th scope="col">Quantity</th>
                                                                                            <th class="text-right" scope="col">Comments</th>
                                                                                            <th class="text-right" scope="col"> Duty Guard</th>
                                                                                            <th class="text-right" scope="col"> Relief Guard</th>
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>Keys</td>
                                                                                            <td></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Registered Post</td>
                                                                                            <td></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Clocking Devices</td>
                                                                                            <td></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Radio Equipment</td>
                                                                                            <td></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td>Clocking Points</td>
                                                                                            <td></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                            <td class="text-right"></td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div> 
                                    </div>


                                </div>

                                <div class="inv--thankYou">
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <p class="">Thank you for doing Business with us.</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
            <?php  $this->load->view("admin/common/footer"); ?>
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo base_url(); ?>/theme/dark/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>/theme/dark/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>/theme/dark/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/theme/dark/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url(); ?>/theme/dark/assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?php echo base_url(); ?>/theme/dark/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo base_url(); ?>/theme/dark/assets/js/apps/invoice.js"></script>
</body>
</html>
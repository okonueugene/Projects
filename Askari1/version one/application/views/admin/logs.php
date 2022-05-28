<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Askari Guard Patrol</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/theme/dark/assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/dark/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/dark/plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL STYLES -->

</head>

<body>

    <!--  BEGIN NAVBAR  -->
    <?php $this->load->view("admin/common/header"); ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Security</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Login Logs</span></li>
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
        <?php $this->load->view("admin/common/sidebar"); ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <?php echo $this->session->flashdata("message"); ?>
                            <div class="box box-primary" style="padding:25px;">
                                <?php echo $this->lang->line("Date range button:"); ?>
                                <?php if (!empty($date_range_lable)) {
                                    echo $date_range_lable;
                                } else {
                                    echo date("M , d Y");
                                } ?>
                                <div class="table-responsive mb-4 mt-4">
                                    <table id="zero-config" class="table table-hover" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>User</th>
                                                <th>IP</th>
                                                <th>Browser</th>
                                                <th>Platform</th>
                                                <th>Login Status</th>
                                                <th class="no-content"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $this->db->order_by('id', 'desc');
                                            $products = $this->db->get('logs')->result();
                                            foreach ($products as $product) {
                                                if ($product->status == '2') {
                                            ?>
                                                    <tr>
                                                        <td><?php echo date('d/m/Y h:i A', strtotime($product->time)); ?></td>
                                                        <td><?php if ($product->user_id != null) {
                                                                echo $this->db->where('user_id', $product->user_id)->get('users')->row()->user_name;
                                                            } else {
                                                                echo "Anonymous";
                                                            } ?></td>
                                                        <td><?php echo $product->ip_address; ?></td>
                                                        <td><?php echo $product->agent_type; ?></td>
                                                        <td><?php echo $product->platform; ?></td>
                                                        <td><?php echo "Failed"; ?></td>
                                                        <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-octagon"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                                            </svg></td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td><?php echo date('d/m/Y h:i A', strtotime($product->time)); ?></td>
                                                        <td><?php if ($product->user_id != null) {
                                                                echo $this->db->where('user_id', $product->user_id)->get('users')->row()->user_name;
                                                            } else {
                                                                echo "Anonymous";
                                                            } ?></td>
                                                        <td><?php echo $product->ip_address; ?></td>
                                                        <td><?php echo $product->agent_type; ?></td>
                                                        <td><?php echo $product->platform; ?></td>
                                                        <td><?php echo "Success"; ?></td>
                                                        <td><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                                            </svg></td>
                                                    </tr>
                                            <?php }
                                            } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>User</th>
                                                <th>IP</th>
                                                <th>Browser</th>
                                                <th>Platform</th>
                                                <th>Login Status</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
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

        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="<?php echo base_url(); ?>/theme/dark/plugins/table/datatable/datatables.js"></script>
        <script>
            $('#zero-config').DataTable({
                "oLanguage": {
                    "oPaginate": {
                        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                    },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7
            });
        </script>
        <!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
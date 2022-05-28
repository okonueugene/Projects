<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Askari Guard Patrol </title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/theme/dark/assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
        
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/theme/dark/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/theme/dark/plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/theme/dark/plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="<?php echo base_url();?>/theme/dark/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css">
    <link rel="<?php echo base_url();?>/theme/dark/stylesheet" href="plugins/font-icons/fontawesome/css/regular.css">
    <link rel="<?php echo base_url();?>/theme/dark/stylesheet" href="plugins/font-icons/fontawesome/css/fontawesome.css">

</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);"><?php echo $this->lang->line("Admin");?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Guards</span></li>
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
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message'); unset($_SESSION['message']);
                                    ?>
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <!-- <th>Profile</th> -->
                                            <th>Site</th>
                                            <th>Mobile Number</th>
                                            <th>Email</th>
                                            <th>Shift Start</th>
                                            <th>Shift End</th>
                                            <th>Status</th>
                                            <th class="text-center" style="width: 100px;"><?php echo $this->lang->line("Action");?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($products as $product){ ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php echo date('d-m-Y',strtotime($product->date)); ?></td>
                                            <td><?php echo $product->name; ?></td>
                                            <td><?php echo $product->agency; ?></td>
                                            <td><?php echo $product->mobile; ?></td>
                                            <td><?php echo $product->email; ?></td>
                                            <td><?php echo date('h:i A',strtotime($product->start)); ?></td>
                                            <td><?php echo date('h:i A',strtotime($product->end)); ?></td>


                                            <td><?php if($product->status=='1'){echo "Active";}else{echo "Suspended";} ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php echo anchor('admin/edit_guard/'.$product->id, '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>', array("class"=>"btn btn-outline-info")); ?>
                                                    <?php
                                                       if($product->status=='1')
                                                       {
                                                       ?>
                                                    <?php echo anchor('admin/suspend_guard/'.$product->id, '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>', array("class"=>"btn btn-outline-danger", "onclick"=>"return confirm('Are you sure to Suspend?')")); ?>
                                                    <?php
                                                       }else{
                                                           ?>

                                                    <?php echo anchor('admin/active_guard/'.$product->id, '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>', array("class"=>"btn btn-outline-success", "onclick"=>"return confirm('Are you sure to Active?')")); ?>
                                                    <?php
                                                       }
                                                        ?>

                                                </div>
                                            </td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
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
    <script src="<?php echo base_url();?>/theme/dark/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="<?php echo base_url();?>/theme/dark/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/datatables.js"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/button-ext/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/button-ext/jszip.min.js"></script>    
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        } );
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="<?php echo base_url();?>/theme/dark/assets/js/scrollspyNav.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/font-icons/feather/feather.min.js"></script>
    
</body>
</html>
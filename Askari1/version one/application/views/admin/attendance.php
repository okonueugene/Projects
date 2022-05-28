<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Askari Guard Patrol </title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/theme/dark/assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>/theme/dark/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>/theme/dark/plugins/table/datatable/custom_dt_html5.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url();?>/theme/dark/plugins/table/datatable/dt-global_style.css">
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <!-- Add -->
    <!-- daterange picker -->
    <link rel="stylesheet"
        href="<?php echo base_url($this->config->item("theme_admin")."/plugins/daterangepicker/daterangepicker-bs3.css"); ?>">

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="<?php echo base_url();?>/theme/dark/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="<?php echo base_url();?>/theme/dark/stylesheet" type="text/css"
        href="plugins/bootstrap-select/bootstrap-select.min.css">
    <!--  END CUSTOM STYLE FILE  -->
</head>

<body>

    <!--  BEGIN NAVBAR  -->
    <?php  $this->load->view("admin/common/header"); ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-menu">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="javascript:void(0);"><?php echo $this->lang->line("Home");?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Rounds Report</span></li>
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
                        <div class="widget-content widget-content-area br-6">
                            <div class="col-lg-12">
                            <!-- FILTER OPTIONS -->
                            <?php 
                            echo $this->session->flashdata("message"); 
                            unset($_SESSION['message']);
                            ?>
                            
                            <form action="" method="post">
                                <input type="hidden" name="date_range" id="date_range_field" />
                                <input type="hidden" name="date_range_lable" id="date_range_lable" />
                                <div class="form-group">
                                    <label> <?php echo $this->lang->line("Date range button:");?></label>
                                    <div class="input-group">
                                        <button class="btn btn-default" type="button" id="daterange-btn">
                                            <i class="fa fa-calendar"></i> <span
                                                id="reportrange"><?php if(!empty($date_range_lable)){ echo $date_range_lable; } else { echo date("M , d Y"); } ?></span>
                                            <i class="fa fa-caret-down"></i>
                                        </button>&nbsp;
                                        <select name="guard_id" class="btn btn-default" required>
                                            <option value="">---Select Guard---</option>
                                            <option value="all">All</option>
                                            <?php
                                    $q=$this->db->get('guards')->result();
                                    foreach($q as $r)
                                    {
                                    ?>
                                            <option value="<?php echo $r->id?>"><?php echo $r->name?></option>
                                            <?php
                                    }
                                    ?>
                                        </select>&nbsp;
                                        <input type="submit" name="filter" class="btn btn-outline-warning" value="Filter" />

                                    </div>
                                </div> 
                            </form>
                            </div>
                            <div class="table-responsive mb-4 mt-4">
                                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Guard Name</th>
                                            <th>Shift Timing</th>
                                            <th>In Time</th>
                                            <th> Out Time</th>
                                            <th>Status</th>
                                            <td class="text-center">
                                                Actions
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($products as $product) {
                                            if ($product->status == 1) {
                                        ?>
                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($product->created_at)); ?></td>
                                            <td><?php echo $this->db->where('id', $product->guard_id)->get('guards')->row()->name; ?></td>
                                            <td><?php echo date('h:i A', strtotime($this->db->where('id', $product->guard_id)->get('guards')->row()->start)) . "<b>-</b>" . date('h:i A', strtotime($this->db->where('id', $product->guard_id)->get('guards')->row()->end)); ?></td>
                                            <td><?php echo "N/A"; ?></td>
                                            <td><?php echo "N/A"; ?></td>
                                            <td>
                                                <?php if ($product->intime == null) {
                                                    echo "<i class='fa fa-times' ></i> Absent";
                                                } else {
                                                    echo "<i class='fa fa-check' ></i> Present";
                                                } ?>
                                            </td>
                                            <td>
                                            <?php echo anchor('admin/edit_attendance/'.$product->id, 'Update', array("class"=>"btn btn-warning btn-sm")); ?>
                                            </td>
                                            
                                        </tr>
                                                
                                        <?php } else { ?>

                                        <tr>
                                            <td><?php echo date('d/m/Y', strtotime($product->created_at)); ?></td>
                                            <td><?php echo $this->db->where('id', $product->guard_id)->get('guards')->row()->name; ?></td>
                                            <td><?php echo date('h:i A', strtotime($this->db->where('id', $product->guard_id)->get('guards')->row()->start)) . "<b>-</b>" . date('h:i A', strtotime($this->db->where('id', $product->guard_id)->get('guards')->row()->end)); ?></td>
                                            <td><?php echo date('h:i A', strtotime($product->intime)); ?></td>
                                            <td><?php if (empty($product->outtime)) {
                                                echo "N/A";
                                                } else {
                                                echo date('h:i A', strtotime($product->outtime));
                                                } ?>
                                            </td>
                                            <td>
                                                <?php if ($product->intime == null) {
                                                echo "<i class='fa fa-times' ></i> Absent";
                                                } else {
                                                echo "<i class='fa fa-check' ></i> Present";
                                                } ?>
                                            </td>
                                            <td>
                                            <?php echo anchor('admin/edit_attendance/'.$product->id, 'Update', array("class"=>"btn btn-warning btn-sm")); ?>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
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
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/datatables.js"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/button-ext/dataTables.buttons.min.js">
    </script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/button-ext/jszip.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/button-ext/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/table/datatable/button-ext/buttons.print.min.js"></script>
    <script>
    $('#html5-extension').DataTable({
        dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
        buttons: {
            buttons: [{
                    extend: 'copy',
                    className: 'btn'
                },
                {
                    extend: 'csv',
                    className: 'btn'
                },
                {
                    extend: 'excel',
                    className: 'btn'
                },
                {
                    extend: 'print',
                    className: 'btn'
                }
            ]
        },
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
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/jQuery/jQuery-2.1.4.min.js"); ?>">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script
        src="<?php echo base_url($this->config->item("theme_admin")."/plugins/daterangepicker/daterangepicker.js"); ?>">
    </script>
    <script>
    $(function() {
        $('#daterange-btn').daterangepicker({
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function(start, end) {
                $('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#date_range_lable').val(start.format('MMMM D, YYYY') + ' - ' + end.format(
                    'MMMM D, YYYY'));
                $('#date_range_field').val(start.format('YYYY-MM-D') + ',' + end.format('YYYY-MM-D'));
            }
        );
    });
    </script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo base_url();?>/theme/dark/assets/js/scrollspyNav.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
</body>

</html>
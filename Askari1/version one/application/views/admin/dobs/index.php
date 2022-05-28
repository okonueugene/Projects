<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Askari Patrol Software </title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/theme/dark/assets/img/favicon.ico" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>/theme/dark/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="https://kit.fontawesome.com/cc2d68ad86.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="<?php echo base_url(); ?>/theme/dark/plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>/theme/dark/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>/theme/dark/plugins/table/datatable/dt-global_style.css">
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/components/custom-modal.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" type="text/css"
        href="<?php echo base_url(); ?>/theme/dark/plugins/bootstrap-select/bootstrap-select.min.css">
        <link href="<?php echo base_url(); ?>/theme/dark/assets/css/elements/miscellaneous.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url(); ?>/theme/dark/assets/css/elements/popover.css" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body>
    <!-- BEGIN LOADER -->
    <!-- <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div> -->
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php $this->load->view("admin/common/header");?>
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>DOB</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-auto ">
                <li class="nav-item more-dropdown">
                    <div class="dropdown  custom-dropdown-icon">
                        <a class="dropdown-toggle btn" href="#" role="button" id="customDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><span>Settings</span> <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-down">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg></a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="customDropdown">
                            <a class="dropdown-item" data-value="Settings" href="javascript:void(0);">Settings</a>
                            <a class="dropdown-item" data-value="Mail" href="javascript:void(0);">Mail</a>
                            <a class="dropdown-item" data-value="Print" href="javascript:void(0);">Print</a>
                            <a class="dropdown-item" data-value="Download" href="javascript:void(0);">Download</a>
                            <a class="dropdown-item" data-value="Share" href="javascript:void(0);">Share</a>
                        </div>
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
        <?php $this->load->view("admin/common/sidebar");?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12 mb-4">
                        <div class="card component-card_1">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-6">
                                    <h5 class="card-title">Daily Occurence Book</h5>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-primary btn-rounded float-right" data-toggle="modal"
                                    data-target="#exampleModal1">
                                    Add New Occurence
                                    </button>
                                </div>
                                </div>
                            </div>
                        </div>     
                    </div>
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <!-- Success -->
                    <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success mb-4" role="alert"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button> 
                            <strong>Success!</strong> <?php echo $this->session->flashdata('success'); unset($_SESSION['success']); ?>. 
                        </div>
                        <?php endif;?>
                        <!-- Error -->
                        <?php if ($this->session->flashdata('errors')): ?>
                        <div class="alert alert-danger mb-4" role="alert"> 
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                            </button> 
                            <Strong>Error! Please fill in all the required fileds</Strong>
                            <?php unset($_SESSION['errors']); ?>
                        </div>
                        <?php endif;?>

                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="zero-config" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Submitted By</th>
                                            <th>Status</th>
                                            <th class="no-content text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($dobs  as  $dob) {
                                        ?>
                                            <tr>
                                                <td>
                                                    DOB-<?php echo $dob->id ?>
                                                </td>
                                                <td><?php echo date('d/m/Y',strtotime($dob->date)); ?></td>
                                                <td><?php echo $dob->time; ?></td>
                                                <td>
                                                    <?php echo $this->db->where('id',$dob->submitted_by)->get('guards')->row()->name; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($dob->confirmed == true){
                                                            echo  '<span class="badge badge-success"> Approved </span>';
                                                        }
                                                        else if($dob->confirmed == false)
                                                        {
                                                            echo  '<span class="badge badge-warning"> Not Approved </span>';
                                                        }
                                                    ?>
                                                </td>

                                                <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a href="<?php echo base_url('dob/show/' . $dob->id) ?>" class="btn btn-primary btn-rounded btn-sm">View</a>
                                                </div>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Submitted By</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <?php $this->load->view("admin/common/footer");?>
        </div>
        
        <!--  END CONTENT PART  -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Daily Occurence</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-x">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>
                    <form action="<?php echo base_url('admin/dob/store')?>" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Reported By <span style="color:red">*</span></label>
                                <select name="submitted_by" class="selectpicker form-control">
                                    <?php foreach ($guards as $guard) {?>
                                    <option value="<?php echo $guard->id; ?>"><?php echo $guard->name; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput2">Date <span style="color:red">*</span></label>
                                <input type="date" name="date" class="form-control" id="formGroupExampleInput2"
                                    placeholder="Another input">
                            </div>
                            <div class="form-group mb-4">
                                <label for="formGroupExampleInput2">Time<span style="color:red">*</span></label>
                                <input type="time" name="time" class="form-control" id="formGroupExampleInput2"
                                    placeholder="Another input">
                            </div>
                            <div class="form-group mb-4">
                                <label for="exampleFormControlTextarea1">Nature</label>
                                <textarea class="form-control" name="nature" id="exampleFormControlTextarea1"
                                    rows="3"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                            <button type="submit" class="btn btn-warning">Add DOB</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
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
    <script src="<?php echo base_url(); ?>/theme/dark/plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>
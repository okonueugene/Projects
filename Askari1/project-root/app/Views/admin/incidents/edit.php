<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Askari Report Software </title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/theme/dark/assets/img/favicon.ico" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>/theme/dark/assets/js/loader.js"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Reports</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Incident Report</span></li>
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
        <?php  $this->load->view("admin/common/sidebar"); ?>
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT PART  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-sm-12 mb-4">
                        <div class="card component-card_1">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-6">
                                    <!-- <h6 class="card-title">INC: Leaves Management</h6> -->
                                    <h6 class="mt-2"><?php echo $incident->title?> reported by <?php echo $this->db->where('id',$incident->reported_by)->get('guards')->row()->name; ?></h6> 
                                </div>
                                <div class="col-6">
                                    <a href="<?php echo base_url(); ?>admin/incidents/"  class="btn btn-outline-warning btn-rounded float-right">
                                        Go Back
                                    </a>
                                </div>
                                </div>
                            </div>
                        </div>     
                    </div>
                    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12" style="margin-bottom:24px;">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4>Incident Report</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content widget-content-area">
                            <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message');
                                    unset($_SESSION['message']);
                                    ?>
                                <form action="<?php echo base_url('incident/update/'.$incident->id)?>"" method="POST">
                                    <div class="form-row mb-4">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Title</label>
                                            <input type="title" name="title" value="<?php  echo $incident->title; ?>" class="form-control" id="inputEmail4"
                                                placeholder="Title">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Incident Date</label>
                                            <input type="date" name="date" value="<?php  echo $incident->date; ?>" class="form-control" id="inputPassword4"
                                                placeholder="Date">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="inputPassword4">Incident Time</label>
                                            <input type="time" name="time" value="<?php  echo $incident->time; ?>" class="form-control" id="inputPassword4"
                                                placeholder="Time">
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="inputAddress2">Reported By</label>
                                        <input type="text" name="reported_by" class="form-control" id="inputAddress2"
                                            placeholder="Reported by" value="<?php  echo $incident->reported_by; ?>">
                                    </div> 
                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlTextarea1">Details</label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"><?php  echo $incident->description; ?></textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="exampleFormControlTextarea1">Actions Taken</label>
                                        <textarea name="actions" class="form-control" id="exampleFormControlTextarea1" rows="3"><?php  echo $incident->actions; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-check pl-0">
                                            <div class="custom-control custom-checkbox checkbox-info">
                                                <input type="checkbox" class="custom-control-input" id="gridCheck">
                                                <label class="custom-control-label" for="gridCheck">Confirm</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button name="submit" type="submit" class="btn btn-warning mt-3">Update Report</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php  $this->load->view("admin/common/footer"); ?>
        </div>
        <!--  END CONTENT PART  -->

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
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

</body>

</html>
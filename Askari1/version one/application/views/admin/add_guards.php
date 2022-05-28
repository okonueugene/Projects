<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title> Askari Guard Patrol </title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url();?>/theme/dark/assets/img/favicon.ico" />
    <link href="<?php echo base_url();?>/theme/dark/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>/theme/dark/assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="<?php echo base_url();?>/theme/dark/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/theme/dark/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/theme/dark/plugins/flatpickr/custom-flatpickr.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url();?>/theme/dark/plugins/noUiSlider/custom-nouiSlider.css" rel="stylesheet"
        type="text/css">
    <link href="<?php echo base_url();?>/theme/dark/plugins/bootstrap-range-Slider/bootstrap-slider.css"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/theme/dark/plugins/dropify/dropify.min.css">
    <link href="<?php echo base_url();?>/theme/dark/assets/css/users/account-setting.css" rel="stylesheet"
        type="text/css" />
    <!--  END CUSTOM STYLE FILE  -->
</head>

<body data-spy="scroll" data-target="#navSection" data-offset="100">
    <!-- BEGIN LOADER -->
    <!-- <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div> -->
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
                                <li class="breadcrumb-item"><a
                                        href="javascript:void(0);"><?php echo $this->lang->line("Admin");?></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Add Guards</span></li>
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

        <!-- BEGIN CONTENT AREA -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                <div class="account-settings-container layout-top-spacing">

                    <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 layout-spacing">
                        <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message');
                                    unset($_SESSION['message']);
                                    ?>
                        <form action="" method="post" enctype="multipart/form-data" style="font-size:initial"
                            id="contact" class="section contact">
                            <div class="info">
                                <h5 class="">Add Guards</h5>
                                <div class="row">
                                    <div class="col-md-11 mx-auto">
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-4 ">
                                                <div class="upload mt-4 pr-md-4">
                                                    <input type="file" name="image" accept="image/*" id="input-file-max-fs" class="dropify" data-default-file="<?php echo base_url();?>/theme/dark/assets/img/200x200.jpg" data-max-file-size="2M" />
                                                    <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="country">Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="name" class="form-control" id="name"
                                                        placeholder="Enter Guard's name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Guard ID<span class="text-danger">*</span></label>
                                                    <input type="text" name="guard_id" class="form-control" id="id"
                                                        placeholder="Enter Guard's ID" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="location">Site Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="agency" class="form-control" id="site"
                                                        placeholder="Enter Site name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Email<span class="text-danger">*</span></label>
                                                    <input type="email" name="email" class="form-control"
                                                        id="exampleFormControlInput2" placeholder="name@example.com" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Mobile Number<span class="text-danger">*</span></label>
                                                    <input type="text" name="mobile" class="form-control" id="id"
                                                        placeholder="Enter Guard's number" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shiftstart">Shift Start Time<span class="text-danger">*</span></label>
                                                    <input type="time" name="start" class="form-control" placeholder=""
                                                        required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="shiftend">Shift End Time<span class="text-danger">*</span></label>
                                                    <input type="time" name="end" class="form-control" placeholder=""
                                                        required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="password1">Password<span class="text-danger">*</span></label>
                                                    <input type="password" name="password" class="form-control"
                                                        id="pass" placeholder="" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="confirmpass">Confirm Password<span class="text-danger">*</span></label>
                                                    <input type="password" name="conf_password" class="form-control"
                                                        id="pass" placeholder="" required>
                                                </div>
                                            </div>
                                            <div style="text-align:center;" class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" name="submit" class="mt-2 mb-4 btn btn-primary"
                                                        value="Add Guard" id="sub">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php  $this->load->view("admin/common/footer"); ?>
        </div>

    </div>

    <!-- END CONTENT AREA -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo base_url();?>/theme/dark/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/perfect-scrollbar/perfect-scrollbar.min.js">
    </script>
    <script src="<?php echo base_url();?>/theme/dark/assets/js/app.js"></script>

    <script>
    $(document).ready(function() {
        App.init();
    });
    </script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/highlight/highlight.pack.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?php echo base_url();?>/theme/dark/assets/js/scrollspyNav.js"></script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="<?php echo base_url();?>/theme/dark/plugins/dropify/dropify.min.js"></script>
    <script src="<?php echo base_url();?>/theme/dark/plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="<?php echo base_url();?>/theme/dark/assets/js/users/account-settings.js"></script>
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
</body>

</html>
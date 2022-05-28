<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Account Settings | Askari Guard Patrol </title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>/theme/dark/assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/dark/plugins/dropify/dropify.min.css">
    <link href="<?php echo base_url(); ?>/theme/dark/assets/css/users/account-setting.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/theme/dark/assets/css/forms/theme-checkbox-radio.css">
    <!--  END CUSTOM STYLE FILE  -->
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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">User</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Account Settings</span></li>
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

                <div class="account-settings-container layout-top-spacing">

                    <div class="account-content">
                        <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                            <div class="row">
                                <div class="col-xl-8 col-lg-8 col-md-12 layout-spacing">
                                    <?php 
                                    echo $this->session->flashdata("message");
                                    ?>
                                    <form id="general-info" role="form" action="" method="post" class="section general-info">
                                        <div class="info">
                                            <h6 class="">User Information</h6>
                                            <div class="row">
                                                <div class="col-lg-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                            <div class="form">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="user_fullname"><?php echo $this->lang->line("Full Name");?> </label>
                                                                            <input type="text" name="user_fullname" class="form-control mb-4" id="user_fullname"  placeholder="Full Name" value="<?php echo $user->user_fullname; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label for="user_email"><?php echo $this->lang->line("User Email");?></label>
                                                                        <input type="email" class="form-control mb-4" id="user_email" disabled="" name="user_email" readonly="" placeholder="User Email" value="<?php echo $user->user_email; ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="user_password"><?php echo $this->lang->line("Password");?></label>
                                                                    <input type="password" class="form-control mb-4" id="user_password" name="user_password" placeholder="" value="">
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="checkbox">
                                                                    <label for="status">
                                                                        <input type="checkbox" id="status" name="status"   <?php echo ($user->user_status == 1) ? "checked" : ""; ?>  />  <?php echo $this->lang->line("Status");?>
                                                                    </label>
                                                                    </div>
                                                                </div>
                                                                <div style="text-align: center;" class="center">
                                                                    <button type="submit" class="btn btn-outline-warning">Submit</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 layout-spacing">                                    
                                    <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <?php 
                                    echo $this->session->flashdata("message");
                                    ?>
                                    <form id="general-info" role="form" action="" method="post" class="section general-info">
                                        <div class="info">
                                            <h6 class="">User Information</h6>
                                            <div class="row">
                                            <div class="col-xl-12 col-lg-12">
                                                <input type="file" id="input-file-max-fs" class="dropify" data-default-file="<?php echo base_url(); ?>/theme/dark/assets/img/200x200.jpg" data-max-file-size="2M" />
                                                    <p class="mt-2"><i class="flaticon-cloud-upload mr-1"></i> Upload Picture</p>         
                                                    <div class="mt-4">
                                                        <button type="submit" class="btn btn-outline-warning">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="account-settings-footer">

                        <div class="as-footer-container">

                            <button id="multiple-reset" class="btn btn-primary">Reset All</button>
                            <div class="blockui-growl-message">
                                <i class="flaticon-double-check"></i>&nbsp; Settings Saved Successfully
                            </div>
                            <button id="multiple-messages" class="btn btn-dark">Save Changes</button>

                        </div>

                    </div> -->
                </div>

            </div>
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

    <!--  BEGIN CUSTOM SCRIPTS FILE  -->

    <script src="<?php echo base_url(); ?>/theme/dark/plugins/dropify/dropify.min.js"></script>
    <script src="<?php echo base_url(); ?>/theme/dark/plugins/blockui/jquery.blockUI.min.js"></script>
    <!-- <script src="plugins/tagInput/tags-input.js"></script> -->
    <script src="<?php echo base_url(); ?>/theme/dark/assets/js/users/account-settings.js"></script>
    <!--  END CUSTOM SCRIPTS FILE  -->
</body>

</html>
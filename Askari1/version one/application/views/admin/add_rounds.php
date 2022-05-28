<!DOCTYPE html>
<html lang="en">

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#show").load("<?php echo  base_url().'/admin/check';?>"); //checking
        $("#btn_in").click(function() {
            $.post("<?php echo  base_url().'/admin/add_sub';?>", {
                    location: $('#location').val(),
                    //   qty: $('#qty').val(),

                },
                function(data, status) {
                    $("#show").load("<?php echo  base_url().'/admin/get_sub_data';?>");
                    $("#location").load("<?php echo  base_url().'/admin/get_list_data';?>");
                    //alert("Data: " + data + "\nStatus: " + status);
                });
        });
    });
    </script>
    <script language="javascript">
    function del(x) {

        $("#show").load("<?php echo  base_url().'/admin/del/';?>" + x); //deleting
        $("#show").load("<?php echo  base_url().'/admin/get_sub_data';?>");
        $("#show").load("<?php echo  base_url().'/admin/get_sub_data';?>");
        $("#show").load("<?php echo  base_url().'/admin/get_sub_data';?>");
        $("#show").load("<?php echo  base_url().'/admin/get_sub_data';?>");
        $("#show").load("<?php echo  base_url().'/admin/get_sub_data';?>");

        $("#show").load("<?php echo  base_url().'/admin/get_sub_data';?>");
        $("#location").load("<?php echo  base_url().'/admin/get_list_data';?>");
    }
    </script>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Askari Guard Patrol </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>/theme/dark/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>/theme/dark/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="<?php echo base_url();?>/theme/dark/assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/theme/dark/plugins/select2/select2.min.css">
    <!--  END CUSTOM STYLE FILE  -->
</head>

<body data-spy="scroll" data-target="#navSection" data-offset="100">

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
                                <li class="breadcrumb-item active" aria-current="page"><span>Add Rounds</span></li>
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
                <div class="account-settings-container layout-top-spacing">
                    <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 layout-spacing">
                        <div id="fs2Basic" class="col-lg-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message'); ?>
                                <div class="widget-content widget-content-area">
                                    <form action="" method="post" enctype="multipart/form-data"
                                        style="font-size:initial">
                                        <div class="info">
                                            <h5 style="text-align:center;" class="">Add Rounds</h5>
                                            <div class="row">
                                                <div class="col-md-11 mx-auto">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="country">Select Guard<span
                                                                        class="text-danger">*</span></label>
                                                                <select name="guard_id" required
                                                                    class="form-control  basic">
                                                                    <option value="">--Select Guard--</option>
                                                                    <?php
                                                                    $q=$this->db->get('guards')->result();
                                                                    foreach($q as $r)
                                                                    {
                                                                    ?>
                                                                    <option value="<?php echo $r->id?>">
                                                                        <?php echo $r->name;?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="address">Round Name<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" name="round_name"
                                                                    class="form-control" id="id"
                                                                    placeholder="Enter Round Name" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="shiftstart">Start Time<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="time" name="start" class="form-control"
                                                                    placeholder="" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="shiftend">End Time<span
                                                                        class="text-danger">*</span></label>
                                                                <input type="time" name="end" class="form-control"
                                                                    placeholder="" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php  if(isset($error)){ echo $error; }
                                                                echo $this->session->flashdata('message'); 
                                                                unset($_SESSION['message']);
                                                            ?>
                                                        </div>

                                                        <div class="col-md-9">
                                                            <p>Add
                                                                <code>CHECKPOINTS<span class="text-danger">*</span></code>
                                                            </p>
                                                            <Select class="form-control basic" id='location'>
                                                                <?php 
                                                                    $q=$this->db->get('locations')->result();
                                                                    foreach($q as $r)
                                                                    {
                                                                    ?>
                                                                    <option value='<?php echo $r->id;?>'>
                                                                    <?php echo $r->location;?></option>
                                                                    <?php    
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <p><code></code>
                                                            </p>
                                                            <input type="button" class="btn mt-4"
                                                                style="background-color:#00887a; color:white" name="add"
                                                                value="Add" id='btn_in'
                                                                onclick="document.getElementById('save').style.display='block'" />
                                                            <br>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="widget-content widget-content-area">
                                                                <div class="table-responsive">
                                                                    <table class="table table-hover table-dark mb-4">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center">Sr.No</th>
                                                                                <th>Checkpoint Name</th>
                                                                                <th>Location</th>
                                                                                <th>Delete</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="show">

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div style="text-align:center;" class="col-md-12">
                                                            <div class="form-group">
                                                                <input type="submit" class="btn"
                                                                    style="background-color:#00887a; color:white;display:none; width:120px;"
                                                                    name="submit" value="Save" id="save" />
                                                                <input type="submit" class="btn btn-primary" name="pay"
                                                                    value="Pay" id="pay" style="display:none" />
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
                    </div>
                    <?php  $this->load->view("admin/common/footer"); ?>
                </div>
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
        <script src="<?php echo base_url();?>/theme/dark/plugins/highlight/highlight.pack.js"></script>
        <script src="<?php echo base_url();?>/theme/dark/assets/js/custom.js"></script>
        <!-- END GLOBAL MANDATORY SCRIPTS -->

        <!--  BEGIN CUSTOM SCRIPTS FILE  -->
        <script src="<?php echo base_url();?>/theme/dark/assets/js/scrollspyNav.js"></script>
        <script src="<?php echo base_url();?>/theme/dark/plugins/select2/select2.min.js"></script>
        <script src="<?php echo base_url();?>/theme/dark/plugins/select2/custom-select2.js"></script>
        <script>
        $(function() {

            $('#example1').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "info": true,
                "autoWidth": true,
            });
            $("body").on("change", ".tgl_checkbox", function() {
                var table = $(this).data("table");
                var status = $(this).data("status");
                var id = $(this).data("id");
                var id_field = $(this).data("idfield");
                var bin = 0;
                if ($(this).is(':checked')) {
                    bin = 1;
                }
                $.ajax({
                        method: "POST",
                        url: "<?php echo site_url("admin/change_status"); ?>",
                        data: {
                            table: table,
                            status: status,
                            id: id,
                            id_field: id_field,
                            on_off: bin
                        }
                    })
                    .done(function(msg) {
                        alert(msg);
                    });
            });
        });
        </script>
        <script src="<?php echo base_url()."/theme/index.js"; ?>"></script>
        <src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>">
            <!--  BEGIN CUSTOM SCRIPTS FILE  -->
</body>

</html>
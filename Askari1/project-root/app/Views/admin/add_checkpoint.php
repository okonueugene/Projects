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
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Checkpoints</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>Generate</span></li>
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
                <?php $code = substr(md5(time()), 5, 5); ?>
                <div class="row layout-top-spacing">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6 col-sm-6 col-6">
                                            <?php if (isset($error)) {
                                                echo $error;
                                            }
                                            echo $this->session->flashdata('message'); ?>
                                            <h4 style="text-align: center;">Generate Checkpoint</h4>
                                            <form action="" method="post" enctype="multipart/form-data" style="font-size:initial">
                                                <h6><input type="radio" name="mode" style="width: 0.8em; height: 0.8em; " value="auto" checked=true; onclick="document.getElementById('print').style.display='inline';document.getElementById('image').value='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='+document.getElementById('codex').value; document.getElementById('code').style.display='none';document.getElementById('img').src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='+document.getElementById('codex').value; document.getElementById('lbl').innerHTML='Code: '+document.getElementById('codex').value; document.getElementById('codexx').value=document.getElementById('codex').value" /> <b>Auto</b>
                                                    <input type="radio" name="mode" style="width: 0.8em; height: 0.8em; " value="manual" onclick="document.getElementById('print').style.display='none';document.getElementById('code').style.display='block';document.getElementById('img').src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=----'; document.getElementById('lbl').innerHTML='Code: ----';document.getElementById('codexx').value='';" required /><b> Manual</b>
                                                </h6>
                                                <div class="form-group mb-4">
                                                    <label for="formGroupExampleInput">Checkpoint Name</label>
                                                    <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Checkpoint name" required>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="formGroupExampleInput2">Location</label>
                                                    <input type="text" name="location" class="form-control" placeholder="Location" required />
                                                    <input type="hidden" value="<?php echo $code; ?>" id='codex' required>
                                                    <input type="hidden" value="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $code; ?>" name='image' id='image'>
                                                </div>
                                                <div class="form-group" id='code' style="display:none">
                                                    <label class="">Code<span class="text-danger">*</span></label>
                                                    <input type="text" value="<?php echo $code; ?>" class="form-control" name='code' onkeyup="document.getElementById('lbl').innerHTML='Code: '+this.value; document.getElementById('img').src='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='+this.value; document.getElementById('image').value='https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl='+this.value;" id='codexx' required>
                                                </div>
                                                <input type="submit" class="btn btn-primary "  name="submit" value="Save" id="sub" />
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="submit" class="btn btn-warning"  name="print" value="Save & Print" id="print" />
                                                <!-- <input type="submit" name="time" class="btn btn-primary"> -->
                                            </form>
                                        </div>
                                        <!-- QR CODE -->
                                        <div class="col-xs-6 col-lg-6 col-md-6" id="qrcode" style="text-align:center">
                                            <?php if (isset($error)) {
                                                echo $error;
                                            }
                                            echo $this->session->flashdata('message');
                                            unset($_SESSION['message']);
                                            ?>
                                            <div class="box box-primary">

                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="box-body">
                                                        
                                                        <div class="form-group">
                                                            <label class=""><b>
                                                                    <h4 id='lbl' style="font-weight:bold;">Code: <?php echo $code; ?> </h4>
                                                                </b></label>

                                                        </div>
                                                        <div class="form-group">

                                                            <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $code; ?>" id='img'>
                                                        </div>

                                                    </div><!-- /.box-body -->

                                                    <div class="box-footer">

                                                        <br>
                                                        <a href="#" class="btn btn-outline-warning">Download</a>
                                                        <br>
                                                    </div>
                                                </form>
                                            </div><!-- /.box -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- Footer start -->

                <!-- Footer End -->
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
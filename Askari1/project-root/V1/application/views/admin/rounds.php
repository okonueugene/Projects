<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/css/bootstrap.min.css"); ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.css"); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/dist/css/AdminLTE.css
    "); ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/dist/css/skins/_all-skins.min.css"); ?>">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
        
        #overlay{
    position: fixed; 
    width: 100%; 
    height: 100%; 
    top: 0px; 
    left: 0px; 
    background-color: #000; 
    opacity: 0.7;
    filter: alpha(opacity = 70) !important;
    display: none;
    z-index: 100;
    }
#overlayContent{
    position: fixed; 
    width: 100%;
    top: 100px;
    text-align: center;
    display: none;
    overflow: hidden;
    z-index: 100;
}
#contentGallery{
    margin: 0px auto;
}
#imgBig, .imgSmall{
    cursor: pointer;
}
/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
 
    </style>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php  $this->load->view("admin/common/common_header"); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php  $this->load->view("admin/common/common_sidebar"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                 <section class="content-header">
                    <h1>
                      Rounds
                        <small>  </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line("Admin");?></a></li>
                        <li><a href="#">Rounds</a></li>
                        
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message'); 
                                    unset($_SESSION['message']);
                                    ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">All Rounds</h3>
                                    <a class="pull-right" href="<?php echo site_url("admin/add_products"); ?>"><?php echo $this->lang->line("ADD");?></a>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped f1">
                                        <thead>
                                            <tr>
                                                <!--<th class="text-center">Date</th>-->
                                                <th>Guard Name</th>
                                                <th>Round Name</th>
                                                <th>Start Time</th>
                                                <th >End Time</th>
                                                <!--<th>Number Of Rounds</th>-->
                                                 
                                                
                                                
                                                <th class="text-center" style="width: 100px;"><?php echo $this->lang->line("Action");?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($products as $product){ ?>
                                            <tr>
                                                <!--<td class="text-center"><?php echo date('d/m/Y',strtotime($product->date)); ?></td>-->
                                                <td><?php echo $this->db->where('id',$product->guard_id)->get('guards')->row()->name; ?></td>
                                                 <td><?php echo $product->round_name; ?></td>
                                                <td class=""><?php echo date('h:i: A',strtotime($product->start)); ?></td>
                                                 <td class=""><?php echo date('h:i: A',strtotime($product->end)); ?></td>
                                                <!--<td><?php echo $product->rounds; ?></td>-->
                                                    
                                               
                                                <td class="text-center"><div class="btn-group">
                                                        <?php echo anchor('admin/edit_rounds/'.$product->id, '<i class="fa fa-edit"></i>', array("class"=>"btn btn-success")); ?>
                                                       <?php echo anchor('admin/view_rounds/'.$product->id, '<i class="fa fa-eye"></i>', array("class"=>"btn btn-info")); ?>
                                                        <?php echo anchor('admin/delete_rounds/'.$product->id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger", "onclick"=>"return confirm('Are you sure to Delete?')")); ?>
                                                       
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                    <!-- Main row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- /.content-wrapper -->
      
      <?php  $this->load->view("admin/common/common_footer"); ?>  

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/datatables/dataTables.bootstrap.min.js"); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
    <script>
      $(function () {
        
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
        });
        $("body").on("change",".tgl_checkbox",function(){
            var table = $(this).data("table");
            var status = $(this).data("status");
            var id = $(this).data("id");
            var id_field = $(this).data("idfield");
            var bin=0;
                                         if($(this).is(':checked')){
                                            bin = 1;
                                         }
            $.ajax({
              method: "POST",
              url: "<?php echo site_url("admin/change_status"); ?>",
              data: { table: table, status: status, id : id, id_field : id_field, on_off : bin }
            })
              .done(function( msg ) {
                alert(msg);
              }); 
        });
      });
    </script>
    
    
    
    <div id="overlay"></div>
    <div id="overlayContent">
    <img id="imgBig" src="" alt="" width="400" />
</div>
    <script>
    $(".imgSmall").click(function(){
    $("#imgBig").attr("src",$(this).attr('src'));
    $("#overlay").show();
    $("#overlayContent").show();
});

$("#imgBig").click(function(){
    $("#imgBig").attr("src", "");
    $("#overlay").hide();
    $("#overlayContent").hide();
});

 </script>

  </body>
</html>

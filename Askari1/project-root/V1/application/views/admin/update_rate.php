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
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <?php  $this->load->view("admin/common/common_header"); ?>
      <!-- Left side column. contains the logo and sidebar -->
      <?php  $this->load->view("admin/common/common_sidebar"); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                 <section class="content-header" >
                    <h1 >
Update Milk Rate
                        <small>  </small>
                    </h1>
                    <!--<ol class="breadcrumb">-->
                    <!--    <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line("Admin");?></a></li>-->
                    <!--    <li><a href="#">Update Milk Rate</a></li>-->
                        
                    <!--</ol>-->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-6">
                            <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message'); ?>
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                    <a class="pull-right" href="<?php echo site_url("admin/add_products"); ?>"><?php echo $this->lang->line("ADD");?></a>                                    
                                </div><!-- /.box-header -->
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="box-body row">
                                     <!--  <div class="form-group">
                                            <label class="">Date<span class="text-danger">*</span></label>
                                            <input type="text" name="date" class="form-control" placeholder="Date"/>
                                        </div> -->
                                        <div class="form-group col-md-3">
                                            <label class="">Milk Type<span class="text-danger">*</span></label>
                                            <br>
                                            <Select class="form-control" name='milk_type' id='m_type'>
                                            
                                            <option value='1' >Cow</option>
                                            <option value='2'>Buffalo</option>
                                            </select>
                                        </div>
                                    
                                   

                                        <div class="form-group col-md-3">
                                            <label class="">Milk Rate<span class="text-danger">*</span></label>
                                            <input type="number" name="rate" class="form-control" placeholder="00.00" required />
                                        </div>
                                        
                                        <div class="form-group col-md-3">
                                        <label class="">&nbsp; <span class="text-danger"></span></label>
                                        <br>
                                        <input type="submit" class="btn btn-primary" name="submit" value="Add" id="sub"/>
                                        
                                         <input type="submit" class="btn btn-primary" name="pay" value="Pay" id="pay" style="display:none"/>
                                       
                                    </div>
                                    </div><!-- /.box-body -->
                                            
                                    
                                </form>
                            </div><!-- /.box -->
                        </div>
                    
                    
                    <!-- Main row -->

                    
                        <div class="col-xs-6">
                            <!-- <?php  if(isset($error)){ echo $error; }
                                    echo $this->session->flashdata('message'); ?> -->
                            <div class="box box-primary">
                                <!-- <div class="box-header">
                                    <h3 class="box-title">All Suppliers</h3>
                                    <a class="pull-right" href="<?php echo site_url("admin/add_products"); ?>"><?php echo $this->lang->line("ADD");?></a>                                    
                                </div>< /.box-header 
                                <div class="box-body table-responsive"> -->
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                
                                                                                              
                                                <th>Rate Per Ltr.</th>
                                                  <th >Milk Type</th>
                                                
                                              
                                                
                                                
                                                <!-- <th class="text-center" style="width: 100px;"><?php echo $this->lang->line("Action");?></th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php 
                                           $products=$this->db->get('milk_stock')->result();
                                           foreach($products as $product){ ?>
                                            <tr>
                                                
                                               
                                                <td><?php echo $product->rate; ?></td>
                                                 <td><?php if($product->milk_type==1){echo "Cow";}else{echo "Buffalow";}?></td>
                                                 
                                                   
                                                    
                                               
                                                <!-- <td class="text-center"><div class="btn-group">
                                                        <?php echo anchor('admin/edit_quality/'.$product->id, '<i class="fa fa-edit"></i>', array("class"=>"btn btn-success")); ?>
                                                        <?php echo anchor('admin/delete_quality/'.$product->id, '<i class="fa fa-times"></i>', array("class"=>"btn btn-danger", "onclick"=>"return confirm('Are you sure delete?')")); ?>

                                                       
                                                    </div>
                                                </td> -->
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
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
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": false,
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
  </body>
</html>

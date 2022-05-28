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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.1/css/buttons.dataTables.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/dist/css/AdminLTE.min.css
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
    
      <link href="<?php echo base_url();?>/theme/css/style.default.css" rel="stylesheet">
        <link href="<?php echo base_url();?>/theme/css/morris.css" rel="stylesheet">
        <link href="<?php echo base_url();?>/theme/css/select2.css" rel="stylesheet" />
        <style>
            .row-stat .md-title {
    opacity: 0.6;
    font-size: 13px;
    margin-bottom: 5px;
}

.mt5 {
    font-size:x-large;
    margin-top: 12px !important;
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
            <?php echo $this->lang->line('dashboard')?>
           
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line("Home");?></a></li>
            <li class="active"><?php echo $this->lang->line('dashboard')?></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
           
          <div class="contentpanel">
                        
                        
                        <div class="row row-stat">
                            <div class="col-md-6" >
                                <div class="panel panel-success-alt noborder" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); ">
                                    <div class="panel-heading noborder" style="background-color:#2b9fd2">
                                        <div class="panel-btns">
                                            <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-users" ></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin">total guards</h5>
                                            <h1 class="mt5"><?php echo $this->db->get('guards')->num_rows();?></h1>
                                        </div><!-- media-body -->
                                        <!--<hr>-->
                                        <!--<div class="clearfix mt20">-->
                                        <!--    <div class="pull-left">-->
                                        <!--        <h5 class="md-title nomargin">Yesterday</h5>-->
                                        <!--        <h4 class="nomargin">$29,009.17</h4>-->
                                        <!--    </div>-->
                                        <!--    <div class="pull-right">-->
                                        <!--        <h5 class="md-title nomargin">This Week</h5>-->
                                        <!--        <h4 class="nomargin">$99,103.67</h4>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            
                            <div class="col-md-6">
                                <div class="panel panel-success-alt noborder">
                                    <div class="panel-heading noborder" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color:#2b9fd2" >
                                        <div class="panel-btns">
                                            <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-map-marker"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin">Total CheckPoints</h5>
                                            <h1 class="mt5"><?php echo $this->db->get('locations')->num_rows();?></h1>
                                        </div><!-- media-body -->
                                        <!--<hr>-->
                                        <!--<div class="clearfix mt20">-->
                                        <!--    <div class="pull-left">-->
                                        <!--        <h5 class="md-title nomargin">Yesterday</h5>-->
                                        <!--        <h4 class="nomargin">$29,009.17</h4>-->
                                        <!--    </div>-->
                                        <!--    <div class="pull-right">-->
                                        <!--        <h5 class="md-title nomargin">This Week</h5>-->
                                        <!--        <h4 class="nomargin">$99,103.67</h4>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            
                            <div class="col-md-6">
                                <div class="panel panel-primary noborder">
                                    <div class="panel-heading noborder" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);background-color:#2b9fd2">
                                        <div class="panel-btns">
                                            <a href="" class="panel-close tooltips" data-toggle="tooltip" title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-street-view"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin"> Total Rounds</h5>
                                            <h1 class="mt5"><?php echo $this->db->get('rounds')->num_rows();?></h1>
                                        </div><!-- media-body -->
                                        <!--<hr>-->
                                        <!--<div class="clearfix mt20">-->
                                        <!--    <div class="pull-left">-->
                                        <!--        <h5 class="md-title nomargin">Yesterday</h5>-->
                                        <!--        <h4 class="nomargin">10,009</h4>-->
                                        <!--    </div>-->
                                        <!--    <div class="pull-right">-->
                                        <!--        <h5 class="md-title nomargin">This Week</h5>-->
                                        <!--        <h4 class="nomargin">178,222</h4>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                            <div class="col-md-6">
                                <div class="panel panel-dark noborder">
                                    <div class="panel-heading noborder" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); background-color:#2b9fd2">
                                        <div class="panel-btns">
                                            <a href="" class="panel-close tooltips" data-toggle="tooltip" data-placement="left" title="Close Panel"><i class="fa fa-times"></i></a>
                                        </div><!-- panel-btns -->
                                        <div class="panel-icon"><i class="fa fa-times"></i></div>
                                        <div class="media-body">
                                            <h5 class="md-title nomargin"> Monthly Missed Checkpoints</h5>
                                            <h1 class="mt5"><?php echo $this->db->where('MONTH(created_at)',date('m'))->where('time',null)->get('history')->num_rows();?></h1>
                                        </div><!-- media-body -->
                                        <!--<hr>-->
                                        <!--<div class="clearfix mt20">-->
                                        <!--    <div class="pull-left">-->
                                        <!--        <h5 class="md-title nomargin">Yesterday</h5>-->
                                        <!--        <h4 class="nomargin">144,009</h4>-->
                                        <!--    </div>-->
                                        <!--    <div class="pull-right">-->
                                        <!--        <h5 class="md-title nomargin">This Week</h5>-->
                                        <!--        <h4 class="nomargin">987,212</h4>-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                        
                                    </div><!-- panel-body -->
                                </div><!-- panel -->
                            </div><!-- col-md-4 -->
                            
                        </div><!-- row -->
                        
                          <table class="table data_table row-border  "  style="background-color:white; font-size:initial">
                <thead >
                 <tr>
                                                <th style="text-align:center">Date</th>
                                                <th style="text-align:center">Guard Name</th>                                                 
                                                <th style="text-align:center">Round Name</th>
                                                <th style="text-align:center">Checkpoint</th>
                                                <th style="text-align:center">Scanned At</th>
                                                <th style="text-align:center">Status</th>
                                                
                                                <!-- <th class="text-center" style="width: 100px;"><?php echo $this->lang->line("Action");?></th-->
                                            </tr>
                </thead>
          <tbody style="text-align:center">
          <?php 
                                        $this->db->order_by('id','desc');
                                          $products=$this->db->where('time',null)->get('history')->result();
                                           foreach($products as $product){
                                            if($product->time==null)
                                            {
                                             ?>
                                            <tr  style="background-color:; color:">
                                                <td ><?php echo date('d/m/Y',strtotime($product->created_at)); ?></td>
                                                <td><?php echo $this->db->where('id',$product->guard_id)->get('guards')->row()->name;?></td> 
                                                <td><?php echo $this->db->get_where('rounds',array('id'=>$product->round_id))->row()->round_name; ?></td>
                                                 <td><?php echo $this->db->get_where('locations',array('id'=>$product->loc_id))->row()->name; ?></td>
                                                 <td><?php if($product->time==null){echo "-----------";}else{echo date('h:i:s A',strtotime($product->time));} ?></td>
                                                   <td style=" text-align:center"><?php if($product->time==null){echo "<i class='fa fa-times' ></i> Missed";}else{echo "<i class='fa fa-check' ></i> Checked";} ?></td>
                                           
                                            </tr>
                                          
                                            <?php }else{ ?>
                                            
                                  <tr  >
                                                <td ><?php echo date('d/m/Y',strtotime($product->created_at)); ?></td>
                                                <td><?php echo $this->db->where('id',$product->guard_id)->get('guards')->row()->name;?></td> 
                                                <td><?php echo $this->db->get_where('rounds',array('id'=>$product->round_id))->row()->round_name; ?></td>
                                                 <td><?php echo $this->db->get_where('locations',array('id'=>$product->loc_id))->row()->name; ?></td>
                                                 <td><?php if($product->time==null){echo "-----------";}else{echo date('h:i:s A',strtotime($product->time));} ?></td>
                                                   <td style=" text-align:center"><?php if($product->time==null){echo "<i class='fa fa-times' ></i> Missed";}else{echo "<i class='fa fa-check' ></i> Checked";} ?></td>
                                           
                                            </tr>
                                            <?php
                                            }}
                                            ?>
                                               </tbody>
          </table>                              
       
                                    
                        
                    </div><!-- contentpanel -->  

        </section><!-- /.content -->
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
          "ordering": false,
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
    
      <script>
    $(document).ready(function() {
    $('.data_table').DataTable( {
        dom: 'Bfrtip',
         "ordering": false,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
    </script>
  </body>
</html>

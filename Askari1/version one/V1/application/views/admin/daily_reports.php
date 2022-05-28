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
    <!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/plugins/daterangepicker/daterangepicker-bs3.css"); ?>">
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
  Round Reports
            <small></small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
            <div class="box box-primary" style="padding:25px;">
          <?php echo $this->session->flashdata("message"); ?>
          
          <form action="" method="post">
                        <input type="hidden" name="date_range" id="date_range_field" />
                        <input type="hidden" name="date_range_lable" id="date_range_lable" />
                    <div class="form-group">
                        <label> <?php echo $this->lang->line("Date range button:");?></label>
                        <div class="input-group">
                          <button class="btn btn-default" type="button" id="daterange-btn">
                            <i class="fa fa-calendar"></i> <span id="reportrange"><?php if(!empty($date_range_lable)){ echo $date_range_lable; } else { echo date("M , d Y"); } ?></span> 
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
                          <input type="submit" name="filter" class="btn btn-success" value="Filter" />
                          
                        </div>
                      </div>
                    </form>
          
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
                                        // $this->db->order_by('id','desc');
                                        //   $products=$this->db->get('cust_transactions')->result();
                                           foreach($products as $product){
                                            if($product->time==null)
                                            {
                                             ?>
                                            <tr  style="background-color:#d03323; color:white">
                                                <td ><?php echo date('d/m/Y',strtotime($product->created_at)); ?></td>
                                                <td><?php echo $this->db->where('id',$product->guard_id)->get('guards')->row()->name;?></td> 
                                                <td><?php echo $product->round_name; ?></td>
                                                 <td><?php echo $product->loc_name; ?></td>
                                                 <td><?php if($product->time==null){echo "-----------";}else{echo date('h:i:s A',strtotime($product->time));} ?></td>
                                                   <td style=" text-align:center"><?php if($product->time==null){echo "<i class='fa fa-times' ></i> Missed";}else{echo "<i class='fa fa-check' ></i> Checked";} ?></td>
                                           
                                            </tr>
                                          
                                            <?php }else{ ?>
                                            
                                  <tr  >
                                                <td ><?php echo date('d/m/Y',strtotime($product->created_at)); ?></td>
                                                <td><?php echo $this->db->where('id',$product->guard_id)->get('guards')->row()->name;?></td> 
                                                 <td><?php echo $product->round_name; ?></td>
                                                 <td><?php echo $product->loc_name; ?></td>
                                                 <td><?php if($product->time==null){echo "-----------";}else{echo date('h:i:s A',strtotime($product->time));} ?></td>
                                                   <td style=" text-align:center"><?php if($product->time==null){echo "<i class='fa fa-times' ></i> Missed";}else{echo "<i class='fa fa-check' ></i> Checked";} ?></td>
                                           
                                            </tr>
                                            <?php
                                            }}
                                            ?>
                                               </tbody>
          </table>                              
       

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?php  $this->load->view("admin/common/common_footer"); ?>  

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/daterangepicker/daterangepicker.js"); ?>"></script>
    <script>
    $(function () {
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end) {
          $('#reportrange').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          $('#date_range_lable').val(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          $('#date_range_field').val(start.format('YYYY-MM-D')+','+end.format('YYYY-MM-D'));
        }
        );
    });
    </script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.flash.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
    <script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>
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
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/js/bootstrap.min.js"); ?>"></script>
    
    <!-- AdminLTE App -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/app.min.js"); ?>"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/pages/dashboard.js"); ?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/dist/js/demo.js"); ?>"></script>
    <!-- date-range-picker -->
    
  </body>
</html>

<head>
      <link rel="stylesheet" href="<?php echo base_url();?>/theme/custom/demo-files/demo.css">
    <link rel="stylesheet" href="<?php echo base_url();?>/theme/custom/style.css">
    
      <style>


.icon-milk2:before {
  content: "\e900";
}
      </style>
    </head>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo base_url("img/icon.jpg"); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php _get_current_user_name($this); ?></p>
              <a href="#"><i class="fa fa-circle text-success"></i>  <?php echo $this->lang->line("Online");?></a>
            </div>
          </div>
          
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu f1">
            <li class="header"> <?php echo $this->lang->line("MAIN NAVIGATION");?></li>
            <li class="active treeview">
              <a href="<?php echo site_url("admin/dashboard"); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <?php if(_get_current_user_type_id($this)==0){ ?>
            <!--<li class="treeview">
              <a href="#">
                <i class="fa fa-files-o"></i>
                <span>Common Settings</span>
                <span class="label label-primary pull-right"></span>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> User Settings</a>
                    <ul class="treeview-menu">
                        <li><a href="<?php echo site_url("admin/user_types"); ?>"><i class="fa fa-circle-o"></i> User Types</a></li>
                        
                    </ul>
                </li>
               
              </ul>
             </li>-->
            <!--<li>-->
            <!--  <a href="<?php echo site_url("admin/add_customers"); ?>">-->
            <!--    <i class="fa fa-mobile"></i> <span>Add Cutomer</span> <small class="label pull-right bg-green"></small>-->
            <!--  </a>-->
            <!--</li>-->
            
            <!--<li>-->
            <!--  <a href="<?php echo site_url("admin/customers"); ?>">-->
            <!--    <i class="fa fa-list"></i> <span>Customers List</span> <small class="label pull-right bg-green"></small>-->
            <!--  </a>-->
            <!--</li>-->
            <!--<li>-->
            <!--  <a href="<?php echo site_url("admin/cust_transactions"); ?>">-->
            <!--    <i class="fa fa-list"></i> <span>Customers Transactions</span> <small class="label pull-right bg-green"></small>-->
            <!--  </a>-->
            <!--</li>-->
            
            <!--<li>-->
            <!--  <a href="<?php echo site_url("admin/add_product"); ?>">-->
            <!--    <i class="fa fa-list"></i> <span>Add Products</span> <small class="label pull-right bg-green"></small>-->
            <!--  </a>-->
            <!--</li>-->
            <!--<li>-->
            <!--  <a href="<?php echo site_url("admin/products"); ?>">-->
            <!--    <i class="fa fa-list"></i> <span>Products List</span> <small class="label pull-right bg-green"></small>-->
            <!--  </a>-->
            <!--</li>-->
            <!--<li>-->
            <!--  <a href="<?php echo site_url("Admin/add_quality"); ?>">-->
            <!--    <i class="fa fa-mobile"></i> <span>Add Milk Quality</span> <small class="label pull-right bg-green"></small>-->
            <!--  </a>-->
            <!--</li>-->
            <!--<li>-->
            <!--  <a href="<?php echo site_url("Admin/update_rate"); ?>">-->
            <!--    <i class="fa fa-mobile"></i> <span>Change Milk Rates</span> <small class="label pull-right bg-green"></small>-->
            <!--  </a>-->
            <!--</li>-->

            <li class="treeview">
              <a href="#">
                <i class="fa fa-user-secret"></i>
                <span> Guard Management </span>
                <span class="label label-primary pull-right"></span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo site_url("admin/add_guards"); ?>"><i class="fa fa-circle-o"></i>  Add Guards </a></li>
              <li><a href="<?php echo site_url("admin/guards"); ?>"><i class="fa fa-circle-o"></i> Guards List  </a></li>
              
                
              </ul>
            </li>
            
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-user-secret"></i>
                <span> Checkpoints Management </span>
                <span class="label label-primary pull-right"></span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo site_url("admin/add_checkpoint"); ?>"><i class="fa fa-circle-o"></i>  Add Checkpoints </a></li>
              <li><a href="<?php echo site_url("admin/checkpoints"); ?>"><i class="fa fa-circle-o"></i> Checkpoints List  </a></li>
               
                
              </ul>
            </li>
            
             <li class="treeview">
              <a href="#">
                <i class="fa fa-user-secret"></i>
                <span> Rounds Management </span>
                <span class="label label-primary pull-right"></span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo site_url("admin/add_rounds"); ?>"><i class="fa fa-circle-o"></i>  Add Rounds </a></li>
              <li><a href="<?php echo site_url("admin/rounds"); ?>"><i class="fa fa-circle-o"></i> Rounds List  </a></li>
              
                
              </ul>
            </li>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-user-secret"></i>
                <span> Reports </span>
                <span class="label label-primary pull-right"></span><i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              <li><a href="<?php echo site_url("admin/daily_reports"); ?>"><i class="fa fa-circle-o"></i>Round Reports </a></li>
                   <li><a href="<?php echo site_url("admin/attendance"); ?>"><i class="fa fa-circle-o"></i> Attendance Reports </a></li>
             
              
                
              </ul>
            </li>
            <li>
              <a href="<?php echo site_url("Admin/about_us"); ?>">
                <i class="fa fa-mobile"></i> <span>About Us</span> <small class="label pull-right bg-green"></small>
              </a>
            </li>
            
              <li>
              <a href="<?php echo site_url("Admin/logs"); ?>">
                <i class="fa fa-history"></i> <span>Login Logs</span> <small class="label pull-right bg-green"></small>
              </a>
            </li>

            <?php  } ?>


             
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
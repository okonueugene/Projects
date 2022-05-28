<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/css/bootstrap.min.css"); ?>" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/dist/css/AdminLTE.min.css"); ?>" />
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url($this->config->item("theme_admin")."/plugins/iCheck/square/blue.css"); ?>" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <style>
     
        .login-page{
    /*background-color: #b01e23;*/
    background-image: url("<?php base_url();?>/guardadmin/img/bg.jpg");
   background-size: 100% 100%;
    /*background-repeat: repeat;*/
   
}

.card {
  box-shadow: 0 0px 2px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  
}

.card:hover {
  box-shadow: 0 4px 4px 0 rgba(0,0,0,0.2);
}


    </style>
  </head>

  <body class="hold-transition login-page">
    <div class="login-box ">
      <div class="">
      <div class="login-logo">
        <a href="#"><?php echo $this->config->item('company_title');  ?></a>
      </div><!-- /.login-logo -->
      
        <p class="login-box-msg"><?php echo $this->lang->line('Sign in to your account')?></p>
        <?php if(isset($error) && $error!=""){
                            echo $error;
                        } ?>
        <form action="" method="post">
          <div class="form-group has-feedback">
            <input type="email" name="email" class="form-control" placeholder="Email" required="" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
            <div class="col-xs-12">
              <button type="submit" class="btn  btn-block btn-flat" style="background-color:#2b9fd2; color:white"><?php echo $this->lang->line('Sign In')?></button>
            </div><!-- /.col -->
          </div>
          <br>
          <div class="form-group has-feedback">
            <a href="<?php echo base_url();?>/admin/sendmail">Forget password ?</a>
            
          </div>
        </form>

      
         

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/jQuery/jQuery-2.1.4.min.js"); ?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/bootstrap/js/bootstrap.min.js"); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url($this->config->item("theme_admin")."/plugins/iCheck/icheck.min.js"); ?>"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>

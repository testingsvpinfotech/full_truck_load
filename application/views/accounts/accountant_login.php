<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_assets/dist/vendors/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_assets/dist/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/admin_assets/dist/vendors/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">
        label { color: red; }
    </style>
    <script>var baseURL = '<?= base_url(); ?>'; </script>
</head>
<body class="hold-transition login-page" style="background-image: url('assets/images/image_bg.jpg'); width: 100% !important; background-position: center !important; background-repeat: no-repeat !important; background-size: cover !important;  position: relative !important;  background-attachment: fixed;">
    <div>
        <div class="login-box">
            <div class="login-logo"></div>          
            <div class="login-box-body">  
                <h3 class="exp_heading"><center><?php echo $company->company_name; ?></center></h3>
                <p class="text-center">Accounts Login</p>
                </br>
                <form id="accountLoginForm">
                    <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Enter Username" autocomplete="off">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" autocomplete="off">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-xs-3"></div>
                        <div class="col-md-6 col-xs-6">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <div class="col-md-3 col-xs-3"></div>
                    </div><br>
                </form>
            </div><!-- /.login-box-body -->          
        </div> <!-- /.login-box -->
    </div>

    <!-- <script src="<?php echo base_url();?>assets/web_assets/bower_components/jquery/dist/jquery.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/web_assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script> -->
    <!-- <script src="<?php echo base_url();?>assets/web_assets/plugins/iCheck/icheck.min.js"></script> -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/web_assets/js/validate.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    $("#accountLoginForm").validate({
        rules: {
            username: {  required: true },
            password: {  required: true }
        },
        messages: {
            username: {  required: "Enter username" },
            password: {  required: "Enter password" }
        },
        submitHandler: function(form) {
            $.ajax({
                url: baseURL+'validateLogin',
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                   console.log(response);
                   if (response == 1) {
                        window.location.href = baseURL+'accounts-vendor';
                   }
                }
            });
        }
    });

});
</script>
    <!-- <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' /* optional */
        });
      });
    </script> -->
</body>
</html>

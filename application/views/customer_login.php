<?php include 'shared/web_header.php'; ?>
     
<body class="home header-v4 hide-topbar-mobile">
    <div id="page">

        <!-- Preloader-->
       

        <?php include 'shared/web_menu.php'; ?>
        <!-- masthead end -->

      <style type="text/css">
          .btn1{
            float:right;
          }
      </style> 


<div class="page-title">
        <div class="container">
            <div class="padding-tb-120px">
                <h1>Customer Login</h1>
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active">Customer Login</li>
                </ol>
            </div>
        </div>
    </div>
      
       

        <!--contact pagesec-->
<section class="contactpagesec secpadd">
<div class="container">
<div class="row">
<div class="col-md-12">
<div class="form-heading text-center">
<h3 class="form-title text-center" style="color:#d89444;">Login to your account!</h3>
</div>
</div>
</div>



<!-- <section class="sign-up-area ptb-100">
<div class="container">
<div class="row">
<div class="col-6 col-md-6">
<div class="contact-form-action">
<div class="form-heading text-center">
<h3 class="form-title" style="color:#d89444;">Login to your account!</h3>
</div> -->
<div class="row">
<div class="center-login">
<form action="Login/index" method="post">
<div class="mainform"> 
 <div class="col-12 col-lg-12 col-md-12">   
<div class="form-group">
<label>Email</label>
<input class="form-control" type="text" name="email" placeholder="Enter Username or Email">
</div>
<br>

<div class="form-group">
<label>Password</label>
<input class="form-control" type="password" name="password" placeholder="Enter Password">
</div>

<div class=" form-condition">

</div>
<!-- <center>
<div class="col-12"> -->
<!-- <br> -->
<!-- </div> -->
<!-- </div> -->
<!-- <div class="row">
<div class="col-6 col-lg-6 col-md-6"> -->
<input type="submit" name="submit" class=" btn btn-md default-btn btn1 btn-two btn-primary " value="Sign In">
</div>
</div>
</form>
<!-- <div class="col-md-6 col-lg-6">
    <img src="<?php echo base_url();?>assets/login-img.jpg" style="width:200px;height:auto;">
</div> -->
</div>
</div>
</div>

</form> 
</div>



</section>
</div>

<!-- </div> -->
<!--  </div>
</div> -->
<!-- </section> -->
<!--contact end-->

<!--google map end-->

<?php include 'shared/web_footer.php'; ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>carexid.com/rental</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="BTS Application, BTS Project" name="description" />
        <meta content="" name="author" />

        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/loginv4/css/util.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/loginv4/css/main.css">

		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/loginv4/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/loginv4/fonts/iconic/css/material-design-iconic-font.min.css">

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">

				<?php echo form_open('login/ceklogin', array('class' => 'login100-form validate-form')); ?>
					<span class="login100-form-title p-b-49">
						<img src="<?php echo base_url()?>assets/loginv4/images/gaia.png">
						<br>
						<img src="<?php echo base_url()?>assets/loginv4/images/logo.png">
					</span>
					
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
						<span class="label-input100">Username</span>						
						<?php echo form_input(['id' => 'username', 'name' => 'username'], '', ['class' => 'input100', 'placeholder' => 'Masukkan username anda']); ?>
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<?php echo form_password(['id' => 'password', 'name' => 'password'],'',['class' => 'input100', 'placeholder' => 'Masukkan password anda']); ?>
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>

					<div class="text-left p-t-8 p-b-31">
			
					<?php if($this->session->flashdata('error') || validation_errors() || isset($error)) { ?>

						<ul style="margin-left: 0px;margin-bottom: 0; color: red;">
					        <?php echo isset($error) ? $error : ''; ?>
					        <?php
					        if($this->session->flashdata('error')){
					            echo '<li>'.$this->session->flashdata('error').'</li>';
					        }
					        ?>
					        <?php echo validation_errors('<li>','</li>'); ?>
					    </ul>
										    
					<?php } ?>	
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Login
							</button>
						</div>
					</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>


<!-- JS File -->
    <script src="<?php echo base_url()?>assets/js/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url()?>assets/loginv4/js/main.js"></script>
</body>
</html>
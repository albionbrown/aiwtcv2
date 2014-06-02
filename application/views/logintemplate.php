<html class="no-js logged-out"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">

        <link rel="stylesheet" href="/css/jquery.multilevelpushmenu.css">
        <link rel="stylesheet" href="/css/bootstrap.css">
        <link rel="stylesheet" href="/css/responsive.css">
        <link rel="stylesheet" href="/css/aiwtc.css">
        <link rel="icon" type="image/png" href="/images/favicon.png">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://oss.maxcdn.com/libs/modernizr/2.6.2/modernizr.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="/js/jquery.multilevelpushmenu.min.js"></script>
        <script src="/js/responsive.js"></script>
    </head>
    <body class="login container">

    <div class="col-sm-6">
    	<img src="/images/logo.png" class="login_logo"/>
    </div>

	<div id="boxes" class="col-sm-6 clearfix">

		<div id="login_boxes" class="col-sm-12">
			<?php echo form_open('main/verify_login');?>
				
				<?php $email_data = array(
		              'name'        => 'email',
		              'class'       => 'input col-md-6',
		              'placeholder' => 'Email Address'
		            );

				echo form_input($email_data);

				$password_data = array(
		              'name'        => 'password',
		              'class'       => 'input col-md-6',
		              'placeholder' => 'Password'
		            );

				echo form_password($password_data); ?>

				<br>

				<?php $form_submit = array(
		              'name'        => 'submit',
		              'class'       => 'submit',
		            );

				echo form_submit($form_submit, 'Log in');
			echo form_close();

			$result = @$_GET['result']; 
			echo "<p>$result</p>";
			echo @$_SESSION['userid'];
		?>
		</div>

		<div id="register_boxes" class="col-sm-12">

		<h2>Haven't got an account? Enter your details below!</h2>
			<?php echo form_open('site/register');?>

				<?php $firstname_data = array(
						'name' 		=> 'firstname',
						'class' 	=> 'input col-md-6',
						'placeholder' => 'First Name'
					);

				echo form_input($firstname_data);
				
				$surname_data = array(
						'name' 		=> 'surname',
						'class' 	=> 'input col-md-6',
						'placeholder' => 'Surname'
					);

				echo form_input($surname_data);?>
				<br>
				<?php $email_data = array(
		              'name'        => 'email',
		              'class'       => 'input col-md-12',
		              'placeholder' => 'Email Address'
		            );

				echo form_input($email_data); ?>
				<br>
				<?php $location_data = array(
		              'name'        => 'location',
		              'class'       => 'input col-md-12',
		              'placeholder' => 'City'
		            );

				echo form_input($location_data); ?>
				<br>
				<?php $password_data = array(
		              'name'        => 'password',
		              'id'          => 'password',
		              'class'       => 'input col-md-6',
		              'placeholder' => 'Password'
		            );

				echo form_password($password_data);
				
				$confirm_data = array(
		              'name'        => 'confirm',
		              'id'          => 'password',
		              'class'       => 'input col-md-6',
		              'placeholder' => 'Confirm Password'
		            );

				echo form_password($confirm_data); ?>
				<br>
				<?php $form_submit = array(
		              'name'        => 'submit',
		              'class'       => 'submit',
		            );

				echo form_submit($form_submit, 'Register') ?>
			<?php echo form_close();?>
			<div id="errors">
			<?php 
			if($this->session->flashdata('error1') || $this->session->flashdata('error2') || $this->session->flashdata('error3') || $this->session->flashdata('error4') || $this->session->flashdata('error5')){
				echo @$this->session->flashdata('error1')."<br />";
				echo @$this->session->flashdata('error2')."<br />";
				echo @$this->session->flashdata('error3')."<br />";
				echo @$this->session->flashdata('error4')."<br />";
				echo @$this->session->flashdata('error5')."<br />";
			}
			if($this->session->flashdata('result')){
				echo "<h1>".$this->session->flashdata('result')."</h1>";
			}
			?>
			</div>
		</div>
		</div>
	</body>
</html>

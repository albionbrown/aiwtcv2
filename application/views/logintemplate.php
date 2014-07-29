<html class="no-js logged-out"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="google-site-verification" content="tO3eM2_dCV1mifmUKGf6TpOtxj39iqXKuEgmEHJDmJc" />

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
        <script src="/js/login.js"></script>
    </head>
    <body class="login container">

    <div id="resp_logo" class="col-sm-6">
    	<img src="/images/logo.gif" class="login_logo"/>

    	<?php 
    		$pwdrecoverform = array('class' => 'pwd-recover-form', 'name' => 'pwd-recover');
    		echo form_open('main/pwd_recover', $pwdrecoverform);

    		echo "<h2>First, enter your email</h2>";
				
				$email_data = array(
		              'name'        => 'email',
		              'class'       => 'text-input col-md-12',
		              'placeholder' => 'Email'
		            );
				echo form_input($email_data);

				$form_submit = array(
		              'name'        => 'submit',
		              'class'       => 'submit col-md-12',
		              'value' => 'Recover my password'
		            );

				echo form_submit($form_submit);
			echo form_close(); 

			$pwdrecoverform = array('class' => 'pwd-recover-form', 'name' => 'pwd-recover-2');
    		echo form_open('main/pwd_recover_confirm', $pwdrecoverform);

    		echo "<h2>Second, reset your password</h2>";
				
				$email_data = array(
		              'name'        => 'email',
		              'class'       => 'text-input col-md-12',
		              'placeholder' => 'Email'
		            );
				echo form_input($email_data);

				$code_data = array(
		              'name'        => 'code',
		              'class'       => 'text-input col-md-12',
		              'placeholder' => 'Code'
		            );
				echo form_input($code_data);

				$password_data = array(
		              'name'        => 'password',
		              'class'       => 'text-input col-md-6',
		              'placeholder' => 'Password'
		            );

				echo form_password($password_data);

				$password_data = array(
		              'name'        => 'password-repeat',
		              'class'       => 'text-input col-md-6',
		              'placeholder' => 'Confirm Password'
		            );

				echo form_password($password_data);

				$form_submit = array(
		              'name'        => 'submit',
		              'class'       => 'submit col-md-12',
		              'value' => 'Recover my password'
		            );

				echo form_submit($form_submit);
			echo form_close(); ?>
    </div>

	<div id="boxes" class="col-sm-6 clearfix">

		<div id="login_boxes" class="col-sm-12">
		<h2>Already got an account? Log in here!</h2>
			<?php echo form_open('main/verify_login');?>
				
				<?php $email_data = array(
		              'name'        => 'email',
		              'class'       => 'text-input col-md-6',
		              'placeholder' => 'Email'
		            );

				echo form_input($email_data);

				$password_data = array(
		              'name'        => 'password',
		              'class'       => 'text-input col-md-6',
		              'placeholder' => 'Password'
		            );

				echo form_password($password_data); ?>

				<br>

				<?php $form_submit = array(
		              'name'        => 'submit',
		              'class'       => 'submit long',
		            );

				echo form_submit($form_submit, 'Log in');
			echo form_close(); ?>
			<a class="pwd-recover-toggle">Forgotten your password?</a>
		</div>
		<div id="log_errors" class="clearfix"><p>
		<?php
				echo "<p>" . $this->session->flashdata('log_messages') . "</p>";
			?>
		</p></div>

		<div id="register_boxes" class="col-sm-12">

		<h2>Haven&#145;t got an account? Enter your details below!</h2>
			<?php echo form_open('main/register');?>

				<?php $firstname_data = array(
						'name' 		=> 'firstname',
						'class' 	=> 'text-input col-md-6',
						'placeholder' => 'First Name'
					);

				echo form_input($firstname_data);
				
				$surname_data = array(
						'name' 		=> 'surname',
						'class' 	=> 'text-input col-md-6',
						'placeholder' => 'Surname'
					);

				echo form_input($surname_data);?>
				<br>
				<?php $email_data = array(
		              'name'        => 'email',
		              'class'       => 'text-input col-md-12 long',
		              'placeholder' => 'Email Address'
		            );

				echo form_input($email_data); ?>
				<br>
				<?php $location_data = array(
		              'name'        => 'location',
		              'class'       => 'text-input col-md-12 long',
		              'placeholder' => 'City'
		            );

				echo form_input($location_data); ?>
				<br>
				<?php $password_data = array(
		              'name'        => 'password',
		              'id'          => 'password',
		              'class'       => 'text-input col-md-6',
		              'placeholder' => 'Password'
		            );

				echo form_password($password_data);
				
				$confirm_data = array(
		              'name'        => 'confirm',
		              'id'          => 'password',
		              'class'       => 'text-input col-md-6',
		              'placeholder' => 'Confirm Password'
		            );

				echo form_password($confirm_data); ?>
				<br>
				<?php $form_submit = array(
		              'name'        => 'submit',
		              'class'       => 'submit long',
		            );

				echo form_submit($form_submit, 'Register');
			echo form_close(); ?>
			<div id="reg_errors">
			<?php
			$reg_errors = $this->session->flashdata('reg_errors');
			while($reg_errors){
				echo "<p>" . array_pop($reg_errors) . "</p>";
			}
			?>
			</div>
			<p>All I Want This Christmas uses Gravatar for your profile picture. To use your Gravatar, sign up with the same email you registered with Gravatar and you&#145;re done! Don&#145;t have a Gravatar account? <a href="https://en.gravatar.com/" target="_blank">Click here!</a></p>
		</div>
		</div>
	</body>
</html>



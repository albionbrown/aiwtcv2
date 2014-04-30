<div id="login_boxes">
<h2>Already have an account? Log in here.</h2>
	<?php echo form_open('site/verify_log_in');?>
		
		<?php $email_data = array(
              'name'        => 'email',
              'class'       => 'input',
              'placeholder' => 'Email Address'
            );

		echo form_input($email_data); ?>
		<br>
		<?php $password_data = array(
              'name'        => 'password',
              'class'       => 'input',
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
?>
</div>

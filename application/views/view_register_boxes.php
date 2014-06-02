<div id="register_boxes">

<h2>Haven't got an account? Enter your details below!</h2>
	<?php echo form_open('site/register');?>

		<?php $firstname_data = array(
				'name' 		=> 'firstname',
				'class' 	=> 'input',
				'placeholder' => 'First Name'
			);

		echo form_input($firstname_data);
		
		$surname_data = array(
				'name' 		=> 'surname',
				'class' 	=> 'input',
				'placeholder' => 'Surname'
			);

		echo form_input($surname_data);?>
		<br>
		<?php $email_data = array(
              'name'        => 'email',
              'class'       => 'input long_input',
              'placeholder' => 'Email Address'
            );

		echo form_input($email_data); ?>
		<br>
		<?php $location_data = array(
              'name'        => 'location',
              'class'       => 'input long_input',
              'placeholder' => 'City'
            );

		echo form_input($location_data); ?>
		<br>
		<?php $password_data = array(
              'name'        => 'password',
              'id'          => 'password',
              'class'       => 'input',
              'placeholder' => 'Password'
            );

		echo form_password($password_data);
		
		$confirm_data = array(
              'name'        => 'confirm',
              'id'          => 'password',
              'class'       => 'input',
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
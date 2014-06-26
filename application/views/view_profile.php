<?php


$userid = $_SESSION['userid'];



$query = $this->db->query("SELECT * FROM users WHERE userid='$userid'");
if($query->num_rows() > 1){echo "<h2>Sorry! There is an error with your profile page.</h2>";
}else{

	foreach($query->result_array() as $row){

		$fname = $row['fname'];
		$sname = $row['sname'];
		$email = $this->encrypt->decode($row['email']);
		$location = $row['location'];

		$fname_data = array(
			'name'        => "fname",
			'class'       => "input",
			'value'       => ucwords($fname)
			);

		$sname_data = array(
			'name'        => "sname",
			'class'       => "input",
			'value'       => ucwords($sname)
			);

		$email_data = array(
			'name'        => "email",
			'placeholder' => $email,
			'class'       => "input",
			'value'       => $email 
			);

		$location_data = array(
			'name'        => "location",
			'placeholder' => ucwords($location),
			'class'       => "input",
			'value'       => ucwords($location) 
			);

		$password_data = array(
              'name'        => 'pwd',
              'class'       => 'input',
              'placeholder' => ' Current Password'
            );

		$new_password_data = array(
              'name'        => 'newpwd',
              'class'       => 'input',
              'placeholder' => 'New Password'
            );

		$confirm_password_data = array(
              'name'        => 'cnewpwd',
              'class'       => 'input',
              'placeholder' => 'Confirm New Password'
            );

		$form_submit = array(
              'name'        => 'submit',
              'class'       => 'submit profile',
            );

		echo form_open('main/profile_changes');
		echo "<h1>PROFILE SETTINGS"."</h1>";
		if($this->session->flashdata('result')){ echo "<h2>".$this->session->flashdata('result')."</h2>";}
		echo "<div class='profile-box'><p>Enter password to make changes<br />".form_password($password_data)."</p>";
		echo "<p>Change password<br />".form_password($new_password_data)."</p>";
		echo "<p>Confirm new password<br />".form_password($confirm_password_data)."</div></p>";
		echo "<div class='profile-box'><p>Change first name<br />".form_input($fname_data)."</p>";
		echo "<p>Change surname<br />".form_input($sname_data)."</p>";
		echo "<p>Change email address<br />".form_input($email_data)."</p>";
		echo "<p>Change your location<br />".form_input($location_data)."</div></p>";
		echo form_submit($form_submit, 'Apply');
		echo form_close();
	}
}

?>
<script type="text/javascript">
	
	function deluser(userid){

		var r=confirm("Are you sure you want to delete your account?");
		if (r==true){
		  window.location.href = "/main/profile_delete?uid="+userid;
		  }else{
		  
		  }
		}
</script>
<?php


$userid = $_SESSION['userid'];



$query = $this->db->query("SELECT * FROM users WHERE id='$userid'")->row_array();

		$fname = $query['first_name'];
		$sname = $query['last_name'];
		$email = $query['email'];
		$location = $query['location'];

		$fname_data = array(
			'name'        => "fname",
			'class'       => "text-input max-width",
			'value'       => ucwords($fname)
			);

		$sname_data = array(
			'name'        => "sname",
			'class'       => "text-input max-width",
			'value'       => ucwords($sname)
			);

		$email_data = array(
			'name'        => "email",
			'class'       => "text-input max-width",
			'value'       => $email 
			);

		$location_data = array(
			'name'        => "location",
			'class'       => "text-input max-width",
			'value'       => ucwords($location) 
			);

		$password_data = array(
              'name'        => 'pwd',
              'class'       => 'text-input',
              'placeholder' => ' Current Password'
            );

		$new_password_data = array(
              'name'        => 'newpwd',
              'class'       => 'text-input max-width',
              'placeholder' => 'New Password'
            );

		$confirm_password_data = array(
              'name'        => 'cnewpwd',
              'class'       => 'text-input max-width',
              'placeholder' => 'Confirm New Password'
            );

		$form_submit = array(
              'name'        => 'submit',
              'class'       => 'submit profile max-width',
            );

		echo form_open('main/profile_changes');
		echo "<h1>PROFILE SETTINGS"."</h1>";
		if($this->session->flashdata('messages')){ echo "<h2>".$this->session->flashdata('messages')."</h2>";}
		echo "<p>Enter password to make changes<br />".form_password($password_data)."</p>";
		echo "<div class='row'>";
		echo "<div class='col-md-4'><p>Change password<br />".form_password($new_password_data)."</p>";
		echo "<p>Confirm new password<br />".form_password($confirm_password_data)."</p>";
		echo "<p>Change email address<br />".form_input($email_data)."</p>";
		echo "<p>Change your location<br />".form_input($location_data)."</p></div>";
		
		echo "<div class='col-md-4'><p>Change first name<br />".form_input($fname_data)."</p>";
		echo "<p>Change surname<br />".form_input($sname_data)."</p><br>";
		echo form_submit($form_submit, 'Apply'); ?>
		<br><br><input type="button" onClick='deluser(<?php echo $userid ?>)' class="submit max-width" value="delete account"/>
		<?php echo "</div>";
		echo form_close();
?>

		
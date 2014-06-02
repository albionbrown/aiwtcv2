<?php

class profile extends CI_Model{

	function profile_controller($fname, $sname, $email, $location, $newpwd, $cnewpwd){
		$this->checkifpwd($newpwd, $cnewpwd);
		$this->checkfname($fname);
		$this->checksname($sname);
		$this->checkemail($email);
		$this->checklocation($location);
		$this->session->set_flashdata('result', 'Your changes have been made');
		header('Location: ../site/profile');
	}

	function pwdvalid($pwd){
		
		$userid = $_SESSION['userid'];
		$query = $this->db->query("SELECT * FROM users WHERE userid='$userid'");
		foreach($query->result_array() as $row){
			if($this->encrypt->decode($row['pwd']) == $pwd){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	} 

	function checkifpwd($newpwd, $cnewpwd){
		if($newpwd != ""){
			if(strlen($newpwd) > 4){
				if($newpwd == $cnewpwd){
					$userid = $_SESSION['userid'];
					$newpwd = $this->encrypt->encode($newpwd);
					$this->db->query("UPDATE users SET pwd='$newpwd' WHERE userid='$userid'");
				}else{$this->session->set_flashdata('result', 'Your new passwords do not match');}
			}else{$this->session->set_flashdata('result', 'Your new password is not long enough');}
		}
	}

	function checkfname($fname){
		if($fname != ""){
			$fname = strtolower($fname);
			$fname = $this->encrypt->encode($fname);
			$userid = $_SESSION['userid'];
			$this->db->query("UPDATE users SET fname='$fname' WHERE userid='$userid'");
		}
	}

	function checksname($sname){
		if($sname != ""){
			$sname = strtolower($sname);
			$sname = $this->encrypt->encode($sname);
			$userid = $_SESSION['userid'];
			$this->db->query("UPDATE users SET sname='$sname' WHERE userid='$userid'");
		}
	}

	function checkemail($email){
		if($email != ""){
			$email = $this->encrypt->encode($email);
			$userid = $_SESSION['userid'];
			$this->db->query("UPDATE users SET email='$email' WHERE userid='$userid'");
		}
	}

	function checklocation($location){
		if($location != ""){
			$location = strtolower($location);
			$userid = $_SESSION['userid'];
			$this->db->query("UPDATE users SET location='$location' WHERE userid='$userid'");
		}
	}


}
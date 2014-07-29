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
		
		$id = $_SESSION['userid'];
		$match = FALSE;
		// set up autoloader
require ('vendor\autoload.php');

// configure database
$dsn = 'mysql:dbname=alliwant_staging;host=localhost';
$u = 'alliwant_josh';
$p = 'aiwtc8159login';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
  new PDO($dsn, $u, $p));
  
  try {
    $id = strip_tags($_POST['id']);    
    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserById($id);
    $curpwd = $user->password;
    if($pwd == $curpad){
    	$match = TRUE;
    }
    }
    return $match
	} 

	function checkifpwd($newpwd, $cnewpwd){
		if($newpwd != ""){
			if(strlen($newpwd) > 4){
				if($newpwd == $cnewpwd){
					$userid = $_SESSION['userid'];
					$newpwd = $this->encrypt->encode($newpwd);
					$this->db->query("UPDATE users SET password='$newpwd' WHERE id='$userid'");
				}else{$this->session->set_flashdata('result', 'Your new passwords do not match');}
			}else{$this->session->set_flashdata('result', 'Your new password is not long enough');}
		}
	}

	function checkfname($fname){
		if($fname != ""){
			$fname = strtolower($fname);
			$fname = $this->encrypt->encode($fname);
			$userid = $_SESSION['userid'];
			$this->db->query("UPDATE users SET first_name='$fname' WHERE id='$userid'");
		}
	}

	function checksname($sname){
		if($sname != ""){
			$sname = strtolower($sname);
			$sname = $this->encrypt->encode($sname);
			$userid = $_SESSION['userid'];
			$this->db->query("UPDATE users SET last_name='$sname' WHERE id='$userid'");
		}
	}

	function checkemail($email){
		if($email != ""){
			$email = $this->encrypt->encode($email);
			$userid = $_SESSION['userid'];
			$this->db->query("UPDATE users SET email='$email' WHERE id='$userid'");
		}
	}

	function checklocation($location){
		if($location != ""){
			$location = strtolower($location);
			$userid = $_SESSION['userid'];
			$this->db->query("UPDATE users SET location='$location' WHERE id='$userid'");
		}
	}


}
	function makechanges(){
// set up autoloader
require ('vendor\autoload.php');

// configure database
$dsn = 'mysql:dbname=alliwant_staging;host=localhost';
$u = 'alliwant_josh';
$p = 'aiwtc8159login';
Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
  new PDO($dsn, $u, $p));

if (isset($_POST['submit'])) {

  try {
    $id = strip_tags($_POST['id']);    
    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserById($id);    
    $user->email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $user->first_name = strip_tags($_POST['first_name']);
    $user->last_name = strip_tags($_POST['last_name']);
    $user->password = strip_tags($_POST['password']);
    
    if ($user->save()) {
      echo 'User successfully updated.';
      exit;
    } else {
      throw new Exception('User could not be updated.');
    }
  } catch (Exception $e) {
    echo 'User could not be created.';
    exit;
  }

} else if (isset($_GET['id'])) {

  try {
    $id = strip_tags($_GET['id']);    
    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserById($id);
    $userArr = $user->toArray();
  } catch (Exception $e) {
    echo 'User could not be found.';
    exit;
  }
 }
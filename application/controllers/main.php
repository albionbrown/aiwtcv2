<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Main extends CI_Controller {

	
	public function index(){
		if(isset($_SESSION['userid'])){
			
			$data = array(
				'title' => 'Home | All I Want This Christmas',
				'main_content' => $this->load->view('view_dashboard', '', true)
			);

			$this->parser->parse('admintemplate', $data);
		}else{
		
			$data = array(
				'title' => 'Log In | All I Want This Christmas'
			);

			$this->parser->parse('logintemplate', $data);
		}
	}

	public function my_wishlist(){
		if(!isset($_SESSION['userid'])){
			header('Location: /index');
		}else{
			$data = array(
				'title' => 'My Wishlist | All I Want This Christmas',
	            'main_content' => $this->load->view('view_wishlist', '', true)
			);

			$this->parser->parse('admintemplate', $data);
		}
	}

	public function groups(){
		if(!isset($_SESSION['userid'])){
			header('Location: /index');
		}else{
			$data = array(
				'title' => 'Groups | All I Want This Christmas',
				'main_content' => $this->load->view('view_groups', '', true)
				);

			$this->parser->parse('admintemplate', $data);
		}
	}

	public function gifts(){
		if(!isset($_SESSION['userid'])){
			header('Location: /log_in');
		}else{
			$data = array(
				'title' => 'Gifts | All I Want This Christmas',
	            'main_content' => $this->load->view('view_gifts', '', true)
			);

			$this->parser->parse('admintemplate', $data);
		}
	}

	public function user(){
		if(!isset($_SESSION['userid'])){
			header('Location: /index');
		}else{
			$useridofrow = $this->session->flashdata('useridofrow');
			$query = $this->db->query("SELECT * FROM users WHERE id='$useridofrow'");
			foreach($query->result_array() as $row){
				$name = $row['fname']." ".$row['sname'];
			}

			$data = array(
				'title' => 'All I Want This Christmas',
	            'main_content' => $this->load->view('view_user','', true),
	            
			);

			$this->parser->parse('admintemplate', $data);
		}
	}

	public function profile(){
		if(!isset($_SESSION['userid'])){
			header('Location: /index');
		}else{
			$useridofrow = $this->session->flashdata('useridofrow');
			$query = $this->db->query("SELECT * FROM users WHERE id='$useridofrow'");
			foreach($query->result_array() as $row){
				$name = $row['fname']." ".$row['sname'];
			}

			$data = array(
				'title' => 'Profile | All I Want This Christmas',
	            'main_content' => $this->load->view('view_profile','', true),
	            
			);

			$this->parser->parse('admintemplate', $data);
		}
	}

	public function login()
	{
		$data = array(
			'title' => 'Log In | All I Want This Christmas',
			'loginboxes' => $this->load->view('login', '', true)
			);

		$this->parser->parse('logintemplate', $data);
	}

	public function search_model(){
		$searchentry = $_POST['searchentry'];
		$this->load->model('Search');
		$this->Search->search_main($searchentry);
	}

	public function search(){

		if(!isset($_SESSION['userid'])){
			header('Location: /log_in');
		}else{
			$data = array(
				'title' => 'Search | All I Want This Christmas',
	            'main_content' => $this->load->view('view_search', '', true)
			);

			$this->parser->parse('admintemplate', $data);
		}
	}

	public function logout()
	{
		unset($_SESSION['userid']);
		// set up autoloader
		require ('vendor\autoload.php');

		// configure database
		$dsn      = 'mysql:dbname=aiwtcappdata;host=localhost';
		$u = 'root';
		$p = '';
		Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
		  new PDO($dsn, $u, $p));

		// log user out
		Cartalyst\Sentry\Facades\Native\Sentry::logout();
		header('location: index');
	}

	public function verify_login()
	{
		// set up autoloader
		require ('/vendor/autoload.php');

		// configure database
		 $dsn = 'mysql:dbname=aiwtcappdata;host=localhost';
		 $u = 'root';
		 $p = '';
		Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
		  new PDO($dsn, $u, $p));

		// check for form submission
		if (isset($_POST['submit'])) {
		  try {
		    // validate input
		    $username = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		    $password = strip_tags(trim($_POST['password']));
		    
		    // set login credentials
		    $credentials = array(
		      'email'    => $username,
		      'password' => $password
		    );

		    // authenticate
		    $currentUser = Cartalyst\Sentry\Facades\Native\Sentry::authenticate($credentials, false);
		    // check if user logged in
			if (Cartalyst\Sentry\Facades\Native\Sentry::check()) {
			  $currentUser = Cartalyst\Sentry\Facades\Native\Sentry::getUser();
			  $_SESSION['userid'] = $currentUser['id'];
			}
		  } catch (Exception $e) {
				$this->session->set_flashdata('log_errors', 'Invalid email/password. Please try again.');
		  }
		}
		header('location: /index');
	}

	public function register() {

		if (isset($_POST['submit'])) {
			  // set up autoloader
			  require ('/vendor/autoload.php');

			  // configure database
			  $dsn      = 'mysql:dbname=aiwtcappdata;host=localhost';
			  $u = 'root';
			  $p = '';
			  Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
			    new PDO($dsn, $u, $p));
			  
			  // validate input and create user record
			  // send activation code by email to user
			  try {
			    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
			    $fname = strip_tags($_POST['firstname']);
			    $lname = strip_tags($_POST['surname']);
			    $password = strip_tags($_POST['password']);
			    $cpassword = strip_tags($_POST['confirm']);
			    $location = strip_tags($_POST['location']);

			    unset($errors);
				$errors = array();

				$check = $this->login->dblookupemail($email);
				if($check){
					array_push($errors, "This email has already been registered");
				}

				$check = $this->login->check_email($email);
				if(!$check){
					array_push($errors, "Invalid email address");
				}

				$check = $this->login->pwdlength($password);
				if(!$check){
					array_push($errors, "Your password is not long enough");
				}else{
					$check = $this->login->pwdmatch($password, $cpassword);
					if(!$check){
						array_push($errors, "Your passwords do not match");
					}
				}


				$check = $this->login->namecheck($fname, $lname);
				if(!$check){
					array_push($errors, "Please enter your first name and surname");
				}

			    $user = Cartalyst\Sentry\Facades\Native\Sentry::createUser(array(
			        'email'    => $email,
			        'password' => $password,
			        'first_name' => $fname,
			        'last_name' => $lname,
			        'activated' => true
			    ));
 
			    header('Location: /index');
			    exit;
			  } catch (Exception $e) {
			  	header('Location: /index');
			    exit;
			  }
			}
		
		header('Location: /index');

	}

	public function pwd_recover(){
		if (isset($_POST['submit'])) {
		  // set up autoloader
		  require ('/vendor/autoload.php');

		  // configure database
		   $dsn = 'mysql:dbname=aiwtcappdata;host=localhost';
			$u = 'root';
			$p = '';
		  Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
		    new PDO($dsn, $u, $p));
		  
		  // validate input and find user record
		  // send reset code by email to user
		  try {
		    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserByCredentials(array(
		      'email' => $email
		    ));
		    
		    $code = $user->getResetPasswordCode();

		    $subject = 'Your password reset code';
		    echo $message = 'Code: ' . $code;
		    $headers = 'From: no-reply@alliwantthischristmas.co.uk';
		    if (!mail($email, $subject, $message, $headers)) {
		      throw new Exception('Email could not be sent.');
		    }    
		    
		    exit;
		  } catch (Exception $e) {

		    exit;
		  }
		}

		//header('Location: /index');
	}

	public function pwd_recover_confirm(){
		if (isset($_POST['code']) && $_POST['email']) {

		  // set up autoloader
		  require ('/vendor/autoload.php');

		  // configure database
		   $dsn = 'mysql:dbname=aiwtcappdata;host=localhost';
			$u = 'root';
			$p = '';
		  Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
		    new PDO($dsn, $u, $p));

		  // find user by email address
		  // attempt password reset
		  try {
		    $code = strip_tags($_POST['code']);
		    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		    $password = htmlentities($_POST['password']);
		    $password_repeat = htmlentities($_POST['password-repeat']);
		    if ($password != $password_repeat) {
		      throw new Exception ('Passwords do not match.');
		    }
		    
		    $user = Cartalyst\Sentry\Facades\Native\Sentry::findUserByCredentials(array(
		      'email' => $email
		    ));
		    
		    if ($user->checkResetPasswordCode($code)) {
		      if ($user->attemptResetPassword($code, $password)) {
		        echo 'Password successfully reset.';
		        exit;
		      } else {
		        throw new Exception('User password could not be reset.');  
		      }
		    } else {
		      throw new Exception('User password could not be reset.');  
		    }
		  } catch (Exception $e) {

		    exit;
		  }
		}

		header('Location: /index');
	}

	public function invite(){
		$arrayrow = $_POST['groups'];
		$groupids = $this->session->flashdata('groupids');
		$groupnames = $this->session->flashdata('groupnames');
		$groupids = unserialize($groupids);
		$groupnames = unserialize($groupnames);
		$userid = $_SESSION['userid'];
		$groupid = $groupids[$arrayrow];
		$useridofrow = $_POST['useridofrow'];

		$this->load->model('groups');
		$check = $this->groups->checkdbforuser($useridofrow, $groupid);
		if($check == FALSE){
			$query = $this->db->query("INSERT INTO groupinvites (invitefromuserid, invitetouserid, groupid) VALUES($userid, $useridofrow, $groupid)");
			$this->session->set_flashdata('messages', 'Invite sent!');
			header('location: /index');
		}else{
			$this->session->set_flashdata('messages', 'The user you are trying to invite is already in that group');
			header('location: /index');
		}
	}

	public function makeitem(){
		$itemname = $_POST['title'];
		$itemdesc = $_POST['description'];
		$itemlink = $_POST['link'];
		
		if(strlen($itemname) == 0){
			$this->session->set_flashdata('error', 'Remember a name for the gift!');
		}else{
			$userid = $_SESSION['userid'];
			$bought = "no";
			$itemname = strtolower($itemname);
			$itemdesc = strtolower($itemdesc);
			$this->db->query("INSERT INTO items (userid,itemname,itemdescription,itemlink,itembought) VALUES ('$userid','$itemname','$itemdesc','$itemlink','$bought')");
		}
		header('Location: /my_wishlist');
	}

	public function create_group(){
		$groupname = $_POST['groupname'];
		$this->load->model('groups');
		$check = $this->groups->checkname($groupname);
		if($check == FALSE){
			$this->session->set_flashdata('result','Please enter a group name');
		}else{
			$check = $this->groups->checkdbforgroup($groupname);
			if($check == TRUE){
				$this->session->set_flashdata('result','You already belong in a group with that name');
			}else{
				$this->groups->transferdata($groupname);
			}
		}
		header('Location: /groups');
	}

	public function deleteitem(){
		$itemid = $_GET['itemid'];
		$this->load->model('items');
		$this->items->delete($itemid);
		header('location: /my_wishlist');
	}

	public function deletegroup(){
		$groupid = $_GET['groupid'];
		$this->load->model('groups');
		$this->groups->deletefromgroups($groupid);
	}

	public function leavegroup(){
		$groupid = $_GET['groupid'];
		$this->load->model('groups');
		$this->groups->leavegroup($groupid);
	}

	public function getitem(){
		$itemid = base64_decode($_GET['itemid']);
		$this->load->model('items');
		$this->items->getitem($itemid);
	}

	public function boughtitem(){
		$itemid = $_GET['itemid'];
		$this->load->model('items');
		$this->items->itembought($itemid);
	}

	public function acceptinvite(){
		$inviteid = base64_decode($_GET['inviteid']);
		$this->load->model('Search');
		$this->Search->acceptinvite($inviteid);
	}

	public function declineinvite(){
		$inviteid = base64_decode($_GET['inviteid']);
		$this->load->model('Search');
		$this->Search->declineinvite($inviteid);
	}


	public function profile_changes(){
		$pwd = $_POST['pwd'];
		$newpwd = $_POST['newpwd'];
		$cnewpwd = $_POST['cnewpwd'];
		$fname = $_POST['fname'];
		$sname = $_POST['sname'];
		$email = $_POST['email'];
		$location = $_POST['location'];
		$this->load->model('profile');
		$pwdcheck = $this->profile->pwdvalid($pwd);
		if($pwdcheck == TRUE){
			$this->profile->profile_controller($fname, $sname, $email, $location, $newpwd, $cnewpwd);
		}else{
			$this->session->set_flashdata('result', 'Please enter your current password to save changes');
			header('Location: main/profile');
		}
	}
}


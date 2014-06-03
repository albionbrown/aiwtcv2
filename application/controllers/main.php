<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Main extends CI_Controller {

	
	public function index(){
		if(isset($_SESSION['userid'])){
			
			$data = array(
				'title' => 'Home | All I Want This Christmas',
				'main_content' => $this->load->view('home', '', true)
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
			$query = $this->db->query("SELECT * FROM users WHERE userid='$useridofrow'");
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
			$query = $this->db->query("SELECT * FROM users WHERE userid='$useridofrow'");
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

	public function logout()
	{
		unset($_SESSION['userid']);
		header('location: index');
	}

	public function verify_login()
	{
		$email = $_POST['email'];
		$pwd = $_POST['password'];
		$check = $this->login->checkdb($email, $pwd);
		header("location: /index");
	}

	public function register() {

		$fname    = $_POST['firstname'];
		$sname    = $_POST['surname'];
		$email    = $_POST['email'];
		$location = $_POST['location'];
		$pwd      = $_POST['password'];
		$cpwd     = $_POST['confirm'];

		unset($errors);
		$errors = array();

		$check = $this->login->dblookupemail($email);
		if($check == TRUE){
			array_push($errors, "This email has already been registered");
		}

		$check = $this->login->check_email($email);
		if($check == FALSE){
			array_push($errors, "Invalid email address");
		}

		$check = $this->login->pwdlength($pwd);
		if($check == FALSE){
			array_push($errors, "Your password is not long enough");
		}elseif($check == TRUE){
			$check = $this->login->pwdmatch($pwd, $cpwd);
			if($check == FALSE){
				array_push($errors, "Your passwords do not match");
			}
		}


		$check = $this->login->namecheck($fname, $sname);
		if($check == FALSE){
			array_push($errors, "Please enter your first name and surname");
		}

		$errors = serialize($errors);
		$this->session->set_flashdata('reg_errors', $errors);
		header("Location: /index");

	}

	public function model_search(){
		$entry = $_POST['search_box'];
		$this->load->model('Search');
		$this->Search->search_main($entry);
	}

	public function invite(){
		$arrayrow=$_POST['groups'];
		$userid = $_SESSION['userid'];
		$options = array();
		$query = $this->db->query("SELECT groupid FROM userstogroups WHERE userid='$userid'");
		foreach($query->result_array() as $row){
			$groupid = $row['groupid'];
			$query = $this->db->query("SELECT * FROM groups WHERE groupid='$groupid'");
			foreach($query->result_array() as $row){
				$groupname = $row['groupname'];
				array_push($options,$groupname);
			}
		}

		$groupname = $options[$arrayrow];
		//run query to get all group ids from group that have session user id then run query below
		$userid = $_SESSION['userid'];
		$invitetouserid = $this->session->flashdata('useridofrow');
		$query = $this->db->query("SELECT groupid FROM userstogroups WHERE userid='$userid'");
		foreach($query->result_array() as $row){
			$groupid = $row['groupid'];
			$query = $this->db->query("SELECT * FROM groups WHERE groupname='$groupname' AND groupid='$groupid'");
			foreach ($query->result_array() as $row){
				$this->load->model('search');
				$check = $this->search->checkifuseringroup($invitetouserid, $groupid);
				$check2 = $this->search->checkifuserinvited($invitetouserid, $groupid);
				if($check == FALSE && $check2 == FALSE){
					//$this->search->newuseringroup($invitetouserid,$groupid);
					$this->search->sendinvite($invitetouserid,$groupid);
					//echo $invitetouserid;
				}elseif($check == TRUE || $check2 == TRUE){
					$this->session->set_flashdata('error', 'This user has already been invited to the group');
					header('Location: ../site/search');
				}
			}
		}
	}

	//WRITE FUNCTION WHERE IF LOGGED IN USER IS NOT IN ANY GROUPS... ECHO NOT IN ANY GROUPS
	//DO SAME FOR ITEMS

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
		echo $itemid = $_GET['itemid'];
		$this->load->model('items');
		$this->items->getitem($itemid);
	}

	public function boughtitem(){
		$itemid = $_GET['itemid'];
		$this->load->model('items');
		$this->items->itembought($itemid);
	}

	public function accept(){
		$inviteid = $_GET['inviteid'];
		$this->load->model('Search');
		$this->Search->acceptinvite($inviteid);
	}

	public function decline(){
		$inviteid = $_GET['inviteid'];
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


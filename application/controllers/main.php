<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Main extends CI_Controller {

	
	public function index()
	{
		if(isset($_SESSION['userid'])){
			
			$data = array(
				'title' => 'Home | All I Want This Christmas',
				'main_content' => $this->load->view('home', '', true)
			);

			$this->parser->parse('admintemplate', $data);
		}else{

			$data = array(
				'title' => 'Log In | All I Want This Christmas',
				'loginboxes' => $this->load->view('login', '', true)
			);

			$this->parser->parse('logintemplate', $data);
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
		$this->load->model('login');
		$check = $this->login->checkdb($email, $pwd);
		if($check == TRUE){
			header('location: /home');
		}else{
			$this->session->set_flashdata('result', 'Incorrect email/password. Please try again.');
			header('location: /login');
		}
	}
}


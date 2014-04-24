<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	
	public function index()
	{
		if(isset($_SESSION['userid'])){
			$data = array(
				'title' => 'Home | All I Want This Christmas'
			);

			$this->parser->parse('admintemplate', $data);
			$this->load->view('admintemplate');
		}else{
			header('location: /login');
		}
	}

	public function login()
	{
		$data = array(
			'title' => 'Log In | All I Want This Christmas'
			);

		$this->parser->parse('logintemplate', $data);
	}
}

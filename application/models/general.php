<?php

	class General extends CI_Model{

		function getemail(){
			$userid = $_SESSION['userid'];
			$query = $this->db->query("SELECT email FROM users WHERE userid='$userid'");
			foreach($query->result_array() as $row){
				$email = $row['email'];                        
			}

			return $email;
		}
	}
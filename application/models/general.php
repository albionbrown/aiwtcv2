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

		function getusername(){
			$userid = $_SESSION['userid'];
		    $query = $this->db->query("SELECT * FROM users WHERE userid='$userid'");
		    foreach($query->result_array() as $row){
		        $fname = $row['fname'];
		        $sname = $row['sname'];
		        $username = ucwords($fname." ".$sname);
		    }
		    
		    return $username;
		}
	}
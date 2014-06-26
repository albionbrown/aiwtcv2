<?php

	class general extends CI_Model{

		function getemail(){
			$userid = $_SESSION['userid'];
			$query = $this->db->query("SELECT email FROM users WHERE id='$userid'");
			foreach($query->result_array() as $row){
				$email = $row['email'];                        
			}

			return $email;
		}

		function getusername(){
			$userid = $_SESSION['userid'];
		    $query = $this->db->query("SELECT * FROM users WHERE id='$userid'");
		    foreach($query->result_array() as $row){
		        $fname = $row['first_name'];
		        $sname = $row['last_name'];
		        $username = ucwords($fname." ".$sname);
		    }
		    
		    return $username;
		}
	}
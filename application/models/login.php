<?php 
	class Login extends CI_Model{

		function checkdb($email, $password){

			$this->load->database();
			
			$key = 'sdgwe4tgwgsregase';
			$match = FALSE;
			$encodedemail = $this->encrypt->encode($email, $key);
			$encodedpwd = $this->encrypt->encode($password, $key);
			$query = $this->db->query("SELECT * FROM users");
			foreach($query->result_array() as $row){
				$emailfromdb = $row['email'];
				$pwdfromdb = $row['pwd'];
				$decodedemail = $this->encrypt->decode($emailfromdb, $key);
				$decodedpwd = $this->encrypt->decode($pwdfromdb, $key);
				if($decodedemail == $email && $decodedpwd == $password){
					$query = $this->db->query("SELECT email AND pwd FROM users WHERE email='$emailfromdb' AND pwd='$pwdfromdb'");
					if($query->num_rows() == 1){
						$match = TRUE;
						$_SESSION['userid'] = $row['userid'];
					}else{
						$match = false;
					}
				}
			}
			return $match;
		}

		function namecheck($fname, $sname){
			if($fname == "" || $sname == ""){
				return FALSE;
			}else{
				return TRUE;
			}
		}

		function check_email($email){
			$char = "@";
			$check = strpos($email, $char);
			if($check){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		function pwdlength($pwd){
			if(strlen($pwd) < 5){
				return FALSE;
			}else{
				return TRUE;
			}
		}

		function pwdmatch($pwd, $cpwd){
			if($pwd === $cpwd){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		function dblookupemail($email){

			$key = 'sdgwe4tgwgsregase';
			$match = FALSE;
			$query = $this->db->query("SELECT email FROM users");
			foreach($query->result() as $row){
				$emailfromdb = $row->email;
				$decodedemail = $this->encrypt->decode($emailfromdb, $key);
				if($decodedemail == $email){
					$match = TRUE;
				}
				return $match;
			}	
		}

		function transfer_details($fname, $sname, $email, $pwd, $location){
			$this->load->library('encrypt');
			$fname = strtolower($fname);
			$sname = strtolower($sname);
			$location = strtolower($location);
			$key = 'sdgwe4tgwgsregase';
			$fname = $this->encrypt->encode($fname,$key);
			$sname = $this->encrypt->encode($sname,$key);
			$pwd = $this->encrypt->encode($pwd,$key);
			$email = $this->encrypt->encode($email, $key);
			$query = $this->db->query("INSERT INTO users (fname, sname, email, pwd, location) VALUES ('$fname', '$sname', '$email', '$pwd', '$location')");
			$this->email->from('alliwantthischristmas@gmail.co.uk', 'All I Want This Christmas');
			$this->email->to('josh@alphawavemedia.co.uk'); 
			$this->email->subject('Email Test');
			$this->email->message('Testing the email class.');	
			$this->email->send();
			if(!$this->email->send()){
				echo "fail";
			}else{
				//$query = $this->db->query("INSERT INTO users (fname, sname, email, pwd, location) VALUES ('$fname', '$sname', '$email', '$pwd', '$location')");
			}
		}

	}

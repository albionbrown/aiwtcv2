<?php 

	class groups extends CI_Model{

		function transferdata($groupname){
			$userid = $_SESSION['userid'];
			$groupname = strtolower($groupname);
			$query = $this->db->query("INSERT INTO groups (name, adminuserid) VALUES ('$groupname', '$userid')");
			$groupid = $this->getgroupid($groupname);
			$query = $this->db->query("INSERT INTO userstogroups (userid,groupid) VALUES ('$userid','$groupid')");
		}

		function getgroupid($groupname){
			$userid = $_SESSION['userid'];
			$query = $this->db->query("SELECT id FROM groups WHERE name='$groupname' AND adminuserid='$userid'");
			foreach ($query->result_array() as $row){
				$groupid = $row['id'];
			}
			return $groupid;
		}

		function deletefromgroups($groupid){
			$query = $this->db->query("DELETE FROM groups WHERE id='$groupid'");
			$query = $this->db->query("DELETE FROM userstogroups WHERE groupid='$groupid'");
			header('Location: /groups');
		}

		function leavegroup($groupid){
			$userid = $_SESSION['userid'];
			$query = $this->db->query("DELETE FROM userstogroups WHERE groupid='$groupid' AND userid='$userid'");
			header('Location: /groups');
		}

		function checkdbforgroup($groupname){
			$query = $this->db->query("SELECT * FROM groups WHERE name='$groupname'");
			if($query->num_rows() > 0){
					foreach($query->result_array() as $row) {
					$groupid = $row['id'];
					$userid = $_SESSION['userid'];
					$query = $this->db->query("SELECT * FROM userstogroups WHERE groupid='$groupid' AND userid='$userid'");
					//$useridingroup = $row['useridingroup'];
					foreach ($query->result_array() as $row){
						if($useridingroup = $_SESSION['userid']){
							return TRUE;
						}
					}
				}
			}
		}

		function checkname($groupname){
			if(strlen($groupname) < 1){return FALSE;}else{return TRUE;}
		}

		function checkdbforuser($useridofrow, $groupid){
			$match = FALSE;
			$query = $this->db->query("SELECT * FROM userstogroups WHERE userid='$useridofrow' AND groupid='$groupid'");
			if($query->num_rows() > 0){
				$match = TRUE;
			}
			return $match;
		}

}
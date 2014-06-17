<?php 
	class Search extends CI_Model{

		function search_main($entry){
			$type = $this->searchstring($entry);
			if($type === 1){
				$entryarray = array();
				$entryarray['email'] = $entry;
				$entryarray['type'] = 'email';
				$entryarray = serialize($entryarray);
				header('location: /search?q=' . $entryarray);
			}elseif($type === 0){
				$fname = strstr($entry," ",true);
				$len = strlen($fname) + 1;
				$entrylen = strlen($entry);
				$sname = substr($entry, $len, $entrylen);
				$entryarray = array();
				$entryarray['fname'] = $fname;
				$entryarray['sname'] = $sname;
				$entryarray['type'] = 'name';
				$entryarray = serialize($entryarray);
				header('location: /search?q=' . $entryarray);
			}
		}	
	
		function searchstring($entry){
			$char = "@";
			$check = strpos($entry, $char);
			if($check){
				return 1;
			}else{
				return 0;
			}
		}

		function newuseringroup($invitetouserid,$groupid){
			$this->db->query("INSERT INTO userstogroups (userid, groupid) VALUES ($invitetouserid,$groupid)");
			header('Location: /search');
		}

		function checkifuseringroup($invitetouserid, $groupid){
			$query = $this->db->query("SELECT * FROM userstogroups WHERE groupid='$groupid' AND userid='$invitetouserid'");
			if($query->num_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		function checkifuserinvited($invitetouserid, $groupid){
			$query = $this->db->query("SELECT * FROM groupinvites WHERE groupid='$groupid' AND invitetouserid='$invitetouserid'");
			if($query->num_rows() > 0){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		function sendinvite($invitetouserid, $groupid){
			$invitefromuserid = $_SESSION['userid'];
			$query = $this->db->query("INSERT INTO groupinvites (invitefromuserid, invitetouserid, groupid) VALUES ('$invitefromuserid', '$invitetouserid','$groupid')");
			header('Location: /search?invite=sent');
		}

		function acceptinvite($inviteid){
			$query = $this->db->query("SELECT * FROM groupinvites WHERE inviteid='$inviteid'");
			foreach ($query->result_array() as $row){
				$groupid = $row['groupid'];
				$userid = $row['invitetouserid'];
				$this->db->query("INSERT INTO userstogroups (userid, groupid) VALUES ('$userid', '$groupid')");
			}
			$this->db->query("DELETE FROM groupinvites WHERE inviteid='$inviteid'");
			header('Location: /groups');
		}

		function declineinvite($inviteid){
			//echo "hello";
			$this->db->query("DELETE FROM groupinvites WHERE inviteid='$inviteid'");
			header('Location: /home');
		}
}

		

<?php 
	class items extends CI_Model{

		public function makeitem($itemname,$itemdesc,$itemlink){
			$userid = $_SESSION['userid'];
			$bought = "no";
			$itemname = strtolower($itemname);
			$itemdesc = strtolower($itemdesc);
			$this->db->query("INSERT INTO items (userid,itemname,itemdescription,itemlink,itembought) VALUES ('$userid','$itemname','$itemdesc','$itemlink','$bought')");
		}
		public function delete($itemid){
			$query = $this->db->query("DELETE FROM items WHERE itemid='$itemid'");
			header('Location: main/my_wishlist');
		}

		public function getitem($itemid){
			$userid = $_SESSION['userid'];
			$query = $this->db->query("UPDATE items SET useridgetting='$userid' WHERE itemid='$itemid'");
			header('Location: /gifts');
		}

		public function itembought($itemid){
			$query = $this->db->query("UPDATE items SET itembought=1 WHERE itemid='$itemid'");
			header('Location: /gifts');
		}

		public function checkdbforitem($itemname){
			$userid = $_SESSION['userid'];
			$query = $this->db->query("SELECT * FROM items WHERE itemname='$itemname' AND userid='$userid'");
			if($query->num_rows() > 0){
				$this->session->set_flashdata('error', 'You have already listed this item');
				return TRUE;
			}
		}
		
		public function revertitem($itemid){
		$query = $this->db->query("UPDATE items SET useridgetting=0 WHERE itemid='$itemid'");
		header('Location: /gifts');
	}

}
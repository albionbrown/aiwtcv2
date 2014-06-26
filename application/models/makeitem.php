<?php

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
<?php
$useridofrow= $_GET['uid'];
if($useridofrow == $_SESSION['userid']){Header('Location: ../site/my_wishlist');}else{
	$query=$this->db->query("SELECT * FROM users WHERE userid='$useridofrow'");
	foreach($query->result_array() as $row){
		$name = $this->encrypt->decode($row['fname'])." ".$this->encrypt->decode($row['sname']);
	}
}
?>

<head><title>{title}</title></head>

<h1><?php echo ucwords($name); ?>'s wishlist</h1>

<?php

$query = $this->db->query("SELECT * FROM items WHERE userid ='$useridofrow'");
if($query->num_rows() > 0){
	foreach($query->result_array() as $row){
		?><div class="result-box short"><h2><?php
		echo $row['itemname'];
		$itemid = $row['itemid'];
		$useridgetting = $row['useridgetting'];
		if($useridgetting == 0){
		echo form_open('main/getitem?itemid='.$itemid);

		$button_data = array(
			'name' => 'get-item-button',
			'class' => 'invite-background',
			'value' => 'Getting it!'
		);

		echo form_submit($button_data);

		echo form_close();
	}else{}

		?></h2></div><?php
	}
}else{
	?><h2><?php echo ucwords($name); ?> hasn't got anything on their list yet! :(</h2><?php
}
?>
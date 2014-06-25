<?php
$useridofrow = base64_decode($_GET['uid']);
if($useridofrow == $_SESSION['userid']){Header('Location: /my_wishlist');}else{
	$query=$this->db->query("SELECT * FROM users WHERE userid='$useridofrow'");
	foreach($query->result_array() as $row){
		$name = $row['fname'] . " " . $row['sname'];
	}
}
?>

<h1><?php echo strtoupper($name); ?>'S WISHLIST</h1>
<div id="user-wishlist-results">
<?php
$query = $this->db->query("SELECT * FROM items WHERE userid ='$useridofrow' AND useridgetting='0'");
if($query->num_rows() > 0){
	foreach($query->result_array() as $row){
		?><div class="content-box col-md-4 col-xs-12"><div class="content"><?php
		echo "<h2>" . ucwords($row['itemname']) . "</h2><br><p>" . $row['itemdescription'] . "<br>" . $row['itemlink'] . "</p>";
		$itemid = $row['itemid'];
		$useridgetting = $row['useridgetting'];
		if($useridgetting == 0){
		echo form_open('main/getitem?itemid='.base64_encode($itemid));

		$button_data = array(
			'name' => 'get-item-button',
			'class' => 'submit max-width',
			'value' => 'Getting it!'
		);

		echo form_submit($button_data);

		echo form_close();
	}else{}

		?></div></div><?php
	}
}else{
	?><h2><?php echo ucwords($name); ?> hasn't got anything on their list yet! :(</h2><?php
}
?>
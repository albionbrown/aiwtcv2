<?php if(!isset($_SESSION['userid'])){ ?><h2>Please log in to view your gifts</h2> <?php }else{

	echo "<h1>YOUR SHOPPING LIST</h1>";
	$userid = $_SESSION['userid'];

	$query = $this->db->query("SELECT * FROM items WHERE useridgetting='$userid'");
	if($query->num_rows() > 0){foreach($query->result_array() as $row){
		$userid = $row['userid'];
		$itemname = $row['itemname'];
		$itemid = $row['itemid'];
		$bought = $row['itembought'];
		$query = $this->db->query("SELECT * FROM users WHERE userid='$userid'");
		foreach($query->result_array() as $row){$username = $this->encrypt->decode($row['fname'])." ".$this->encrypt->decode($row['sname']);}
		?><div class="result-box"><h2><?php echo $itemname." for ".$username;

		if($bought=="no"){

			echo form_open('site/boughtitem?itemid='.$itemid);

			$button_data = array(
				'name' => 'bought-item',
				'class' => 'invite-background gifts',
				'value' => "Have you bought this gift?",
			);

			echo form_submit($button_data);

			echo form_close();

			}else{

				echo "<p class='got-item'>I have bought this item!</p>";

			}

		

		?></h2></div><?php
	}
}else{
	echo "<h2>You are not getting any gifts for anybody yet! :(</h2>";
}

}
?>
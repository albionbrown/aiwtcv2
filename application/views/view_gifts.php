<?php

	echo "<h1>YOUR SHOPPING LIST</h1>";
	$userid = $_SESSION['userid'];

	$query = $this->db->query("SELECT * FROM items WHERE useridgetting='$userid'");
	if($query->num_rows() > 0){foreach($query->result_array() as $row){
		$userid = $row['userid'];
		$itemname = $row['itemname'];
		$itemid = $row['itemid'];
		$bought = $row['itembought'];
		$query = $this->db->query("SELECT * FROM users WHERE id='$userid'");
		foreach($query->result_array() as $row){
			$username = ucfirst($row['first_name']." ".$row['last_name']);
		}
		?><div class="content-box col-md-4 col-xs-12"><div class="content clearfix"><?php echo "<h2>".ucwords($itemname)." for ".$username."</h2>";

		if($bought==0){

			echo form_open('main/boughtitem?itemid='.base64_encode($itemid));

			$button_data = array(
				'name' => 'bought-item',
				'class' => 'submit col-lg-6 col-md-12 col-sm-6 col-xs-12',
				'value' => "I have got this!",
			);

			echo form_submit($button_data);

			echo form_close();
			
			echo form_open('main/revertitem?itemid='.base64_encode($itemid));

			$button_data = array(
				'name' => 'revert-item',
				'class' => 'submit col-lg-6 col-md-12 col-sm-6 col-xs-12',
				'value' => "Drop this gift",
			);

			echo form_submit($button_data);

			echo form_close();

			}else{

				echo "<p class='got-item'>Present bought!</p>";

			}

		

		?></div></div><?php
	}
}else{
	echo "<p>You are not getting any gifts for anybody yet! :(</p>";
}


?>
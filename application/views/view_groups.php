<script type="text/javascript">
	
	function delgroup(groupid){

		var r=confirm("Do you really want to delete this group?");
		if (r==true){
		  window.location.href = "/main/deletegroup?groupid="+groupid;
		  }else{
		  
		  }
		}

		function leavegroup(groupid){
			var r=confirm("Do you really want to leave this group?");
			if (r==true){
			  window.location.href = "/main/leavegroup?groupid="+groupid;
			  }else{
			  
			  }
		}
</script>

<?php if(!isset($_SESSION['userid'])){ ?><h2>Please log in to create a group</h2> <?php }else{

$userid=$_SESSION['userid'];
$query=$this->db->query("SELECT * FROM users WHERE userid='$userid'");
foreach($query->result_array() as $row){
	$fname = $row['fname'];
	$sname = $row['sname'];
	echo "<h1>YOUR GROUPS</h1>";
}

$attributes = array('class' => 'form clearfix', 'id' => 'group_create_group_form');
echo form_open('main/create_group', $attributes);

?>

<p>Create a group by entering a name for your group in the box below and click create! All the groups you are a member of are listed below.</p><div id="form"><?php

$input_data = array(
	'name'		=> 'groupname',
	'class'		=> 'text-input col-md-9 col-xs-12',
	'placeholder' => 'Group name',
);

echo form_input($input_data);

$create_data = array(
	'name'		=> 'create-group',
	'class'		=> 'submit col-md-3 col-xs-12',
	'value'		=> 'create',
);

echo form_submit($create_data);
echo form_close();
?>

</div><?php

<<<<<<< Updated upstream
echo "<p>".@$this->session->flashdata('result')."</p>";
?><div class="row"><?php
=======
echo "<p>".@$this->session->flashdata('errors')."</p>";

>>>>>>> Stashed changes
$userid = $_SESSION['userid'];
/* Gets all group id's related to user */
$query = $this->db->query("SELECT groupid FROM userstogroups WHERE userid='$userid'");
$count = 0;
foreach($query->result_array() as $row){ 

	/* Gets number of members in the group */
	$groupid = $row['groupid'];
<<<<<<< Updated upstream
	$query = $this->db->query("SELECT userid FROM userstogroups WHERE groupid='$groupid'");
	$no_members = $query->num_rows();
	/* Gets information about group */
	$query = $this->db->query("SELECT * FROM groups WHERE groupid='$groupid'");

=======
	$query = $this->db->query("SELECT * FROM groups WHERE id='$groupid'");
	
>>>>>>> Stashed changes
	/* Prints each group header */
	foreach($query->result_array() as $row){
	if($count == 0){
		?><div class="row"><?php }
		$count++;
	?>
		<div class="content-box col-md-4"><div class="content">
		<?php echo "<h2>" . $groupname = ucwords($row['groupname']) . "</h2>";
		$adminuserid = $row['adminuserid'];
		

		/* Gets all users in a group */
		foreach($query->result_array() as $row){
			$query = $this->db->query("SELECT userid FROM userstogroups WHERE groupid='$groupid'");

			/* Gets each user's information */
			foreach($query->result_array() as $row){
				$userid = $row['userid'];
				/* Gets and dislpays each user in group */
				$query = $this->db->query("SELECT * FROM users WHERE userid='$userid'");
				$row = $query->row();
				$useridofrow = $row->userid;
				$membername = $row->fname." ".$row->sname;
				?><?php echo '<p><a href=/main/user?uid='.base64_encode($useridofrow).'>'. ucfirst($membername).'</a></p>';
				?><?php
			}
		}

		if($adminuserid == $_SESSION['userid']){ ?><input type="button" onClick='delgroup(<?php echo $groupid ?>)' style="margin-top:0px;" class="submit max-width" value="delete"/><?php }else{ ?>
			<input type="button" onClick='leavegroup(<?php echo $groupid ?>)' class="submit max-width" value="leave"/>
		<?php } ?>
		</div></div><?php
		if($count == 3){
			$count = 0;
			?></div><?php
		}
	}	
}

}?>


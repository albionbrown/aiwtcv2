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
echo form_open('main/create_group');

?>

<p>Create a group by entering a name for your group in the box below and click create! All the groups you are a member of are listed below.</p><div id="form"><?php

$input_data = array(
	'name'		=> 'groupname',
	'class'		=> 'input',
	'placeholder' => 'Group name',
);

echo form_input($input_data);

$create_data = array(
	'name'		=> 'create-group',
	'class'		=> 'submit',
	'value'		=> 'create',
);

echo form_submit($create_data);
echo form_close();
?>

</div><?php

echo "<p>".@$this->session->flashdata('result')."</p>";

$userid = $_SESSION['userid'];
/* Gets all group id's related to user */
$query = $this->db->query("SELECT groupid FROM userstogroups WHERE userid='$userid'");
foreach($query->result_array() as $row){ 

	/* Gets number of members in the group */
	$groupid = $row['groupid'];
	$query = $this->db->query("SELECT userid FROM userstogroups WHERE groupid='$groupid'");
	$no_members = $query->num_rows();
	/* Gets information about group */
	$query = $this->db->query("SELECT * FROM groups WHERE groupid='$groupid'");

	/* Prints each group header */
	foreach($query->result_array() as $row){ ?>
		<div class="result-row"><h2>
		<?php echo $groupname = ucwords($row['groupname']);
		$adminuserid = $row['adminuserid'];
		?>
		
		<?php if($row['adminuserid'] == $_SESSION['userid']){ ?><span style="float:right; margin-top: -3px;"><input type="button" onClick='delgroup(<?php echo $groupid ?>)' style="margin-top:0px;" class="invite-background" value="delete"/></span><?php }else{ ?>
			<span style="float:right; margin-top: 40px;"><input type="button" onClick='leavegroup(<?php echo $groupid ?>)' class="invite-background" value="leave"/></span>
			<?php } ?>
		</h2></div><?php

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
				?><div class="result-box capatalise short"><h2><?php echo '<a href=/main/user?uid='.$useridofrow.'>'.$membername.'</a>';
				?></h2></div><?php
			}
		}
	}	
}

}?>


<h1>YOUR DASHBOARD</h1>
<div class="dashboard-messages">
<?php echo $this->session->flashdata('messages'); ?>
</div>

<div id="group-invites-box" class="content-box col-md-3">
	<div class="content">

	<h2>Group Invites</h2>
	<?php 
	$userid = $_SESSION['userid'];
	$query = $this->db->query("SELECT * FROM groupinvites WHERE invitetouserid='$userid'");
	if($query->num_rows() > 0){
		foreach($query->result_array() as $row){
			$invitefrom = $row['invitefromuserid'];
			$groupid = $row['groupid'];
			$inviteid = base64_encode($row['inviteid']);
			$query = $this->db->query("SELECT name FROM groups WHERE id='$groupid'");
			foreach($query->result_array() as $row){
				$groupname = $row['name'];
			}
			$query = $this->db->query("SELECT first_name, last_name FROM users WHERE id='$invitefrom'");
			foreach($query->result_array() as $row){
				$name = $row['first_name'] . " " . $row['last_name'];
			}

			echo '<p>Invite from ' . ucfirst($name) . ' to join ' . ucfirst($groupname) . ' | <a href="/main/acceptinvite?inviteid=' . $inviteid . '">Accept</a> <a href="/main/declineinvite?inviteid=' . $inviteid . '">Ignore</a></p>';
		} 
	}else{
		echo "<p>You have no invites</p>";
	}
	?>
	</div>
</div>

<div id="present-tracking-box" class="content-box box col-md-4">
	<div class="content">
	<h2>Quick Shopping List</h2>
	<?php
		$userid = $_SESSION['userid'];
		$query = $this->db->query("SELECT * FROM items WHERE useridgetting='$userid' AND itembought='0'");
		if($query->num_rows() > 0){
			foreach($query->result_array() as $row){
				$itemname = $row['itemname'];
				$itemforuserid = base64_encode($row['userid']);
				$query = $this->db->query("SELECT * FROM users WHERE id='$itemforuserid'");
				foreach($query->result_array() as $row){
					$username = ucfirst($row['fname'] . " " . $row['sname']);
				}

				echo '<p>' . ucfirst($itemname) . ' for <a href="/user?uid=' . $itemforuserid . '">' . $username . '</a></p>';
			}
		}else{
			echo '<p>You are not getting any presents yet</p>';
		}
	?>
	</div>
</div>




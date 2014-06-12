<h1>YOUR DASHBOARD</h1>

<div class="content-box col-md-6">
	<div class="content">

	<h2>Group Invites</h2>
	<?php 
	$userid = $_SESSION['userid'];
	$query = $this->db->query("SELECT * FROM groupinvites WHERE invitetouserid='$userid'");
	if($query->num_rows() > 0){
		foreach($query->result_array() as $row){
			$invitefrom = $row['invitefromuserid'];
			$groupid = $row['groupid'];
			$inviteid = $this->encrypt->encode($row['inviteid']);
			$query = $this->db->query("SELECT groupname FROM groups WHERE groupid='$groupid'");
			foreach($query->result_array() as $row){
				$groupname = $row['groupname'];
			}
			$query = $this->db->query("SELECT fname, sname FROM users WHERE userid='$invitefrom'");
			foreach($query->result_array() as $row){
				$name = $row['fname'] . " " . $row['sname'];
			}

			echo "<p>Invite from " . ucfirst($name) . " to join " . ucfirst($groupname) . "</p>";
			echo '<a href="/main/acceptinvite?inviteid=' . $inviteid . '">Accept</a> <a href="/main/declineinvite?inviteid=' . $inviteid . '">Ignore</a>';
		} 
	}else{
		echo "<p>You have no group invites</p>";
	}
	?>
	</div>
</div>




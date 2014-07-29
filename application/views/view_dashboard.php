<h1>YOUR DASHBOARD</h1>
<div class="dashboard-messages">
<?php echo $this->session->flashdata('messages'); ?>
</div>

<div class="clearfix row">

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
			$query = $this->db->query("SELECT groupname FROM groups WHERE groupid='$groupid'");
			foreach($query->result_array() as $row){
				$groupname = $row['groupname'];
			}
			$query = $this->db->query("SELECT fname, sname FROM users WHERE userid='$invitefrom'");
			foreach($query->result_array() as $row){
				$name = $row['fname'] . " " . $row['sname'];
			}

			echo '<p>Invite from ' . ucfirst($name) . ' to join ' . ucfirst($groupname) . ' | <a href="/main/acceptinvite?inviteid=' . $inviteid . '">Accept</a> <a href="/main/declineinvite?inviteid=' . $inviteid . '">Ignore</a></p>';
		} 
	}else{
		echo "<p>You have no invites</p>";
	}
	?>
	</div>
</div>

<div id="percentage-box" class="content-box col-md-3">
	<div class="content">

	<h2>How are you doing?</h2>
	<?php 
	$userid = $_SESSION['userid'];
	$query = $this->db->query("SELECT * FROM items WHERE useridgetting='$userid' AND itembought=1");
	$noofgiftsbought = $query->num_rows();
	$query = $this->db->query("SELECT * FROM items WHERE useridgetting='$userid'");
	$noofgiftstotal = $query->num_rows();
	if($noofgiftstotal == 0) {
		$perc = 0;
	}else{
		$perc = ($noofgiftsbought / $noofgiftstotal) * 100;
	}
	echo "<p class='percentage'>" . $perc . "%</p>";
	echo "<p>of presents bought</p>";
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
<<<<<<< Updated upstream
				$itemforuserid = base64_encode($row['userid']);
				$query = $this->db->query("SELECT * FROM users WHERE userid='$itemforuserid'");
				foreach($query->result_array() as $row){
					$username = ucfirst($row['fname'] . " " . $row['sname']);
				}

				echo '<p>' . ucfirst($itemname) . ' for <a href="/user?uid=' . $itemforuserid . '">' . $username . '</a></p>';
=======
				$itemforuserid = $row['userid'];
				
				// set up autoloader
				require ('vendor/autoload.php');
				
				// configure database
		 		$dsn = 'mysql:dbname=alliwant_staging;host=localhost';
		 		$u = 'alliwant_josh';
				$p = 'aiwtc8159login';
				Cartalyst\Sentry\Facades\Native\Sentry::setupDatabaseResolver(
		 		new PDO($dsn, $u, $p));
				$user = Cartalyst\Sentry\Facades\Native\Sentry::findUserById($itemforuserid);
				$username = $user->first_name . " " . $user->last_name;
				$itemforuserid = base64_encode($itemforuserid);
				echo '<ol>';
				echo '<li><p>' . ucfirst($itemname) . ' for <a href="/user?uid=' . $itemforuserid . '">' . $username . '</a></p></li>';
				echo '</ol>';
>>>>>>> Stashed changes
			}
		}else{
			echo '<p>You are not getting any presents yet</p>';
		}
	?>
	</div>
</div>

</div>

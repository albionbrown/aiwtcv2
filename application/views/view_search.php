<?php
$entry = $this->session->flashdata('entry');

$type = $entry['type'];

if($type === 'email'){
	$email = $this->encrypt->encode($entry['email']);

	$query = $this->db->query("SELECT * FROM users WHERE email = '$email'");
	
}elseif($type === 'name'){
	$fname = $entry['fname'];
	$sname = $entry['sname'];

	$query = $this->db->query("SELECT * FROM users WHERE fname = '$fname' AND sname = '$sname'");
}

if($query->num_rows() > 0){
	foreach($query->result_array() as $row){

		$name = $row['fname'] . ' ' . $row['sname'];
		$location = $row['location'];

		?><div class="content-box">
		<div class="content"><?php
		echo '<h2>' . ucfirst($name) . '</h2>';
		echo '<p>' . ucfirst($location) . '</p>';
		?>
		</div>
		</div><?php
	}
}else{
	echo '<p>Sorry, we couldn&#39;t find anybody with that name!</p>';
}
?>
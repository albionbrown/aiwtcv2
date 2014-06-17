<?php
$entryarray = $_GET['q'];
$entryarray = unserialize($entryarray);
$type = $entryarray['type'];

if($type == "email"){
	$searchentry = $entryarray['email'];
	$check = $this->db->query("SELECT email FROM users");
	foreach($check->result_array() as $row){
		$encodeddemailfromdb = $row['email'];
		$decodedemailfromdb = $this->encrypt->decode($encodeddemailfromdb);
		if($decodedemailfromdb == $searchentry){
			$string = "SELECT * FROM users WHERE email = '$encodeddemailfromdb'";
			$queryarray = array('string' => $string);
		}
	}
}elseif($type == "name"){
	$fname = $entryarray['fname'];
	$sname = $entryarray['sname'];
	$string = "SELECT * FROM users WHERE fname = '$fname' AND sname = '$sname'";
	$queryarray = array('string' => $string);
}

$querystring = $queryarray['string'];
$query = $this->db->query($querystring);
if($query->num_rows() > 0){
	foreach($query->result_array() as $row){

		$name = $row['fname'] . ' ' . $row['sname'];
		$location = $row['location'];

		?><div class="content-box col-md-3">
		<div class="content"><?php
		echo '<h2>' . ucfirst($name) . '</h2>';
		echo '<p>' . ucfirst($location) . '</p>';
		?>
		</div>
		</div><?php
	}
}else{
	if($type === 'name'){
		echo '<p>Sorry, we couldn&#39;t find anybody with that name</p>';
	}else{
		echo '<p>Sorry, we couldn&#39;t find anybody with that email</p>';
	}
}
?>

<?php
function array_column($array, $column_key){
	echo $array . "<br>";
	print_r($array = unserialize($array));
	//Gets amoutn of groups the user is in.
	echo "<br>" . $noofgroups = sizeof($array) . "<br>";

	echo "<br>" . $column_key;

	$i = 0;

	print_r($keys = array_keys($array));

	die();
	
	foreach ($array as $key => $row)
	{
		$key = $i;
		if (isset($index_key) && sizeof($index_key) > $i)
			$key = $index_key[$keys[$i]];

		$newArray[$key] = $row[$column_key];
	}
	
	return $newArray;
}
?>
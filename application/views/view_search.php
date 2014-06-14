<?php
$entry = $this->session->flashdata('entry');
$entry = unserialize($entry);

echo $entry['fname'];
echo $entry['sname'];
?>
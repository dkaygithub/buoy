<?php
include('database.php'); 
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `device_kind` SET  `dimension0_name` =  ? ,  `dimension1_name` =  ? ,  `device_name` = ? WHERE `id` = ?"; 
$pdo = Database::connect();
$q = $pdo->prepare($sql);
$q->execute(array($_POST['dimension0_name'],$_POST['dimension1_name'],$_POST['device_name'],$id));
echo (mysql_affected_rows()) ? "Edited row.<br />" : "Nothing changed. <br />"; 
echo "<a href='listDeviceKind.php'>Back To Listing</a>"; 
} 
$sql2 = "SELECT * FROM `device_kind` WHERE `id` = ?"; 
$q2 = $pdo->prepare($sql2);
$row = $q2->execute(array($id));

Database::disconnect();
?>

<form action='' method='POST'> 
<p><b>Dimension0 Name:</b><br /><input type='text' name='dimension0_name' value='<?= stripslashes($row['dimension0_name']) ?>' /> 
<p><b>Dimension1 Name:</b><br /><input type='text' name='dimension1_name' value='<?= stripslashes($row['dimension1_name']) ?>' /> 
<p><b>Device Name:</b><br /><input type='text' name='device_name' value='<?= stripslashes($row['device_name']) ?>' /> 
<p><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> 
</form> 
<? } ?> 

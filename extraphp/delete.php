<?php
include "../lib/db.php";
$id = $_REQUEST['id'] ?? null;
connectDB();
$statement = $db->prepare("DELETE FROM `items` WHERE `id` = $id;");
$statement->execute();
closeDB();
header("Location: ../admin.php");
?>
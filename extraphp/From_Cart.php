<?php
include "../lib/db.php";
$id = $_REQUEST['id'] ?? null;
connectDB();
$statement = $db->prepare("DELETE FROM `cart` WHERE `id` = $id;");
$statement->execute();
closeDB();
header("Location: ../cartpage.php");
?>
<?php
include "../lib/db.php";
connectDB();
$statement = $db->prepare("DELETE FROM `cart`;");
$statement->execute();
closeDB();
session_start();
$_SESSION=[];
session_regenerate_id();
header("Location: ../main.php");
?>
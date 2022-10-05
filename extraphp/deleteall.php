<?php
include "../lib/db.php";
connectDB();
$statement = $db->prepare("DELETE FROM `cart`;");
$statement->execute();
closeDB();
header("Location: ../cartpage.php");
?>
<?php
session_start();
include "../lib/db.php";
$id = $_REQUEST['id'] ?? null;
connectDB();

    $st = $db->prepare("SELECT`name`, `price`,`img` FROM `items` WHERE id = :id");
    $st->bindParam(':id', $id);
    $st->execute();
    $st2 = $st->fetch();

    $name = $st2["name"];
    $price = $st2["price"];
    $img = $st2["img"];

$statement = $db->prepare("INSERT INTO `cart`(`name`, `price`,`img`) VALUES ('$name',$price,'$img')");
$statement->execute();
closeDB();
if($_SESSION['login'] == "admin")header("Location: ../admin.php");
else header("Location: ../main.php");
?>
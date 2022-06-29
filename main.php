<?php
session_start();
include "lib/render.php";
include "lib/db.php";

connectDB();
$show = $_REQUEST["show"] ?? "all";
if($show == "all") $statement = $db->prepare("SELECT * FROM `items`");
else if($show == "sale") $statement = $db->prepare("SELECT * FROM `items` WHERE `sale` = 1");
else if($show == "popular") $statement = $db->prepare("SELECT * FROM `items` WHERE `popular` = 1");
else if($show == "new") $statement = $db->prepare("SELECT * FROM `items` WHERE `new` = 1");


$statement->execute();
$ok = $statement->fetchall();

$st = $db->prepare("SELECT count(*) FROM `cart`");
$st->execute();
$a = $st->fetch();
closeDB();

$main_html = '';
foreach ($ok as $row) {
    $replaces = [
        '{{name}}' => $row['name'],
        '{{price}}' => $row['price'],
        '{{src}}' => "img/".$row['img'],
        '{{id}}' => $row['id']
    ];
    $main_html .= render('extrahtml/item_card.html', $replaces);
}

$acc = $_SESSION["login"] ?? "My account";
$data = [
    '{{items}}' => $main_html,
    '{{My account}}' => $acc,
    '{{count}}' => $a['count(*)']
];

$page_template = render('index.html', $data);
echo $page_template;
?>
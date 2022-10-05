<?php
include "../lib/db.php";
include "../lib/render.php";
$name = $_REQUEST['name'] ?? null;
$price = $_REQUEST['price'] ?? null;
$src = $_REQUEST['src'] ?? null;

$new = 0;
$sale = 0;
$pop = 0;

if($_REQUEST['new'] == "on")$new = 1;
if($_REQUEST['sale'] == "on")$sale = 1;
if($_REQUEST['pop'] == "on")$pop = 1;

if($name!=null && $price!=null && $src!=null){
connectDB();
$st = $db->prepare("INSERT INTO `items`(`name`, `img`, `price`, `sale`, `popular`, `new`) VALUES ('$name','$src',$price,$sale,$pop,$new)");
$st->execute();
closeDB();
}
?>
<html>
    <head>
        <link href="../css/styles.css" rel="stylesheet" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>NewItem</title>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    </head>
<body class = "mybooody">
    <div class = "tflp">
        <form method="get">
            <input type="text" name="name" placeholder="name" class = "coolinp">
            <input type="text" name="price" placeholder="price" class = "coolinp">
            <input type="text" name="src" placeholder="src" class = "coolinp">
            <div class = "coolinp">
            <input type="checkbox" name="new">New</input>
            </div>
            <div class = "coolinp">
            <input type="checkbox" name="sale">Sale</input>
            </div>
            <div class = "coolinp">
            <input type="checkbox" name="pop">Popular</input>
            </div>
            <button type="submit" class = "coolinp">Add Item</button>
        </form>
        <a href="../admin.php">Вернуться на главную</a>
    </div>
</body>
</html>

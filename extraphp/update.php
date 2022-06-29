<?php
include "../lib/db.php";
include "../lib/render.php";
$id = $_REQUEST['id'] ?? null;
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
$st = $db->prepare("UPDATE `items` SET  `name`='$name',`img`='$src',`price`=$price,`sale`= $sale,`popular`= $pop,`new`= $new WHERE `id` = $id");
$st->execute();
closeDB();
//echo("<script>alert('Item успешно обновлён')</script>")
//header("Location: ../admin.php");
} else {
    connectDB();
    $st = $db->prepare("SELECT * FROM `items` WHERE `id` = $id");
    $st->execute();
    $ok = $st->fetch();
    closeDB();
    $name = $ok['name'];
    $price = $ok['price'];
    $src = $ok['img'];
}
?>
<html>
    <head>
        <link href="../css/styles.css" rel="stylesheet" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Update</title>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    </head>
<body class = "mybooody">
    <div class = "tflp">
    <?php echo($name) ?>
        <form method="get">
            <input type="text" name="name" value='<?php echo($name) ?>' class = "coolinp">
            <input type="text" name="price" value='<?php echo($price) ?>' class = "coolinp">
            <input type="text" name="src" value='<?php echo($src) ?>' class = "coolinp">
            <div class = "coolinp">
            <input type="checkbox" name="new">New</input>
            </div>
            <div class = "coolinp">
            <input type="checkbox" name="sale">Sale</input>
            </div>
            <div class = "coolinp">
            <input type="checkbox" name="pop">Popular</input>
            </div>
            <button type="submit" name="id" value="<?php echo($id) ?>"  class = "coolinp">Update</button>
        </form>
        <a href="../admin.php">Вернуться на главную</a>
    </div>
</body>
</html>

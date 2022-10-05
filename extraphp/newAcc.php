<html>
    <head>
        <link href="../css/styles.css" rel="stylesheet" />
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>NewAcc</title>
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    </head>
<body class = "mybooody">
    <div class = "tflp">
        <form method="post">
            <input type="text" name="login" placeholder="Логин" class = "coolinp" value = <?php echo($_REQUEST["login"]) ?>>
            <input type="text" name="password" placeholder="Пароль" class = "coolinp">
            <input type="submit" value="Зарегистрироваться">
        </form>
    </div>
</body>
</html>

<?php
session_start();

include "../lib/render.php";
include "../lib/db.php";
 
connectDB();
    $login = $_REQUEST["login"] ?? null;
    $password = $_REQUEST["password"] ?? null;
    if($login != null && $password != null) {

    $token = md5(date('Y-m-d_H:i:s').$login);
    $_SESSION["token"] = $token;
    $template = $db->prepare("INSERT INTO `users`(`login`, `password`) VALUES (:login,:password)");
    $template->bindParam(':login', $login);
    $template->bindParam(':password', $password);
    $template->execute();
    $_SESSION["login"] = $login;
    if($_SESSION['login'] == "admin")header("Location: ../admin.php");
else header("Location: ../main.php");
}

closeDB();

?>
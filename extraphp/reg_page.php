<?php
session_start();

include "../lib/render.php";
include "../lib/db.php";

connectDB();

if(isset($_REQUEST["login"]) && isset($_REQUEST["password"])) {
    $template = $db->prepare("SELECT * FROM `users`  WHERE login = :login AND password = :password;");
    $login = $_REQUEST["login"];
    $password = $_REQUEST["password"];
    $template->bindParam(':login', $login);
    $template->bindParam(':password', $password);
    $template->execute();
    $res = $template->fetchAll();
    $count = count($res);
    $token = md5(date('Y-m-d_H:i:s').$login);
    if($login == "admin"){
        $_SESSION["login"] = $_REQUEST['login'];
        $_SESSION["token"] = $token;
        //echo('<script>alert("Добро пожаловать, господин");window.location = ‘../admin.php’</script>;');
        header("Location: ../admin.php");
    } else if( $count != 0 ) {
        $_SESSION["login"] = $_REQUEST['login'];
        $_SESSION["token"] = $token;
        //echo('<script>alert("Вы успешно вошли в аккаунт");window.location = ‘../main.php’</script>;');
        header("Location: ../main.php");
    } else {
        //echo("<script>alert('Неправильно введён логин или пароль');window.location = ‘../reg_page.html’</script>");
        header("Location: ../extrahtml.reg_page.html");
    }
}

closeDB();
?>
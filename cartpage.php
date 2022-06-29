<?php
session_start();
    include "lib/render.php";
    include "lib/db.php";

    connectDB();
    $statement = $db->prepare("SELECT * FROM `cart`");
    $statement->execute();
    $ok = $statement->fetchall();
    closeDB();

    $price = 0;

    $main_html = '';
    foreach ($ok as $row) {
        $replaces = [
            '{{name}}' => $row['name'],
            '{{price}}' => $row['price'],
            '{{src}}' => "img/".$row['img'],
            '{{id}}' => $row['id']
        ];
        $price += $row['price'];
        $main_html .= render('extrahtml\cart_item.html', $replaces);
    }
    $acc = $_SESSION["login"] ?? "My account";
    if($acc == "My account"){
        $text = "<a href='extrahtml/reg_page.html'>Войдите в аккаунт</a>";
    } else $text = "<button>Купить</button>";
    if($acc == "admin")$href = $acc;
    else $href = "main";
    $data = [
        '{{items}}' => $main_html,
        '{{My account}}' => $acc,
        '{{price}}' => $price,
        '{{text}}' => $text,
        '{{href}}' => $href
    ];

    $page_template = render('cartpage.html', $data);
    echo $page_template;
?>
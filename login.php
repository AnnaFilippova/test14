<?php
  session_start();
  $pdo = new PDO("mysql:host=localhost; dbname=task13;charset=utf8", "root", "");
   if ($_SESSION['userID']) {
     header("Location: http://".$_SERVER[HTTP_HOST].str_replace('login.php', 'todos.php', $_SERVER[REQUEST_URI]));
     return;
   }

 if ($_POST['login'] && $_POST['password']) {
   $sql = "SELECT * FROM users WHERE login='".$_POST['login']."' and password ='".$_POST['password']."';";
   $res = $pdo->query($sql);
    if($res) {
      echo "Юзер найден";
      $_SESSION['userID'] = $res->fetch(1)->id;
    }
    else {
    echo "Юзер не найден";
    }
 }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Авторизуйтесь</h1>
    <form method="POST">
        <input type="text" name="login" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <button type="submit">Войти</button>
        <?= $error ?>
    </form>
</body>
</html>

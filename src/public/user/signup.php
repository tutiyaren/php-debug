<?php
session_start();

$error = "";
if(isset($_SESSION['errorMessage'])) {
    $error = $_SESSION['errorMessage'];
    unset($_SESSION['errorMessage']);
}
if(isset($_SESSION['errorPassword'])) {
    $error = $_SESSION['errorPassword'];
    unset($_SESSION['errorPassword']);
}
if(isset($_SESSION['errorEmail'])) {
    $error = $_SESSION['errorEmail'];
    unset($_SESSION['errorEmail']);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>会員登録</title>
    </head>


    <h1 style="text-align:center;margin-top: 2em;margin-bottom: 1em;" class="h1_log">会員登録</h1>
<form action="/user/signup_complete.php" method="post" class="form_log">
     <input type="username" name="username" class="textbox un" placeholder="User Name"><br>
     <input type="email" name="email" class="textbox un" placeholder="Email"><br>
     <input type="password" name="password" class="textbox pass" placeholder="Password"><br>
     <input type="password" name="password_check" class="textbox pass" placeholder="Password確認"><br>
     <button type="submit" class="log_button">アカウント作成</button> 
</form>
    <p><a href="/user/signin.php">ログイン画面へ</a></p>
    
    
    <?php echo $error ?>

</html>
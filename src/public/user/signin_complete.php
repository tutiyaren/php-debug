<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];


// echo('<pre>');
// var_dump($email);
// echo('</pre>');

$errors_signin = [];
if (empty($email) || empty($password)) {
  $errors_signin[] = 'EmailかPasswordの入力がありません';
  $_SESSION['errors_signin'] = $errors_signin;
}


$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
  'mysql:host=mysql; dbname=memo; charset=utf8',
  $dbUserName, 
  $dbPassword
);

$stmt =" SELECT
    *
FROM users where email = '$email' ";
$stmt = $pdo->prepare($stmt);
$stmt->bindValue('email',$email,PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


echo('<pre>');
var_dump($users);
echo('</pre>');

foreach ($users as $user){
  $singin_password= $user['password'];
}


echo('<pre>');
var_dump($singin_password) ;
echo('</pre>');

echo('<pre>');
var_dump(password_hash($password, PASSWORD_DEFAULT)); ;
echo('</pre>');

echo('<pre>');
echo $password ;
echo('</pre>');

if (password_verify($password,$singin_password)){
  echo '正しい！';
  } else {
  echo '違う';
  }

$errors2_singin = [];
if (password_verify( $users['password'] ,$password)) {
  //DBのユーザー情報をセッションに保存
   $_SESSION['username'] = $users['username'];
   $_SESSION['email'] = $users['email'];
   $msg = 'ログインしました。';
   $link = '<a href="index.php">ホーム</a>';
   echo $_SESSION['username'];
   echo $_SESSION['email'];
}else{
    $errors2_singin = 'メールアドレスまたはパスワードが違います';
    $_SESSION['errors2_singin'] = $errors2_singin;
} 
?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会員登録</title>
</head>
 
<body>
  <div>

   <?php if (!empty($_SESSION['errors_singin'] ) || !empty($_SESSION['errors2_singin'])): ?>
      <!-- <meta http-equiv="refresh" content="1;URL=http://localhost:8080/user/signin.php"> -->
   <?php endif; ?>
  </div>
</body> 
</html>

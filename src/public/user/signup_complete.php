<?php
session_start();

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassword
);

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_check = $_POST['password_check'];

if (empty($username) || empty($email) || empty($password)) {
    $_SESSION['errorMessage'] ='「UserName」か「Email」か「Password」の入力がありません';
    header('Location:signup.php');
    exit();
}

if ($password !== $password_check) {
    $_SESSION['errorPassword'] = 'パスワードが一致しません。';
    header('Location:signup.php');
    exit();
}

$smt = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
$smt->bindParam(':email', $email);
$smt->execute();
$count = $smt->fetchColumn();

if ($count > 0) {
    $errors[] = 'すでに登録されているメールアドレスです';
    $_SESSION['errors'] = $errors;
    header('Location: /user/signup.php');
    exit();
}


$stmt = $pdo->prepare(
    'INSERT INTO users (username, email, password) VALUES (:username, :email, :password)'
);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    header('Location: /user/signin.php');
    exit();

?>
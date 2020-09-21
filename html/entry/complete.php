<?php
session_start();
require('dbconnect.php');

if(!isset($_SESSION['form']) || $_GET['action'] !== 'confirm'){
    header('Location: error.php');
    exit();
}

$sql = "INSERT INTO applicants SET name=?, furigana=?, email=?, phone_number=?, day_of_birth=?, prefecture_id=?";
$formData = array(
    $_SESSION['form']['name'],
    $_SESSION['form']['furigana'],
    $_SESSION['form']['email'],
    $_SESSION['form']['phone_number'],
    $_SESSION['form']['year'].$_SESSION['form']['month'].$_SESSION['form']['day'],
    $_SESSION['form']['prefectures']
);

$applicant = $db -> prepare($sql);
$complete = $applicant ->execute($formData);
if($complete){
    unset($_SESSION);
}else{
    header('Location: error.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <title>プレエントリーお申し込み｜QUELCODE ISA オンラインプログラミングスクール｜卒業まで学費不要、日本初のISAを採用</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
<header>
    <img src="../images/quelcode.png" alt="QUELCODEロゴ">
</header>
<main>
    <div class="container__heading">
        <h1>
            【ISA】QUELCODE<br>
            プレエントリーフォーム
        </h1>
        <h2>
            応募はこちらから。日本で初めてISA(学費後払い)を採用したプログラミングスクール。<br>
            の応募です。全国からのご応募おまちしています。
        </h2>
        <p>
            ご応募ありがとうございました。
        </p>
    </div><!-- /.cointainer__heading -->
</main>
</body>
</html>

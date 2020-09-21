<?php
session_start();
require('dbconnect.php');

if(!isset($_SESSION['form']) || $_GET['action'] !== 'input'){
    header('Location: error.php');
    exit();
}

//get prefectures
$prefectures = $db->prepare('SELECT name FROM prefectures WHERE id=?');
$prefectures->execute(array($_SESSION['form']['prefectures']));
$prefecture = $prefectures->fetch();
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
        <hr class="hr--short">
    </div><!-- /.cointainer__heading -->
    <article class="container__form">
            <section class="form">
                <h3 class="form__title">お名前<span class="form__title--must">必須</span></h3>
                <p><?=$_SESSION['form']['name']?></p>
            </section>
            <section class="form">
                <h3 class="form__title">ふりがな<span class="form__title--must">必須</span></h3>
                <p><?=$_SESSION['form']['furigana']?></p>
            </section>
            <section class="form">
                <h3 class="form__title">メールアドレス<span class="form__title--must">必須</span></h3>
                <p><?=$_SESSION['form']['email']?></p>
            </section>
            <section class="form">
                <h3 class="form__title">電話番号<span class="form__title--must">必須</span></h3>
                <p><?=$_SESSION['form']['phone_number']?></p>
            </section>
            <section class="form">
                <h3 class="form__title">生年月日<span class="form__title--must">必須</span></h3>
                <p><?=$_SESSION['form']['year'].'年'.$_SESSION['form']['month'].'月'.$_SESSION['form']['day'].'日'?></p>
            </section>
            <section class="form">
                <h3 class="form__title">都道府県<span class="form__title--must">必須</span></h3>
                <p><?=$prefecture['name']?></p>
            </section>
            <hr class="hr--long">
            <section class="btn">
                <a href="input.php?action=return" class="form__btn--narrow form__btn--white">戻る</a>
                <a href="complete.php?action=confirm" class="form__btn--narrow form__btn--main">送信</a>
            </section>
    </article><!-- /.container__form -->
</main>
</body>
</html>

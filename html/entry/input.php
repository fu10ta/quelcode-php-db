<?php
session_start();
require('dbconnect.php');

//配列が空の場合のエラーメッセージ制御
error_reporting(E_ALL ^ E_NOTICE);

//ユーザー定義関数
function blankCheck($value){
    //文字列前後にある空白を削除する
    $value = trim($value);
    //連続した空白を一つの空白へ変換する
    $value = preg_replace('/　/',' ', $value);
    $value = preg_replace('/\s+/',' ', $value);
    return $value;
}

function h($value){
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

//confirm.phpからの遷移の場合
if($_GET['action'] === 'return'){
    $post = $_SESSION['form'];
    unset($_SESSION);
}

//post value check
if(!empty($_POST)){
    //blank check
    foreach($_POST as $blank_key => $blank_value){
        $post[$blank_key] = blankCheck($_POST[$blank_key]);
    }
    //empty check
    $emptyCheck = array(
        'お名前' => $post['name'],
        'ふりがな' => $post['furigana'],
        'メールアドレス' => $post['email'],
        '電話番号' => $post['phone_number'],
        '生年月日' => array(
            '誕生月' => $post['month'],
            '誕生日' => $post['day'],
        ),
        '都道府県' => $post['prefectures']
    );
    foreach ($emptyCheck as $empty_keys => $empty_values){
        if(is_array($empty_values)){
            foreach($empty_values as $empty_key => $empty_value){
                if(empty($empty_value)){
                    $error[$empty_keys] = $empty_keys.'は必須入力です<br>';
                }
            }
        }else{
            if(empty($empty_values)){
                $error[$empty_keys] = $empty_keys.'は必須入力です<br>';
            }else{
                $countCheck[$empty_key] = $empty_value;
            }
        }
    }

    //count check
    foreach((array)$countCheck as $count_key => $count_value){
        if(mb_strwidth($count_value) > 100){
            $error[$count_key] .= $count_key.'は半角100文字以内で入力してください';
        }
    }

    //chack date
    if(empty($error['生年月日'])){
        if(!checkdate($post['month'], $post['day'], $post['year'])){
            $error['生年月日'] .= '日付として正しくありません';
        }
    }

    //check regex
    if(!preg_match('/^[ぁ-ん]+[ぁ-ん 　]*$/', $post['furigana'])){
        $error['ふりがな'] .= 'ふりがなはひらがなおよびスペースで入力してください';
    }
    if(empty($error['電話番号'])){
        if(!preg_match('/^[0][0-9]{9,10}/', $_POST['phone_number'])){
            $error['電話番号'] .= '電話番号として正しくありません';
        }
    }
    if(empty($error['メールアドレス'])){
        if(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $post['email'])){
            $error['メールアドレス'] .= 'メールアドレスとして正しくありません';
        }
    }

    if(empty($error)){
        $_SESSION['form'] = $post;
        header('Location: confirm.php?action=input');
        exit();
    }
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
        <hr class="hr--short">
    </div><!-- /.cointainer__heading -->
    <article class="container__form">
        <form action="#" method="POST">
<?php
if(!empty($error)){
    echo '<p class="container__form--error">正しく入力されていない項目があります</p>';
}
?>
            <section class="form">
                <label for="name">
                    <h3 class="form__title">お名前<span class="form__title--must">必須</span></h3>
                    <input type="text" id="name" name="name" placeholder="山田　太郎" class="
                    <?php if(empty($error['お名前'])){echo 'form__contents';}else{echo 'form__contents--error';}?> form__contents--wide" value="<?php if(!empty($post['name'])){echo h($post['name']);}?>">
                    <p class="form__message">漢字／フルネームでご記入ください</p>
<?php
if(!empty($error['お名前'])){
    echo "<p class='form__message--error'>${error['お名前']}</p>";
}
?>
                </label>
            </section>
            <section class="form">
                <label for="furigana">
                    <h3 class="form__title">ふりがな<span class="form__title--must">必須</span></h3>
                    <input type="text" id="furigana" name="furigana" placeholder="やまだ　たろう" class="<?php if(empty($error['ふりがな'])){echo 'form__contents';}else{echo 'form__contents--error';}?> form__contents--wide" value="<?php if(!empty($post['furigana'])){echo h($post['furigana']);}?>">
<?php
if(!empty($error['ふりがな'])){
    echo "<p class='form__message--error'>${error['ふりがな']}</p>";
}
?>
                </label>
            </section>
            <section class="form">
                <label for="email">
                    <h3 class="form__title">メールアドレス<span class="form__title--must">必須</span></h3>
                    <input type="text" id="email" name="email"placeholder="example@gmail.com" class="<?php if(empty($error['メールアドレス'])){echo 'form__contents';}else{echo 'form__contents--error';}?> form__contents--wide" value="<?php if(!empty($post['email'])){echo h($post['email']);}?>">
                    <p class="form__message">確認メールが届きます。入力の間違いが無いようにご確認ください。</p>
<?php
if(!empty($error['メールアドレス'])){
    echo "<p class='form__message--error'>${error['メールアドレス']}</p>";
}
?>
                </label>
            </section>
            <section class="form">
                <label for="phone_number">
                    <h3 class="form__title">電話番号<span class="form__title--must">必須</span></h3>
                    <input type="text" id="phone_number" name="phone_number" placeholder="09012345678" class="<?php if(empty($error['電話番号'])){echo 'form__contents';}else{echo 'form__contents--error';}?> form__contents--wide" value="<?php if(!empty($post['phone_number'])){echo h($post['phone_number']);}?>">
<?php
if(!empty($error['電話番号'])){
    echo "<p class='form__message--error'>${error['電話番号']}</p>";
}
?>
                </label>
            </section>
            <section class="form">
                    <h3 class="form__title">生年月日<span class="form__title--must">必須</span></h3>
                    <select name="year" class="<?php if(empty($error['生年月日'])){echo 'form__contents';}else{echo 'form__contents--error';}?> form__contents--narrow">
<?php
for($i = 1900;$i <= date('Y'); $i++){
    if(empty($post['year'])){
        if($i === (int)date('Y',strtotime(' -20 years'))){
            echo "<option selected value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
        }else{
            echo "<option value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";

        }
    }else{
        if($i === (int)$post['year']){
            echo "<option selected value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
        }else{
            echo "<option value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
        }
    }
}
?>
                    </select>
                    <span>年</span>
                <select name="month" class="<?php if(empty($error['生年月日'])){echo 'form__contents';}else{echo 'form__contents--error';}?> form__contents--narrow">
<?php
if(empty($post['month'])){
    echo "<option disabled selected value=''> - </option>";
    for($i = 1;$i <= 12; $i++){
        echo "<option value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
    }
}else{
    echo "<option disabled value=''> - </option>";
    for($i = 1;$i <= 12; $i++){
        if($i === (int)$post['month']){
            echo "<option selected value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
        }else{
            echo "<option value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
        }
    }
}
?>
                </select>
                <span>月</span>
                <select name="day" class="<?php if(empty($error['生年月日'])){echo 'form__contents';}else{echo 'form__contents--error';}?> form__contents--narrow">
<?php
if(empty($post['day'])){
    echo "<option disabled selected value=''> - </option>";
    for($i = 1;$i <= 31; $i++){
        echo "<option value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
    }
}else{
    echo "<option disabled value=''> - </option>";
    for($i = 1;$i <= 31; $i++){
        if($i === (int)$post['day']){
            echo "<option selected value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
        }else{
            echo "<option value='".sprintf('%02d', $i)."'>".sprintf('%02d', $i)."</option>";
        }
    }
}
?>
                </select>
                <span>日</span>
                <p class="form__message">満16歳以上の方を対象としています。</p>
<?php
if(!empty($error['生年月日'])){
    echo "<p class='form__message--error'>${error['生年月日']}</p>";
}
?>
            </section>
            <section class="form">
                <h3 class="form__title">都道府県<span class="form__title--must">必須</span></h3>
                <select name="prefectures" class="<?php if(empty($error['都道府県'])){echo 'form__contents';}else{echo 'form__contents--error';}?> form__contents--wide"><!-- ADD .form__contents--error -->
<?php
//GET prefectures option list
if(empty($post['prefectures'])){
    echo '<option value="" disabled selected>選択してください</option>';
    foreach($db->query('SELECT id, name from prefectures order by id') as $prefectures){
        echo "<option value=${prefectures['id']}>${prefectures['name']}</option>";
    }
}else{
    echo '<option value="" disabled>選択してください</option>';
    foreach($db->query('SELECT id, name from prefectures order by id') as $prefectures){
        if($prefectures['id'] === (string)$post['prefectures']){
            echo "<option selected value=${prefectures['id']}>${prefectures['name']}</option>";
        }else{
            echo "<option value=${prefectures['id']}>${prefectures['name']}</option>";
        }
    }
}
?>
                </select>
                <p class="form__message">現在のお住まいの都道府県を選択ください。 </p>
<?php
if(!empty($error['都道府県'])){
    echo "<p class='form__message--error'>${error['都道府県']}</p>";
}
?>
            </section>
            <hr class="hr--long">
            <section class="form">
                <input type="submit" value="入力内容を確認" class="form__btn--wide form__btn--main">
            </section>
            <section class="form">
                <p class="form__message"><a href="" class="form__message--link">プライバシーポリシー</a>をお読みの上、同意して送信してください。</p>
            </section>
        </form>
    </article><!-- /.container__form -->
</main>
</body>
</html>

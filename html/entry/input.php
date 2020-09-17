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
            <p class="container__form--error">正しく入力されていない項目があります</p>
            <section class="form">
                <label for="name">
                    <h3 class="form__title">お名前<span class="form__title--must">必須</span></h3>
                    <input type="text" id="name" name="name" placeholder="山田　太郎" class="form__contents--wide"><!-- ADD .form__contents--error -->
                    <p class="form__message">漢字／フルネームでご記入ください</p>
                    <p class="form__message--error">ERROR MESSAGE</p>
                </label>
            </section>
            <section class="form">
                <label for="furigana">
                    <h3 class="form__title">ふりがな<span class="form__title--must">必須</span></h3>
                    <input type="text" id="furigana" name="furigana" placeholder="やまだ　たろう" class="form__contents--wide"><!-- ADD .form__contents--error -->
                    <!-- ADD p.form__message--error ERROR MESSAGE -->
                </label>
            </section>
            <section class="form">
                <label for="email">
                    <h3 class="form__title">メールアドレス<span class="form__title--must">必須</span></h3>
                    <input type="text" id="email" name="email"placeholder="example@gmail.com" class="form__contents--wide"><!-- ADD .form__contents--error -->
                    <p class="form__message">確認メールが届きます。入力の間違いが無いようにご確認ください。</p>
                    <!-- ADD p.form__message--error ERROR MESSAGE -->
                </label>
            </section>
            <section class="form">
                <label for="phone_number">
                    <h3 class="form__title">電話番号<span class="form__title--must">必須</span></h3>
                    <input type="text" id="phone_number" name="phone_number" placeholder="09012345678" class="form__contents--wide"><!-- ADD .form__contents--error -->
                    <!-- ADD p.form__message--error ERROR MESSAGE -->
                </label>
            </section>
            <section class="form">
                    <h3 class="form__title">生年月日<span class="form__title--must">必須</span></h3>
                    <select name="year" class="form__contents--narrow"><!-- ADD .form__contents--error -->
                        <option value="2000" selected>2000</option>
                    </select>
                    <span>年</span>
                <select name="month" class="form__contents--narrow"><!-- ADD .form__contents--error -->
                    <option disabled selected>-</option>
                </select>
                <span>月</span>
                <select name="day" class="form__contents--narrow"><!-- ADD .form__contents--error -->
                    <option disabled selected>-</option>
                </select>
                <span>日</span>
                <p class="form__message">満16歳以上の方を対象としています。</p>
                <!-- ADD p.form__message--error ERROR MESSAGE -->
            </section>
            <section class="form">
                <h3 class="form__title">都道府県<span class="form__title--must">必須</span></h3>
                <select name="prefectures_id" class="form__contents--wide"><!-- ADD .form__contents--error -->
                    <option desabled selected>選択してください</option>
                </select>
                <p class="form__message">現在のお住まいの都道府県を選択ください。 </p>
                <!-- ADD p.form__message--error ERROR MESSAGE -->
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

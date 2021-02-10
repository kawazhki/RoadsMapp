<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規登録</title>
</head>
<body>
    <section class="containar">
        <!--ここにロゴを挿入-->
        <h1>新規登録</h1>
        <!--ここにエラーメッセージを表示-->
        <form action="" method="post">
            <input type="text" name="user_name" placeholder="ユーザー名">
            <input type="text" name="email" placeholder="メールアドレス">
            <input type="text" name="passwd" placeholder="パスワード">
            <p class="">8文字以上、半角英・数・記号が使えます</p>
            <input type="submit" name="commit" value="RoadsMappに登録する">
        </form>
        <p class="">RoadsMappのアカウントを持っている場合は<a href="#">ログイン</a>から</p>
    </section>
</body>
</html>
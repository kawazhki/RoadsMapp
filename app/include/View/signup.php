<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/template/signup.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
    <title>新規登録</title>
</head>
<body>
    <section class="containar">
        <!--ここにロゴを挿入-->
        <h1>新規登録</h1>
        <!--ここにエラーメッセージを表示-->
        <?php if (gettype($errMsgs) === 'array') { ?>
            <?php foreach ($errMsgs as $msg) { ?>
                <p class="err_msg"><?php print $msg; ?></p>
            <?php } ?>
        <?php } ?>
        <form action="" method="post" class="new_user">
            <input type="text" name="user_name" class="item" placeholder="ユーザー名"><br>
            <input type="text" name="email" class="item" placeholder="メールアドレス"><br>
            <input type="password" name="passwd" class="item" placeholder="パスワード"><br>
            <p class="helptext">8文字以上、半角英・数・記号が使えます</p>
            <input type="submit" name="commit" class="item" id="commit" value="RoadsMappに登録する">
        </form>
        <p class="login">RoadsMappのアカウントを持っている場合は<a href="LoginController.php">ログイン</a>から</p>
    </section>
</body>
</html>
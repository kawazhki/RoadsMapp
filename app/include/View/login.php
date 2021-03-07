<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/template/signup.css" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+1p&display=swap" rel="stylesheet">
    <title>ログイン</title>
</head>
<body>
    <section class="containar">
        <!--ここにロゴを挿入-->
        <h1>ログイン</h1>
        <!--ここにエラーメッセージを表示-->
        <?php if (gettype($errMsgs) === 'array') { ?>
            <?php foreach ($errMsgs as $msg) { ?>
                <p class="err_msg"><?php print $msg; ?></p>
            <?php } ?>
        <?php } ?>
        <form action="" method="post" class="new_user">
            <input type="text" name="identity" class="item" placeholder="ユーザー名 または メールアドレス"><br>
            <input type="password" name="passwd" class="item" placeholder="パスワード"><br>
            <input type="submit" name="commit" class="item" id="commit" value="RoadsMappにログイン">
        </form>
        <p class="login">RoadsMappのアカウントを持っていない場合は<a href="SignUpController.php">新規登録</a>から</p>
    </section>
</body>
</html>
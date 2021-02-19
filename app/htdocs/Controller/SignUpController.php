<?php
    session_start();
    require_once '../../include/config/const.php';
    require_once FilePath::MODEL . '/signUp.php';
    require_once FilePath::LIBRARY . '/RegexClass.php';
    require_once FilePath::LIBRARY . '/UsePDOClass.php';

    //エラーメッセージ用の配列を用意
    $err = [];
    //ログイン済かどうかを確認するため、最初にDBに接続する
    $db = new DbOperation();

    //ログイン済ならホーム画面へ移行させる処理を記載する
    /*
    if (isset($_SESSION['user_id'])) {
        toHome();
    }
    */

    if (!empty($_POST['commit'])) {
        $post_data = filter_input_array(INPUT_POST);
        $err[] = isValidUserName($post_data['user_name'], $db);
        var_dump($err);
    }

    include FilePath::VIEW . '/signup.php';

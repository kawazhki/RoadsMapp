<?php
    session_start();
    require_once '../../include/config/const.php';
    require_once FilePath::MODEL . '/signUp.php';
    require_once FilePath::LIBRARY . '/RegexClass.php';
    require_once FilePath::LIBRARY . '/UsePDOClass.php';
    require_once FilePath::LIBRARY . '/ValidatorClass.php';

    //エラーメッセージ用の配列を用意
    $err = [];
    //ログイン済かどうかを確認するため、最初にDBに接続する
    $db = new DbOperation();
    //バリデーションクラスをインスタンス化
    $dv = new DataValidation();

    //ログイン済ならホーム画面へ移行させる処理を記載する
    /*
    if (isset($_SESSION['user_id'])) {
        toHome();
    }
    */

    if (!empty($_POST['commit'])) {
        //メールアドレス重複メッセージ
        $post_data = filter_input_array(INPUT_POST);

        //$post_dataを配列のまま渡してもいけるか？
        if ($dv->signUpValidation($post_data['user_name'], $post_data['email'], $post_data['passwd'], $db)) {
            //$post_dataをdbに登録
            print 'Success!!';
        } else {
            //エラーメッセージを取得する
            print 'Failed..';
        }
    }

    include FilePath::VIEW . '/signup.php';

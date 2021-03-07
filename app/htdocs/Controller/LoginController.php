<?php
    session_start();
    require_once '../../include/config/const.php';
    require_once FilePath::LIBRARY . '/RegexClass.php';
    require_once FilePath::LIBRARY . '/UsePDOClass.php';
    require_once FilePath::LIBRARY . '/ValidatorClass.php';

    //エラーメッセージ用の変数を用意
    $errMsgs = '';
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
        //ポストデータの取得
        $post_data = filter_input_array(INPUT_POST);

        if ($dv->signUpValidation($post_data, $db)) {
            //$post_dataをdbに登録
            $db->setEmail($post_data['email']);
            $db->setPasswd($post_data['passwd']);
            $db->insertSignUpData();
        } else {
            //エラーメッセージを取得する
            $errMsgs = $dv->getErrorMsg();
        }
    }

    include FilePath::VIEW . '/login.php';
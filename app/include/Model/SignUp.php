<?php
    /**
     * ユーザー名チェック
     */
    function isValidUserName(string $user_name, object $db) {
        $db->setUserName($user_name);
        if (empty($user_name)) {
            //空入力チェック
            return ErrMessage::USER_NAME_EMPTY;
        } elseif (!RegexCheck::addUserName($user_name)) {
            //入力文字チェック
            return ErrMessage::USER_NAME_INPUT_RULE;
        } elseif (!$db->userNameDuplicateCheck()) {
            //重複チェック
            return $user_name . ErrMessage::DUPLICATE_USER_NAME;
        }
    }

    /**
     * メールアドレスチェック
     */
    function isValidEmail(string $email, object $db) {
        if (empty($email)) {
            //空入力チェック
            return ErrMessage::EMAIL_EMPTY;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //入力文字チェック
            return ErrMessage::EMAIL_INPUT_RULE;
        }
    }

    /**
     * パスワードチェック
     */
    function isValidPasswd(string $passwd, object $db) {
        if (empty($passwd)) {
            //空入力チェック
            return ErrMessage::PASSWD_EMPTY;
        } elseif (!RegexCheck::addPasswd($passwd)) {
            //入力文字チェック
            return ErrMessage::PASSWD_INPUT_RULE;
        }
    }

    /**
     * 新規登録におけるユーザ情報のINSERT処理
     */
    function userDataSignUp(array $post_data, object $db) {
        $hash = password_hash($post_data['passwd'], PASSWORD_DEFAULT);
        $db->setUserName($post_data['user_name']);
        $db->setEmail($post_data['email']);
        $db->setPasswd($hash);
        $db->insertSignUpData();
    }

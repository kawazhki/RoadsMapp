<?php
    /**
     * ユーザー名チェック
     */
    function isValidUserName($user_name, $db) {
        if (empty($user_name)) {
            //空入力チェック
            return ErrMessage::USER_NAME_EMPTY;
        } elseif (!RegexCheck::addUserName($user_name)) {
            //入力文字チェック
            return ErrMessage::USER_NAME_INPUT_RULE;
        } elseif (!$db->userNameDuplicateCheck($user_name)) {
            //重複チェック
            return $user_name . ErrMessage::DUPLICATE_USER_NAME;
        }
    }

    /**
     * メールアドレスチェック
     */
    function isValidEmail($email, $db) {
        if (empty($email)) {
            //空入力チェック
            return ErrMessage::EMAIL_EMPTY;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //入力文字チェック
            return ErrMessage::EMAIL_INPUT_RULE;
        } elseif (!$db->emailDuplicateCheck($email)) {
            //重複チェック
            return $email . ErrMessage::DUPLICATE_EMAIL;
        }
    }

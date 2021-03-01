<?php

    class DataValidation {
        private $errMsg = [];

        /**
         * コンストラクタ
         * 不要かも..
         */
        public function __construct() {
            $this->errMsg = [];
        }

        /**
         * サインイン時のユーザー名バリデーションメソッド
         *
         * @param $user_name 入力されたユーザー名
         * @param $db PDOインスタンス
         * @return string エラーメッセージ or バリデーションに掛からなければ戻り値なし
         */
        public function validFrAddUserName(string $user_name, object $db) {
            $db->serUserName($user_name);
            if (empty($user_name)) {
                //空文字チェック
                $this->errMsg = ErrMessage::USER_NAME_INPUT_RULE;
            } elseif (!RegexCheck::addUserName($user_name)) {
                //入力文字チェック
                $this->errMsg = ErrMessage::USER_NAME_INPUT_RULE;
            } elseif (!$db->userNameDuplicateCheck()) {
                //重複チェック
                $this->errMsg = $user_name . ErrMessage::DUPLICATE_USER_NAME;
            }
        }

        /**
         * サインイン時のメールアドレスバリデーションメソッド
         *
         * @param $email 入力されたメールアドレス
         * @return string エラーメッセージ or バリデーションに掛からなければ戻り値なし
         */
        public function validForAddEmail(string $email) {
            if (empty($email)) {
                //空文字チェック
                $this->errMsg = ErrMessage::EMAIL_EMPTY;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //入力文字チェック
                $this->errMsg = ErrMessage::EMAIL_INPUT_RULE;
            }
        }

        /**
         * サインイン時のパスワードバリデーションメソッド
         *
         * @param $passwd 入力されたパスワード
         * @return string エラーメッセージ or バリデーションに掛からなければ戻り値なし
         */
        public function validForPasswd(string $passwd) {
            if (empty($passwd)) {
                //空入力チェック
                $this->errMsg = ErrMessage::PASSWD_EMPTY;
            } elseif (!RegexCheck::addPasswd($passwd)) {
                //入力文字チェック
                $this->errMsg = ErrMessage::PASSWD_INPUT_RULE;
            }
        }
    }
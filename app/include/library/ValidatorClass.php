<?php

    class DataValidation {
        private $errMsg;

        /**
         * コンストラクタ
         */
        public function __construct() {
            //エラーメッセージを格納する変数を初期化
            $this->errMsg = [];
        }

        /**
         * サインイン時のユーザー名バリデーションメソッド
         *
         * @param string $user_name 入力されたユーザー名
         * @param object $db PDOインスタンス
         * @return string エラーメッセージ or バリデーションに掛からなければ戻り値なし
         */
        public function addUserNameCheck(string $user_name, object $db) {
            $db->serUserName($user_name);
            if (empty($user_name)) {
                //空文字チェック
                $this->errMsg[] = ErrMessage::USER_NAME_INPUT_RULE;
            } elseif (!RegexCheck::addUserName($user_name)) {
                //入力文字チェック
                $this->errMsg[] = ErrMessage::USER_NAME_INPUT_RULE;
            } elseif (!$db->userNameDuplicateCheck()) {
                //重複チェック
                $this->errMsg[] = $user_name . ErrMessage::DUPLICATE_USER_NAME;
            }
        }

        /**
         * サインイン時のメールアドレスバリデーションメソッド
         *
         * @param string $email 入力されたメールアドレス
         * @return string エラーメッセージ or バリデーションに掛からなければ戻り値なし
         */
        public function addEmailCheck(string $email) {
            if (empty($email)) {
                //空文字チェック
                $this->errMsg[] = ErrMessage::EMAIL_EMPTY;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //入力文字チェック
                $this->errMsg[] = ErrMessage::EMAIL_INPUT_RULE;
            }
        }

        /**
         * サインイン時のパスワードバリデーションメソッド
         *
         * @param string $passwd 入力されたパスワード
         * @return string エラーメッセージ or バリデーションに掛からなければ戻り値なし
         */
        public function addPasswdCheck(string $passwd) {
            if (empty($passwd)) {
                //空入力チェック
                $this->errMsg[] = ErrMessage::PASSWD_EMPTY;
            } elseif (!RegexCheck::addPasswd($passwd)) {
                //入力文字チェック
                $this->errMsg[] = ErrMessage::PASSWD_INPUT_RULE;
            }
        }

        /**
         * サインイン時の一括バリデーションチェック
         *
         * @param string $user_name 入力されたユーザー名
         * @param string $email 入力されたメールアドレス
         * @param string $passwd 入力されたパスワード
         * @param object $db PDOインスタンス
         * @return bool or array $errMsg エラーメッセージ
         */
        public function signUpValidation(string $user_name, string $email, string $passwdm, object $db) {
            $this->addUserNameCheck($user_name, $db);
            $this->addEmailCheck($email);
            $this->addPasswd($passwd);

            if (count($this->errMsg) === 0) {
                return true;
            } else {
                return $this->errMsg;
            }
        }
    }
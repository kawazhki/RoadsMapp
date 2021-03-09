<?php

    class DataValidation {
        private $errMsgs;

        /**
         * コンストラクタ
         */
        public function __construct() {
            //エラーメッセージを格納する変数を初期化
            $this->errMsgs = [];
        }

        /**
         * サインイン時のユーザー名バリデーションメソッド
         *
         * @param string $user_name 入力されたユーザー名
         * @param object $db PDOインスタンス
         * @return string エラーメッセージ or バリデーションに掛からなければ戻り値なし
         */
        public function addUserNameCheck(string $user_name, object $db) {
            $db->setUserName($user_name);
            if (empty($user_name)) {
                //空文字チェック
                $this->errMsgs[] = ErrMessage::USER_NAME_EMPTY;
            } elseif (!RegexCheck::addUserName($user_name)) {
                //入力文字チェック
                $this->errMsgs[] = ErrMessage::USER_NAME_INPUT_RULE;
            } elseif (!$db->userNameDuplicateCheck()) {
                //重複チェック
                $this->errMsgs[] = $user_name . ErrMessage::DUPLICATE_USER_NAME;
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
                $this->errMsgs[] = ErrMessage::EMAIL_EMPTY;
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //入力文字チェック
                $this->errMsgs[] = ErrMessage::EMAIL_INPUT_RULE;
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
                $this->errMsgs[] = ErrMessage::PASSWD_EMPTY;
            } elseif (!RegexCheck::addPasswd($passwd)) {
                //入力文字チェック
                $this->errMsgs[] = ErrMessage::PASSWD_INPUT_RULE;
            }
        }

        /**
         * サインイン時の一括バリデーションチェック
         *
         * @param array $post_data POSTされたデータ
         * @param object $db PDOインスタンス
         * @return bool
         */
        public function signUpValidation(array $post_data, object $db): bool {
            $this->addUserNameCheck($post_data['user_name'], $db);
            $this->addEmailCheck($post_data['email']);
            $this->addPasswdCheck($post_data['passwd']);

            if (count($this->errMsgs) === 0) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * ログイン時のバリデーションチェック
         *
         * @param array POSTされたデータ
         * @param object $db PDOインスタンス
         * @return bool
         */
        public function loginValidation(array $post_data, object $db):bool {
            $db->setUserName($post_data['user_name']);
            $db->setPasswd($post_data['passwd']);
            if(empty($post_data['user_name']) || empty($post_data['passwd'])) {
                $this->errMsgs[] = ErrMessage::POST_DATA_EMPTY;
                return false;
            } elseif (!$db->authenticationCheck()) {
                $this->errMsgs[] = ErrMessage::AUTHENTICATION_FAILURE;
                return false;
            } else {
                return true;
            }
        }

        /**
         * エラーメッセージ取得用メソッド
         *
         * @return array $errMsg エラーメッセージ
         */
        public function getErrorMsgs(): array {
            return $this->errMsgs;
        }
    }
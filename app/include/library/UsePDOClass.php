<?php
    class DbOperation {
        //ユーザ名、パスワードはダミー表記にしてからpushすること
        const DB_NAME = 'testdb';
        const HOST = 'localhost';
        const UTF = 'utf8';
        const DB_USER_NAME = 'user';
        const DB_PASSWD = 'passwd';

        private $dbh;
        private $user_name;
        private $email;
        private $passwd;

        /**
         * DB接続メソッド
         * インスタンス化時に接続する様コンストラクタにする
         */
        public function __construct() {
            $dsn = 'mysql:dbname=' . self::DB_NAME . ';host=' . self::HOST . ';charset=' . self::UTF;
            try {
                $dbh = new PDO($dsn, self::DB_USER_NAME, self::DB_PASSWD);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                print "接続エラー：{$e->getMessage()}";
                die();
            }

            $this->dbh = $dbh;
            /*
            user_name,email,passwdプロパティの初期化
            初期値「''」は仮。要検討。
            */

            $this->setUserName('');
            $this->setEmail('');
            $this->setPasswd('');
        }

        /**
         * user_nameプロパティのゲッター(取得)&セッター(設定)メソッド
         */
        public function getUserName(): string {
            return $this->user_name;
        }

        public function setUserName(string $user_name) {
            $this->user_name = $user_name;
        }

        /**
         * emailプロパティのゲッター(取得)&セッター(設定)メソッド
         */
        public function getEmail(): string {
            return $this->email;
        }

        public function setEmail(string $email) {
            $this->email = $email;
        }

        /**
         * passwdプロパティのゲッター(取得)&セッター(設定)メソッド
         */
        public function getPasswd(): string {
            return $this->passwd;
        }

        public function setPasswd(string $passwd) {
            $this->passwd = $passwd;
        }

        /**
         * user_name重複チェック
         */
        public function userNameDuplicateCheck (): bool {
            $stt = $this->dbh->prepare('SELECT COUNT(name = :username or NULL) FROM users');
            $stt->bindValue(':username', $this->getUserName());
            $stt->execute();
            $result = $stt->fetch(PDO::FETCH_COLUMN);
            if ($result === 0) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * 新規登録用INSERT処理
         */
        public function insertSignUpDara() {
            try {
                $stt = $this->dbh->prepare('INSERT INTO users(name, email, hashed_password) VALUES(:username, :email, :passwd)');
                $stt->bindValue(':username', $this->getUserName());
                $stt->bindValue(':email', $this->getEmail());
                $stt->bindValue(':passwd', $this->getPasswd());
                $stt->execute();
            } catch(PDOException $e) {
                print "新規登録エラー：{$e->getMessage()}";
            }
        }
    }
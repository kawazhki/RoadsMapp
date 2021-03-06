<?php
    class DbOperation {
        private $dbh;
        private $user_name;
        private $email;
        private $passwd;

        /**
         * DB接続メソッド
         * インスタンス化時に接続する様コンストラクタにする
         */
        public function __construct() {
            $dsn = 'mysql:dbname=' . DbConnect::DB_NAME . ';host=' . DbConnect::HOST . ';charset=' . DbConnect::UTF;
            try {
                $dbh = new PDO($dsn, DbConnect::DB_USER_NAME, DbConnect::DB_PASSWD);
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
            $stt = $this->dbh->prepare('SELECT COUNT(username = :username or NULL) FROM testtable');
            $stt->bindValue(':username', $this->getUserName());
            $stt->execute();
            $result = $stt->fetch(PDO::FETCH_COLUMN);
            if ((int)$result === 0) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * 新規登録用INSERT処理
         */
        public function insertSignUpData() {
            $hash = password_hash($this->getPasswd(), PASSWORD_DEFAULT);

            try {
                $stt = $this->dbh->prepare('INSERT INTO testtable(username, email, passwd) VALUES(:username, :email, :passwd)');
                $stt->bindValue(':username', $this->getUserName());
                $stt->bindValue(':email', $this->getEmail());
                $stt->bindValue(':passwd', $hash);
                $stt->execute();
            } catch(PDOException $e) {
                print "新規登録エラー：{$e->getMessage()}";
            }
        }
    }
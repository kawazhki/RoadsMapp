<?php
    function getDbConnect() {
        $db = new PDO(DbConnect::DSN, DbConnect::USERNAME, DbConnect::PASSWD);
        return $db;
    }
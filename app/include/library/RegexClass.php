<?php
    class RegexCheck {
        const ADD_USER_NAME = '/^(?=.*[a-zA-Z0-9])([a-zA-Z0-9-_.]{4,15})$/';
        const ADD_PASSWD =  '/^(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[-_.])([a-zA-Z0-9-_.]{8,64})$/';

        public static function addUserName(string $user_name) {
            if (preg_match(self::ADD_USER_NAME, $user_name)) {
                return true;
            } else {
                return false;
            }
        }

        public static function addPasswd(string $passwd) {
            if (preg_match(self::ADD_PASSWD, $passwd)) {
                return true;
            } else {
                return false;
            }
        }
    }
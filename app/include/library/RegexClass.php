<?php
    class RegexCheck {
        const ADD_USER_NAME = '/^(?=.*[a-z0-9])([a-zA-Z0-9-_.]{4,15})$/';
        const ADD_PASSWD =  '';

        public static function addUserName(string $post_data) {
            if (preg_match(self::ADD_USER_NAME, $post_data)) {
                return true;
            } else {
                return false;
            }
        }

        public static function addPasswd(string $post_data) {
            if (preg_match(self::ADD_PASSWD, $post_data)) {
                return true;
            } else {
                return false;
            }
        }
    }
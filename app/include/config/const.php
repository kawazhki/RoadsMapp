<?php
    class CharacterSet {
        const HTML = 'UTF-8';
    }

    class FilePath {
        const VIEW = '../../include/View';
        const MODEL = '../../include/Model';
        const LIBRARY = '../../include/library';
        const CSS = '../assets/template';
    }

    class DbConnect {
        const DB_NAME = 'testdb';
        const HOST = 'localhost';
        const UTF = 'utf8';
        const DB_USER_NAME = 'user';
        const DB_PASSWD = 'testpass';
    }

    class ErrMessage {
        const USER_NAME_EMPTY = 'ユーザー名を入力してください';
        const USER_NAME_INPUT_RULE = 'ユーザー名は4文字以上15文字以下、半角英数字、記号(- . _)で入力してください(半角英数字は必須)';
        const DUPLICATE_USER_NAME = 'は既に使用されています';
        const EMAIL_EMPTY = 'メールアドレスを入力してください';
        const EMAIL_INPUT_RULE = 'メールアドレスのフォーマットが正しくありません';
        const PASSWD_EMPTY = 'パスワードを入力してください';
        const PASSWD_INPUT_RULE = 'パスワードは半角英字、数字、記号(- . _)それぞれを含む8文字以上64文字以内で入力してください';
    }
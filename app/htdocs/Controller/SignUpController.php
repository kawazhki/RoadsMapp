<?php
    require_once '../../include/config/const.php';
    require_once FilePath::MODEL . '/signUp.php';

    if ($db = getDbConnect()) {

    }

    include FilePath::VIEW . '/signup.php';
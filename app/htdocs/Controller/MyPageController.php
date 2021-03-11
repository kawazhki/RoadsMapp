<?php
    session_start();
    require_once '../../include/config/const.php';
    require_once FilePath::LIBRARY . '/RegexClass.php';
    require_once FilePath::LIBRARY . '/UsePDOClass.php';
    require_once FilePath::LIBRARY . '/ValidatorClass.php';

    include FilePath::VIEW . '/mypage.php';
<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2016-12-29
 * Time: 오후 7:11
 */
    require_once "../Database.php";
    $db = new Database();

    if(!isMember()) {
        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
    }

    if ($db->insertAssess($_REQUEST)) {
        redirectAlert("/mypage", "등록했습니다.");
    }

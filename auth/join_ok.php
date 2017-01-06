<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2016-12-27
 * Time: 오후 4:07
 */

    require_once "../Database.php";
    $db = new Database();


    $member_infos = [
        'name' => $_POST['u_name'],
        'email' => $_POST['u_email'],
        'password' => password_hash($_POST['u_pwd_1'], PASSWORD_DEFAULT),
        'birth_year' => $_POST['u_birth_year'],
        'location' => $_POST['u_location'],
        'cellphone' => $_POST['u_cellphone'],
    ];

    $member_id = $db->insertMemberInfo($member_infos);

    $_SESSION['m_id'] = $member_id;
    $_SESSION['m_nm'] = $member_infos['name'];
    $_SESSION['m_email'] = $member_infos['email'];

    $msg = "가입이 완료되었습니다.";
    redirectAlert(SITE_URL.SITE_PORT, $msg);


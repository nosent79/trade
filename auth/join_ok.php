<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2016-12-27
 * Time: 오후 4:07
 */

    require_once "../Database.php";

    $db = new Database();

    $ages = getAges($_POST['u_ident1']);
    $location = $_POST['u_location'];

    $member_infos = [
        'name' => $_POST['u_ident1'],
        'email' => $_POST['u_email']."@".$_POST['u_email_domain_select'],
        'password' => password_hash($_POST['u_pwd1'], PASSWORD_DEFAULT),
        'birth_year' => $_POST['u_ident1'],
        'location' => $_POST['u_location'],
        'cellphone' => $_POST['u_hp1'].$_POST['u_hp2'].$_POST['u_hp3'],
    ];

    $member_id = $db->insertMemberInfo($member_infos);

    $_SESSION['m_id'] = $member_id;
    $_SESSION['m_nm'] = $member_infos['name'];
    $_SESSION['m_email'] = $member_infos['email'];

    $msg = "가입이 완료되었습니다.";
    redirectAlert(SITE_URL.SITE_PORT, $msg);


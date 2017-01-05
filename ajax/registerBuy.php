<?php
    /**
     * Created by PhpStorm.
     * User: 최진욱
     * Date: 2016-12-28
     * Time: 오후 5:18
     */
    require_once "../Database.php";
    $db = new Database();

    $params = [
        'tr_cate' => $_POST['tr_cate'],
        'tr_gubun' => 'B',
        'qty' => $_POST['qty'],
        'price' => $_POST['price'],
        'tr_title' => $_POST['tr_title'],
        'tr_desc' => $_POST['tr_desc'],
        'tr_kind' => $_POST['tr_kind'],
    ];

    if ($db->insertTrade($params)) {
        $code   = "00";
        $status = "success";
        $msg    = "success";
    } else {
        $code   = "91";
        $status = "error";
        $msg    = "error";
    }

    $result = [
        "code"      => $code,
        "status"    => $status,
        "msg"       => $msg,
    ];

    http_response_code(201);
    header('Content-Type: application/json');
    echo json_encode($result);
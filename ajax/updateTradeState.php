<?php
    require_once "../Database.php";
    $db = new Database();

    $tr_code = $_REQUEST['tr_code'];

    if ($db->insertTradeState($tr_code, 'S')) {
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
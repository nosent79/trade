<?php
    require_once "../Database.php";
    $db = new Database();

    $params = [
        'amount' => $_POST['mileage_amt'],
        'm_gubun' => 'P',
    ];

    if ($db->chargeMileage($params)) {
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
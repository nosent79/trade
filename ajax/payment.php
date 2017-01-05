<?php
    require_once "../Database.php";
    $db = new Database();

    $params = [
        'amount' => $_POST['real_use_mileage'],
        'tr_code' => $_POST['tr_code'],
        'tr_state' => 'W',
        'm_gubun' => 'M',
        'reg_m_id' => $_POST['reg_m_id'],
    ];

    if ($db->payment($params)) {
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
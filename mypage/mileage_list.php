<?php
    require_once "../Database.php";
    require_once "../common/html/header_bootstrap.html";

    include_once "../common/html/button.html";

    $db = new Database();

    if(!isMember()) {
        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
    }

    $mileage = $db->getMileage();
    $mileage_flag = isset($_REQUEST['mileage_flag']) ? $_REQUEST['mileage_flag'] : 'P';

?>
    <div class="row">
        <?php
        include_once "../common/html/mypage/left.html";
        ?>
        <div class="col-md-10">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button id="btnChargePoint" type="button" class="btn btn-default <?=($mileage_flag === 'P') ? 'btn-success' : ''?>">충전내역</button>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnUsePoint" type="button" class="btn btn-default <?=($mileage_flag === 'M') ? 'btn-success' : ''?>">사용내역</button>
                </div>
            </div>
            <br />
            <div class="table-responsive">
                <table class="table table-striped">
                    <caption>마일리지 내역</caption>
                    <colgroup>
                        <col width="*" />
                        <col width="*" />
                        <col width="50%" />
                    </colgroup>
                    <thead>
                    <tr>
                        <th scope="col">충전금액</th>
                        <th scope="col">충전일시</th>
                        <th scope="col">비고</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $mileage_list = $db->getMileageList($mileage_flag);

                        foreach ($mileage_list as $list) {
                    ?>
                    <tr>
                        <td><?=number_format($list['amount']) ?></td>
                        <td><?=$list['reg_date']?></td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<script src="../common/js/mypage.js"></script>
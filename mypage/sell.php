<?php
    require_once "../Database.php";
    require_once "../common/html/header_bootstrap.html";

    include_once "../common/html/button.html";

    $db = new Database();

    if(!isMember()) {
        redirectAlert(LOGIN_PATH. "/login.php", "로그인 후 이용하세요.");
    }

    $tr_state = isset($_REQUEST['state']) ? $_REQUEST['state'] : 'W';
    $bGoTradeDesc = false;

    if ('P' === $tr_state) {
        $bGoTradeDesc = true;
    }

    $params = [
        'gubun' => 'S',
        'state' => $tr_state,
    ];
?>
<div class="container">
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?=SITE_URL.SITE_PORT?>/auth/logout.php"><span class="glyphicon glyphicon-log-in"></span> 로그아웃</a></li>
        </ul>
    </div>

    <div class="row">
        <?php
        include_once "../common/html/mypage/left.html";
        include_once "../common/html/mypage/tab.html";
        ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>카테고리</th>
                    <th>분류</th>
                    <th>제목</th>
                    <th>거래금액</th>
                    <th>등록일</th>
                    <?php
                        if ($tr_state === 'S') {
                            echo "<th>평가1</th>";
                        }
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php
                $sell_list = $db->getTradeListMember($params);

                foreach ($sell_list as $list) {
                    ?>
                    <tr>
                        <td><?=$list['tr_cate']?></td>
                        <td><?=$list['tr_kind']?></td>
                        <?php
                        if ($bGoTradeDesc) {
                            ?>
                            <a href="#" tr_code="<?= $list['tr_code'] ?>" class="_goTradeDesc"><?= $list['tr_title'] ?></a>
                            <?php
                        } else {
                        ?>
                            <td><?= $list['tr_title'] ?></td>
                        <?php
                        }
                        ?>

                        <td><?=$list['price']?></td>
                        <td><?=$list['t_date']?></td>
                        <?php
                        if ($tr_state === 'S') {
                            echo "<td><button class='button g_button _assess'>평가</button></td>";
                        }
                        ?>

                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Single button -->
</div>
<script src="../common/js/mypage.js"></script>
<script>
//    $("._assess").click(function(e) {
//        e.preventDefault();
//
//        var url = "assess.php";
//        var f = document.frmAssess;
//        f.t_m_id.value = $(this).attr("t_m_id");
//        f.t_m_nm.value = $(this).attr("t_m_nm");
//
//        var pop_title = "popupOpener" ;
//        window.open("", pop_title) ;
//
//        f.target = pop_title ;
//        f.action = url ;
//
//        f.submit() ;
//    });

</script>
</body>
</html>

<?php
    require_once "../Database.php";
    require_once "../common/html/header_bootstrap.html";

    include_once "../common/html/button.html";

    $db = new Database();

    if(!isMember()) {
        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
    }

    $tr_state = $_REQUEST['state'] ?? 'W';
    $bGoTradeDesc = false;

    if ('P' === $tr_state) {
        $bGoTradeDesc = true;
    }

    $params = [
        'gubun' => 'B',
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
                </tr>
                </thead>
                <tbody>
                <?php
                $buy_list = $db->getTradeListMember($params);

                foreach ($buy_list as $list) {
                    ?>
                    <tr>
                        <td><?=$list['tr_cate']?></td>
                        <td><?=$list['tr_kind']?></td>
                        <td>
                            <?php
                            if ($bGoTradeDesc) {
                            ?>
                            <a href="#" tr_code="<?= $list['tr_code'] ?>" class="_goTradeDesc"><?= $list['tr_title'] ?></a>
                            <?php
                            } else {
                            ?>
                            <?= $list['tr_title'] ?>
                            <?php
                            }
                            ?>
                        </td>
                        <td><?=$list['price']?></td>
                        <td><?=$list['t_date']?></td>
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
    //        $("._assess").click(function(e) {
    //            e.preventDefault();
    //
    //            var url = "assess.php";
    //            var f = document.frmAssess;
    //            f.g_id.value = $(this).attr("g_id");
    //            f.g_name.value = $(this).attr("g_name");
    //
    //            var pop_title = "popupOpener" ;
    //            window.open("", pop_title) ;
    //
    //            f.target = pop_title ;
    //            f.action = url ;
    //
    //            f.submit() ;
    //        });

</script>
</body>
</html>

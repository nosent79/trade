<?php
    require_once "../Database.php";
    require_once "../common/html/header_bootstrap.html";

    include_once "../common/html/button.html";

    $db = new Database();

    if(!isMember()) {
        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
    }

    $params = [
        'gubun' => 'S',
        'state' => $_REQUEST['state'] ?? 'P',
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
        ?>
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

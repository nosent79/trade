<?php
    require_once "../Database.php";
    require_once "../common/html/header_bootstrap.html";

    include_once "../common/html/button.html";

    $db = new Database();

    if(!isMember()) {
        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
    }
?>
    <div class="row">
        <?php
        include_once "../common/html/mypage/left.html";
        ?>
    </div>
</div>
<script src="../common/js/mypage.js"></script>
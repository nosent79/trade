<?php
require_once "../Database.php";
require_once  "../common/html/header.html";

if (($_REQUEST['tr_code'] ?? "") === "") {
    redirectAlert(SITE_URL.SITE_PORT."/", "잘못된 접근입니다.");
}

$tr_code = $_REQUEST['tr_code'];

//    if (!isMember()) {
//        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
//    }

$db = new Database();
$info = $db->getTradeDesc($tr_code);
$mileage = $db->getMileage();
?>

<script>
    $(function() {
        $("._goTradeDesc").click(function(e) {
            e.preventDefault();

            var tr_code = $(this).attr("tr_code");
            location.href="view.php?tr_code="+tr_code;
        });
    });
</script>
<?php
require_once "../common/html/footer.html"
?>
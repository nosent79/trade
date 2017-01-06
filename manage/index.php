<?php
    require_once "../Database.php";
    require_once "../common/html/header_bootstrap.html";

    if(!isAdmin()) {
        redirectSiteURL(SITE_URL. SITE_PORT."/manage/auth/login.php");
    }

    $db = new Database();
?>

<div class="container">
    <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?=SITE_URL.SITE_PORT?>/auth/logout.php"><span class="glyphicon glyphicon-log-in"></span> 로그아웃</a></li>
        </ul>
    </div>
</div>

<?php
    require_once  "../common/html/footer.html"
?>


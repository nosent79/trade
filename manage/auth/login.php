<?php
    require_once "../../Database.php";

    if(isAdmin()) {
        redirectSiteURL(SITE_URL.SITE_PORT . "/manage/index.php");
    }
?>

<!doctype html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="login_ok.php">
    <div class="imgcontainer">
    </div>

    <div class="container">
        <label><b>Admin ID</b></label>
        <input type="text" placeholder="Enter Admin ID" name="admin_id" required>

        <label><b>Admin Password</b></label>
        <input type="password" placeholder="Enter Admin Password" name="admin_pwd" required>

        <button type="submit">Login</button>
    </div>
</form>
</body>
</html>

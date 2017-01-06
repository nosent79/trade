<?php
    require_once "../Database.php";
    require_once  "../common/html/header_bootstrap.html";


    if (!isMember()) {
        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
    }

    $db = new Database();
?>

    <form id="frmMileage" name="frmMileage" method="post">
    <table >
        <colgroup>
            <col width="130">
            <col>
        </colgroup>
        <tbody>
        <tr>
            <th>충전금액</th>
            <td><input type="text" name="mileage_amt" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="button g_btn_red1" id="btnChargeMileage">충전하기</button>
                <button class="button g_btn_gray1" id="btnCancel">취소하기</button>
            </td>
        </tr>
        </tbody>
    </table>
    </form>
<script>
    $(function() {
        $("#btnChargeMileage").click(function(e) {
            e.preventDefault();

            var url = "<?=SITE_URL.SITE_PORT?>/ajax/chargeMileage.php";
            var params = $("#frmMileage").serialize();

            $.ajax({
                type: "post",
                url: url,
                data: params,
                dataType: 'json',
                success: function(res){
                    if(res.status == 'success') {
                        popupCloseAlert("적립되었습니다.")
                    } else {
                        alert("실패했습니다.");
                    }
                }
            });
        });

        $("#btnCancel").click(function() {
            self.close();
        });
    });
</script>

<?php
require_once "../common/html/footer.html";
?>

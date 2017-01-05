<?php
    require_once "../Database.php";
    require_once  "../common/html/header.html";

    if ((isset($_REQUEST['tr_code']) ? $_REQUEST['tr_code'] : "") === "") {
        redirectAlert(SITE_URL.SITE_PORT."/", "잘못된 접근입니다.");
    }
    
    $tr_code = $_REQUEST['tr_code'];
    
    if (!isMember()) {
        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
    }
    
    $db = new Database();
    $info = $db->getTradeDesc($tr_code);
?>
    <div class="g_content">
        <div>물품정보</div>
        <form id="frmDetail" name="frmDetail" method="post">
            <input type="hidden" name="tr_code" value="<?=$tr_code?>" />
            <table class="g_blue_table">
                <colgroup>
                    <col width="130">
                    <col width="250">
                    <col width="130">
                    <col>
                </colgroup>
                <tbody><tr>
                    <th>카테고리</th>
                    <td colspan="3"><?=$info['tr_cate'] . " > " . $info['tr_kind']?></td>
                </tr>
                <tr>
                    <th>물품제목</th>
                    <td colspan="3"><?=$info['tr_title']?></td>
                </tr>
                <tr>
                    <th>거래번호</th>
                    <td><?=$info['tr_code']?></td>
                    <th>등록일시</th>
                    <td><?=$info['t_date']?></td>
                </tr>
                <tr>
                    <th>구매수량</th>
                    <td><?=number_format($info['qty'])?></td>
                    <th>단위금액</th>
                    <td><?=number_format($info['price'])?></td>
                </tr>
                <tr>
                    <th>거래상태</th>
                    <td><?=$info['tr_state']?></td>
                    <th>예상결제금액</th>
                    <td><span class="trade_money1"><?=number_format($info['price'])?></span> 원</td>
                </tr>
                </tbody>
            </table>
        </form>
        <div style="padding-top:20px;text-align: center">
            <button id="btnSendComplete" class="button g_big_box1 ">물품인수 확인</button>
            <button id="btnCancel" class="button g_big_box1">취소</button>
        </div>
    </div>

    <script>
        $(function() {
            $("#btnSendComplete").click(function(e) {
                e.preventDefault();

                var url = "<?=SITE_URL.SITE_PORT?>/ajax/updateTradeState.php";
                var data = $("#frmDetail").serialize();

                $.ajax({
                    type: "post",
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(res){
                        if(res.status == 'success') {
                            popupCloseAlert("처리되었습니다.")
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
require_once "../common/html/footer.html"
?>
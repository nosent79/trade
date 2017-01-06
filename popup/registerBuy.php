<?php
    require_once "../Database.php";
    require_once  "../common/html/header_bootstrap.html";

    if (!isMember()) {
        redirectAlert(LOGIN_PATH."/login.php", "로그인 후 이용하세요.");
    }

    $db = new Database();
?>
<div>
    <div>
        <form id="frmTrade" name="frmTrade" method="post">
            <table class="g_blue_table" id="goods_info">
                <colgroup>
                    <col width="130">
                    <col>
                </colgroup>
                <tbody>
                <tr>
                    <th>카테고리</th>
                    <td>
                        <select name="tr_cate">
                            <option value="">선택</option>
                            <?php
                            $cate_list = $db->getCodes('trade_cate');
                            foreach($cate_list as $list) {
                            ?>
                            <option value="<?=$list['id']?>"><?=$list['name']?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>물품종류</th>
                    <td>
                        <input type="radio" name="tr_kind" id="rd_money" class="g_radio" value="M" checked>
                        <label id="spnGoods_money" for="rd_money">게임머니</label>
                        <input type="radio" name="tr_kind" id="rd_item" class="g_radio" value="I">
                        <label id="spnGoods_item" for="rd_item">아이템</label>
                        <input type="radio" name="tr_kind" id="rd_etc" class="g_radio" value="E">
                        <label id="spnGoods_etc" for="rd_etc">기타</label>
                    </td>
                </tr>
                <tr class="sell_type_tr">
                    <th>구매수량</th>
                    <td class="h_auto">
                        <div id="game_money">
                            <input type="text" name="qty" maxlength="7" class="g_text text_right">
                        </div>
                    </td>
                </tr>
                <tr class="sell_type_tr">
                    <th>구매금액</th>
                    <td>
                        <input type="text" name="price" maxlength="10" class="g_text text_right"> 원
                    </td>
                </tr>
                <tr>
                    <th>물품제목</th>
                    <td class="h_auto">
                        <input type="text" class="g_text mode-active" name="tr_title" maxlength="30">
                    </td>
                </tr>
                <tr>
                    <th>상세설명</th>
                    <td class="h_auto">
                        <textarea name="tr_desc" class="mode-active" ></textarea>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
        <div style="padding-top:20px; text-align:center;">
            <button id="btnRegisterBuy" class="button g_green1">구매등록</button>
            <button id="btnCancel" class="button g_red1">등록취소</button>
        </div>
    </div>
<script>
    $("#btnRegisterBuy").click(function(e) {
        e.preventDefault();

        var url = "<?=SITE_URL.SITE_PORT?>/ajax/registerBuy.php";
        var params = $("#frmTrade").serialize();

        $.ajax({
            type: "post",
            url: url,
            data: params,
            dataType: 'json',
            success: function(res){
                if(res.status == 'success') {
                    popupCloseAlert("정상적으로 등록되었습니다.");
                } else {
                    alert("실패했습니다.");
                }
            }
        });
    });

    $("#btnCancel").click(function(e) {
        e.preventDefault();
        popupClose("index.php");
    });
</script>
<?php
    require_once "../common/html/footer.html";
?>

<?php
    require_once "../Database.php";
    require_once  "../common/html/header_bootstrap.html";

//    if (($_REQUEST['tr_code'] ?? "") === "") {
    if ((isset($_REQUEST['tr_code']) ? $_REQUEST['tr_code'] : "") === "") {
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

<div class="g_content">
    <div>물품정보</div>
    <form id="frmPay" name="frmPay" method="post">
        <input type="hidden" id="real_use_mileage" name="real_use_mileage" value=<?=$info['price']?> />
        <input type="hidden" id="real_pay_amount" name="real_pay_amount" value=0 />
        <input type="hidden" id="my_mileage" name="my_mileage" value="<?=number_format($mileage)?>" />
        <input type="hidden" name="tr_code" value="<?=$info['tr_code']?>" />
        <input type="hidden" name="reg_m_id" value="<?=$info['reg_id']?>" />

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
    <div>결제정보</div>
    <div id="charge_box">
        <ul id="price_info" class="g_sideway">
            <li><img src="http://img3.itemmania.com/images/sell/img_buy_price.gif" width="52" height="16" alt="구매금액" class="g_icon"></li>
            <li class="price_font1"><span id="trade_money"><?=number_format($info['price'])?></span><img src="http://img3.itemmania.com/images/sell/img_won.gif" width="12" height="15" alt="원" class="g_icon"></li>
            <li class="math_icon"><img src="http://img3.itemmania.com/images/sell/img_minus.gif" width="23" height="23" alt="마이너스" class="g_icon"></li>
            <li><img src="http://img3.itemmania.com/images/sell/img_cp_dc.gif" width="51" height="16" alt="쿠폰할인" class="g_icon"></li>
            <li class="price_font2"><span id="use_coupon_price">0</span><img src="http://img3.itemmania.com/images/sell/img_won.gif" width="12" height="15" alt="원" class="g_icon"></li>
            <li class="math_icon"><img src="http://img3.itemmania.com/images/sell/img_equ.gif" width="24" height="24" alt="=" class="g_icon"></li>
            <li><img src="http://img3.itemmania.com/images/sell/img_total.gif" width="68" height="16" alt="총결제금액" class="g_icon"></li>
            <li class="price_font3"><span id="pay_mileage"><?=number_format($info['price'])?></span><img src="http://img3.itemmania.com/images/sell/img_won.gif" width="12" height="15" alt="원" class="g_icon"></li>
        </ul>
        <ul id="my_mileage" class="g_right">
            <li>
                <span class="g_left g_black2_b">내 마일리지</span>
                <span id="span_cur_mile" class="g_right"><?=number_format($mileage)?> 원</span>
            </li>
            <li>
                <span class="g_left g_black2_b">사용할 마일리지</span>
                <span class="g_right"><input type="text" class="g_text" id="pay_mileage2" name="pay_mileage2" value="0" onkeyPress="InpuOnlyNumber(this);" onfocusout="payment();">원</span>
            </li>
            <li>
                <span class="g_right"><button id="btnUseMileage">전액사용</button></span>
            </li>
            <li>
                <span class="g_left g_black2_b">결제하실 금액</span>
                <span class="g_right"><input type="text" class="g_text" id="changePayment" name="changePayment" value="<?=number_format($info['price'])?>" readonly="">원</span>
            </li>
        </ul>
    </div>
    <table class="g_blue_table">
        <colgroup>
            <col width="130">
            <col>
        </colgroup>
        <tbody><tr>
            <th>결제방식</th>
            <td id="payment_td">
                <input type="radio" name="payment_type" class="g_radio" value="mileage" id="rd_mileage" checked="">
                <label for="rd_mileage">마일리지</label>
            </td>
            <th>마일리지</th>
            <td><span class="g_right g_btn_gray1 g_button" id="btnChargeMileage">마일리지 충전 &gt;</span></td>
        </tr>
        </tbody>
    </table>
    <div class="g_btn">
        <img src="http://img4.itemmania.com/images/btn/btn_buy.gif" width="128" height="37" alt="구매신청" class="g_button first" id="btnApplyTrade">
        <img src="http://img4.itemmania.com/images/btn/btn_info_cancel1.gif" width="128" height="37" alt="취소하기" id="btnCancel"></a>
    </div>
    </form>
</div>
<script>
    function calculatePrice()
    {
        var price = 0;
        var use_amt = parseInt($("#real_use_mileage").val());
        var pay_amt = parseInt(<?=$info['price']?>);
        var my_mileage = parseInt(<?=$mileage?>);

        if (use_amt > my_mileage) {
            alert('사용할 마일리지가 보유하신 마일리지보다 큽니다.');
            $("#pay_mileage2").val(0)
            return false;
        }

        if (use_amt > pay_amt) {
            alert('사용할 마일리지가 결제하실 금액보다 큽니다.');
            $("#pay_mileage2").val(0)
            return false;
        }

        price = pay_amt - use_amt;
        return price;
    }

    function payment()
    {
        // 입력받은 사용할 마일리지 금액을 히든값에 저장
        $("#real_use_mileage").val($("#pay_mileage2").val());

        // 계산
        var price = calculatePrice();

        $("#changePayment").val(price);
        $("#real_pay_amount").val(price);
        $("#pay_mileage2").val(numberWithCommas($("#pay_mileage2").val()));
        $("#changePayment").val(numberWithCommas($("#changePayment").val()));
    }

    $(function() {
        $("#btnChargeMileage").click(function() {
            var url = "../popup/chargeMileage.php";
            var opt = "width=400, height=300, resizable=no, scrollbars=no, status=no;";

            popupOpen(url, opt);
        });

        $("#btnApplyTrade").click(function() {
            if (confirm("구매하시겠습니까?")) {

                var price = calculatePrice();
                var url = "<?=SITE_URL.SITE_PORT?>/ajax/payment.php";
                var params = $("#frmPay").serialize();

                if (price !== 0) {
                    alert("결제금액을 확인해주세요");
                    return false;
                }

                $.ajax({
                    type: "post",
                    url: url,
                    data: params,
                    dataType: 'json',
                    success: function(res){
                        if(res.status == 'success') {
                            goUrlAndAlert("<?=BUY_PATH. "/"?>", "정상적으로 처리되었습니다.");
                        } else {
                            alert("실패했습니다.");
                        }
                    }
                });
            }
        });

        $("#btnCancel").click(function() {
            goUrl("<?=BUY_PATH . "/"?>");
        });

        $("#btnUseMileage").click(function(e) {
            e.preventDefault();

            // 보유 마일리지가 총 결제금액보다 적은 경우 충전 요청
            if (false === calculatePrice()) {
                return;
            }

            // 사용할 마일리지 뿌려주기
            $("#pay_mileage2").val($("#pay_mileage").text());
            $("#changePayment").val(0);
        });

    });
</script>


<?php
    require_once "../common/html/footer.html";
?>

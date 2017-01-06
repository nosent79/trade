<?php
    require_once "../Database.php";
    require_once "../common/html/header_bootstrap.html";

    include_once "../common/html/button.html";

    $db = new Database();

//    $tr_kind = $_REQUEST['tr_kind'] ?? "all";
$tr_kind = isset($_REQUEST['tr_kind']) ? $_REQUEST['tr_kind'] : 'all';
?>
    <div class="g_content">
        <div class="g_tab" id="search_goods_tab">
            <div class="_kind selected" name="tr_kind" value="all">ALL</div>
            <div class="_kind" name="tr_kind" value="M">게임머니</div>
            <div class="_kind" name="tr_kind" value="I">아이템</div>
            <div class="_kind last " name="tr_kind" value="E">기타</div>
        </div>
        <div>
            <table style="width:980px;">
                <thead>
                <tr>
                    <th>카테고리</th>
                    <th>종류</th>
                    <th>거래제목</th>
                    <th>수량</th>
                    <th>거래금액</th>
                    <th>등록시간</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $buy_list = $db->getTradeList('B', $tr_kind);
                    $complete = "g_black6";

                    foreach($buy_list as $list) {
                        ('S' === $list['tr_state']) ?: $complete = "";
                ?>
                    <tr>
                        <td class="first <?=$complete?>"><?=$list['tr_title']?></td>
                        <td class="<?=$complete?>"><?=$list['tr_title']?></td>
                        <td class="s_left <?=$complete?>">
                            <div class="g_left trade_title">
                                <a href="#" tr_code="<?=$list['tr_code']?>" class="_goTradeDesc <?=$complete?>"><?=$list['tr_title']?></a>
                            </div>
                        </td>
                        <td class="<?=$complete?>"><?=$list['qty']?></td>
                        <td class="s_right  g_red1 <?=$complete?>"><?=$list['price']?></td>
                        <td class=" <?=$complete?>"><?=$list['t_date']?></td>
                    </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
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
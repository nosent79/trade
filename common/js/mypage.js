/**
 * Created by 최진욱 on 2017-01-05.
 */
$(function() {
    $("#btnMain").click(function(e) {
        goUrl("index.php")
    });

    $("#btnSellMember").click(function(e) {
        goUrl("sell.php")
    });

    $("#btnSellApplyMember").click(function(e) {
        goUrl("sell_apply.php")
    });

    $("#btnBuyMember").click(function(e) {
        goUrl("buy.php")
    });

    $("#btnBuyApplyMember").click(function(e) {
        goUrl("buy_apply.php")
    });

    $("#btnHistoryMileage").click(function(e) {
        goUrl("mileage_list.php")
    });

    $("#btnChargePoint").click(function(e) {
        goUrl("?mileage_flag=P")
    });

    $("#btnUsePoint").click(function(e) {
        goUrl("?mileage_flag=M")
    });

    $("._goBuyDesc").click(function(e) {
        e.preventDefault();

        var tr_code = $(this).attr("tr_code");
        var url = "../popup/detailBuy.php?tr_code="+tr_code;
        var opt = "width=768, height=600, resizable=no, scrollbars=no, status=no;";

        popupOpen(url, opt)
    });

    $("._goSellDesc").click(function(e) {
        e.preventDefault();

        var tr_code = $(this).attr("tr_code");
        var url = "../popup/detailSell.php?tr_code="+tr_code;
        var opt = "width=768, height=600, resizable=no, scrollbars=no, status=no;";

        popupOpen(url, opt)
    });

    $("._assess").click(function(e) {
       e.preventDefault();

       var url = "assess.php";
       var f = document.frmAssess;
       f.t_m_id.value = $(this).attr("t_m_id");
       f.t_m_nm.value = $(this).attr("t_m_nm");

       var pop_title = "popupOpener" ;
       window.open("", pop_title) ;

       f.target = pop_title ;
       f.action = url ;

       f.submit() ;
    });


    $("#btnWait").click(function() {
        goUrl("?state=W");
    });

    $("#btnTrading").click(function() {
        goUrl("?state=P");
    });

    $("#btnComplete").click(function() {
        goUrl("?state=S");
    });

    $("#btnCancel").click(function() {
        goUrl("?state=C");
    });
});

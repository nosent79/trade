    $(document).ready(function() {
        $("#btnMyPage").click(function() {
            location.href = "../mypage/index.php";
        });
        $("#btnLogin").click(function() {
            location.href = "../auth/login.php";
        });
        $("#btnJoin").click(function() {
            location.href = "../auth/join.php";
        });
        $("#btnBuy").click(function() {
            location.href = "../buy/index.php";
        });
        $("#btnSell").click(function() {
            location.href = "../../sell/index.php";
        });
        $("#btnBuyRegister").click(function() {
            var url = "../popup/registerBuy.php";
            var opt = "width=600, height=600, resizable=no, scrollbars=no, status=no;";

            popupOpen(url, opt);
        });
        $("#btnSellRegister").click(function() {
            var url = "../popup/registerSell.php";
            var opt = "width=600, height=600, resizable=no, scrollbars=no, status=no;";

            popupOpen(url, opt);
        });

        $("._kind").click(function(e) {
            e.preventDefault();

            var tr_kind = $(this).attr("value");
            location.href = "?tr_kind="+tr_kind;
        });
    });

    function popupOpen(url, opt)
    {
        var popUrl = url;	//팝업창에 출력될 페이지 URL
        var popOption = opt;    //팝업창 옵션(optoin)


        window.open(popUrl, "", popOption);
    }

    function popupOpenPost(f, url){

    }

    function popupCloseAlert(msg)
    {
        alert(msg);
        self.close();
    }

    function popupClose()
    {
        self.close();
    }

    function goUrl(url)
    {
        location.href = url;
    }

    function goUrlAndAlert(url, msg)
    {
        alert(msg);
        location.href = url;
    }

    function InpuOnlyNumber(obj)
    {
        if (event.keyCode >= 48 && event.keyCode <= 57) { //숫자키만 입력
            return true;
        } else {
            event.returnValue = false;
        }
    }

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
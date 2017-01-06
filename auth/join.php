<?php
    require_once "../Database.php";
    require_once "../common/html/header_bootstrap.html";

    include_once "../common/html/button.html";

    $db = new Database();

    if(isMember()) {
        redirectAlert(SITE_URL. SITE_PORT. "/", "이미 로그인하셨습니다.");
    }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>

<article class="container">
    <div class="col-md-12">
        <div class="page-header">
            <h1>회원가입 <small>horizontal form</small></h1>
        </div>
        <form class="form-horizontal" name="transform" method="post">
            <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail">이메일</label>
                <div class="col-sm-6">
                    <input class="form-control" id="u_email" name="u_email" type="email" placeholder="이메일">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="u_pwd_1">비밀번호</label>
                <div class="col-sm-6">
                    <input class="form-control" id="u_pwd_1" name="u_pwd_1" type="password" placeholder="비밀번호">
                    <p class="help-block">숫자, 특수문자 포함 8자 이상</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="u_pwd_2">비밀번호 확인</label>
                <div class="col-sm-6">
                    <input class="form-control" id="u_pwd_2" name="u_pwd_2" type="password" placeholder="비밀번호 확인">
                    <p class="help-block">비밀번호를 한번 더 입력해주세요.</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="u_name">이름</label>
                <div class="col-sm-6">
                    <input class="form-control" id="u_name" name="u_name" type="text" placeholder="이름">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="u_birth_year">출생년도</label>
                <div class="col-sm-6">
                    <select id="u_birth_year" name="u_birth_year" class="selectpicker">
                        <option value="">선택</option>
                        <?php
                        for ($i = 1997; $i > 1970; $i--) {
                            ?>
                            <option value="<?=$i?>"><?=$i."년"?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="u_location">거주지역</label>
                <div class="col-sm-6">
                    <select id="u_location" name="u_location" class="selectpicker">
                        <option value="">선택</option>
                        <?php
                        $location = $db->getCodes('location');
                        foreach($location as $v) {
                            ?>
                            <option value="<?=$v['id']?>"><?=$v['name']?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="u_cellphone">휴대폰번호</label>
                <div class="col-sm-6">
                    <input class="form-control" id="u_cellphone" name="u_cellphone" type="tel" placeholder="- 없이 입력해 주세요" />
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-primary" id="btnJoinOK">회원가입<i class="fa fa-check spaceLeft"></i></button>
                    <button class="btn btn-danger" id="btnCancel">가입취소<i class="fa fa-times spaceLeft"></i></button>
                </div>
            </div>



        </form>
        <hr>
    </div>
</article>

<script src="<?=SITE_URL.SITE_PORT?>/common/js/validation.js"></script>
<script src="<?=SITE_URL.SITE_PORT?>/common/js/jquery.checkbox.min.js"></script>
<script type="text/javascript">
    $(function() {
        $("#btnJoinOK").click(function(e) {
            e.preventDefault();

            check_submit();
        });
    });

    function check_submit(){
        var frm = document.transform;

        if (checkEmail(frm.u_email) == false) { return; }
        if (!imiValidate.checkPassword(frm.u_email, frm.u_pwd_1, frm.u_pwd_2 )) { return;};
        if (!isValidType(frm.u_name, 'text', '이름을 입력하여 주세요.' )) { return; }
        if (checkstring(frm.u_name.value) == true) { alert("이름입력에 특수문자는 입력할수 없습니다."); return;}
        if (!check_input_byte(frm.u_name.value,10)) { alert("입력 할 수 있는 문자길이를 초과하였습니다."); return;}
        if (!isValidType(frm.u_birth_year, 'select', '출생년도을 선택해 주세요.' )) { return; }
        if (!isValidType(frm.u_location, 'select', '거주지역을 선택하여 주세요.' )) { return; }
        if (!isValidType(frm.u_cellphone, 'number', '핸드폰번호를 입력해주세요' )) { return; }
        if (!hp_chck_array(frm.u_cellphone.value)) { alert("핸드폰 번호가 올바르지 않습니다."); frm.u_cellphone.focus(); return; }

        frm.action = "join_ok.php";
        frm.submit();
    }
</script>
<?php
require_once  "../common/html/footer.html"
?>


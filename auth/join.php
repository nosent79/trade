<?php
/**
 * Created by PhpStorm.
 * User: 최진욱
 * Date: 2016-12-27
 * Time: 오후 4:06
 */
    require_once "../Database.php";

    $db = new Database();

    if(isMember()) {
        redirectAlert(SITE_URL. SITE_PORT. "/", "이미 로그인하셨습니다.");
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=SITE_TITLE?></title>
    <link rel="stylesheet" href="<?=SITE_URL.SITE_PORT?>/common/css/common.css">
    <link rel="stylesheet" href="<?=SITE_URL.SITE_PORT?>/common/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="<?=SITE_URL.SITE_PORT?>/common/js/common.js"></script>
    <script src="<?=SITE_URL.SITE_PORT?>/common/js/validation.js"></script>
    <script src="<?=SITE_URL.SITE_PORT?>/common/js/jquery.checkbox.min.js"></script>
    <script type="text/javascript">
        function check_submit(){
            var frm = document.transform;

            if(frm.u_name.value == $('#u_name').data('defaultValue')) { alert('이름을 입력하여 주세요.'); return; }
            if(!isValidType(frm.u_name, 'text', '이름을 입력하여 주세요.' )){ return; }
            if(checkstring(frm.u_name.value) == true){alert("이름입력에 특수문자는 입력할수 없습니다."); return;}
            if(!check_input_byte(frm.u_name.value,10)){alert("입력 할 수 있는 문자길이를 초과하였습니다."); return;}
            if(!isValidType(frm.u_ident1, 'select', '출생년도을 선택해 주세요.' )){ return; }
//            if(!isValidType(frm.u_ident2, 'check', '성별을 선택하여 선택하여 주세요.' )){ return; }
//            if(!isValidType(frm.u_edu, 'select', '학력을 선택하여 주세요.')){ return; }
//            if(!isValidType(frm.u_work, 'select', '직업종류를 선택하여 주세요.' )){ return; }
            if(!isValidType(frm.u_location, 'select', '거주지역을 선택하여 주세요.' )){ return; }
//            if(!isValidType(frm.u_salary, 'select', '자산을 선택하여 주세요.' )){ return; }
            if(!isValidType(frm.u_hp1, 'select', '핸드폰번호 앞자리를 선택하여 주세요.' )){ return; }
            if(!isValidType(frm.u_hp2, 'number', '핸드폰번호 중간자리를 입력하여 주세요.' )){ return; }
            if(!isValidType(frm.u_hp3, 'number', '핸드폰번호 끝자리를 입력하여 주세요.' )){ return; }

            if(!hp_chck_array(frm.u_hp2.value) && !hp_chck_array(frm.u_hp3.value)){
                alert("핸드폰 번호가 올바르지 않습니다.");
                frm.u_hp3.focus();
                return;
            }

            if(checkEmail(frm.u_email,frm.u_email_domain,frm.u_email_domain_select) == false){ return; }

            frm.action = "join_ok.php";

            frm.submit();
        }

        $(document).ready(function(){

            $('select.select').each(function(){
                var title = $(this).attr('title');
                if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
                $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                    .after('<span class="select">' + title + '</span>')
                .change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                })
            });

            $('select.select-etc').each(function() {
                var title = $(this).attr('title');
                if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
                $(this)
                .css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
                    .after('<span class="select-etc">' + title + '</span>')
                .change(function(){
                    val = $('option:selected',this).text();
                    $(this).next().text(val);
                })
            });

            $('input#u_sex1:radio').checkbox({cls:'chk1'});
            $('input#u_sex2:radio').checkbox({cls:'chk2'});

            var u_name = $("#u_name");
            u_name.data('defaultValue', '이름');
            u_name.attr('value', u_name.data('defaultValue'));
            u_name
            .bind('focus click keydown', function() {
                if (u_name.attr('value') == u_name.data('defaultValue')) {
                    u_name.attr('value','');
                }
                u_name.addClass('focusIn');
            })
            .focusout(function() {
                if (u_name.attr('value') == '') {
                    u_name.attr('value',u_name.data('defaultValue'));
                }
                u_name.removeClass('focusIn');
            })
        });

        //체크박스,라디오버튼 체크표시 label class 변경/ 실제 체크박스 checked 별도 처리
        function check_class_togle(obj,addclass,removeclass,index)
        {
            var now_class;
            var this_obj;

            this_obj = $(obj);

            if (index >= 0)
            {
                now_class = this_obj.eq(index).attr("class");
            }
            else
            {
                now_class = this_obj.attr("class");
            }

            if (addclass.length > 0 && now_class.indexOf(addclass) < 0 )
            {
                if (index >= 0)
                {
                    this_obj.eq(index).addClass(addclass);
                }
                else
                {
                    this_obj.addClass(addclass);
                }
            }

            if (removeclass.length > 0 && now_class.indexOf(removeclass) > 0 )
            {
                if (index >= 0)
                {
                    this_obj.eq(index).removeClass(removeclass);
                }
                else
                {
                    this_obj.removeClass(removeclass);
                }
            }
        }


    </script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?=SITE_TITLE?></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?=SITE_URL.SITE_PORT?>">Home</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div style="width:100%;">
    <form class="match_Form" name="transform" method="post">
        <div id="endingwrap">
            <div id="con">
                <div class="ending_1">
                    <ul>
                        <li class="in1"><input type="text" id="u_name" name="u_name" maxlength="10" value=""></li>
                        <li class="in8">
                            <input type="text" id="u_email1" name="u_email" style="width:130px;" />
                            <span>@</span>
                            <div class="select-etc" style="float:right;">
                                <select name="u_email_domain_select" id="u_email_domain_select" class="select-etc" title="이메일" >
                                    <option value="">선택</option>
                                    <option value="naver.com">naver.com</option>
                                    <option value="hanmail.net">hanmail.net</option>
                                    <option value="gmail.com">gmail.com</option>
                                    <option value="empal.com">empal.com</option>
                                    <option value="nate.com">nate.com</option>
                                    <option value="dreamwiz.com">dreamwiz.com</option>
                                    <option value="hotmail.com">hotmail.com</option>
                                    <option value="korea.com">korea.com</option>
                                    <option value="paran.com">paran.com</option>
                                    <option value="hanafos.com">hanafos.com</option>
                                    <option value="freechal.com">freechal.com</option>
                                    <option value="lycos.co.kr">lycos.co.kr</option>
                                    <option value="chol.com">chol.com</option>

                                    <option value="input">직접입력</option>
                                </select>
                            </div>
                        </li>
                        <li class="in1">
                            <div class="select">
                                <select id="u_ident1" name="u_ident1" class="select" title="출생년도" style="z-index: 10; opacity: 0;">
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
                        </li>
                        <li class="in2">

                        </li>
                        <li class="in7">
                            <div class="select-etc">
                                <select name="u_hp1" class="select-etc" title="핸드폰" style="z-index: 10; opacity: 0;">
                                    <option value="">선택
                                    <option value="010">010</option>
                                    <option value="011">011</option>
                                    <option value="016">016</option>
                                    <option value="017">017</option>
                                    <option value="018">018</option>
                                    <option value="019">019</option>
                                </select>
                            </div><input type="text" name="u_hp2" maxlength="4" style="width:90px; margin-left:15px;"><input type="text" name="u_hp3" maxlength="4" class="last" style="width:90px;">
                        </li>
                        <li class="in6">
                            <div class="select">
                                <select id="u_location" name="u_location" class="select" title="거주지역" style="z-index: 10; opacity: 0;">
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
                        </li>

                        <li class="in1">
                            <input type="password" id="u_pwd1" name="u_pwd1" maxlength="20" value="">
                        </li>
                        <li class="in2">
                            <input type="password" id="u_pwd2" name="u_pwd2" maxlength="20" value="">
                        </li>
                    </ul>
                    <p class="btnComplete"><a href="javascript:check_submit();"><img src="<?=SITE_URL.SITE_PORT?>/common/images/btn_ending.png" alt="완료"></a></p>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
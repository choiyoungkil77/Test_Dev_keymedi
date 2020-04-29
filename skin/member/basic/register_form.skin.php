<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($member[mb_where] != "피부비만" && $w == "u"){
	alert("키메디 회원만 접근하실수 있습니다.","http://www.keymedi.com/");
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
?>
<style>
#register_wrap h1 { position:relative;width:100%;margin:20px 0;font-size: 38px;font-weight: 500;text-align: center; }
h4 { position:relative;width:100%;height:45px;font-size:25px;}

h5 { position:relative;width:100%;height:30px;font-size:18px;}

table.write_tb { position:relative;width:100%;border-top:1px solid #a0a0a0;border-collapse: collapse; border-spacing: 0;}
table.write_tb td { height:40px;border-bottom:1px solid #d1d1d1;font-size:14px;text-indent:20px;}
table.write_tb th { width:130px;height:40px;border-bottom:1px solid #d1d1d1;font-size:14px;background:#ebebeb;}

table.write_tb td.upline {border-bottom:1px solid #a0a0a0;}
table.write_tb th.upline {border-bottom:1px solid #a0a0a0;}
table.write_tb .new_v th {background:#979797;color:#fff;border-bottom:1px solid #d8d8d8;}
table.write_tb .new_v td {background:#f8f8f8;}
table.write_tb .new_v td input { background:#fff;}

#register_wrap { position:relative;background:#fbfbfb;}
#register_wrap .mbskin { position:relative;width:900px;height:auto;border:1px solid #d1d1d1;border-radius:10px;margin-top:50px;background:#fff;padding:45px;}

</style>

<? if($_SERVER['HTTPS'] == "on"){ ?>
<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<? }else{?>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/themes/base/jquery-ui.css" rel="stylesheet" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<? } ?>
 
<style type="text/css">
<!--
.ui-datepicker { font:12px dotum; }
.ui-datepicker select.ui-datepicker-month, 
.ui-datepicker select.ui-datepicker-year { width: 70px;}
.ui-datepicker-trigger { margin:0 0 -5px 2px; cursor:pointer;}
-->
</style> 

<script type="text/javascript">
jQuery(function($){
	$.datepicker.regional['ko'] = {
		closeText: '닫기',
		prevText: '이전달',
		nextText: '다음달',
		currentText: '오늘',
		monthNames: ['1월(JAN)','2월(FEB)','3월(MAR)','4월(APR)','5월(MAY)','6월(JUN)',
		'7월(JUL)','8월(AUG)','9월(SEP)','10월(OCT)','11월(NOV)','12월(DEC)'],
		monthNamesShort: ['1월','2월','3월','4월','5월','6월',
		'7월','8월','9월','10월','11월','12월'],
		dayNames: ['일','월','화','수','목','금','토'],
		dayNamesShort: ['일','월','화','수','목','금','토'],
		dayNamesMin: ['일','월','화','수','목','금','토'],
		weekHeader: 'Wk',
		dateFormat: 'yy-mm-dd',
		firstDay: 0,
		isRTL: false,
		showMonthAfterYear: true,
		yearSuffix: ''};
	$.datepicker.setDefaults($.datepicker.regional['ko']);

    $('.datepicker').datepicker({
        changeMonth: true,
		changeYear: true,
        showButtonPanel: true,
        yearRange: 'c-99:c+99',
//        minDate: '+2d',
		onSelect: function(dateText, inst) { } 
	  
    }); 


});
</script>
<!-- 회원정보 입력/수정 시작 { -->
 
<div id="register_wrap">
	<!-- <h1>회원가입</h1> -->
<? if(!$member[mb_id]){?>
	<h2><img src="http://www.keymedi.com/img/etc/process02.png" alt=""></h2>
<? }else{ ?>
<style>#register_wrap .mbskin {margin-top:0;}</style>
<?  }?>
<div class="mbskin">
	
    <script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
    <?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js"></script>
    <?php } ?>

    <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="url" value="<?php echo $urlencode ?>">
    <input type="hidden" name="agree" value="<?php echo $agree ?>">
    <input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<input type="hidden" name="agree3" id="agree3" value="<?php echo $agree3 ?>">
    <input type="hidden" name="agree4" id="agree4" value="<?php echo $agree4 ?>">

	<input type="hidden" name="mb_30" value="<?php echo $agree3 ?>,<?php echo $agree4 ?>">

    <input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
    <input type="hidden" name="cert_no" value="">
    <?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
    <?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
    <input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
    <input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
    <?php }  ?>
	<input type="hidden" name="mb_v" value="<?=($member[mb_v]=="")?$member_v:$member[mb_v]?>" />
	<input type="hidden" name="mb_where" value="<?=($member[mb_where])?$member[mb_where]:"메디포털"?>" /> 
    <input type="hidden" name="mb_17" value="<?=$member[mb_17]?>" />
    <div>
		<h4><?=($member[mb_id])?"":"02."?> 가입정보 <?=($member[mb_id])?"수정":"입력"?></h4>
		<p>저희 피비성몰은 <span style="color:#e63232;">병의원 사업자</span>를 위한 쇼핑몰로써 사업자 회원만 구매가 가능합니다.</p>
		<h5>개인정보</h5>
        <table class="write_tb">
        <!-- <caption>사이트 이용정보 입력</caption> -->
        <tbody>
		<tr>
            <th scope="row"><label for="reg_mb_name"><span style="color:#e63232;">*</span>이름<strong class="sound_only">필수</strong></label></th>
            <td>
                
                <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" <?php echo $required ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" size="10" <? if($config[cf_cert_use]!="0"){?>readonly="readonly"  onclick="ck_names(this.value);return false;" <? } ?> >
                <?php
                if($config['cf_cert_use']) {
                    if($config['cf_cert_ipin'])
                        echo '<button type="button" id="win_ipin_cert" class="btn_frmline">아이핀 본인확인</button>'.PHP_EOL;
                    if($config['cf_cert_hp'])
                        //echo '<button type="button" id="win_hp_cert" class="btn_frmline" style="text-indent:0;">휴대폰 본인확인</button>'.PHP_EOL;
					
					//if($_SERVER['REMOTE_ADDR'] == "121.134.72.163"){
						
						if($agree3 == "1" && $agree4 =="1"){
							echo '<button type="button" id="win_hp_cert_new2" class="btn_frmline" style="text-indent:0;">키메디 가입확인</button>'.PHP_EOL;
						}else{
							echo '<button type="button" id="win_hp_cert_new" class="btn_frmline" style="text-indent:0;">휴대폰 본인확인</button>'.PHP_EOL;
						}
					//}

                    echo '<noscript>본인확인을 위해서는 자바스크립트 사용이 가능해야합니다.</noscript>'.PHP_EOL;
                }
                ?>
                <?php
                if ($config['cf_cert_use'] && $member['mb_certify']) {
                    if($member['mb_certify'] == 'ipin')
                        $mb_cert = '아이핀';
                    else
                        $mb_cert = '휴대폰';
                ?>
                <div id="msg_certify">
                    <strong><?php echo $mb_cert; ?> 본인확인</strong><?php if ($member['mb_adult']) { ?> 및 <strong>성인인증</strong><?php } ?> 완료
                </div>
                <?php } ?>
				<!-- <span style="color:#e63232;font-size:13px;">휴대폰 본인확인은 인터넷 익스플로러에서만 가능합니다.</span> -->
            </td>
        </tr>
		<input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
		<input type="hidden" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
	
		<!-- 
        <?php if ($req_nick) {  ?>
        <tr>
            <th scope="row"><label for="reg_mb_nick"><span style="color:#e63232;">*</span>닉네임<strong class="sound_only">필수</strong></label></th>
            <td> 
				<? if($w=="u"){?>
				<input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
				<input type="hidden" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
				<?php echo $member['mb_nick'] ?>
				<?}else{?>
                <input type="hidden" name="mb_nick_default" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>">
                <input type="text" name="mb_nick" value="<?php echo isset($member['mb_nick'])?get_text($member['mb_nick']):''; ?>" id="reg_mb_nick" required class="frm_input required nospace" size="10" maxlength="20">
                <span id="msg_mb_nick"></span>
				<span class="frm_info">
                    공백없이 한글,영문,숫자만 입력 가능 (한글2자, 영문4자 이상)  
                </span>
				<? } ?>
            </td>
        </tr>
        <?php }  ?> -->
		<tr>
			<th scope="row"><label for="reg_mb_birth"><span style="color:#e63232;">*</span>생년월일<strong class="sound_only">필수</strong></label></th>
            <td><input type="text" name="mb_birth" id="reg_mb_birth" value="<?=$member[mb_birth]?>" <?php echo $required ?>  class="frm_input required <? if($config[cf_cert_use]=="0"){?>datepicker<? } ?>" required <? if($config[cf_cert_use]!="0"){?>readonly="readonly"<? } ?> size="10"> </td>        
		</tr>
        <tr>
            <th scope="row"><label for="reg_mb_id"><span style="color:#e63232;">*</span>아이디<strong class="sound_only">필수</strong></label></th>
            <td>
                <? if($readonly=="readonly"){?>
				<?php echo $member['mb_id'] ?>
				<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
				<?}else{?>
                <input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
                <span id="msg_mb_id"></span>
				<?
				if($agree3 == "1" && $agree4 =="1"){ }else{
					//echo '<button type="button" onclick="mem_ck();" class="btn_frmline" style="text-indent:0;">중복확인</button>'.PHP_EOL;
				}
				?>
				
				<span class="frm_info">영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요.</span>
				<? } ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_password"><span style="color:#e63232;">*</span>비밀번호<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20"></td>
        </tr>
        <tr>
            <th scope="row"><label for="reg_mb_password_re"><span style="color:#e63232;">*</span>비밀번호 확인<strong class="sound_only">필수</strong></label></th>
            <td><input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="frm_input <?php echo $required ?>" minlength="3" maxlength="20"></td>
        </tr>
     
 
 

        <tr>
            <th scope="row" class="upline"><label for="reg_mb_hp"><span style="color:#e63232;">*</span>휴대폰번호<?php if ($config['cf_req_hp']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td class="upline">
				
				<!-- <select name="wr_hp1" id="wr_hp1" class="frm_input" style="height:24px;width:90px;" >
					<option value="010" <?=($mb_hp[0]=="010")?"selected":"" ?>>010&nbsp;</option>
					<option value="011" <?=($mb_hp[0]=="011")?"selected":"" ?>>011</option>
					<option value="016" <?=($mb_hp[0]=="016")?"selected":"" ?>>016</option>
					<option value="017" <?=($mb_hp[0]=="017")?"selected":"" ?>>017</option>
					<option value="018" <?=($mb_hp[0]=="018")?"selected":"" ?>>018</option>
					<option value="019" <?=($mb_hp[0]=="019")?"selected":"" ?>>019</option>
				</select> -
				<input type="text" maxlength="4" size="5" class="frm_input required" required="" id="wr_hp2" value="<?=$mb_hp[1]?>" name="wr_hp2"> -
				<input type="text" maxlength="4" size="5" class="frm_input required" required="" id="wr_hp3" value="<?=$mb_hp[2]?>" name="wr_hp3"> -->
				
				<? if($w=='u'){ ?>
					<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp"  class="frm_input required" required maxlength="20" readonly>
				<? }else{ ?>
					<input type="text" name="mb_hp" value="<?php echo get_text($member['mb_hp']) ?>" id="reg_mb_hp"  class="frm_input required" required maxlength="20" >
				<? } ?>                
                <?php if ($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
                <input type="hidden" name="old_mb_hp" value="<?php echo get_text($member['mb_hp']) ?>">				
                <?php } ?>
				<? if($w=='u'){ ?>
				<span style="color:#e63232;font-size:13px;">휴대폰 변경이 필요하신 경우, 휴대폰본인확인을 해주세요.</span>
				<? } ?>
            </td>
        </tr> 
		

		<tr>
			<th scope="row"><label for="reg_mb_1"><span style="color:#e63232;">*</span>의사면허번호<strong class="sound_only">필수</strong></label></th>
			<td>
				<? if($w=='u'){?>
				<? echo $member[mb_1]; ?>
				<input type="hidden" name="mb_1" value="<?php echo $member['mb_1'] ?>" id="reg_mb_1" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="3" maxlength="20">
				<?}else{?>
				<input type="text" name="mb_1" id="reg_mb_1" value="<?=$member[mb_1]?>" required class="frm_input required" minlength="3" maxlength="20">
				<span style="color:#e63232;font-size:13px;">의사번호를 입력해주세요.</span>
				<? } ?>
			</td>
		</tr>

		<tr>
			<th scope="row"><label for="reg_mb_9">대표진료과</label></th>
			<td>
				<select name="mb_9" class="frm_input">
					<option value="" >- 선택해주세요 -</option>
					<option value="가정의학과" <?=($member[mb_9]=="가정의학과")?"selected":""?>>가정의학과</option>
					<option value="결핵과" <?=($member[mb_9]=="결핵과")?"selected":""?>>결핵과</option>
					<option value="내과" <?=($member[mb_9]=="내과")?"selected":""?>>내과</option>
					<option value="마취통증의학과" <?=($member[mb_9]=="마취통증의학과")?"selected":""?>>마취통증의학과</option>
					<option value="방사선종양학과" <?=($member[mb_9]=="방사선종양학과")?"selected":""?>>방사선종양학과</option>
					<option value="병리과" <?=($member[mb_9]=="병리과")?"selected":""?>>병리과</option>
					<option value="비뇨기과" <?=($member[mb_9]=="비뇨기과")?"selected":""?>>비뇨기과</option>
					<option value="산부인과" <?=($member[mb_9]=="산부인과")?"selected":""?>>산부인과</option>
					<option value="성형외과" <?=($member[mb_9]=="성형외과")?"selected":""?>>성형외과</option>
					<option value="소아청소년과" <?=($member[mb_9]=="소아청소년과")?"selected":""?>>소아청소년과</option>
					<option value="신경과" <?=($member[mb_9]=="신경과")?"selected":""?>>신경과</option>
					<option value="신경외과" <?=($member[mb_9]=="신경외과")?"selected":""?>>신경외과</option>
					<option value="안과" <?=($member[mb_9]=="안과")?"selected":""?>>안과</option>
					<option value="영상의학과" <?=($member[mb_9]=="영상의학과")?"selected":""?>>영상의학과</option>
					<option value="예방의학과" <?=($member[mb_9]=="예방의학과")?"selected":""?>>예방의학과</option>
					<option value="외과" <?=($member[mb_9]=="외과")?"selected":""?>>외과</option>
					<option value="응급의학과" <?=($member[mb_9]=="응급의학과")?"selected":""?>>응급의학과</option>
					<option value="이비인후과" <?=($member[mb_9]=="이비인후과")?"selected":""?>>이비인후과</option>
					<option value="일반의" <?=($member[mb_9]=="일반의")?"selected":""?>>일반의</option>
					<option value="재활의학과" <?=($member[mb_9]=="재활의학과")?"selected":""?>>재활의학과</option>
					<option value="정신건강의학과" <?=($member[mb_9]=="정신건강의학과")?"selected":""?>>정신건강의학과</option>
					<option value="정형외과" <?=($member[mb_9]=="정형외과")?"selected":""?>>정형외과</option>
					<option value="직업환경의학과" <?=($member[mb_9]=="직업환경의학과")?"selected":""?>>직업환경의학과</option>
					<option value="진단검사의학과" <?=($member[mb_9]=="진단검사의학과")?"selected":""?>>진단검사의학과</option>
					<option value="피부과" <?=($member[mb_9]=="피부과")?"selected":""?>>피부과</option>
					<option value="핵의학과" <?=($member[mb_9]=="핵의학과")?"selected":""?>>핵의학과</option>
					<option value="흉부외과" <?=($member[mb_9]=="흉부외과")?"selected":""?>>흉부외과</option>
				</select>
			</td>
		</tr>
		<tbody>
		</table>

		<h5>사업자 정보</h5>

		<table class="write_tb">
        <!-- <caption>사이트 이용정보 입력</caption> -->
        <tbody>

		<!-- 
		<tr>
			<th scope="row"><label for="reg_mb_11">근무처<strong class="sound_only">필수</strong></label></th>
			<td><input type="text" name="mb_11" value="<?php echo $member['mb_11']; ?>" id="reg_mb_11"  class="frm_input" maxlength="20"></td>
		</tr> 
		-->

		<!--  
		<tr>
            <th scope="row">
                주소
                <?php if ($config['cf_req_addr']) { ?><strong class="sound_only">필수</strong><?php }  ?>
            </th>
            <td>
                <label for="reg_mb_zip" class="sound_only">우편번호<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label>
                <input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>" id="reg_mb_zip" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input <?php echo $config['cf_req_addr']?"required":""; ?>" size="5" maxlength="6" style="margin-top:5px;">
                <button type="button"  style="text-indent:0;margin-top:5px;" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">주소 검색</button><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" <?php echo $config['cf_req_addr']?"required":""; ?> class="frm_input frm_address <?php echo $config['cf_req_addr']?"required":""; ?>" size="50">
                <label for="reg_mb_addr1">기본주소<?php echo $config['cf_req_addr']?'<strong class="sound_only"> 필수</strong>':''; ?></label><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="frm_input frm_address" size="50">
                <label for="reg_mb_addr2">상세주소</label>
                <br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="frm_input frm_address" size="50" readonly="readonly" style="margin-bottom:5px;">
                <label for="reg_mb_addr3">참고항목</label>
                <input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
            </td>
        </tr>
		<? $mb_tel = explode('-' , $member['mb_tel']);?>
		<tr>
            <th scope="row"><label for="reg_mb_tel">전화번호<?php if ($config['cf_req_tel']) { ?><strong class="sound_only">필수</strong><?php } ?></label></th>
            <td>
			<select name="mb_tel1" id="mb_tel1" class="frm_input" style="height:24px;width:90px;" >
					<option value="02" <?=($mb_tel[0]=="02")?"selected":"" ?>>02&nbsp;</option>
					<option value="031" <?=($mb_tel[0]=="031")?"selected":"" ?>>031</option>
					<option value="032" <?=($mb_tel[0]=="032")?"selected":"" ?>>032</option>
					<option value="033" <?=($mb_tel[0]=="033")?"selected":"" ?>>033</option>
					<option value="041" <?=($mb_tel[0]=="041")?"selected":"" ?>>041</option>
					<option value="042" <?=($mb_tel[0]=="042")?"selected":"" ?>>042</option>
					<option value="043" <?=($mb_tel[0]=="043")?"selected":"" ?>>043</option>
					<option value="051" <?=($mb_tel[0]=="051")?"selected":"" ?>>051</option>
					<option value="052" <?=($mb_tel[0]=="052")?"selected":"" ?>>052</option>
					<option value="053" <?=($mb_tel[0]=="053")?"selected":"" ?>>053</option>
					<option value="054" <?=($mb_tel[0]=="054")?"selected":"" ?>>054</option>
					<option value="055" <?=($mb_tel[0]=="055")?"selected":"" ?>>055</option>
					<option value="061" <?=($mb_tel[0]=="061")?"selected":"" ?>>061</option>
					<option value="062" <?=($mb_tel[0]=="062")?"selected":"" ?>>062</option>
					<option value="063" <?=($mb_tel[0]=="063")?"selected":"" ?>>063</option>
					<option value="064" <?=($mb_tel[0]=="064")?"selected":"" ?>>064</option>
					<option value="044" <?=($mb_tel[0]=="044")?"selected":"" ?>>044</option>
					<option value="070" <?=($mb_tel[0]=="070")?"selected":"" ?>>070</option>

				</select> -
				<input type="text" maxlength="4" size="5" class="frm_input" id="mb_tel2" value="<?=$mb_tel[1]?>" name="mb_tel2"> -
				<input type="text" maxlength="4" size="5" class="frm_input" id="mb_tel3" value="<?=$mb_tel[2]?>" name="mb_tel3">
				<input type="hidden" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel"  class="frm_input" maxlength="20">
				</td>
        </tr>


		
		<tr>
			<th scope="row"><label for="reg_mb_4">근무형태<strong class="sound_only">필수</strong></label></th>
			<td>
				<select name="mb_4" required class="frm_input required">
					<option value="" <?=($member[mb_4]=="")?"selected":""?>>- 선택해주세요 -</option>
					<option value="개원의" <?=($member[mb_4]=="개원의")?"selected":""?>>개원의</option>
					<option value="봉직의" <?=($member[mb_4]=="봉직의")?"selected":""?>>봉직의</option>
					<option value="인턴" <?=($member[mb_4]=="인턴")?"selected":""?>>인턴</option>
					<option value="레지던트" <?=($member[mb_4]=="레지던트")?"selected":""?>>레지던트</option>
					<option value="교직" <?=($member[mb_4]=="교직")?"selected":""?>>교직</option>
					<option value="전임의" <?=($member[mb_4]=="전임의")?"selected":""?>>전임의</option>
					<option value="공보의" <?=($member[mb_4]=="공보의")?"selected":""?>>공보의</option>
					<option value="군의관" <?=($member[mb_4]=="군의관")?"selected":""?>>군의관</option>
					<option value="휴직" <?=($member[mb_4]=="휴직")?"selected":""?>>휴직</option>
					<option value="해외" <?=($member[mb_4]=="해외")?"selected":""?>>해외</option>
					<option value="은퇴" <?=($member[mb_4]=="은퇴")?"selected":""?>>은퇴</option>
					<option value="기타" <?=($member[mb_4]=="기타")?"selected":""?>>기타</option>
				</select>
			</td>
		</tr> -->
	<? /* ?>
		<tr>
			<th scope="row"><label for="reg_mb_21">학회선택<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" maxlength="20" size="20" class="frm_input "  id="mb_21" value="<?=$member[mb_21]?>" name="mb_21"  readonly="readonly">
				<select name="mb_21_1" class="frm_input" onchange="javascript:set_mb_21(this.value);">
					<option value=" " >- 선택해주세요 -</option>
					<option value="대한검진의학회" <?=($member[mb_21]=="대한검진의학회")?"selected":""?>>대한검진의학회</option>
					<option value="대한노인의학회" <?=($member[mb_21]=="대한노인의학회")?"selected":""?>>대한노인의학회</option>
					<option value="대한밸런스의학회" <?=($member[mb_21]=="대한밸런스의학회")?"selected":""?>>대한밸런스의학회</option>
					<option value="대한산부인과의사회" <?=($member[mb_21]=="대한산부인과의사회")?"selected":""?>>대한산부인과의사회</option>
					<option value="대한성장의학회" <?=($member[mb_21]=="대한성장의학회")?"selected":""?>>대한성장의학회</option>
					<option value="대한약물영양의학회" <?=($member[mb_21]=="대한약물영양의학회")?"selected":""?>>대한약물영양의학회</option>
					<option value="대한여성성의학회" <?=($member[mb_21]=="대한여성성의학회")?"selected":""?>>대한여성성의학회</option>
					<option value="대한외과의사회" <?=($member[mb_21]=="대한외과의사회")?"selected":""?>>대한외과의사회</option>
					<option value="대한일차진료학회" <?=($member[mb_21]=="대한일차진료학회")?"selected":""?>>대한일차진료학회</option>
					<option value="한국임상고혈압학회" <?=($member[mb_21]=="한국임상고혈압학회")?"selected":""?>>한국임상고혈압학회</option>
					<option value="대한흉부심장혈관외과의사회" <?=($member[mb_21]=="대한흉부심장혈관외과의사회")?"selected":""?>>대한흉부심장혈관외과의사회</option>
					<option value="최소침습성형연구회" <?=($member[mb_21]=="최소침습성형연구회")?"selected":""?>>최소침습성형연구회</option>
					<option value="대한정주의학회" <?=($member[mb_21]=="대한정주의학회")?"selected":""?>>대한정주의학회</option>
					<!-- <option value="대한임상암대사의학회" <?=($member[mb_21]=="대한임상암대사의학회")?"selected":""?>>대한임상암대사의학회</option>
					<option value="제암거슨의학회" <?=($member[mb_21]=="제암거슨의학회")?"selected":""?>>제암거슨의학회</option> -->
					<option value="하지정맥류연구회" <?=($member[mb_21]=="하지정맥류연구회")?"selected":""?>>하지정맥류연구회</option>
					<option value="없음" <?=($member[mb_21]=="없음")?"selected":""?>>없음</option>
					<option value="" >기타</option>
				</select>
				<script>
					function set_mb_21(val) {
						if(val){
							$("#mb_21").val(val).attr("readonly", true);
						}else{
							$("#mb_21").val("").attr("readonly", false);
						}
					}
				</script>
			</td>
		</tr>

		<tr>
			<th scope="row" class="upline"><label for="mb_icon">의사인증파일<strong class="sound_only">필수</strong></label></th>
			<td class="upline">
							
				<?php
				if(!$member['mb_id']){
					$mb_ids = "ZZZZZZZZZZZZZZZZZZZZZZZZZZZZ";
				}else{
					$mb_ids = $member['mb_id'];
				}

				$mb_dir = substr($mb_ids,0,2);
				$icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_ids;
				if (file_exists($icon_file)) {
					$icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb_ids;
					echo '<a href="'.$icon_url.'" target="_blank"><img src="'.$icon_url.'" width="100" alt=""></a>';
					echo '<input type="checkbox" id="del_mb_icon" name="del_mb_icon" value="1">삭제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				
				<input type="file" name="mb_icon" id="reg_mb_icon" class="frm_input"  style="margin-top:5px;">

				<!-- <?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
				<img src="<?php echo $mb_icon_url ?>" alt="회원아이콘">
				<input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
				<label for="del_mb_icon">삭제</label> 
				<?php }  ?> -->
				<br>
				<span style="font-size:12px;margin-top:5px;padding-left:20px;">
					이미지 파일 형식으로 용량은 최대4MB 이하여야하며 육안으로 식별이 가능한 파일이어야 합니다.
					&nbsp;&nbsp;&nbsp;<input type="checkbox" name="mb_24" value="1" <?=($member['mb_24']=="1")?"checked":""?> /> 추후제출예정
				</span>
			</td>
		</tr> 

		<tr>
			 <th scope="row"><label for="reg_mb_22">가입경로<strong class="sound_only">필수</strong></label></th>
			 <td>
				<? if($w=='u'){?>
				<? echo $member['mb_22']; ?>
				<input type="hidden" name="mb_22" value="<?php echo $member['mb_22'] ?>" id="reg_mb_22" <?php echo $required ?> <?php echo $readonly ?> class="frm_input <?php echo $required ?> <?php echo $readonly ?>" minlength="2" maxlength="20">
				<?}else{?>
				<input type="radio" name="mb_22" value="인터넷 검색"   <?=($member['mb_22']=="인터넷 검색")?"checked":""?> onclick="ch_r(this.value);"/> 인터넷 검색&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="mb_22" value="지인추천"   <?=($member['mb_22']=="지인추천")?"checked":""?> onclick="ch_r(this.value);"/> 지인추천&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="mb_22" value="영업사원"   <?=($member['mb_22']=="영업사원")?"checked":""?> onclick="ch_r(this.value);"/> 영업사원&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="mb_22" value="SMS"   <?=($member['mb_22']=="SMS")?"checked":""?> onclick="ch_r(this.value);"/> SMS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="mb_22" value="기타"   <?=($member['mb_22']=="기타")?"checked":""?> onclick="ch_r(this.value);"/> 기타&nbsp;
				<input type="text" name="mb_23" id="reg_mb_23"  value="<?=$member['mb_23']?>" class="frm_input" />
				<? } ?>				
			 </td>
		</tr>
		<tr id="reg_mb_recommend_box" style="">
			<th scope="row"><label for="reg_mb_recommend">추천인아이디</label></th>
			<td><input type="text" name="mb_recommend" value="<?php echo $member['mb_recommend']; ?>" id="reg_mb_recommend"  class="frm_input" maxlength="20"></td>
		</tr>
		<tr id="reg_mb_26_box" style="display:none">
			<th scope="row"><label for="reg_mb_26">영업사원</label></th>
			<td><input type="text" name="mb_26" value="<?php echo $member['mb_26']; ?>" id="reg_mb_26"  class="frm_input" maxlength="20"></td>
		</tr>
		<script type="text/javascript">
			function ch_r(val){
				if(val == "지인추천"){ 
					document.getElementById("reg_mb_recommend_box").style.display = "";
					document.getElementById("reg_mb_23").style.display = "none";
					document.getElementById("reg_mb_26_box").style.display = "none";
				}else if(val == "기타"){
					document.getElementById("reg_mb_recommend_box").style.display = "none";
					document.getElementById("reg_mb_23").style.display = "";
					document.getElementById("reg_mb_26_box").style.display = "none";
				}else if(val == "영업사원"){
					document.getElementById("reg_mb_recommend_box").style.display = "none";
					document.getElementById("reg_mb_23").style.display = "none";
					document.getElementById("reg_mb_26_box").style.display = "";
				}else{
					document.getElementById("reg_mb_recommend_box").style.display = "none";
					document.getElementById("reg_mb_23").style.display = "none";
					document.getElementById("reg_mb_26_box").style.display = "none";
				}	
			}
			document.getElementById("reg_mb_recommend_box").style.display = "none";
			document.getElementById("reg_mb_23").style.display = "none";
			document.getElementById("reg_mb_26_box").style.display = "none";
		</script>
 <? */ ?>
		<input type="hidden" name="mb_shop" value="2" />

		<tr class="new_v">
			<th scope="row"><span style="color:#e63232;">*</span><label for="reg_mb_11">소속 의료기관명<strong class="sound_only">필수</strong></label></th>
			<td><input type="text" name="mb_11" value="<?php echo $member['mb_11']; ?>" required id="reg_mb_11"  class="frm_input" maxlength="20"></td>
		</tr>

		<tr id="new_v_1" class="new_v">
			<th scope="row"><span style="color:#e63232;">*</span><label for="reg_mb_5">병원주소<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="mb_5" value="<?php echo $member['mb_5']; ?>" id="reg_mb_5"  class="frm_input " size="5" maxlength="6" style="margin-top:5px;" required>
				<button type="button" class="btn_frmline" onclick="win_zip('fregisterform', 'mb_5', 'mb_6', 'mb_7', 'mb_7_tmp', '');" style="margin-top:5px;">주소 검색</button><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="mb_6" value="<?php echo get_text($member['mb_6']) ?>" id="reg_mb_6" class="frm_input frm_address" size="50" required><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="text" name="mb_7" value="<?php echo get_text($member['mb_7']) ?>" id="reg_mb_7" class="frm_input frm_address" size="50"  style="margin-bottom:5px;">
				<input type="hidden" name="mb_7_tmp" />	
				<br>
			</td>
		</tr>
		<tr id="new_v_2" class="new_v">
			<th scope="row"><span style="color:#e63232;">*</span><label for="reg_mb_8">병의원 전화번호<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="mb_8" value="<?php echo $member['mb_8']; ?>" id="reg_mb_8" required  class="frm_input " maxlength="20">
			</td>
		</tr>
		<!-- <tr id="new_v_3" class="new_v">
			<th scope="row"><label for="reg_mb_14">병의원 팩스번호<strong class="sound_only">필수</strong></label></th>
			<td>
				<input type="text" name="mb_14" value="<?php echo $member['mb_14']; ?>" id="reg_mb_14"  class="frm_input " maxlength="20">
			</td>
		</tr> -->
		<tr id="new_v_4" class="new_v">
			<th scope="row"><span style="color:#e63232;">*</span><label for="reg_mb_15">사업자등록번호<strong class="sound_only">필수</strong></label></th>
			<td><input type="text" name="mb_15" id="reg_mb_15" value="<?=$member[mb_15]?>"  class="frm_input "  minlength="3" maxlength="20" required> 예)000-00-00000</td>
		</tr>
		<tr id="new_v_5" class="new_v">
			<th scope="row"><label for="reg_mb_18">요양기관번호<strong class="sound_only">필수</strong></label></th>
			<td><input type="text" name="mb_18" value="<?php echo $member['mb_18']; ?>" id="reg_mb_18"  class=" frm_input" maxlength="20"></td>
		</tr>
		<tr id="new_v_6" class="new_v">
            <th scope="row"><label for="reg_mb_email"><span style="color:#e63232;">*</span>전자세금계산서 수취 이메일<strong class="sound_only">필수</strong></label></th>
            <td>
                <input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">

                <?$wr_email = explode('@' , $member['mb_email']);?>
				<input type="text" maxlength="255" size="10" class="frm_input required" required="" id="wr_email1" value="<?=$wr_email[0]?>" name="wr_email1">
				@ <input type="text" maxlength="255" size="10" class="frm_input required" required="" id="wr_email2" value="<?=$wr_email[1]?>" name="wr_email2">
				<select name="wr_email3" id="wr_email3" onchange="javascript:set_email2(this.value);" class="frm_input" style="height:24px;width:150px;" >
					<option value="" <?=($wr_email[1]=="")?"selected":"" ?> >- 이메일 선택 -</option>
					<option value="naver.com" <?=($wr_email[1]=="naver.com")?"selected":"" ?> >naver.com</option>
					<option value="daum.net" <?=($wr_email[1]=="daum.net")?"selected":"" ?> >daum.net</option>
					<option value="nate.com" <?=($wr_email[1]=="nate.com")?"selected":"" ?> >nate.com</option>
					<option value="hotmail.com" <?=($wr_email[1]=="hotmail.com")?"selected":"" ?> >hotmail.com</option>
					<option value="yahoo.com" <?=($wr_email[1]=="yahoo.com")?"selected":"" ?> >yahoo.com</option>
					<option value="empas.com" <?=($wr_email[1]=="empas.com")?"selected":"" ?> >empas.com</option>
					<option value="korea.com" <?=($wr_email[1]=="korea.com")?"selected":"" ?> >korea.com</option>
					<option value="dreamwiz.com" <?=($wr_email[1]=="dreamwiz.com")?"selected":"" ?> >dreamwiz.com</option>
					<option value="gmail.com" <?=($wr_email[1]=="gmail.com")?"selected":"" ?> >gmail.com</option>
					<option value="" >기타(직접입력)</option>
				</select>
				<input type="hidden" name="mb_email" value="<?php echo get_text($member['mb_email']) ?>" id="reg_mb_email"  class="frm_input" maxlength="20">
				<script>
					function set_email2(val) {
						document.getElementById('wr_email2').value = val;
					}
				</script>
            </td>
        </tr> 
		<tr id="new_v_7" class="new_v">
			<th scope="row"><!-- <span style="color:#e63232;">*</span> --><label for="reg_mb_icon2">사업자등록증<strong class="sound_only">필수</strong></label></th>
			<td>
				<?php
				if(!$member['mb_id']){
					$mb_ids = "ZZZZZZZZZZZZZZZZZZZZZZZZZZZZ";
				}else{
					$mb_ids = $member['mb_id'];
				}

				$mb_dir = substr($mb_ids,0,2);
				$icon_file = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_ids."_saup";
				$icon_file2 = G5_DATA_PATH.'/member/'.$mb_dir.'/'.$mb_ids."_saup.pdf";
				if (file_exists($icon_file) || file_exists($icon_file2)) {
					$icon_url = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb_ids."_saup";
					$icon_url2 = G5_DATA_URL.'/member/'.$mb_dir.'/'.$mb_ids."_saup.pdf";
					if (file_exists($icon_file)){
						echo '<a href="'.$icon_url.'" target="_blank"><img src="'.$icon_url.'" width="100" alt=""></a>';
					}
					if (file_exists($icon_file2)){
						echo '<a href="'.$icon_url2.'" target="_blank">사업자등록증</a> ';
					}
					echo '<input type="checkbox" id="del_mb_icon2" name="del_mb_icon2" value="1">삭제&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
				}
				?>
				
				<input type="file" name="mb_icon2" id="reg_mb_icon2" class="frm_input"  style="margin-top:5px;" >

				<!-- <?php if ($w == 'u' && file_exists($mb_icon_path)) {  ?>
				<img src="<?php echo $mb_icon_url ?>" alt="회원아이콘">
				<input type="checkbox" name="del_mb_icon" value="1" id="del_mb_icon">
				<label for="del_mb_icon">삭제</label> 
				<?php }  ?> -->
				<br>
				<span style="font-size:12px;margin-top:5px;padding-left:20px;">
					이미지, PDF 파일 형식으로 용량은 최대4MB 이하여야하며 육안으로 식별이 가능한 파일이어야 합니다.				
				</span><br>
				<span style="font-size:12px;margin-top:5px;padding-left:20px;">
					사업자등록증 첨부가 어려우신분들은 팩스 02-540-5597로 전송 바랍니다.
				</span>
			</td>
		</tr>
		<script type="text/javascript">
		/*
			function ch_r2(val){
				if(val == "2"){ 
					document.getElementById("new_v_1").style.display = ""; 
					document.getElementById("new_v_2").style.display = ""; 
					document.getElementById("new_v_3").style.display = ""; 
					document.getElementById("new_v_4").style.display = ""; 
					document.getElementById("new_v_5").style.display = ""; 
					document.getElementById("new_v_6").style.display = ""; 
					document.getElementById("new_v_7").style.display = ""; 
					<? if(!$member[mb_id]){?>
					//document.getElementById("reg_mb_5").value = document.getElementById("reg_mb_zip").value;
					//document.getElementById("reg_mb_6").value = document.getElementById("reg_mb_addr1").value;
					//document.getElementById("reg_mb_7").value = document.getElementById("reg_mb_addr2").value;
					<? } ?>

				}else{
					document.getElementById("new_v_1").style.display = "none";
					document.getElementById("new_v_2").style.display = "none";
					document.getElementById("new_v_3").style.display = "none";
					document.getElementById("new_v_4").style.display = "none";
					document.getElementById("new_v_5").style.display = "none";
					document.getElementById("new_v_6").style.display = "none";
					document.getElementById("new_v_7").style.display = "none";
				}	
			}
			document.getElementById("new_v_1").style.display = "none";
			document.getElementById("new_v_2").style.display = "none";
			document.getElementById("new_v_3").style.display = "none";
			document.getElementById("new_v_4").style.display = "none";
			document.getElementById("new_v_5").style.display = "none";
			document.getElementById("new_v_6").style.display = "none";
			document.getElementById("new_v_7").style.display = "none";
			ch_r2(<?=$member['mb_shop']?>);
		*/
		</script>
		
		<tr>
			<th scope="row">광고수신동의</th>
            <td>
                <input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($w=='' || $member['mb_mailling'])?'checked':''; ?>><label for="reg_mb_mailling">메일</label>
				<input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?php echo ($w=='' || $member['mb_sms'])?'checked':''; ?>><label for="reg_mb_sms">SMS</label>
            </td>
		</tr>

		<? /* ?>
        <?php if (isset($member['mb_open_date']) && $member['mb_open_date'] <= date("Y-m-d", G5_SERVER_TIME - ($config['cf_open_modify'] * 86400)) || empty($member['mb_open_date'])) { // 정보공개 수정일이 지났다면 수정가능  ?>
        <tr>
            <th scope="row"><label for="reg_mb_open">정보공개</label></th>
            <td>
                <!-- <span class="frm_info">
                    정보공개를 바꾸시면 앞으로 <?php echo (int)$config['cf_open_modify'] ?>일 이내에는 변경이 안됩니다.
                </span> -->
                <input type="hidden" name="mb_open_default" value="<?php echo $member['mb_open'] ?>">
                <input type="checkbox" name="mb_open" value="1" <?php echo ($w=='' || $member['mb_open'])?'checked':''; ?> id="reg_mb_open">
                다른분들이 나의 정보를 볼 수 있도록 합니다.
            </td>
        </tr>
        <?php } else {  ?>
        <tr>
            <th scope="row">정보공개</th>
            <td>
                <span class="frm_info">
                    정보공개는 수정후 <?php echo (int)$config['cf_open_modify'] ?>일 이내, <?php echo date("Y년 m월 j일", isset($member['mb_open_date']) ? strtotime("{$member['mb_open_date']} 00:00:00")+$config['cf_open_modify']*86400:G5_SERVER_TIME+$config['cf_open_modify']*86400); ?> 까지는 변경이 안됩니다.<br>
                    이렇게 하는 이유는 잦은 정보공개 수정으로 인하여 쪽지를 보낸 후 받지 않는 경우를 막기 위해서 입니다.
                </span>
                <input type="hidden" name="mb_open" value="<?php echo $member['mb_open'] ?>">
            </td>
        </tr>
        <?php }  ?>
		<? */ ?>
		</tbody>
		</table>

		<table class="write_tb">
        <!-- <caption>사이트 이용정보 입력</caption> -->
        <tbody>
        <tr>
            <th scope="row"><span style="color:#e63232;">*</span>자동등록방지</th>
            <td><?php echo captcha_html(); ?></td>
        </tr>
        </tbody>
        </table>
    </div>
	<br>
    <div class="btn_confirm">
        <input type="submit" value="<?php echo $w==''?'회원가입':'정보수정'; ?>" id="btn_submit" class="btn_submit" accesskey="s">
        <a href="<?php echo G5_URL ?>" class="btn_cancel">취소</a>
    </div>
    </form>

    <script>
    $(function() {
        $("#reg_zip_find").css("display", "inline-block");

        <?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
        // 아이핀인증
        $("#win_ipin_cert").click(function() {
            if(!cert_confirm())
                return false;

            var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
            certify_win_open('kcb-ipin', url);
            return;
        });

        <?php } ?>
        <?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
        // 휴대폰인증
        $("#win_hp_cert").click(function() {
            if(!cert_confirm())
                return false;

            <?php
            switch($config['cf_cert_hp']) {
                case 'kcb':
                    $cert_url = G5_OKNAME_URL.'/hpcert1.php';
                    $cert_type = 'kcb-hp';
                    break;
                case 'kcp':
                    $cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
                    $cert_type = 'kcp-hp';
                    break;
                case 'lg':
                    $cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
                    $cert_type = 'lg-hp';
                    break;
                default:
                    echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
                    echo 'return false;';
                    break;
            }
            ?>

            certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>");
            return;
        });
		$("#win_hp_cert_new").click(function() {
			certify_win_open("kmc-hp", "/plugin/kmchp/kmcis_web_sample_step01.php");
            return;
		});

		$("#win_hp_cert_new2").click(function() {
			certify_win_open("kmc-hp", "/help/keymedi_use.php");
            return;
		});

        <?php } ?>
    });
	function mem_ck(){
		var msg = reg_mb_id_check2();
		if (msg) {
			if(confirm(msg)){
				certify_win_open("kmc-hp", "/help/keymedi_use.php");
			}else{
				document.fregisterform.mb_id.value = "";
			}


			document.fregisterform.mb_id.select();
			return false;
		}else{
			alert("입력하신 ID: "+document.fregisterform.mb_id.value+" 는 사용가능합니다 \n사용하시겠습니까?");
		}
	}
    // submit 최종 폼체크
    function fregisterform_submit(f)
    {
		f.mb_email.value = f.wr_email1.value+"@"+f.wr_email2.value; 
		f.mb_17.value = f.mb_email.value;
		<?php if ($w=='')  {?>
		f.mb_nick_default.value = f.mb_name.value;
		f.mb_nick.value = f.mb_name.value;
		<? } ?>
		
		var regExp = /^01([0|1|6|7|8|9]?)-?([0-9]{3,4})-?([0-9]{4})$/; 
		if( !regExp.test( f.mb_hp.value ) ) {
			  alert("잘못된 휴대폰 번호입니다. 숫자, - 를 포함한 숫자만 입력하세요.");
			  return false
		}
		var num_regExp = /^[0-9]{1,20}$/;
		if(!num_regExp.test( f.mb_1.value ) ) {
			  alert("의사면허번호는 숫자만 입력하세요.");
			  return false
		}
		if(f.mb_18.value != ""){
			if(!num_regExp.test( f.mb_18.value ) ) {
				  alert("요양기관번호는 숫자만 입력하세요.");
				  return false
			}
		}
		var mb_15_regExp = /^([0-9]{3})-?([0-9]{2})-?([0-9]{5})$/; 
		if( !mb_15_regExp.test( f.mb_15.value ) ) {
			  alert("잘못된 사업자등록번호 입니다.");
			  return false
		}	  
		var date_regExp = /^([0-9]{4})-?([0-9]{2})-?([0-9]{2})$/; 
		if( !date_regExp.test( f.mb_birth.value ) ) {
			  alert("잘못된 생년월일입니다. 숫자, - 를 포함한 숫자만 입력하세요.");
			  return false
		}

        // 회원아이디 검사
        if (f.w.value == "") {
            var msg = reg_mb_id_check();
            if (msg) {
                alert(msg);
                f.mb_id.select();
                return false;
            }
        }
		<? if($w != 'u'){?>
		/*
        if (f.mb_icon.value == "") {
            if (!f.mb_24.checked) {
                alert("의사인증파일이 없을 경우 추후제출예정에 체크해 주십시요.");
                f.mb_24.focus();
                return false;
            }
        }
		*/
		<? } ?>
        if (f.w.value == "") {
            if (f.mb_password.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password.focus();
                return false;
            }
        }

        if (f.mb_password.value != f.mb_password_re.value) {
            alert("비밀번호가 같지 않습니다.");
            f.mb_password_re.focus();
            return false;
        }

        if (f.mb_password.value.length > 0) {
            if (f.mb_password_re.value.length < 3) {
                alert("비밀번호를 3글자 이상 입력하십시오.");
                f.mb_password_re.focus();
                return false;
            }
        }

        // 이름 검사
        if (f.w.value=="") {
            if (f.mb_name.value.length < 1) {
                alert("이름을 입력하십시오.");
                f.mb_name.focus();
                return false;
            }

           /*
            var pattern = /([^가-힣\x20])/i;
            if (pattern.test(f.mb_name.value)) {
                alert("이름은 한글로 입력하십시오.");
                f.mb_name.select();
                return false;
            }
            */
        } 
        <?php if($w == '' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
        // 본인확인 체크
        if(f.cert_no.value=="") {
            alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
            return false;
        }
        <?php } ?> 
        // 닉네임 검사
		/*
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_nick.defaultValue != f.mb_nick.value)) {
            var msg = reg_mb_nick_check();
            if (msg) {
                alert(msg);
                f.reg_mb_nick.select();
                return false;
            }
        }
		*/
		// 의사번호 체크
		/*
        if ((f.w.value == "") || (f.w.value == "u" && f.reg_mb_1.defaultValue != f.reg_mb_1.value)) {
            var msg = reg_mb_1_check();
            if (msg) {
                alert(msg);
                f.reg_mb_1.select();
                return false;
            }
        }
		*/
        // E-mail 검사
        if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
          
			var msg = reg_mb_email_check(); 

            if (msg) {
                alert(msg);
                f.reg_mb_email.select();
                return false;
            }
        }

        <?php if (($config['cf_use_hp'] || $config['cf_cert_hp']) && $config['cf_req_hp']) {  ?>
        // 휴대폰번호 체크
		/*
        var msg = reg_mb_hp_check();
        if (msg) {
            alert(msg);
            f.reg_mb_hp.select();
            return false;
        }
		*/
        <?php } ?>

        if (typeof f.mb_icon != "undefined") {
           
			if (f.mb_icon.value) {
                if (!f.mb_icon.value.toLowerCase().match(/.(gif|jpg|png|bmp|JPG|PNG)$/i)) {
                    alert("회원아이콘이 gif|jpg|png|bmp 파일이 아닙니다.");
                    f.mb_icon.focus();
                    return false;
                }
            }
        }
		if (typeof f.mb_icon2 != "undefined") {
           
			if (f.mb_icon2.value) {
                if (!f.mb_icon2.value.toLowerCase().match(/.(gif|jpg|png|bmp|JPG|PNG|pdf)$/i)) {
                    alert("이미지 혹은 PDF 파일만 첨부할 수 있습니다.");
                    f.mb_icon2.focus();
                    return false;
                }
            }
        }
		

        if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
            if (f.mb_id.value == f.mb_recommend.value) {
                alert("본인을 추천할 수 없습니다.");
                f.mb_recommend.focus();
                return false;
            }

            var msg = reg_mb_recommend_check();
            if (msg) {
                alert(msg);
                f.mb_recommend.select();
                return false;
            }
        }
		<?php if ($w=='u') { ?>
		if(f.mb_shop[0].checked){
			if(f.mb_5.value == ""){
				alert("병원주소를 입력해주세요");
				f.mb_5.focus();
				return false;

			}
			if(f.mb_8.value == ""){
				alert("병의원 전화번호를 입력해주세요");
				f.mb_8.focus();
				return false;

			}
			if(f.mb_14.value == ""){
				alert("병의원 팩스번호를 입력해주세요");
				f.mb_14.focus();
				return false;

			}
			if(f.mb_15.value == ""){
				alert("사업자등록번호를 입력해주세요");
				f.mb_15.focus();
				return false;

			}
			if(f.mb_18.value == ""){
				alert("요양기관번호를 입력해주세요");
				f.mb_18.focus();
				return false;

			}
			if(f.mb_17.value == ""){
				alert("세금계산서 이메일을 입력해주세요");
				f.mb_17.focus();
				return false;

			}

		} 
		<? } ?>

        <?php echo chk_captcha_js();  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

	function ck_names(val){
		if(!val){
			alert("본인인증시 자동입력 됩니다");
		}
	}
    </script>

</div>
</div>
<!-- } 회원정보 입력/수정 끝 -->
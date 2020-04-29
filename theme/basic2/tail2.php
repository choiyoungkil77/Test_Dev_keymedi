<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}
?>


<?php 
if(basename($_SERVER['PHP_SELF']) != "index.php" ){
?>
		</div>
	</div>	
</div>


<?php } ?>


<!-- TAIL S -->
 

	<div id="tail_wrap">

	<div id="tail_top_wrap">
		<div id="tail_top">
			<ul>
				<li class="fL"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=intro">서비스 소개</a></li>
				<li class="fL bars">|</li>
				<li class="fL"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=0801">공지사항</a></li>
				<li class="fL bars">|</li>
				<li class="fL"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=provision">이용약관</a></li>
				<li class="fL bars">|</li> 
				<li class="fL"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=privacy"><span style="font-weight:bold">개인정보처리방침</span></a></li>
				<li class="fL bars">|</li>
				<li class="fL"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=0801">고객센터</a></li>
				<li class="fL bars">|</li>
				<li class="fL"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=online2">제휴제안</a></li> 
				<li class="fL bars">|</li>
				<li class="fL"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=bannerguide">광고가이드</a></li>
			</ul>
			<div id="site_move">
				<fieldset>
					<legend>관련사이트</legend>
					<form name="site" method="get">
						<select name="select_site" id="select_site" onchange="if(this.options[this.selectedIndex].value != '')window.open(this.options[this.selectedIndex].value,'_blank')">
							<option value="">관련사이트</option>
							<option value="http://keydoc.co.kr">키닥</option>
							<option value="http://keymedi.com">키메디</option>
							<option value="http://shop.keymedi.com/">키메디몰</option>
							<option value="http://obgys.keymedi.com">산부인과협동조합</option>
						</select>
					</form>
				</fieldset>
			</div>
		</div>
	</div>

	<div id="tail">
		<h1><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/nt.png" alt="<?php echo $config['cf_title']; ?>"></a></h1>
		<p style="position:absolute;left:0px;top:92px;font-size:16px;color:#e0e0e0;letter-spacing:-0.25px;">고객센터 02-549-9985</p>
		<address>
			<p>법인명:(주)키닥&nbsp;&nbsp;|&nbsp;&nbsp;서울특별시 강남구 영동대로 702,403호(청담동,화천회관빌딩)&nbsp;&nbsp;|&nbsp;&nbsp;대표:장명준&nbsp;&nbsp;|&nbsp;&nbsp;사업자등록번호:338-81-00767</p>
			<p>팩스:02-540-5597&nbsp;&nbsp;|&nbsp;&nbsp;이메일:keymedi@keydoc.co.kr</p>
			<p>키메디 대표전화:02-549-9985&nbsp;&nbsp;|&nbsp;&nbsp;키메디몰 대표전화:070-4467-9738&nbsp;&nbsp;|&nbsp;&nbsp;고객센터:09:00~18:00 운영(점심시간:11:30~12:30) 토,일,공휴일 휴무</p>
			<p>통신판매번호:제2017-서울강남-03514호&nbsp;&nbsp;|&nbsp;&nbsp;개인정보관리책임자:오동현&nbsp;&nbsp;|&nbsp;&nbsp;메일:peaceoh@keydoc.co.kr&nbsp;&nbsp;|&nbsp;&nbsp;Copyrightⓒkeydoc All Right Reserved.</p>
		</address>
	</div>
</div>
	
</div>
<!-- TAIL E -->
<script type="text/javascript">
function ch_url(url){
	if(url){
		document.location.href = url;
	}else{

	}
	
}

</script>

										
<?php


if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>
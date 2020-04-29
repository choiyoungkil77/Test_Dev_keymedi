<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');


if(basename($_SERVER['PHP_SELF']) != "index.php" && $co_id != "privacy"  && $co_id != "provision"  &&  $_SERVER['PHP_SELF'] != "/bbs/register.php"){
	if(!$member[mb_id]){
		alert("키메디 로그인 이후 이용부탁드립니다.","/");
	}
}
?>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
$(document).ready(function(){ 
	$(".showcate a").on('click',function(){ 
		$("#cate_full2").css("height","0");
		if($(".showcate a img").attr("src") == "http://shop.kacsmall.com/img/main/top/menu_drop.png" ){
			$(".showcate a img").attr("src","http://shop.kacsmall.com/img/main/top/menu_fold.png");
			$("#cate_full").stop(true,true).animate({height:480},200);
		}else{
			$(".showcate a img").attr("src","http://shop.kacsmall.com/img/main/top/menu_drop.png");
			$("#cate_full").stop(true,true).animate({height:0},200);
		}
		
	}); 

	$("#cate_full").mouseleave(function(){ 
		$(".showcate a img").attr("src","http://shop.kacsmall.com/img/main/top/menu_drop.png");
		$("#cate_full").stop(true,true).animate({height:0},200);
	});

});

$(document).ready(function(){ 
	$(".showcate2 a").on('click',function(){ 
		$("#cate_full").css("height","0");	 
		$(".showcate a img").attr("src","http://shop.kacsmall.com/img/main/top/menu_drop.png");	
		if($("#cate_full2").css("height") == "0px")
		{
			$("#cate_full2").stop(true,true).animate({height:405},200);
		}else{
			$("#cate_full2").stop(true,true).animate({height:0},200);
		}

	}); 
	$("#cate_full2").mouseleave(function(){  
		$("#cate_full2").stop(true,true).animate({height:0},200);
	});

});

</script>

<?php
if(defined('_INDEX_')) { // index에서만 실행
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
}

if($co_id){
	$dep_1th = substr($co_id,0,2);
	$dep_2th = substr($co_id,2,2);
	$dep_3th = substr($co_id,4,2);
	$dep_4th = substr($co_id,6,2);
}else{
	$dep_1th = substr($bo_table,0,2);
	$dep_2th = substr($bo_table,2,2);
	
	if($bo_table == "online" ){
		$dep_1th = "06";
		$dep_2th = "01";
	}
	if($bo_table == "reservation" ){
		$dep_1th = "06";
		$dep_2th = "04";
	}
}

?>
<div id="wrap">
	<!-- <div id="popup_zone">

	</div> -->
	<div id="popup_layers_box" style="display:none;"></div>
	<div id="popup_layers" style="display:none;">
		<div class="box_cn">
			<a href="#" onclick="close_ly();return false;"><img src="<?php echo G5_IMG_URL ?>/nt.png" class="cl_btn"/></a>
		</div>
	</div>
	<div id="popup_layers2" style="display:none;">
		<div class="box_cn">
			<a href="#" onclick="close_ly();return false;"><img src="<?php echo G5_IMG_URL ?>/nt.png" class="cl_btn"/></a>
			<a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=register_form.php"><img src="<?php echo G5_IMG_URL ?>/nt.png" class="go_btn"/></a>
		</div>
	</div>
	
	<script type="text/javascript">
				function ck_use(url){
				<?if(!$member[mb_id]){?>
				//	alert("로그인이 필요한 서비스 입니다.");
				//	return false;
				<?}?>
				document.location.href = url;

				<? if($member[mb_level] == "1") { ?>
					//document.getElementById("popup_layers").style.display = "";
					//document.getElementById("popup_layers_box").style.display = "";
				<? }else if($member[mb_shop] != "2"){ ?>
					//document.getElementById("popup_layers2").style.display = "";
					//document.getElementById("popup_layers_box").style.display = "";
				<? }else{ ?>
					//document.location.href = url;
				<? } ?>
				}
				function close_ly(){
					document.getElementById("popup_layers").style.display = "none";
					document.getElementById("popup_layers2").style.display = "none";
					document.getElementById("popup_layers_box").style.display = "none";
				}
				<? if($member[mb_id] !="" && $member[mb_level] <= 1) { ?>				
					document.getElementById("popup_layers").style.display = "";
					document.getElementById("popup_layers_box").style.display = "";			
				<? } ?>
				</script>

	<div id="login_wraps"  style="display:none;">
		<div id="login_boxs"  >
			<a href="#" onclick="close_login();return false;"><img src="/img/main/top/close.png" alt="" class="btn_close"></a>
			<form name="flogin" action="/bbs/login_check.php" onsubmit="return flogin_submit(this);" method="post">
			<input type="hidden" name="url" value="/">

			<fieldset id="login_fs">
				<legend>회원로그인</legend> 
				<p class="lo_txt1">키메디 아이디로 로그인가능</p>
				<input type="text" name="mb_id" id="login_id" required class="frm_input required" size="20" maxLength="20" value="<?=get_cookie('ck_mb_id')?>"> 
				<input type="password" name="mb_password" id="login_pw" required class="frm_input required" size="20" maxLength="20">
				<input type="image" src="/img/nt.png" value="로그인" class="btn_submit2">
				<input type="checkbox" name="auto_login" id="login_auto_login" <?=(get_cookie('ck_mb_id'))?"checked":""?>> 
			</fieldset> 
					<a href="http://www.keymedi.com/help/id_01.php"  ><img src="/img/nt.png" alt="아이디찾기" class="btn_02"></a>
					<a href="http://www.keymedi.com/help/pw_01.php"  ><img src="/img/nt.png" alt="비밀번호찾기" class="btn_03"></a>
					<a href="/bbs/register.php"><img src="/img/nt.png" alt="회원 가입" class="btn_01"></a>
			</form>
		</div>
	</div>
	<div id="login_wraps_bg" style="display:none;"></div>
<script>
function open_login(){ 
	document.getElementById("login_wraps").style.display = "";
	document.getElementById("login_wraps_bg").style.display = "";
	return false;
}
function close_login(){ 
	document.getElementById("login_wraps").style.display = "none";
	document.getElementById("login_wraps_bg").style.display = "none";
	return false;
}
</script>

	<div id="head_wrap">
		<div id="head_top_wrap">
			<div id="head_top">
				<div id="head_dot1">
					<ul>
						<li class="fL"><a href="http://keymedi.com/bbs/content.php?co_id=0101" target="_blank">메디세미나</a></li>
						<li class="fL"><a href="http://keymedi.com/bbs/content.php?co_id=0200" target="_blank">메디튜브</a></li>
						<li class="fL"><a href="http://keymedi.com/bbs/content.php?co_id=0300" target="_blank">포인트존</a></li>
						<li class="fL"><a href="/bbs/board.php?bo_table=0401">고객센터</a></li>
					</ul>
				</div> 
				<div id="head_dot2">
					<ul>
						<li class="fL"><img src="<?php echo G5_IMG_URL ?>/main/top/gnb_partners.png" alt="" > <a href="<?php echo G5_BBS_URL ?>/content.php?co_id=0901">공급업체 안내</a></li>
				 
						<?php if ($is_member) {  ?>
						<li class="fL"><img src="<?php echo G5_IMG_URL ?>/main/top/gnb_logout.png" alt="" > <a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li> 
						<li class="fL"><img src="<?php echo G5_IMG_URL ?>/main/top/gnb_cart.png" alt="" > <a href="<?php echo G5_SHOP_URL; ?>/cart.php">장바구니</a></li> 
						<?php } else {  ?>  
						<li class="fL"><img src="<?php echo G5_IMG_URL ?>/main/top/gnb_logout.png" alt="" > <a href="#" onclick="open_login();return false;">로그인</a></li> 
						<li class="fL"><img src="<?php echo G5_IMG_URL ?>/main/top/join_icon.png" alt="" > <a href="/bbs/register.php">회원가입</a></li> 
						<?php }  ?> 
						

						
					</ul>
				</div>
			</div>
		</div>
		<div id="head">
			<h1><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>2/top_logo.png" alt="<?php echo $config['cf_title']; ?>"></a></h1>
	
			
			<fieldset id="hd_sch">
				
				<form name="frmsearch1" action="<?php echo G5_SHOP_URL; ?>/search.php" onsubmit="return search_submit(this);">
				<select name="s_select" id="sch_select_box">
					<option value="all" <?=($_GET[s_select]=="all")?"selected":""?>>전체</option>
					<option value="qname" <?=($_GET[s_select]=="qname")?"selected":""?>>상품명</option>
					<option value="qexplan" <?=($_GET[s_select]=="qexplan")?"selected":""?>>상품설명</option>
					<option value="qid" <?=($_GET[s_select]=="qid")?"selected":""?>>상품코드</option>
					<option value="it_5" <?=($_GET[s_select]=="it_5")?"selected":""?>>규격</option>
 

				</select>
				<label for="sch_str" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
				<input type="text" name="q" value="<?=($q_where=="main")?"":stripslashes(get_text(get_search_string($q))) ?>" id="sch_stx" required placeholder="검색어 입력" >
				<input type="image" src="<?php echo G5_IMG_URL ?>/main/top/serch_btn.png" value="검색" id="sch_stx_btn" >

				</form>
				<script>
				function search_submit(f) {
					if (f.q.value.length < 2) {
						alert("검색어는 두글자 이상 입력하십시오.");
						f.q.select();
						f.q.focus();
						return false;
					}

					return true;
				}
            </script>

			</fieldset>

			<?php include_once(G5_PATH.'/member_check.php'); ?>

			<div id="head_dot3">
				<?
					$sso = sql_fetch("select * from sso.user_sso where wr_key = 'KEYMEDI' and in_id = '$member[mb_id]' ");
					if($sso[in_id]){
						$url_link = "/bbs/content.php?co_id=0205&tab=vod&vod_select=%ED%95%9C%EA%B5%AD%ED%94%BC%EB%B6%80%EB%B9%84%EB%A7%8C%EC%84%B1%ED%98%95%ED%95%99%ED%9A%8C&price=&stx=&sst=wr_2&sod=desc";
						$url_link = urlencode($url_link);
						$url_sso = "http://www.keymedi.com/sso.php?return_url=".$url_link."&in_id=".$sso[in_id];
						$sso_onclick = "";
					}else{
						$url_sso = "#";
						$sso_onclick = "onclick='open_layer(\"layer_agree\",\"#\");return false;';";

					}
				?>
				 <a href="http://www.keymedi.com" target="_blank"><img src="/img2/top_bn.png" alt=""></a> 
			</div>
		</div>
		<div id="head_menu_wrap">
			<div id="head_menu">
				<ul class="dp1"> 
					
					<li class="fL dept showcate"><a href="#"><img src="<?php echo G5_IMG_URL ?>/main/top/menu_drop.png" alt=""/></a></li>
					<!-- <li class="fL dept"><a href="<?php echo G5_BBS_URL ?>/content.php?co_id=0101" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('menu_1','','<?php echo G5_IMG_URL ?>/main/top/menu_01ov.png',1);"><img src="<?php echo G5_IMG_URL ?>/main/top/menu_01.png" alt="" name="menu_1" id="menu_1" /></a></li> -->
					<li class="fL dept"><a href="<?php echo G5_SHOP_URL; ?>/event.php?sort=it_update_time&sortodr=desc" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('menu_2','','<?php echo G5_IMG_URL ?>/main/top/menu_02ov.png',1);"><img src="<?php echo G5_IMG_URL ?>/main/top/menu_02.png" alt="" name="menu_2" id="menu_2" /></a></li>
					<li class="fL dept showcate2"><a href="#" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('menu_3','','<?php echo G5_IMG_URL ?>/main/top/menu_03ov.png',1);"><img src="<?php echo G5_IMG_URL ?>/main/top/menu_03.png" alt="" name="menu_3" id="menu_3" /></a></li>
					<li class="fL dept"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=event" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('menu_4','','<?php echo G5_IMG_URL ?>/main/top/menu_04ov.png',1);"><img src="<?php echo G5_IMG_URL ?>/main/top/menu_04.png" alt="" name="menu_4" id="menu_4" /></a></li>
					<li class="fL dept"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=0401" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('menu_5','','<?php echo G5_IMG_URL ?>/main/top/menu_05ov.png',1);"><img src="<?php echo G5_IMG_URL ?>/main/top/menu_05.png" alt="" name="menu_5" id="menu_5" /></a></li>
					<li class="fL dept"><a href="<?php echo G5_SHOP_URL; ?>/mypage.php" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('menu_6','','<?php echo G5_IMG_URL ?>/main/top/menu_06ov.png',1);"><img src="<?php echo G5_IMG_URL ?>/main/top/menu_06.png" alt="" name="menu_6" id="menu_6" /></a></li>
					<li class="fL dept"><a href="http://gigi.keymedi.com/" target="_blank" onMouseOut="MM_swapImgRestore();" onMouseOver="MM_swapImage('menu_7','','<?php echo G5_IMG_URL ?>/main/top/menu_07ov.png',1);"><img src="<?php echo G5_IMG_URL ?>/main/top/menu_07.png" alt="" name="menu_7" id="menu_7" /></a></li>
				</ul>
				<div id="cate_full" style="height:0;">
					<div id="cate_full_dep1">
						<ul>
						<?php
							$sql1 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where LENGTH(ca_id) = '2' and ca_use = '1' and ca_id != 'i0' and left(ca_id,1) != 'f'  and site_code like '%mall%' order by ca_id , ca_order ";
						$result1 = sql_query($sql1);
						for ($i=0; $row1=sql_fetch_array($result1); $i++) { 
							echo "<li><a href='".G5_SHOP_URL."/list.php?ca_id=".$row1['ca_id']."' class='dep2_link dep2_link_".$row1['ca_id']."' onmouseover=shop_dep2('".$row1['ca_id']."');>".$row1['ca_name']."</a></li>";						}
						?>
						</ul>
					</div>
					<div id="cate_full_dep2">
						<?php
						$sql1 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where LENGTH(ca_id) = '2' and ca_use = '1' order by ca_id , ca_order ";
						$result1 = sql_query($sql1);
						while($row1=sql_fetch_array($result1)) { 
							echo "<ul id='dep2_".$row1['ca_id']."' class='dep2_class' style='display:none;'>";
							$sql2 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where LENGTH(ca_id) = '4' and left(ca_id,2) = '{$row1['ca_id']}' and ca_use = '1' order by ca_id , ca_order ";
							$result2 = sql_query($sql2);
							while($row2=sql_fetch_array($result2)) { 
								echo "<li><a href='".G5_SHOP_URL."/list.php?ca_id=".$row2['ca_id']."' class='dep3_link dep3_link_".$row2['ca_id']."' onmouseover=shop_dep3('".$row2['ca_id']."');>".$row2['ca_name']."</a></li>";	
							}
							echo "</ul>";
						}
						?>
					</div>
					<div id="cate_full_dep3">
						<?php
						$sql1 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where LENGTH(ca_id) = '4' and ca_use = '1' order by ca_id , ca_order ";
						$result1 = sql_query($sql1);
						while($row1=sql_fetch_array($result1)) { 
							echo "<ul id='dep3_".$row1['ca_id']."' class='dep3_class' style='display:none;'>";
							$sql2 = " select ca_id, ca_name from {$g5['g5_shop_category_table']} where LENGTH(ca_id) = '6' and left(ca_id,4) = '{$row1['ca_id']}' and ca_use = '1' order by ca_id , ca_order ";
							$result2 = sql_query($sql2);
							while($row2=sql_fetch_array($result2)) { 
								echo "<li><a href='".G5_SHOP_URL."/list.php?ca_id=".$row2['ca_id']."' class='dep4_link dep4_link_".$row2['ca_id']."'  onmouseover=shop_dep4('".$row2['ca_id']."'); >".$row2['ca_name']."</a></li>";	
							}
							echo "</ul>";
						}
						?>
					</div>
					<script>
					function shop_dep2(dep2){
						$(".dep2_class").css("display","none");
						$(".dep3_class").css("display","none");
						$(".dep2_link").removeClass("ov");

						$(".dep2_link_"+dep2).addClass("ov");
						$("#dep2_"+dep2).css("display","");
					}
					function shop_dep3(dep3){
						$(".dep3_class").css("display","none");
						$(".dep3_link").removeClass("ov");

						$(".dep3_link_"+dep3).addClass("ov");
						$("#dep3_"+dep3).css("display","");
					}
					function shop_dep4(dep4){
						$(".dep4_link").removeClass("ov");
						$(".dep4_link_"+dep4).addClass("ov");
					}
					<? if($ca_id){ ?>
					shop_dep2("<?=substr($ca_id,0,2)?>");
					shop_dep3("<?=substr($ca_id,0,4)?>");
					<? }else{?>
					shop_dep2("10");
					<? } ?>					
					</script> 
				</div>

				<div id="cate_full2" style="height:0;">
					<table width="100%" style="border-collapse: collapse;border-spacing: 0;">
						<tbody>
							<tr>
								<th width="190" style="border-bottom:1px solid #d7d7d7;font-size:18px;color:#fff;background:#01a3e5;">의약품</th>
								<td style="padding:20px;border-bottom:1px solid #d7d7d7;">
								<?
									$sql = "select * from {$g5['member_table']} where mb_v = '4' and mb_leave_date = '' and mb_13 = '1' and mb_28 like '%skin%' order by mb_nick asc"; 
									$res = sql_query($sql);
									while($row = sql_fetch_array($res)){
								?>
										<li class="fL" style="width:20%;height:30px;"><a href="/shop/seller.php?s_select=it_10&q2=<?=$row[mb_id]?>" style="font-size:15px;color:#646464;"><?=$row[mb_nick]?></a></li>
								<?
									}
								?>
								</td>
							</tr>
							<tr>
								<th width="190" style="border-bottom:1px solid #d7d7d7;font-size:18px;color:#fff;background:#01a3e5;">화장품/건기식</th>
								<td style="padding:20px;border-bottom:1px solid #d7d7d7;">
								<?
									$sql = "select * from {$g5['member_table']} where mb_v = '4' and mb_leave_date = '' and mb_13 = '2' and mb_28 like '%skin%' order by mb_nick asc"; 
									$res = sql_query($sql);
									while($row = sql_fetch_array($res)){
								?>
										<li class="fL" style="width:20%;height:30px;"><a href="/shop/seller.php?s_select=it_10&q2=<?=$row[mb_id]?>" style="font-size:15px;color:#646464;"><?=$row[mb_nick]?></a></li>
								<?
									}
								?>
								</td>
							</tr>
							<tr>
								<th style="border-bottom:1px solid #d7d7d7;font-size:18px;color:#fff;background:#01a3e5;">의료기기/장비</th>
								<td style="padding:20px;border-bottom:1px solid #d7d7d7;">
								<?
									$sql = "select * from {$g5['member_table']} where mb_v = '4' and mb_leave_date = '' and mb_13 = '3' and mb_28 like '%skin%' order by mb_nick asc"; 
									$res = sql_query($sql);
									while($row = sql_fetch_array($res)){
								?>
										<li class="fL" style="width:20%;height:30px;"><a href="/shop/seller.php?s_select=it_10&q2=<?=$row[mb_id]?>" style="font-size:15px;color:#646464;"><?=$row[mb_nick]?></a></li>
								<?
									}
								?>
								</td>
							</tr>
							<tr>
								<th style="border-bottom:1px solid #d7d7d7;font-size:18px;color:#fff;background:#01a3e5;">소모품</th>
								<td style="padding:20px;border-bottom:1px solid #d7d7d7;">
								<?
									$sql = "select * from {$g5['member_table']} where mb_v = '4' and mb_leave_date = '' and mb_13 = '4' and mb_28 like '%skin%' order by mb_nick asc"; 
									$res = sql_query($sql);
									while($row = sql_fetch_array($res)){
								?>
										<li class="fL" style="width:20%;height:30px;"><a href="/shop/seller.php?s_select=it_10&q2=<?=$row[mb_id]?>" style="font-size:15px;color:#646464;"><?=$row[mb_nick]?></a></li>
								<?
									}
								?>
								</td>
							</tr>
						</tbody>
					</table>				
				</div>
				<!-- <div id="head_left_menu">
			
					<?php// include_once(G5_SHOP_SKIN_PATH.'/boxcategory.skin.php'); // 상품분류 ?>
				
				</div>
				
				<div id="head_right_banner">
				<?php echo display_banner('왼쪽'); ?>
				</div> -->
			 
				<div id="sub_content2">
				<? if($_SERVER['PHP_SELF'] == "/shop/list.php"|| $_SERVER['PHP_SELF'] == "/shop/search.php" || $_SERVER['PHP_SELF'] == "/shop/search2.php" || $_SERVER['PHP_SELF'] == "/shop/seller.php"){ ?>
				<style>
				#sub_content { position:relative;width:610px;float:left;margin-bottom: 20px;}
				#sub_content2 { position:absolute;width:530px;min-height:300px;top:0;z-index:100;padding:20px;padding-top:5px;border-left:1px solid #c8c8c8;border-top:1px solid #000000;}
				#right_quick { position:absolute;right:-150px;top:70px;}
				</style>

				<iframe width="530" src="" onLoad="resizeHeight('itemview');" height="1050" frameborder="0"  scrolling="no" id="itemview" name="itemview"></iframe>
				<script type="text/javascript">
				function resizeHeight(name){
					var the_height = document.getElementById(name).contentWindow.document.body.scrollHeight;
					var the_height2 = the_height + 370;
					//alert(document.getElementById("sct_ct_1").height);
					document.getElementById(name).height = the_height + 50;

					
					$("#sub").attr("style","min-height:"+the_height2+"px");
					deep(2);

					$("#head_left_menu").attr("style","height:"+document.getElementById("sub_wrap").height+"px");
					
				}
				</script>

				<? } ?>
				</div>
				
				<div id="right_quick">
					<!-- <a href="/shop/cart.php"><img src="<?php echo G5_IMG_URL ?>/main/cart_btn.png"   alt="" style="margin-bottom:5px;"/></a><br>
					<a href="#" onclick="show_cp();return false;"><img src="/shop/img/cp_point_btn.png"   alt="" style="margin-bottom:5px;"/></a>
					<div id="show_cp_wrap" style="display:none;">
						<div class="pdpd">
						<h4>쿠폰/ 포인트 정책</h4>
						<p>1. 할인정책 (포인트 & 쿠폰)</p>
						<p style="color:red"> - 급여의약품 포함 주문건(공급사기준) 할인사용불가</p>
						<p> - 할인적용</p>
						<p>   > 쿠폰: 개별상품별 또는 공급사별로 적용가능</p>
						<p>   > 포인트: 공급사별 적용가능 (쿠폰과 중복사용가능)</p>
						<p>2. 포인트, 쿠폰 반환정책 (고객센터문의)</p>
						<p> - 전체 취소 및 전체 반품(제품하자)은 요청 즉시반환</p>
						<p>   부분 취소 및 부분 반품은 미반환</p>
						<p>※ 포인트,쿠폰 반환관련 예시</p>
						<p>① 반환 사례</p>
						<p>   - 입금 전 or 신용카드 결제 직후 주문리스트 변경을 위한 취소</p> 
						<p>   - 제품하자로 인한 전체반품</p>
						<p>② 미반환 사례</p>
						<p>  - 배송완료 후의 부분반품</p>
						</div>
						<div class="hd_pops_footer" style="border-left:2px solid #000;">				
							<a href="#" onclick="colse_cp();return false;"><button>닫기</button></a>
						</div>
					</div> -->
					<script>
						function show_cp(){ 
							document.getElementById("show_cp_wrap").style.display = "";
						}
						function colse_cp(){
							document.getElementById("show_cp_wrap").style.display = "none";
						}
					</script>
					<?php include_once(G5_SHOP_SKIN_PATH.'/boxcart.skin.php'); // 장바구니 ?>
					<?php include(G5_SHOP_SKIN_PATH.'/boxtodayview.skin.php'); // 오늘 본 상품 ?>
					<?//php include_once(G5_SHOP_SKIN_PATH.'/boxwish.skin.php'); // 위시리스트 ?>

					<?//php include_once(G5_SHOP_SKIN_PATH.'/boxevent.skin.php'); // 이벤트 ?>
					<!-- <br>
					<a href="#"><img src="<?php echo G5_IMG_URL ?>/main/bn_03.jpg"   alt=""/></a> -->
				</div>
			</div>
			
			

		</div>
	</div>
<!-- HEAD E -->
<script>
$(document).ready(function(){

var clientheight = $(document).height();
//alert(clientheight);
//$("#quick").height( clientheight );
/*	
$(window).scroll(function() {	
	if($('#head_wrap')){
		fty = $(window).scrollTop();
		scrollSystem(fty);
	};
});

function scrollSystem(_top){
		if(_top >= 300){ 
			$('#sub_menu .left_menu').css({'position':'fixed','top':0});
		}else{
			$('#sub_menu .left_menu').css({'position':'relative','top':0});
		}

}
*/
});	
</script>
<?php 
if(basename($_SERVER['PHP_SELF']) != "index.php" ){

if($_SERVER['PHP_SELF']=="/bbs/faq.php"){
	$dep_1th = "04";
}


if($_SERVER['PHP_SELF']=="/sitemap.php" || $_SERVER['PHP_SELF']=="/bbs/login.php" || $_SERVER['PHP_SELF']=="/bbs/register.php" || $_SERVER['PHP_SELF']=="/bbs/register_form.php"  || $co_id =="provision" || $co_id =="privacy" || $co_id =="site" || $_SERVER['PHP_SELF']=="/bbs/register_result.php"){
	$dep_1th = "10";

	if($_SERVER['PHP_SELF']=="/bbs/login.php"){
		$dep_2th = "01";
	}
	if($_SERVER['PHP_SELF']=="/bbs/register.php"){
		$dep_2th = "03";
	}
	if($_SERVER['PHP_SELF']=="/bbs/register_form.php"){
		$dep_2th = "03";
	}
	if($co_id =="provision"){
		$dep_2th = "05";
		$dep_3th = "";
	}
	if($co_id =="privacy"){
		$dep_2th = "06";
		$dep_3th = "";
	}
}

?>

	<style>
		#tail_wrap { margin-top:0;}
		#sub_content2 { right:0;}
	</style>
	<? if($bo_table == "0401" || $bo_table == "0402" || $bo_table == "0403" || $_SERVER['PHP_SELF']=="/bbs/faq.php"){?>
	<style>
	#sub_content { width:800px;margin:0 auto; float:none;} 
	</style>
	<? } ?>
	<div id="sub_wrap">
		
		<div id="sub">
		<? if($_SERVER['PHP_SELF'] == "/shop/list.php"){ ?>
		<? }else{?>
			<div id="sub_top"></div>
		<? } ?>
			<div id="sub_content">
			<? if($dep_1th == "04"){ ?>
			<div id="sub_menu"><?php include_once(G5_PATH.'/menu.php'); ?> </div>
			<? } ?>
	
<?php }else{ ?>
<style>
#right_quick { position:absolute;right:-100px;top:60px;}
</style>
<? }?>
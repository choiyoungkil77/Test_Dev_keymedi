<?php
$sub_menu = "200910";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if(!$year){ $year = date("Y");}
if(!$month){ $month = "1";}
if(!$grade){ $grade = "ROYAL";}

$month_tmp1 = "";
$month_tmp2 = "";
switch($month){
	case "1" : $month_tmp1 = "-01-01"; $month_tmp2 = "-03-31";break;
	case "2" : $month_tmp1 = "-04-01"; $month_tmp2 = "-06-31";break;
	case "3" : $month_tmp1 = "-07-01"; $month_tmp2 = "-09-31";break;
	case "4" : $month_tmp1 = "-10-01"; $month_tmp2 = "-12-31";break;
}

switch($grade){
	case "ROYAL" : $grade_tmp = "where m.price >= '3000000' "; break;
	case "GOLD" : $grade_tmp = "where m.price < '3000000' and m.price >= '1800000' "; break;
	case "SILVER" : $grade_tmp = "where m.price < '1800000' and m.price >= '600000' "; break;
	case "BASIC" : $grade_tmp = "where m.price < '600000' "; break;
}

if($year){
	$sql_search = " and left(od_receipt_time,10) between '{$year}{$month_tmp1}' and '{$year}{$month_tmp2}'   ";
}

$sql_common = " select * from ( select mb_id , sum(od_cart_price) as price from g5_shop_order  where left(od_id,2) = '20' and (od_status = '배송' or od_status = '완료') {$sql_search} group by mb_id order by price desc ) m {$grade_tmp} ";



 
 

$sql = " select count(*) as cnt from ( select mb_id , sum(od_cart_price) as price from g5_shop_order  where left(od_id,2) = '20' and (od_status = '배송' or od_status = '완료') {$sql_search} group by mb_id order by price desc ) m  {$grade_tmp} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$sql = " {$sql_common }  ";
$result = sql_query($sql);

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원 등급제 관리';
include_once('./admin.head.php');

$colspan = 7;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    총 <?php echo number_format($total_count) ?>개
</div>

<form name="fsearch" id="fsearch" class="local_sch01 local_sch" method="get">
<div class="sch_last">
	<select name="year" >
		<? for($i = 2017 ; $i <= date("Y"); $i++){?>
		<option value="<?=$i?>" <?=($i==$year)?"selected":""?>><?=$i?>년도</option>
		<? }?>
	</select>
    <select name="month" >
		<? for($i = 1 ; $i <= 4; $i++){?>
		<option value="<?=$i?>" <?=($i==$month)?"selected":""?>><?=$i?>분기</option>
		<? }?>
	</select>
	<select name="grade" >
		<option value="ROYAL" <?=($grade=="ROYAL")?"selected":""?>>ROYAL</option>
		<option value="GOLD" <?=($grade=="GOLD")?"selected":""?>>GOLD</option>
		<option value="SILVER" <?=($grade=="SILVER")?"selected":""?>>SILVER</option>
		<option value="BASIC" <?=($grade=="BASIC")?"selected":""?>>BASIC</option>
	</select>
    <input type="submit" class="btn_submit" value="검색">
</div>
</form>

<div class="btn_add01 btn_add">
    <!-- <a href="./poll_form.php" id="poll_add">투표 추가</a> -->
</div>

<form name="member_level" method="post" id="member_level" action="./member_level_update.php" autocomplete="off">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="<?php echo $token ?>">

<input type="hidden" name="years" value="<?php echo $year ?>">
<input type="hidden" name="months" value="<?php echo $month ?>">
<input type="hidden" name="grades" value="<?php echo $grade ?>">
<input type="hidden" name="mode" value="coupon">
<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col">
            <label for="chkall" class="sound_only">현재 페이지 투표 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col">순위</th>
        <th scope="col">아이디</th>
        <th scope="col">성명</th>
        <th scope="col">병원명</th>
        <th scope="col">구매금액</th>
        <th scope="col">등급</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
		$num = $from_record  + $i +1;
		$mem = get_member($row[mb_id]);
        $bg = 'bg'.($i%2);
    ?>

    <tr class="<?php echo $bg; ?>">
        <td class="td_chk"> 
            <input type="checkbox" name="chk[]" value="<?php echo $row['mb_id'] ?>" id="chk_<?php echo $i ?>">
        </td>
        <td class="td_num"><?php echo $num ?></td>
        <td class="td_mngsmall"><?php echo $row[mb_id] ?></td>
        <td class="td_mngsmall"><?php echo $mem['mb_name'] ?></td>
        <td class="td_mngsmall"><?php echo $mem['mb_11'] ?></td>
        <td class="td_mngsmall"><?php echo number_format($row[price]) ?></td>
        <td class="td_mngsmall"><?php echo $grade ?></td>
    </tr>

    <?php
    }

    if ($i==0)
        echo '<tr><td colspan="'.$colspan.'" class="empty_table">자료가 없습니다.</td></tr>';
    ?>
    </tbody>
    </table>
</div>

  




<div class="tbl_frm01 tbl_wrap">
	<table>
	<colgroup>
		<col class="grid_4">
		<col>
	</colgroup>
	<tbody>
	<tr>
		<th scope="row"><label for="mb_id">쿠폰종류<strong class="sound_only">필수</strong></label></th>
		<td>
			<select name="coupon_id">
				<? 
					$sql = " select * from g5_coupon  where 1 = 1 order by wr_id desc";
					$result = sql_query($sql);
					for ($i=0; $row=sql_fetch_array($result); $i++) {
				?>
					<option value="<?=$row[wr_id]?>"><?=$row[wr_subject]?> (금액 : <?=number_format($row[wr_price])?> 기간 : <?=$row[wr_sdate]?> ~ <?=$row[wr_edate]?>)</option>
				<? } ?>
			</select>
		</td>
	</tr>
	 
	<tr>
		<th scope="row"><label for="coupon_num">1인당 발급수</label></th>
		<td>
			<select name="coupon_num">
				<option value="1">1</option>
				<option value="2">2</option>
			</select>장
		</td>
	</tr> 

	</tbody>
	</table>
</div>

<div class="btn_confirm01 btn_confirm">
	<input type="submit" value="확인" class="btn_submit">
</div>

</form>

<?//php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<script>
$(function() {
    $('#fpolllist').submit(function() {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
            if (!is_checked("chk[]")) {
                alert("선택삭제 하실 항목을 하나 이상 선택하세요.");
                return false;
            }

            return true;
        } else {
            return false;
        }
    });
});
</script>

<?php
include_once ('./admin.tail.php');
?>
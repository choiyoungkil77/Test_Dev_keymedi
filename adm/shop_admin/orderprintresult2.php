<?php
$sub_menu = '500120';
include_once('./_common.php');

auth_check($auth[$sub_menu], "r");
 
header("Content-Type: text/html; charset=UTF-8");
header("Pragma: no-cache");

$filename = $member[mb_id]."_orderlist_".date("Y-m-d").".xls";

header( "Content-type: application/vnd.ms-excel" ); 
header( "Content-Disposition: attachment; filename=$filename" ); 
header( "Content-Description: PHP4 Generated Data" ); 
 
function conv_telno($t)
{
    // 숫자만 있고 0으로 시작하는 전화번호
    if (!preg_match("/[^0-9]/", $t) && preg_match("/^0/", $t))  {
        if (preg_match("/^01/", $t)) {
            $t = preg_replace("/([0-9]{3})(.*)([0-9]{4})/", "\\1-\\2-\\3", $t);
        } else if (preg_match("/^02/", $t)) {
            $t = preg_replace("/([0-9]{2})(.*)([0-9]{4})/", "\\1-\\2-\\3", $t);
        } else {
            $t = preg_replace("/([0-9]{3})(.*)([0-9]{4})/", "\\1-\\2-\\3", $t);
        }
    }

    return $t;
}


// MS엑셀 XLS 데이터로 다운로드 받음
 
    $fr_date = date_conv($fr_date);
    $to_date = date_conv($to_date);


	$sql = "select * FROM {$g5['g5_shop_order_table']} where 1 = 1 ";
	if($m_class){
		$sql .= " and com_id = '$m_class' ";
	}

	if($c_class){
		$sql .= " and left(od_id ,2) = '$c_class' ";
	}

	if($c_class=="98"){
		$site_fix = "shop_skin";
	}else{
		$site_fix = "shop";
	}

	if($a_class == "od_time"){
		$sql .= " and od_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
	}else{
		$sql .= " and od_receipt_time between '$fr_date 00:00:00' and '$to_date 23:59:59' ";
	}
	
	
	$sql .= " order by od_time asc ";
 
	//echo $sql;

    $result = sql_query($sql);




    $cnt = @sql_num_rows($result);
    if (!$cnt)
        alert("출력할 내역이 없습니다.");


	//주문번호/공급사명/상품명/규격/단위/단가/주문수량/총 주문가격/취소금액/쿠폰사용금액/회원아이디/의사명/병원명/사업자번호/주문시간/발송완료일시/현재주문상태
?>
<table border="1">
	<tr>
		<td>사이트구분</td>
		<td>PG번호</td>
		<td>주문번호</td>
		<td>공급사명</td>
		<td>마스터코드</td>

		<td>셀러상품코드</td>

		<td>입점사코드</td>
		<td>1차 카테고리</td>
		<td>2차 카테고리</td>
		<td>3차 카테고리</td>
		<td>4차 카테고리</td>
		<td>상품명</td>		
		<td>규격</td>
		<td>단위</td>
		<td>단가</td>
		<td>주문수량</td>
		<td>개별쿠폰</td>
		<td>합계</td>

		<td>상품상태</td>
		<td>총 주문가격</td>
		<td>배송비</td>
		<td>취소금액</td>
		<td>(주문)쿠폰사용금액</td>
		<td>포인트사용금액</td>
		<td>입금합계</td>
		<td>회원아이디</td>
		<td>의사명</td>
		<td>병원명</td>
		<td>사업자번호</td>
		<td>주문시간</td>
		<td>결제일시</td>
		<td>발송완료일시</td>
		<td>현재주문상태</td>
	</tr>
<? while($row = sql_fetch_array($result)){

	$cmem = get_member($row[com_id]);

	
	//if($c_class=="98"){ 
	if(substr($row[od_id],0,2)=="98"){
		$rmem = sql_fetch("select * from shop_skin.g5_member where mb_id = '$mb_id' ");
		$site_fix = "shop_skin";
	}else{
		$rmem = get_member($row[mb_id]); 
	}
	$sql_cc = sql_fetch("select sum(od_cart_coupon) as od_cart_coupon_sum from (
					select (select sum(cp_price) from {$site_fix}.g5_shop_cart c where c.od_id = m.od_id ) as od_cart_coupon from g5_shop_order 
					m where mb_id = '$row[mb_id]' and od_id = '$row[od_id]'
				) mm ");


	$sql_cnt = sql_fetch("select count(*) as cnt from {$site_fix}.{$g5['g5_shop_cart_table']} where od_id = '$row[od_id]' ");
	$sqld = "select * from {$site_fix}.{$g5['g5_shop_cart_table']} where od_id = '$row[od_id]' ";
	$res = sql_query($sqld);

	for($i = 1 ; $rowd = sql_fetch_array($res);$i++){
		
		$it_8 = sql_fetch("select it_8 , it_9  from {$site_fix}.{$g5['g5_shop_item_table']} where it_id = '$rowd[it_id]' ");

		$rowdd = sql_fetch("select ca_id , it_5 , it_6 , it_9  from {$g5['g5_shop_item_table']} where it_id = '$it_8[it_8]' ");
		 

		if(strlen($rowdd[ca_id]) > 8){
			$cate1 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,2)."' ");
			$cate2 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,4)."' ");
			$cate3 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,6)."' ");
			$cate4 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,8)."' ");
			$cate5 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '$rowdd[ca_id]' ");
		}else if(strlen($rowdd[ca_id]) > 6){
			$cate1 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,2)."' ");
			$cate2 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,4)."' ");
			$cate3 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,6)."' ");
			$cate4 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '$rowdd[ca_id]' ");
			$cate5 = "";
		}else if(strlen($rowdd[ca_id]) > 4){
			$cate1 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,2)."' ");
			$cate2 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,4)."' ");
			$cate3 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '$rowdd[ca_id]' ");
			$cate4 = "";
			$cate5 = "";
		}else if(strlen($rowdd[ca_id]) > 2){
			$cate1 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '".substr($rowdd[ca_id],0,2)."' ");
			$cate2 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '$rowdd[ca_id]' ");
			$cate3 = "";
			$cate4 = "";
			$cate5 = "";
		}else{
			$cate1 = sql_fetch("select ca_name  from {$site_fix}.g5_shop_category where ca_id = '$rowdd[ca_id]' ");
			$cate2 = "";
			$cate3 = "";
			$cate4 = "";
			$cate5 = "";
		}	
		
		

	if($i == 1){

	
?>
	<tr>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=get_sitename(substr($row['pod_id'],0,2))?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>">&nbsp;<?=$row[pod_id]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>">&nbsp;<?=$row[od_id]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$cmem[mb_nick]?></td>
		<td><?=$it_8[it_8]?></td>

		<td>&nbsp;<?=$rowd[it_id]?></td>

		<td><?=$it_8[it_9]?></td>
		<td><?=$cate1[ca_name]?></td>
		<td><?=$cate2[ca_name]?></td>
		<td><?=$cate3[ca_name]?></td>
		<td><?=$cate4[ca_name]?></td>
		<td><?=$rowd[it_name]?></td>		
		<td><?=$rowdd[it_5]?></td>
		<td><?=$rowdd[it_6]?></td>
		<td><?=number_format($rowd[ct_price])?></td>
		<td><?=number_format($rowd[ct_qty])?></td>
		<td><?=number_format($rowd[cp_price])?></td>
		<td><?=number_format($rowd[ct_price] * $rowd[ct_qty])?></td>
		<td><?=$rowd[ct_status]?></td>

		<td rowspan="<?=$sql_cnt[cnt]?>"><?=number_format($row[od_cart_price])?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=number_format($row[od_send_cost])?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=number_format($row[od_cancel_price])?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=number_format($row[od_coupon])?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=number_format($row[od_receipt_point])?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=number_format($row[od_cart_price] + $row[od_send_cost] - $row[od_receipt_point] - $row[od_coupon] - $sql_cc[od_cart_coupon_sum])?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$row[mb_id]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$rmem[mb_name]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$rmem[mb_11]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$rmem[mb_15]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$row[od_time]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$row[od_receipt_time]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$row[od_invoice_time]?></td>
		<td rowspan="<?=$sql_cnt[cnt]?>"><?=$row[od_status]?></td>	
	</tr>
 <? }else { 
	 
 ?>	
	<tr>
		<td><?=$it_8[it_8]?></td>
		<td>&nbsp;<?=$rowd[it_id]?></td>
		<td><?=$it_8[it_9]?></td>
		<td><?=$cate1[ca_name]?></td>
		<td><?=$cate2[ca_name]?></td>
		<td><?=$cate3[ca_name]?></td>
		<td><?=$cate4[ca_name]?></td>
		<td><?=$rowd[it_name]?></td>		
		<td><?=$rowdd[it_5]?></td>
		<td><?=$rowdd[it_6]?></td>
		<td><?=number_format($rowd[ct_price])?></td>
		<td><?=number_format($rowd[ct_qty])?></td>
		<td><?=number_format($rowd[cp_price])?></td>
		<td><?=number_format($rowd[ct_price] * $rowd[ct_qty])?></td>
		<td><?=$rowd[ct_status]?></td>
	</tr>
	<? } ?>
<? } ?>
<? } ?>
</table>

<?
function get_sitename($code){
	$sql_site = sql_fetch("select code_name from site_code where pay_code = '$code' ");
	return $sql_site['code_name'];
}
?>


 
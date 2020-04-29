<?php
include_once('./_common.php');

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_SHOP_URL.'/reorder.php'));
 
 
$g5['title'] = "주문상품 재주문";
include_once('./_head.php');
?>
<div id="sub_top_new_menu"> 
	<span><a href="/shop/mypage.php">마이페이지</a></span>
	<span><a href="/shop/orderinquiry.php">주문내역</a></span>
	<span><a href="/shop/takeback.php">반품신청</a></span>
	<span><a href="/shop/wishlist.php">위시리스트</a></span>
	<span class="ov"><a href="/shop/reorder.php">주문상품 재주문</a></span>
	<span><a href="/shop/coupon.php">쿠폰/<?=$point_txt?></a></span>
	<span><a href="/shop/mylist.php">문의내역</a></span>
	<span><a href="<?=$member_confirm_link?>/bbs/member_confirm.php?url=register_form.php">정보관리</a></span>
</div>
<div id="sub_top_new_menu_title">
	<h2>주문상품 재주문</h2>
</div>
<!-- 위시리스트 시작 { -->
<div id="sod_ws">

    <form name="fwishlist" method="post" action="./cartupdate.php">
    <input type="hidden" name="act"       value="multi">
    <input type="hidden" name="sw_direct" value="">
    <input type="hidden" name="prog"      value="wish">

    <div class="tbl_head01 tbl_wrap">
        <table>
        <thead>
        <tr>
            <th scope="col">선택</th>
            <th scope="col" width="140">이미지</th>
            <th scope="col">상품명</th>
			<th scope="col" >규격</th> 
			<th scope="col" >단위</th>
            <th scope="col">주문일시</th>
            <th scope="col" width="120" ><a href="/shop/reorder.php?oder=1">주문수</a></th>
        </tr>
        </thead>
        <tbody>
        <?php
if($oder == "1"){
	$oder_q = " order by n.cnt desc ";
}

        $sql  = "select count(*) as cnts from ( select * from (
select * , 
( select it_use from g5_shop_item where it_id = (select it_8 from g5_shop_item where it_id = g5_shop_cart.it_id )) as it_use
, count(*) as cnt  from g5_shop_cart where mb_id = 'admin' 
and ( ct_status = '배송' or ct_status = '주문' or ct_status = '완료'  ) 

group by it_id  order by ct_id desc

) n ) m"; 
		$row = sql_fetch($sql); 
		$total_count = $row['cnts'];

		$rows = 8;
		$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
		if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
		$from_record = ($page - 1) * $rows; // 시작 열을 구함


		$sql  = " select * from (
				select * , 
				( select it_use from g5_shop_item where it_id = (select it_8 from g5_shop_item where it_id = g5_shop_cart.it_id )) as it_use
				, count(*) as cnt  from g5_shop_cart where mb_id = '{$member['mb_id']}' 
				and ( ct_status = '배송' or ct_status = '주문' or ct_status = '완료'  ) 

				group by it_id  order by ct_id desc

				) n where n.it_use = '1' $oder_q

				limit $from_record, $rows "; 

		
        $result = sql_query($sql);
        for ($i=0; $row = sql_fetch_array($result); $i++) {

            $out_cd = '';
            $sql = " select count(*) as cnt from {$g5['g5_shop_item_option_table']} where it_id = '{$row['it_id']}' and io_type = '0' ";
            $tmp = sql_fetch($sql);
            if($tmp['cnt'])
                $out_cd = 'no';

            $it_price = get_price($row);

            if ($row['it_tel_inq']) $out_cd = 'tel_inq';
			
			$row2 = sql_fetch("select * from g5_shop_item where it_id = '$row[it_id]' ");
			$row3 = sql_fetch("select * from shop.g5_shop_item where it_id = '$row2[it_8]' ");

            $image = get_it_image($row2['it_8'], 70, 70);

			
        ?>

        <tr>
            <td class="td_chk">
                <?php
                // 품절검사
                if(is_soldout($row['it_id']))
                {
                ?>
                품절
                <?php } else { //품절이 아니면 체크할수 있도록한다 ?>
                <label for="chk_it_id_<?php echo $i; ?>" class="sound_only"><?php echo $row['it_name']; ?></label>
                <input type="checkbox" name="chk_it_id[<?php echo $i; ?>]" value="1" id="chk_it_id_<?php echo $i; ?>" onclick="out_cd_check(this, '<?php echo $out_cd; ?>');">
                <?php } ?>
                <input type="hidden" name="it_id[<?php echo $i; ?>]" value="<?php echo $row['it_id']; ?>">
                <input type="hidden" name="io_type[<?php echo $row['it_id']; ?>][0]" value="0">
                <input type="hidden" name="io_id[<?php echo $row['it_id']; ?>][0]" value="">
                <input type="hidden" name="io_value[<?php echo $row['it_id']; ?>][0]" value="<?php echo $row['it_name']; ?>">
                <input type="hidden"   name="ct_qty[<?php echo $row['it_id']; ?>][0]" value="1">
            </td>
            <td class="sod_ws_img"><?php echo $image; ?></td>
            <td style="text-align:center;"><!-- <a href="./item.php?it_id=<?php echo $row['it_id']; ?>"> -->
				<a href="/shop/search.php?q=<?php echo $row3['it_id']; ?>&q_where=main">
					<?php echo stripslashes($row['it_name']); ?></a></td>
			<td  class="td_numbig"><?=$row3['it_5']?></td>
			<td  class="td_numbig"><?=$row3['it_6']?></td>

            <td class="td_datetime"><?php echo substr($row['ct_select_time'],0,10); ?></td>
            <td class="td_mngsmall"><?=$row['cnt']?></td>
        </tr>
        <?php
        }

        if ($i == 0)
            echo '<tr><td colspan="5" class="empty_table">내용이 없습니다.</td></tr>';
        ?>
        </tr>
        </tbody>
        </table>

		 <?php echo get_paging($config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;oder=".$oder."&amp;page="); ?>
    </div>

    <div id="sod_ws_act">
        <button type="submit" class="btn01" onclick="return fwishlist_check(document.fwishlist,'');">장바구니 담기</button>
        <button type="submit" class="btn02" onclick="return fwishlist_check(document.fwishlist,'direct_buy');">주문하기</button>
    </div>
    </form>
</div>

<script>
<!--
    function out_cd_check(fld, out_cd)
    {
        if (out_cd == 'no'){
            alert("옵션이 있는 상품입니다.\n\n상품을 클릭하여 상품페이지에서 옵션을 선택한 후 주문하십시오.");
            fld.checked = false;
            return;
        }

        if (out_cd == 'tel_inq'){
            alert("이 상품은 전화로 문의해 주십시오.\n\n장바구니에 담아 구입하실 수 없습니다.");
            fld.checked = false;
            return;
        }
    }

    function fwishlist_check(f, act)
    {
        var k = 0;
        var length = f.elements.length;

        for(i=0; i<length; i++) {
            if (f.elements[i].checked) {
                k++;
            }
        }

        if(k == 0)
        {
            alert("상품을 하나 이상 체크 하십시오");
            return false;
        }

        if (act == "direct_buy")
        {
            f.sw_direct.value = 1;
        }
        else
        {
            f.sw_direct.value = 0;
        }

        return true;
    }
//-->
</script>
<!-- } 위시리스트 끝 -->

<?php
include_once('./_tail.php');
?>
<? 
$query = mysql_query("select * from notice order by id desc limit 7");
while ($row = mysql_fetch_array($query)) {
          	if($row["imp"]==1) echo "<div class=impNotice>";
         ?>
          <table width="100%"  border="1" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF">
          
            <tr>
              <td class="menuLinkSelected"><?=$row["heading"]?></td>
              <td width="200" class="menuLinkSelected">by:
                <?=select_field("emp where id=".$row["by"],"Name");?>
                <br>
                on
<?=date("d M, Y h:i A",$row["time"]);?></td>
            </tr>
            <tr>
              <td colspan="2"><?=str_replace("\n","<br>",$row["message"]);?></td>
            </tr>
          </table>          <? if($row["imp"]==1) echo "</div>"; ?>
          <br><?
		       	
             }
           ?>
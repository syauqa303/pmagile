<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Notice board</h1>
          <form name="form1" method="post" action="">
            <table width="100%"  border="0" cellspacing="1" cellpadding="3">
              <tr>
                <td class="listOddCell">Heading</td>
                <td><input name="heading" type="text" size="50" maxlength="254"></td>
              </tr>
              <tr>
                <td class="listOddCell">Importance</td>
                <td><select name="imp">
                  <option value="0" selected>Normal</option>
                  <option value="1">Special</option>
                </select></td>
              </tr>
              <tr>
                <td class="listOddCell">Message</td>
                <td><textarea name="message" cols="44" rows="5"></textarea></td>
              </tr>
              <tr>
                <td class="listOddCell">&nbsp;</td>
                <td><input type="submit" name="Submit" value="Submit"><input type="hidden" name="by" value="<?=$_SESSION["userid"]?>"><input type="hidden" name="time" value="<?=time()?>"></td>
              </tr>
            </table>
          </form>
          <?
          if ($_POST["by"]) {
          	$q = insert_data("notice");
          }
          $query = mysql_query("select * from notice order by id desc limit 20");
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
           ?></td>
      </tr>
    </table><? include("bottom.php"); ?>
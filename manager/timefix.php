<? include("top.php") ?>
<? 
if($_POST["Submit"]){
	//adding to timefix table
	$starttime = mktime($_POST["starthour"],$_POST["startmin"],0,$_POST["startmonth"],$_POST["startdate"],$_POST["startyear"]);
	$endtime = mktime($_POST["endhour"],$_POST["endmin"],0,$_POST["startmonth"],$_POST["startdate"],$_POST["startyear"]);
	
	$q = "insert into timefix values (0,'".$_SESSION["userid"]."','".$starttime."','".$endtime."','".$_POST["reason"]."',0)";
	if(!mysql_query($q))echo "error occured ".$q;
}

 ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Time Fix </h1>
          
		  <div style="border:1px">
		  	<div style="display:block; margin:0px; padding:3px;; font-weight: bold">Entry Time Fix</div>
			<form action="" method="post"  style="margin:0px;">
				<table width="358" border="1" cellpadding="5" cellspacing="0" bordercolor="#FFFFFF">
				  <tr>
				    <td>On</td>
				    <td><input name="startdate" type="text" id="startdate" size="2" maxlength="2">
/
  <input name="startmonth" type="text" id="startmonth" size="2" maxlength="2">
/
<input name="startyear" type="text" id="startyear" size="4" maxlength="4"></td>
			      </tr>
				  <tr>
					<td width="95">Start time </td>
					<td width="237"><nobr>
					  <input name="starthour" type="text" id="starthour" size="2" maxlength="2">
				      :
				      <input name="startmin" type="text" id="startmin" size="2" maxlength="2"> 
			        (24 hr clock) </nobr></td>
				  </tr>
				  <tr>
					<td>End time </td>
					<td><nobr>
					  <input name="endhour" type="text" id="endhour" size="2" maxlength="2">
:
<input name="endmin" type="text" id="endmin" size="2" maxlength="2">
(24 hr clock) </nobr></td>
				  </tr>
				  <tr>
					<td>Reason</td>
					<td><select name="reason" id="reason">
					  <option selected>Select</option>
					  <option value="1">Software wasn't working</option>
					  <option value="2">Server Down</option>
					  <option value="3">I Forgot</option>
					  </select>					</td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
					<td><input type="submit" name="Submit" value="Issue Fix"></td>
				  </tr>
				</table>

			</form>
		  </div><br>
<br>
<?
$q = mysql_query("select * from timefix where userid=".$_SESSION["userid"]);

if(mysql_num_rows($q)>0){
?>
		  <table width="414" border="0" cellspacing="0" cellpadding="3">
            <tr>
              <td class="imp1">Date</td>
              <td class="imp1">Start Time </td>
              <td class="imp1">End Time </td>
              <td class="imp1">Reason</td>
              <td class="imp1">Status</td>
            </tr>
			<? while($r = mysql_fetch_array($q)){ ?>
            <tr>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=date("d-m-Y",$r["starttime"])?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=date("H:i",$r["starttime"])?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=date("H:i",$r["endtime"])?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;"><?=$reason[$r["reason"]]?></td>
              <td style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#FFFFFF;">
			  <?
			if($r["status"]==0){
			  	echo "Pending";
			}
			else if($r["status"]==1){
			  	echo "accepted";
			}
			else if($r["status"]==2){
			  	echo "Rejected";
			}
				
				?>
			  </td>
              </tr>
			  <? } ?>
          </table>		  
		  
<? } ?>
		  <p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

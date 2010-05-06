<? 	include("top.php");	
?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Start Day</p>
		<?
		$query = mysql_query("select * from userworktime where not(endtime) and userid=".$_SESSION["userid"]);
		if (mysql_num_rows($query)>0) {
			echo "Your time didn't end. Click end time to end previous time.";
		}else {
			$query = mysql_query("insert into userworktime values (0,".$_SESSION["userid"].",".time().",0,0,0)");
			echo "Time started now<br><b>".date("d-M-Y, H-i");
		}
		
		?>
		
          <p><? include("../lib/lat/notice.php"); ?></p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

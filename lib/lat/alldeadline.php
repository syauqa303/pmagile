<? 
$bq = mysql_query("select name,enddate,id from projects where projects.status=1");
if (mysql_num_rows($bq)) {
?>
<br>
<table width="169"  border="1"cellpadding="3" cellspacing="0" bordercolor="#666666">
          <tr>
            <td class="listHeader"><div align="center">Deadlines </div></td>
          </tr>
          <tr>
            <td><div align="center"><?
		
		
		while ($row = mysql_fetch_array($bq)) {
			$class = "";
			if ((time() - strtotime($row[1]))>0) {
				$class="class=redbg";
			}else if ((strtotime($row[1]) - time())/3600/24<10) {
				$class="class=impNotice";
			}
			$id=$row[2];
//			echo (time() - strtotime($row[1]))/360/0/24;
			echo "<div $class><b><a href=projectdetails.php?pid=$id $class>".$row[0]."</b><br>".dateFormat1($row[1])."</a><br></div>";
		}
		
		?>
              </div></td>
          </tr>
        </table><? } ?>
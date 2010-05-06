<?
$bq = mysql_query("select name,day(birthdate) from emp where month(birthdate)=".date("m"));
if (mysql_num_rows($bq)) {
?>
<table width="169"  border="1"cellpadding="3" cellspacing="0" bordercolor="#666666">
          <tr>
            <td class="listHeader"><div align="center">Birthday Reminder </div></td>
          </tr>
          <tr>
            <td><div align="center"><?
		
		while ($row = mysql_fetch_array($bq)) {
			echo $row[0]." ".$row[1].",".date("F")."<br>";
		}
		
		?>
              </div></td>
          </tr>
        </table><? } ?>
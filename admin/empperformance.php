<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Employee Performance</h1>
          <?
		  echo make_select("emp where type=1 and jobstatus=0","empid","Name","id",$_POST["empid"],"Select User","Name","chng")." ".create_select_month("month",$_POST["month"])." ".create_select_year("year",$_POST["year"]);
		  ?>
        </td>
      </tr>
    </table>
    <? include("bottom.php") ?>
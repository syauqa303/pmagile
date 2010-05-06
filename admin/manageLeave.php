<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Manage Application for leaves</h1>
		<a href=?status=0>New</a> | <a href=?status=1>Old</a>
		<?
		/*$wheref = "userid";
		$where = $_SESSION["userid"];*/

		include("../lib/leaveConfig.php");
		
		if($_GET["status"]=="1")
		$filter = " status<>0";
		else 
		$filter = " status=0";
		
		/*$dontShow = $dontEdit = $dontAdd = array(0,0,0,1,0,1,0,0,1,1);*/
		/*$dontShow[7] = true;
		$dontShow[8] = true;*/
		
		/*$dontAdd[8] = true;
		$dontEdit[8] = true;
		$dontAdd[7] = true;
		$dontEdit[7] = true;*/
		
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Manage Application for leaves</h1>
		<?
		$wheref = "userid";
		$where = $_SESSION["userid"];

		include("../lib/leaveConfig.php");
		
		$dontShow = $dontEdit = $dontAdd = array(0,0,0,0,1,0,1,0,0,0,0);
		/*$dontShow[7] = true;
		$dontShow[8] = true;*/
		
		$filter = "status<>0";
		
		$defaultValue = array();
		$defaultValue[10] = date("Y-m-d");
		
		/*$dontAdd[8] = true;
		$dontEdit[8] = true;
		$dontAdd[7] = true;
		$dontEdit[7] = true;*/
		$noadd=$noedit=$nodelete=true;
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage Project Managers</p>
		<?
		$wheref = "type";
		$where = 2;
		//$newsAccess = new NewsAccess();
		$tableName="emp";
		$fieldNames = array("S/N","Name","Position","Joining Date","Birth Date","Address 1","Address 2","Phone","Email","Username","Password","Type","Image");
		$_GET["order"]="Name";
		
		$hrefs = array();
		$required = "0,1,9,10";
		$hrefs[1]="<a href=\"".$_SERVER['PHP_SELF']."?id=__ID&action=details\" >";
		
		$fieldShow = array();
		$fieldShow[12]="__IMAGE";
		
		$fieldEdit = array();
		$fieldEdit[12]["location"]="userfile/emp/";
		$fieldEdit[12]["type"]="__IMAGE";
		
		$dontShow = array();
		$dontShow[11] = true;
		
		$defaultValue = array();
		$defaultValue[11] = 2;
		
		$dontAdd[11] = true;
		$dontEdit[11] = true;
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table><? include("bottom.php"); ?>
<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage Project Managers</p>
		<?
		$wheref = "type";
		$where = 2;
		//$newsAccess = new NewsAccess();
		$tableName="emp";
//		$fieldNames = array("Id","Heading","Date","Content","Image URL");
		$hrefs = array();
		$required = "0,1,6,7";
		$hrefs[1]="<a href=\"".$_SERVER['PHP_SELF']."?id=__ID&action=details\" >";
		
		$fieldShow = array();
		$fieldShow[9]="__IMAGE";
		
		$fieldEdit = array();
		$fieldEdit[9]["location"]="userfile/emp/";
		$fieldEdit[9]["type"]="__IMAGE";
		
		$dontShow = array();
		$dontShow[8] = true;
		
		$defaultValue = array();
		$defaultValue[8] = 1;
		
		$dontAdd[8] = true;
		$dontEdit[8] = true;
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table><? include("bottom.php"); ?>
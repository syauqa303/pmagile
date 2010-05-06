<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage Employees</p>
		<?
		//$wheref = "type";
		//$where = 1;
		//$newsAccess = new NewsAccess();
		$tableName="emp";
		$fieldNames = array("S/N","Name","Position","Joining Date","Birth Date","Address 1","Address 2","Phone","Email","Username","Password","Type","Image","Employed?");
		$_GET["order"]="Name";

		$hrefs = array();
		$required = "0,1,9,10";
		$hrefs[1]="<a href=\"".$_SERVER['PHP_SELF']."?id=__ID&action=details\" >";
		
		$typear = array(0,"Employee","Manager");
		
		$fieldShow = array();
		$fieldEdit = array();
		$fieldShow[12]="__IMAGE";
		$fieldShow[11]=$typear;

		$fieldShow[13] = $fieldEdit[13]["content"] = array("Employed","Left");
		$fieldEdit[13]["type"] = "__RADIO";
		
		$fieldEdit[12]["location"]="userfile/emp/";
		$fieldEdit[12]["type"]="__IMAGE";
		
		$fieldEdit[11]["type"]="__RADIO";
		$fieldEdit[11]["content"]=$typear;
		
		$dontShow = array();
		//$dontShow[11] = true;
		
		$defaultValue = array();
		$defaultValue[11] = 1;
		
		//$dontAdd[11] = true;
		//$dontEdit[11] = true;
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table><? include("bottom.php"); ?>
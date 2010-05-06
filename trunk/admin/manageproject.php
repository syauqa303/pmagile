<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage Projects</p>
		<?
		if($_GET["status"])
		{
			$filter = "status = ".$_GET["status"];
			//$where = $_GET["status"];
		}
		//$newsAccess = new NewsAccess();
		$fieldNames = array("id","Name","Start Date","End Date","Hours(estimated)","Status","Info","PM","QA","Client");
		$tableName="projects";
		$hrefs = array();
//		$required = "0,1,6,7";
		$urls[1]="projectdetails.php?pid=__ID";
		
		$fieldEdit[5]["content"] = $fieldShow[5]=$global_projectTypes;
		$fieldEdit[5]["type"]="__RADIO";
		
		$defaultValue[2] = date("Y-m-d");
		
		$fieldEdit[7]["content"] = $fieldEdit[8]["content"] = $fieldShow[7] = $fieldShow[8] = table_to_array_addedit("emp where jobstatus=0 and type=1 or type=2","Name");
		$fieldEdit[9]["content"] = $fieldShow[9] = table_to_array_addedit("emp where jobstatus=0 and type=4","Name");
		$fieldEdit[7]["type"] = $fieldEdit[8]["type"] = $fieldEdit[9]["type"] = "__SELECT";
		/*$dontShow[7] = true;
		$dontShow[8] = true;
		$dontAdd[8] = true;
		$dontEdit[8] = true;
		$dontAdd[7] = true;
		$dontEdit[7] = true;*/
		
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
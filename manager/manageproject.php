<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage Projects</p>
		<?
//		$wheref = "type";
//		$where = 3;
		//$newsAccess = new NewsAccess();
		$fieldNames = array("id","Name","Start Date","End Date","Hours(estimated)","Status","Info");
		$tableName="projects";
		$hrefs = array();
//		$required = "0,1,6,7";
		$urls[1]="projectdetails.php?pid=__ID";
		
		$fieldShow = array();
//		$fieldShow[5]["type"]="__SELECT";
		$fieldShow[5]=array("","On going","Complete");
		
		$fieldEdit = array();
		$fieldEdit[5]["content"]=array("","On going","Complete");
		$fieldEdit[5]["type"]="__RADIO";
		
//		$dontShow = array();
//		$dontShow[8] = true;
//		
		$defaultValue = array();
		$defaultValue[2] = date("Y-m-d");
		
//		$dontAdd[8] = true;
//		$dontEdit[8] = true;
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
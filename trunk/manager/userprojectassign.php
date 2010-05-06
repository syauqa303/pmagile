<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage User's Project Assigning</p>
		<?
		$wheref = "projectid";
		$where = $_GET["projectid"];
		//$newsAccess = new NewsAccess();
		$fieldNames = array("id","User","Project","Assigned Hour");
		$tableName="userprojectassign";
		
		$userList = table_to_array_addedit("emp","Name");
		$projectList = table_to_array_addedit("projects");
//		$required = "0,1,6,7";
//		$urls[1]="projectdetails.php?id=__ID";
		
		$fieldShow = array();
//		$fieldShow[5]["type"]="__SELECT";

		$fieldShow[1]=$userList;
		$fieldShow[2]=$projectList;
		
		$fieldEdit = array();
		$fieldEdit[1]["content"]=$userList;
		$fieldEdit[1]["type"]="__SELECT";
		$fieldEdit[2]["content"]=$projectList;
		$fieldEdit[2]["type"]="__SELECT";
		
//		$dontShow = array();
		$dontShow[4] = true;
		$dontAdd[4] = true;
		$dontEdit[4] = true;
//		
		
//		$dontAdd[8] = true;
//		$dontEdit[8] = true;
		
		include("../lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
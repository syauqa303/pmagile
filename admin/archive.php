<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Manage Archive </h1>
		<? 
		if($_POST["projectid"]){
			if($_POST["name"]){
				$_POST["archiveid"]=insert_data("archive");
			}
			$id = insert_data("archiveproject");
			if($id>0)echo "Archived Successfully";
		}
		 ?>	
		 
		 <?
		$tableName="archiveproject";
		
		$fieldNames = array("SN","Archive","Project");
		
		$archivetable=into_array("archive");
		$projecttable=into_array("projects");

		$fieldEdit[1]["type"]="__SELECT";
		$fieldEdit[1]["content"]=$archivetable;
		$fieldShow[1]=$archivetable;
		
		$fieldEdit[2]["type"]="__SELECT";
		$fieldEdit[2]["content"]=$projecttable;
		$fieldShow[2]=$projecttable;
		$noadd=true;
		include("../lib/addedittable.php");
		?>
		

          <? if($_GET["action"]!="edit"){ ?>
          <? } ?>
<p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Add Archive </h1>
		  <? 
		if($_POST["projectid"]){
			if($_POST["name"]){
				$_POST["archiveid"]=insert_data("archive");
			}
			$id = insert_data("archiveproject");
			if($id>0)echo "Archived Successfully";
		}
		 ?><? if($_GET["action"]!="edit"){ ?>
		  <form name="form1" method="post" action="" onSubmit="return checkarchive();">
            <table width="323" border="1" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF">
              <tr>
                <td width="52" class="editHeader">Project</td>
                <td width="253"><?=make_select("projects","projectid","name");?></td>
              </tr>
              <tr>
                <td class="editHeader">Archive</td>
                <td><nobr><?=make_select("archive","archiveid","name");?>
or                  
  <input name="name" type="text" id="name">
                </nobr></td>
              </tr>
              <tr>
                <td class="editHeader">&nbsp;</td>
                <td>
				<script language="javascript">
					function checkarchive(){
						error="";
						//alert(document.form1.name.value);
						if(document.form1.projectid.value==0){
							error="Please select project";
						}else if(document.form1.archiveid.value==0 && document.form1.name.value==""){
							error="Please select archive or write a archive name";
						}
						
						if(error){
							alert(error);
							return false;
						}else{
							return true;
						}
					}
				</script>
				<input type="submit" onClick="return checkarchive()" name="Submit" value="Archive"></td>
              </tr>
            </table>
            </form>
			<? } ?>
          <p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
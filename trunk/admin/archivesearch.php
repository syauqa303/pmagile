<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Search Archive </h1>
		  <form name="form1" method="post" action="">
		    <table width="46%" border="1" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF">
              <tr>
                <td><input name="search" type="text" id="search">
                  <input type="submit" name="Submit" value="Archive">
                  <input type="submit" name="Submit2" value="Project"></td>
                </tr>
            </table>
		  </form>	
		  <?
		  if($_POST){
			$qstr = "select archive.name,projects.name from archiveproject,archive,projects where archiveproject.archiveid=archive.id and archiveproject.projectid=projects.id";
		  	if($_POST["Submit"]=="Archive"){
				$qstr.= " and archive.name like '%".$_POST["search"]."%'";
			}else{
				$qstr.= " and projects.name like '%".$_POST["search"]."%'";
			}
			$q = mysql_query($qstr);
			
			if(mysql_num_rows($q)){
		  ?>	  
		  <table width="40%" border="1" cellspacing="0" cellpadding="3">
            <tr>
              <td class="listHeader">Archive</td>
              <td class="listHeader">Project</td>
            </tr>
			<? while($r=mysql_fetch_array($q)){ ?>
            <tr>
              <td><?=$r[0]?></td>
              <td><?=$r[1]?></td>
            </tr>
			<? } ?>
          </table>
		  <? 
		  }//if any row
		  }//if posted
		  
		   ?>
  		    <p>&nbsp; </p></td>
      </tr>
    </table>
    <? include("bottom.php") ?>
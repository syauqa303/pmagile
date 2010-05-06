<? 
include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h1>Personal Info </h1>
		<?
		if($_POST){
			echo "Updating ...<br>";
			$updateid=update_data("emp","id",$_SESSION["userid"]);
			if($updateid==1)echo "Updated";
			else echo "Sorry, invalid entry, data couldn't be updated!";
		}
		$rs = fetch_array("emp where id=".$_SESSION["userid"]);
		?>
            <form action="" method="post" enctype="multipart/form-data" name="form1">
            <table width="358"  border="1" cellpadding="3" cellspacing="0" bordercolor="#F7F7F7">
              <tr>
                <td colspan="2" class="listHeader"><?=$rs["Name"]?></td>
                </tr>
              <tr>
                <td width="72" class="listHeader">Birthdate</td>
                <td width="274"><input name="birthdate" style="width:100% " type="text" class="normalText" id="birthdate" value="<?=$rs["birthdate"]?>"></td>
              </tr>
              <tr>
                <td class="listHeader">Address 1</td>
                <td><input name="Address1" style="width:100% " type="text" class="normalText" id="birthdate2" value="<?=$rs["Address1"]?>"></td>
              </tr>
              <tr>
                <td class="listHeader">Address 2 </td>
                <td><input name="Address2" style="width:100% " type="text" class="normalText" id="birthdate3" value="<?=$rs["Address2"]?>"></td>
              </tr>
              <tr>
                <td class="listHeader">Phone</td>
                <td><input name="Phone" style="width:100% " type="text" class="normalText" id="birthdate4" value="<?=$rs["Phone"]?>"></td>
              </tr>
              <tr>
                <td class="listHeader">Email</td>
                <td><input name="Email" style="width:100% " type="text" class="normalText" id="birthdate5" value="<?=$rs["Email"]?>"></td>
              </tr>
              <!--tr>
                <td class="listHeader">Image</td>
                <td><input type="file" name="file"></td>
              </tr-->
              <tr>
                <td class="listHeader">&nbsp;</td>
                <td><input type="submit" name="Submit" value="Submit"></td>
              </tr>
            </table>
          </form>
          <p>&nbsp; </p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

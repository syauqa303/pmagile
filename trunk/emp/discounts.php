<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage Discounts</p>
		<?
		//$newsAccess = new NewsAccess();
		$tableName="discount";
		$fieldNames = array("Id","Name","Address","Logo","From","Discount","Short Desc.");
		$hrefs = array();
		$required = "0,1,2,4";
		$hrefs[1]="<a href=\"discounts.php?id=__ID&action=details\" >";
		
		$fieldShow = array();
		$fieldShow[3]="__IMAGE";
		$fieldShow[4]=array("Select","Dhaka","Chittagong");
		
		$fieldEdit = array();
		$fieldEdit[3]["location"]="uploaded/stores/";
		$fieldEdit[3]["type"]="__IMAGE";
		$fieldEdit[4]["type"]="__SELECT";
		$fieldEdit[4]["content"]=$fieldShow[4];
		
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

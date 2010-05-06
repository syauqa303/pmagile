<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage news</p>
		<?
		//$newsAccess = new NewsAccess();
		$tableName="user";
		$fieldNames = array("Id","Name","Address","Email","Username","Password");
		$hrefs = array();
		$required="4,5";
		$hrefs[1]="<a href=\"users.php?id=__ID&action=details\" >";
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

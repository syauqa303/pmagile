<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage news</p>
		<?
		//$newsAccess = new NewsAccess();
		$tableName="news";
		$fieldNames = array("Id","Heading","Date","Content","Image URL");
		$hrefs = array();
		$required = "0,1,2,3";
		$hrefs[1]="<a href=\"news.php?id=__ID&action=details\" >";
		
		$fieldShow = array();
		$fieldShow[4]="__IMAGE";
		
		$fieldEdit = array();
		$fieldEdit[4]["location"]="uploaded/news/";
		$fieldEdit[4]["type"]="__FILE";
		
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

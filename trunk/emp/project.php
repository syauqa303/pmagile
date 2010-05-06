<? 
include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><h2>Projects</h2>
          <table width="260"  border="1" cellpadding="3" cellspacing="0" bordercolor="#FFFFFF">
            <tr class="listHeader">
              <td width="16">SN</td>
              <td width="226">Project</td>
            </tr>
			<?
			$q = mysql_query("select id,name from projects");
			$i=1;
			while($rs=mysql_fetch_array($q)){
			?>
            <tr>
              <td><?=$i?></td>
              <td><a href="projectdetails.php?pid=<?=$rs["id"]?>">
                <?=$rs['name']?></a></td>
            </tr>
			<? 
			$i++;
			} ?>
          </table>          <p>&nbsp;</p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

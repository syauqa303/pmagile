<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Employee work time </p>
          <form action="" id="form1" name="form1" method="GET"><?
        $uid = $_GET["uid"];
        ?>
        Select Employee <? make_select("emp where type=1","uid","Name","id",$uid,"Select user","Name","on change"); ?>
        <?
		if ($uid) {
        //$qprojectList = mysql_query("select projects.id,projects.name,userprojectassign.assignedhour from projects,userprojectassign where projects.id=userprojectassign.projectid and userprojectassign.userid=".$uid);
		$qprojectList = mysql_query("select distinct projects.id,projects.name from projects,userprojectworktime where projects.id=userprojectworktime.projectid and userprojectworktime.userid=".$uid);
 ?>
		<table width="100%" border="0" cellpadding="3" cellspacing="0" border="1">
            <tr>
              <td width="20%" class="viewHeader">Project Name</td>
              <td width="50%" class="viewHeader">Hours Elapsed </td>
            </tr>
            <? while ($projectList = mysql_fetch_row($qprojectList)){ ?>
            <tr>
              <td width="20%" ><a href="userprojectworktime.php?uid=<?=$uid?>&pid=<?=$projectList[0]?>"><?=$projectList[1]?></a></td>
              <td width="50%" ><? echo user_project_time($uid,$projectList[0]); ?></td>
            </tr>
            <? } ?>
          </table>
          <? } ?>
          </form>
          <p>&nbsp; </p></td>
      </tr>
    </table><? include("bottom.php"); ?>
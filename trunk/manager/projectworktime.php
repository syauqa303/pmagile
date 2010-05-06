<? include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Project work time </p>
        <form action="" id="form1" name="form1" method="GET"><?
        $pid = $_GET["pid"];
        ?>
        Select project <? make_select("projects","pid","name","id",$pid,"Select project","name","on change"); ?>
        <?
		if ($pid) {
        $quserList = mysql_query("select emp.id,emp.name,userprojectassign.assignedhour from emp,userprojectassign where emp.id=userprojectassign.userid and userprojectassign.projectid=".$pid);
 ?>
		<table width="100%" border="0" cellpadding="3" cellspacing="0" border="1">
            <tr>
              <td width="20%" class="viewHeader">User</td>
              <td width="30%" class="viewHeader">Hours Assigned </td>
              <td width="50%" class="viewHeader">Hours Elapsed </td>
            </tr>
            <? while ($userList = mysql_fetch_row($quserList)){ ?>
            <tr>
              <td width="20%" ><a href="userprojectworktime.php?uid=<?=$userList[0]?>&pid=<?=$pid?>"><?=$userList[1]?></a></td>
              <td width="30%" ><?=$userList[2]?></td>
              <td width="50%" ><? echo user_project_time($userList[0],$pid);
              ?></td>
            </tr>
            <? } ?>
          </table>
          <? } ?>
          </form>
          <p>&nbsp; </p></td>
      </tr>
    </table><? include("bottom.php"); ?>
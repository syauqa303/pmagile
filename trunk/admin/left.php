<table width="100%"  border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>About Employees</b>
    <br><? create_link("manageemp.php?action=doadd","Add New Employee","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageemp.php","View/Edit Employees","menuLink","menuLinkSelected"); ?>
    <br><? create_link("managemanager.php","View/Edit Manager","menuLink","menuLinkSelected"); ?>
    <br><? create_link("userworktime.php","Employee Worktime","menuLink","menuLinkSelected"); ?>
    <br><? create_link("timesheet.php","Time Sheet","menuLink","menuLinkSelected"); ?>     
    <br><? create_link("manageLeave.php","Manage Leave","menuLink","menuLinkSelected"); ?>     
    <br><? create_link("empjoin.php","Emp Join","menuLink","menuLinkSelected"); ?>     
	</td>
  </tr>
  <tr>
    <td><b>About projects</b>
    <br><? create_link("manageclients.php","Manage Clients","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php?action=doadd","Add New Project","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php","All Projects","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php?status=1","> Ongoing Projects","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php?status=2","> Complete Projects","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php?status=3","> Paid Projects","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php?status=4","> Cancelled Projects","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php?status=5","> Paused Projects","menuLink","menuLinkSelected"); ?>
	<br><? create_link("projectworktime.php","Project Worktime","menuLink","menuLinkSelected"); ?>    </td>
  </tr>
  <tr>
	<td>
		<b>Process Report</b>
		<br><? create_link("empperformance.php","Emp Performance","menuLink","menuLinkSelected"); ?>
	</td>
  </tr>
  <tr>
    <td><b>Reports</b>
    <br><? create_link("monthreport.php","Monthly report","menuLink","menuLinkSelected"); ?>
    <br><? create_link("customreport.php","Custom report","menuLink","menuLinkSelected"); ?>
    <br><? create_link("overtime.php","Overtime report","menuLink","menuLinkSelected"); ?>
    <br><? create_link("dailyreport.php","Daily report","menuLink","menuLinkSelected"); ?>
    <br><? create_link("timesolve.php","Time Solve","menuLink","menuLinkSelected"); ?>
    <br><? create_link("timesolved.php","Time Solved","menuLink","menuLinkSelected"); ?>
	</td>
  </tr>
  <tr>
    <td><b>Archive</b> <br />
    <? create_link("archiveadd.php","Archive Add","menuLink","menuLinkSelected"); ?>
    <br />    <? create_link("archivesearch.php","Archive Search","menuLink","menuLinkSelected"); ?>
    <br />    <? create_link("archive.php","Archive Modify","menuLink","menuLinkSelected"); ?>
    <br /></td>
  </tr>
  <tr>
    <td><b>About Admin</b>
    <br><? create_link("manageadmin.php?action=doadd","Add new Admin","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageadmin.php","View/Edit Admin","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageholiday.php","Manage Holidays","menuLink","menuLinkSelected"); ?>
    <br><? create_link("changepass.php","Change Password","menuLink","menuLinkSelected"); ?>    </td>
  </tr>  
  <tr>
    <td><b>General</b>
    <br><? create_link("notice.php","Noticeboard","menuLink","menuLinkSelected"); ?>    </td>
  </tr>  
</table>

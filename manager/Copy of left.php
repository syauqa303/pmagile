<table width="100%"  border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>About Employees</b>
    <br>
    <? create_link("manageemp.php?action=doadd","Add New Employee","menuLink","menuLinkSelected"); ?>
    <!--a href="manageemp.php?action=doadd" class="menuLink">Add New Employee</a--> 
    <br>
    <? create_link("manageemp.php","View/Edit Employees","menuLink","menuLinkSelected"); ?>
    <a href="manageemp.php" class="menuLink">View/Edit Employees</a> 
    <br>
    <a href="userworktime.php" class="menuLink">Employee Worktime</a> </td>
  </tr>
  <tr>
    <td><b>About projects</b>
    <br>
    <a href="manageproject.php?action=doadd" class="menuLink">Add New Project</a> 
    <br>
    <a href="manageproject.php" class="menuLink">View/Edit Projects</a> 
    <br>
    <a href="projectworktime.php" class="menuLink">Project Worktime</a></td>
  </tr>
  <tr>
    <td><b>Reports</b>
    <br>
    <a href="monthreport.php" class="menuLink">Monthly report</a> 
    <br>
    <a href="customreport.php" class="menuLink">Custom report</a></td>
  </tr>
  <tr>
    <td><b>About Admin</b>
    <br>
    <a href="manageadmin.php?action=doadd" class="menuLink">Add new Admin</a> 
    <br>
    <a href="manageadmin.php" class="menuLink">View/Edit Admin</a> 
    <br>
    <a href="manageholiday.php" class="menuLink">Manage Holidays</a> 
    <br>
    <a href="changepass.php" class="menuLink">Change Password</a> </td>
     </td>
  </tr>
  
</table>
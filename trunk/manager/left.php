<table width="100%"  border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><b>Worktime</b>
    <br><? create_link("startday.php","Start Day","menuLink","menuLinkSelected"); ?>
    <br><? create_link("endday.php","End Day","menuLink","menuLinkSelected"); ?>
    <br><? create_link("projecttime.php","Project time","menuLink","menuLinkSelected"); ?>    </td>
  </tr>
  <tr>
    <td><b>Manage</b>
    <br><? create_link("userworktime.php","Employee Worktime","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php?action=doadd","Add New Project","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageproject.php","View/Edit Projects","menuLink","menuLinkSelected"); ?>
    <br><? create_link("projectworktime.php","Project Worktime","menuLink","menuLinkSelected"); ?>
    <br><? create_link("manageholiday.php","Manage Holidays","menuLink","menuLinkSelected"); ?>     </td>
  </tr>
  <tr>
    <td><b>Reports</b>
    <br><? create_link("monthreport.php","Monthly report","menuLink","menuLinkSelected"); ?>
    <br><? create_link("customreport.php","Custom report","menuLink","menuLinkSelected"); ?>
    <br><? create_link("overtime.php","Overtime report","menuLink","menuLinkSelected"); ?>    </td>
  </tr>
  <tr>
    <td><b>Others</b>
    <br><? create_link("changepass.php","Change Password","menuLink","menuLinkSelected"); ?>
    <br><? create_link("notice.php","Noticeboard","menuLink","menuLinkSelected"); ?>    </td>
  </tr>  
  <? if($_SESSION["userid"]==19){ ?>
  <tr>
    <td><b>Trouble Ticket </b> <br />
        <? create_link("timefix.php","Time Fix","menuLink","menuLinkSelected"); ?>
    </td>
  </tr>
  <tr>
    <td><b>Trouble Ticket Solve</b>
    <br><? create_link("timesolve.php","Time Solve","menuLink","menuLinkSelected"); ?>    </td>
  </tr>  
  <? } ?>
</table>

<table width="100%"  border="0" cellpadding="5" cellspacing="0" bordercolor="#CCCCCC">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><p><b>Registrations</b>
        <br>
        <? create_link("startday.php","Start Day","menuLink","menuLinkSelected"); ?>
        <br>
        <? create_link("endday.php","End Day","menuLink","menuLinkSelected"); ?>
        <br>
        <br>
        <? create_link("projecttime.php","Time Registration","menuLink","menuLinkSelected"); ?>
        <br>
        <? create_link("projecttimeview.php","View Time","menuLink","menuLinkSelected"); ?>
        <br>
        <br><? create_link("manageproject.php","Manage project","menuLink","menuLinkSelected"); ?>
        <br><? create_link("empmanager.php","Manage Reporting","menuLink","menuLinkSelected"); ?>
        <br>
        <? create_link("timesheet.php","Time Sheet","menuLink","menuLinkSelected"); ?>
        <br>
        <br>
    </p>    </td>
  </tr>
  <tr>
    <td><b>General Info</b>
    <br>
    <? create_link("personalinfo.php","Personal Info","menuLink","menuLinkSelected"); ?>
    <br><? create_link("changepass.php","Change Password","menuLink","menuLinkSelected"); ?>
    <br>    </td>
  </tr>
  <tr>
    <td><b>Leave of Absence</b>
    <br>
    <? create_link("applyLeave.php","Applied","menuLink","menuLinkSelected"); ?>
    <br><? create_link("acceptedLeave.php","Accepted","menuLink","menuLinkSelected"); ?>
    <br>    </td>
  </tr>
  <tr>
    <td><p><b>Notice Board </b>
        <br>
        <? create_link("notice.php","Noticeboard","menuLink","menuLinkSelected"); ?>
    </p>    </td>
  </tr>
  <tr>
    <td><b>Trouble Ticket  </b> <br />
      <? create_link("timefix.php","Time Fix","menuLink","menuLinkSelected"); ?>
<? if($_SESSION["userid"]==7){ ?>
<br />
<br />
      <? create_link("dailyreport.php","Daily Report","menuLink","menuLinkSelected"); ?>
    <br><? create_link("timesolve.php","Time Solve","menuLink","menuLinkSelected"); ?>    
    <br><? create_link("timesolved.php","Time Solved","menuLink","menuLinkSelected"); ?>    
<? } ?>
	  </td>
  </tr>  
</table>

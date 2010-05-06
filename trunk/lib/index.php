<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>docu-lib</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../common.css" rel="stylesheet" type="text/css">
</head>

<body>
Last updates: 25-01-2006
<table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td colspan="2" class="imp1">Date</td>
  </tr>
  <tr>
    <td width="7">&nbsp;</td>
    <td width="477"><p>//to enter in database<br>
        //outDate(&quot;23-06-2005&quot;,&quot;-&quot;) returns &quot;2005-06-23&quot;<br>
        function <span class="imp2">outDate($dt,$sep=&quot;-&quot;)</span>    </p>
    <p>//to show from database<br>
      //showDate(&quot;2005-06-20&quot;)=&gt;20.06.2005<br>
      function <span class="imp2">showDate($dt,$sep=&quot;.&quot;)</span></p>
    <p>//to Show date in specified format<br>
      //default <br>
      function <span class="imp2">dateFormat($date,$type=&quot;l F d, Y &quot;)</span></p>
    <p>//returns time 11:23 PM<br>
      function <span class="imp2">timeFormat($time,$type=&quot;h:i A&quot;)</span></p>
    <p>//echoes January 23,2005<br>
      function <span class="imp2">dateFormat1($date)</span></p>
    <p>//return date and time both<br>
      function <span class="imp2">dateTimeFormat($date)</span></p>
    <p>//returns time 11:23 PM<br>
      function <span class="imp2">timeFormat1($time)</span></p>
    <p>//it returns a &lt;select&gt;&lt;option&gt; -- type for date,<br>
      //inputName = what will be the name of &lt;select&gt;<br>
      //sd = selected date<br>
      //futureYear = if not past but future year is needed then set how many years you want to show<br>
      function <span class="imp2">create_select_date($inputName,$sd=&quot;&quot;,$futureYear=0)</span></p>
    <p>//$sd = selected time<br>
      function <span class="imp2">create_select_time($inputName,$sd=&quot;&quot;)<br>
      </span>    </p></td>
  </tr>
  <tr>
    <td colspan="2" class="imp1">Database</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>//creates the select query<br>
    function <span class="imp2">select($tbl,$field=&quot;*&quot;)</span></p>
    <p>//checks if this sql exists<br>
      function <span class="imp2">data_exist($sql)</span></p>
    <p>//returns the value of a field<br>
      function <span class="imp2">select_field($tbl,$field)</span></p>
    <p>//counts the fieldNames number<br>
      function <span class="imp2">get_count($tblName,$fieldName,$xtra=&quot;&quot;)</span></p>
    <p>//$sql query to execute<br>
      //$num=number of rows to show<br>
      function <span class="imp2">page($sql,$num=10)</span><br>
    </p>
    <p>//just return the country name<br>
      function <span class="imp2">country($code)</span><br>
      <br>
      //return age<br>
      function <span class="imp2">age($dt)</span><br>
      <br>
      //$tble=table name e.g. users or users where type=admin<br>
      //$slct=&lt;select name&gt;<br>
      //$fldshow=which field to show<br>
      //$fldid=which value to return upon select<br>
      //#ed=if anything selected<br>
      //$order=if order by something<br>
      //$select=Select country or Select type i.e. what will be shown<br>
        function <span class="imp2">make_select($tbl,$slct,$fldshow,$fldid=&quot;id&quot;,$ed=&quot;&quot;,$select=&quot;Select&quot;,$order=&quot;&quot;)</span><br>
    </p>
    <p>//if you need to insert value of a table into an array<br>
      //$tbl=table name<br>
      //$id=array's id<br>
      //$value=array's value<br>
      //example: returns an array like this array[$id]=value<br>
      function <span class="imp2">into_array($tbl,$id=0,$value=1)</span><br>
    </p>
    <p>//returns all id of a query<br>
      //necessary for subqueries<br>
      function <span class="imp2">get_all_id($query)</span><br>
    </p>
    <p>/*insertData to a table<br>
      return insertID<br>
      param: tableName<br>
      MUST USE inputName same as fieldName to insert<br>
      if any error $_SESSION[&quot;errortxt&quot;] will contiain the insert string */<br>
      function<span class="imp2"> insert_data($tbl)</span><br>
    </p>
    <p>returns the row, ever if you need only a row <br>
      function <strong>fetch_array($tbl,$fields) </strong> </p>
    Which table, which field match, example, update_data(&quot;user&quot;,&quot;id&quot;,3) ;<br>
    function <span class="imp2">update_data($tbl,$field,$value)
    </span> </td>
  </tr>
  <tr>
    <td colspan="2" class="imp1">File</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>/*write a file<br>
        params $filename and content<br>
        returns nothing*/<br>
      function <span class="imp2">writeFile($fileName,$content)</span><br>
    </p></td>
  </tr>
  <tr>
    <td colspan="2" class="imp1">Mail</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>//use this mail thing so that I'll later replace mail thing<br>
    function <span class="imp2">mymail($to,$subject,$body,$from)</span></td>
  </tr>
  <tr>
    <td colspan="2" class="imp1">HTML</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>function <span class="imp2">checkbox($name,$vl,$label,$style=&quot;&quot;,$flv=&quot;1&quot;) </span></p>
      <p>function <span class="imp2">radio($name,$vl,$label,$style=&quot;&quot;,$flv=&quot;1&quot;) </span></p>
      <p>function <span class="imp2">selected($vl,$flv)      </span></p>
      <p>//function that will make select combo and <br>
        //from array $tbl, named $slct and selected value is $ed and $mode=all will return <br>
        function <span class="imp2">make_select_array($tbl,$slct,$ed=&quot;&quot;,$mode=&quot;&quot;)</span><br>
      </p></td>
  </tr>
  <tr>
    <td colspan="2" class="imp1">Other</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>//returns nothing just takes you to somewhere you specify<br>
        function <span class="imp2">redirect($toapage,$extra=&quot;&quot;,$alert=&quot;&quot;) </span></p>
      <p>//checks if user is logged in<br>
      function <span class="imp2">checklogin()</span></p>
      <p>        //do necessary modification to show a message<br>
        function <span class="imp2">dequote($str)</span><br>
      </p></td>
  </tr>
  <tr>
    <td colspan="2" class="imp1">Add Edit Delete page </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><p>Include page (lib/<span class="imp2">addedittable.php</span>) after doing following </p>
      <p>Scenario 1: One table needs easy change, like add edit or delete a row<br>
        just add this line</p>
      <blockquote>
        <p><span class="imp2">$tableName=&quot;gamesdownload&quot;;</span> //here games download is the table name to addedit </p>
      </blockquote>
      <p>Scenario 2: One table needs a change, but with a field coming from a selected field</p>
      <blockquote>
        <p> $tableName=&quot;gamesdownload&quot;; //this is the table where addition deletion will occur<br>
          <span class="imp2">$wheref=&quot;categoryid&quot;;</span> <br>
          <span class="imp2">$where = $_GET[$wheref];</span><br>
make_select_table(&quot;gamesdownloadcategory&quot;,$wheref,$_GET[$wheref]); <br>
        </p>
      </blockquote>      <p>Scenario 3: Want to add something extra? like a page clicking from this page. </p>
      <blockquote>
        <p><span class="imp2">$addedit_xtra</span>=&quot; | &lt;a target=\&quot;_blank\&quot; href=gamesdownloadimg.php?id=&quot;.$id.&quot;&gt;Manage Image&lt;/a&gt;&quot;;<br>
          <span class="imp2">function addeditxtra($id){</span><br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return &quot; | &lt;a target=\&quot;_blank\&quot; href=gamesdownloadimg.php?id=&quot;.$id.&quot;&gt;Manage Image&lt;/a&gt;&quot;;<br>
}<br>
        </p>
      </blockquote></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>

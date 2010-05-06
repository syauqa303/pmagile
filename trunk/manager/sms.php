<? 
include("top.php") ?>
<table width="100%"  border="0" cellspacing="0" cellpadding="20">
      <tr>
        <td><p>Manage ringtones </p>
		  <?
		//$newsAccess = new NewsAccess();
		$fieldShowWidth = array("2%","20%","50%","20%");
		
		$tableName="sms";
		$fieldNames = array("Id","Heading","Description","Type");
		$fieldShow = array();//into_array("ringtone_type");
		//print_r($fieldShow);
		$fieldShow[3] = array("","Fun","News","Financial");
		
		$fieldEdit = array();
		//$fieldEdit[1]["type"]="__IMAGE";
		/*$fieldEdit[1]["location"]="ringtone/";
		$fieldEdit[1]["type"]="__FILE";
		*///$fieldEdit[3]["type"]="__SELECT";
		$fieldEdit[3]["type"]="__SELECT";
		$fieldEdit[3]["content"]=$fieldShow[3];
		//$fieldShow[1]="__IMAGE";
		/*$fieldShow[1]="__FILE";
		
		
		$urls = array();
		$urls[2]=$_SERVER['PHP_SELF']."?id=__ID";
		
		$fieldEdit = array();
		//$fieldEdit[1]["type"]="__IMAGE";
		$fieldEdit[1]["location"]="ringtone/";
		$fieldEdit[1]["type"]="__FILE";
		//$fieldEdit[3]["type"]="__SELECT";
		$fieldEdit[3]["type"]="__RADIO";
		$fieldEdit[3]["content"]=$fieldShow[3];
		
		$defaultValue = array();
		$defaultValue[2] = "Put your ringtone name here";
		$defaultValue[3] = 1;
		$defaultValue[4] = 100;
		
		$dontShow = array();
		//$dontShow[1]=true;
		$dontAdd = array();
		$dontAdd[4]=true;
		$dontEdit = array();
		$dontEdit[4]=true;
		
		$note = array();
		$note[1] = "Only mp3 is supported";
		
		$required = "0,1,2,3";
		
		$hrefs[1]="<a href=\"news.php?id=__ID&action=details\" >";*/
		include(APP_ROOT . "/lib/addedittable.php");
		?>
          <p>&nbsp; </p></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>

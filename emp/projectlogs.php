<?
include("../lib/include.php");
include_once("login.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Welcome to Admin Section</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../common.css" rel="stylesheet" type="text/css">
</head>

<body style="padding:0px; margin:0px;">
		<?
		$userLista = table_to_array_addedit("emp","Name");
              $fieldNames = array("ID","Log by","Project","Log Date","Content");
              $tableName = "projectlog";
              $where=$_GET["pid"];
              $wheref="projectid";
              $fieldShow[1]=$userLista;
              $fieldEdit[1]["type"]="__SELECT";
              $fieldEdit[1]["content"]=$userLista;
              
              $defaultValue[1]=$_SESSION["userid"];
              $defaultValue[3]=date("Y-m-d H:i:s");
              $dontAdd[1]=true;
              $dontAdd[3]=true;
              include_once("../lib/addedittable.php");
		?>
	</body></html>
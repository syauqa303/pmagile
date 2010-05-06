<?

//returns nothing just takes you to somewhere you specify
function redirect($toapage){
		echo "<script>";
		if($alert!="")echo "alert('$alert');\n";
		?>
			document.location.href = "<?=$toapage?>";
		</script>
		<?
}

//checks if user is logged in
function checklogin($auth=""){
	if($auth!="")
		{
		    define ('AUTH', $auth);
			if(($_SESSION["login"]!=true) || ($_SESSION[AUTH]!=true)){
			if(headers_sent()){
					redirect("../admin.php?errmsg=needlogin");
					exit();
				}else{
					header("Location: ../admin.php?errmsg=needlogin");
				}
			}
			
		}
	else
	{	
	$_SESSION["pagetogo"]=$_GET["action"];
	if($_SESSION["login"]!=true){
		if(headers_sent()){
			redirect("home","errmsg=needlogin");
			exit();
		}else{
			header("Location: ".makeLink("home","errmsg=needlogin"));
		}
	}
}	
}

//do necessary modification to show a message
function dequote($str){
	$result =  str_replace("[quote]","<div class=quote>",$str);
	$result = str_replace("[/quote]","</div><br>",$result);
	$result = str_replace(chr(13),"<br>",$result);
	echo $result;
}


?>
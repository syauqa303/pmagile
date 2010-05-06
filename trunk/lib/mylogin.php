<?
include_once("include.php");

/*
Change logs
25-01-2006
Change password had a problem, if the tablename is not user, it would not have worked, now fixed


*/
class mylogin{
	var $userid;
	var $usertype;
	var $login_page;
	var $queryStr;
	var $usertypepage = array();
	var $table;
	function mylogin($loginPage,$usertypepage,$table="user"){
		//
		
		$this->login_page = $loginPage;
		$this->table = $table;
		$this->queryStr = "select * from $table ";
		$this->userid = $_SESSION["userid"];
		$this->usertypepage = $usertypepage;
		if ($_GET["msg"]=="logout") {
			$this->logout();
		}
		if ($_POST["dochecklogin"]=="true") {
			$this->do_login($_POST["username"],$_POST["password"]);
		}
	}
	
	function check_login($type){
		if ($_SESSION["userid"]) {
			if ($_SESSION["usertype"]!=$type) {
				header("location: ".FOLDER.$this->login_page);
			}
		}else {
			$_SESSION["pagetogo"]=$_SERVER['PHP_SELF'];
			header("Location: ".FOLDER.$this->login_page);
			echo $this->login_page;
		}
		
	}
	
	function do_login($username,$password){
		$this->queryStr .= " where username='$username' and password='$password'";
		$query = mysql_query($this->queryStr);
		//echo $this->queryStr;
		if ($r = mysql_fetch_array($query)) {
			$_SESSION["userid"]=$r["id"];
			$_SESSION["usertype"]=$r["type"];
			
			//echo APP_ROOT.$this->usertypepage[0];
			if ($_SESSION["pagetogo"]) {
				header("Location: ".$_SESSION["pagetogo"]);//$r["type"]
				session_unregister("pagetogo");
			}else {
				header("Location: ".FOLDER.$this->usertypepage[$r["type"]]);//$r["type"]
//				echo FOLDER.$this->usertypepage[$r["type"]];
			}
		}else {
			//header("location: $this->login_page?msg=invalid");
			$_GET["msg"]="invalid";
			//echo($_SERVER['PHP_SELF'].$_GET["msg"]);
		}
	}
	
	function create_login(){
		$str = "";
		$str .= "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
		<table border=0 cellpadding=5 cellspacing=0>\n";
		if ($_GET["msg"]=="invalid") {
			$str .= "<tr><td colspan=2 align=center><font color=red><strong>Invalid Username and/or Password</strong></td></tr>";
		}else if ($_GET["msg"]=="logout"){
			$str .= "<tr><td colspan=2 align=center class=login><font color=red><strong>Logged out</strong></td></tr>";
		}
		
		$str .= "<tr><td class=login>Username</td><td><input type=text name=username id=username /></td></tr>";
		$str .= "<tr><td class=login>Password</td><td><input type=password name=password id=password /></td></tr>";
		$str .= "<tr><td>&nbsp;</td><td><input type=Submit value=Submit /><input type=\"hidden\" name=\"dochecklogin\" id=\"dochecklogin\" value=\"true\" /></td></tr>";
		$str .= "</table></form>";
		echo $str;
	}
	
	function change_password(){
		if ($_POST["dochangepassword"]) {
			$qc = mysql_query("select * from $this->table where id=$this->userid and password='".$_POST["oldpass"]."'");
			if (mysql_num_rows($qc)==1) {
				$qt = mysql_query("update $this->table set password='".$_POST["password"]."' where id=".$this->userid);
				if (mysql_affected_rows()==1) {
					echo "<div>Password changed successfully </div>";
				}else {
					echo "<div>Some error occured. Please check if you are logged in or you may typed same password.</div>";
				}
			}else {
				echo "<div>Old password is not correct!</div>";
			}
			
		}else {
			$str = "";
			$str .= "<form name=myloginform id=myloginform action=\"".$_SERVER['PHP_SELF']."\" method=\"POST\">
					<table border=0 cellpadding=5 cellspacing=0>\n";
			if ($_GET["msg"]=="invalid") {
				$str .= "<tr><td colspan=2 align=center><font color=red><strong>Invalid Username and/or Password</strong></td></tr>";
			}else if ($_GET["msg"]=="logout"){
				$str .= "<tr><td colspan=2 align=center class=login><font color=red><strong>Logged out</strong></td></tr>";
			}

			$str .= "<tr><td class=login>Old password</td><td><input type=password name=oldpass id=oldpass /></td></tr>";
			$str .= "<tr><td class=login>New Password</td><td><input type=password name=password id=password /></td></tr>";
			$str .= "<tr><td class=login>Confirm Password</td><td><input type=password name=cpassword id=cpassword /></td></tr>";
			$str .= "<tr><td>&nbsp;</td><td><input type=Submit value=\"Change password\" onClick=\"return checkPassword()\" /><input type=\"hidden\" name=\"dochangepassword\" id=\"dochangepassword\" value=\"true\" /></td></tr>";
			$str .= "</table></form>";
			echo $str;
			?>
			<script language="javascript">
			function checkPassword(){
				if(document.myloginform.password.value != document.myloginform.cpassword.value ){
					alert("Your password and confirm password is not same. Please check again.");
					return false;
				}else{
					return true;
				}
			}
			</script>
			<?
		}
	}
	
	function logout(){
		session_unregister("userid");
		session_unregister("usertype");
	}
}
?>
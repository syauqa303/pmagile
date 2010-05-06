<?

//use this mail thing so that I'll later replace mail thing
function mymail($to,$subject,$body,$from){
	$mainBody = "<html>
	<head>
	<title>$subject</title>
	</head>
	<body><p>" . $body . "</p></body>
	</html>";	
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "To: ".$to." \r\n";
	$headers .= "From: ".$from." \r\n";
	echo "<br>To:".$to."<br>From:".$from."<br>Subject:".$subject."<br>Body:<br>".$mainBody."<br><br>";
	//mail($to,$subject,$body,$from);
}


?>
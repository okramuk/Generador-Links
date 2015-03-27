<?php

session_start();
$s=session_name();

if(empty($_SESSION["user"]) && empty($_SESSION["password"]))
		{ 
			header('Location: ../index.html');
		}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>IEPS .:::GENERADOR DE LINKS:::.</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<frameset rows="98,*" cols="*" frameborder="NO" border="0" framespacing="0">
  <frame src="header.htm" name="topFrame" scrolling="NO" noresize >
  <frameset rows="*" cols="250,*" framespacing="0" frameborder="NO" border="0">
    <frame src="menu.php" name="leftFrame" scrolling="YES" noresize>
    <frame src="welcome.html" name="mainFrame" scrolling="yes">
  </frameset>
</frameset>
<noframes>
<body>

</body>
</noframes>

</html>

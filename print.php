<!DOCTYPE html>
<html>
<head>
	<title>PHP PRINTING</title>
</head>
<body>

<form action="print.php" method="post">
 <input type="text" name="sometext">
 <input type="submit" name="print" value="Print"></ins>
</form>
<hr>
<?php
if(isset($_POST['print'])){
	if(!empty($_POST['sometext'])){
		echo $_POST['sometext'];
	}else{
		echo "please write some text!";
	}
}
?>
</body>
</html>
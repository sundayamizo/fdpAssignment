<!DOCTYPE html>
<html>
<head>
	<title>Feedback Form</title>
</head>
<body>
<p> Please give us feedback! </p>
<form action="feedback.php"  method="post">
	<label>Name: </label> 
	<input type="text" name="name">
	<label>Comment: </label> 
	<input type="text" name="comment">
	<input type="submit" name="submit" value="Submit">
</form>
<?php

$dbc = mysqli_connect("localhost","root","","feedb");
if(!$dbc){
	echo "Not connected!";
}
if(isset($_POST['submit'])){

	$err = array();

	if(!empty($_POST['name'])){
		$name = $_POST['name'];
	}
	else{
		$err[] = 'Please write your name!';
	}
	if(!empty($_POST['comment'])){
		$comment = $_POST['comment'];
	}
	else{
		$err[] = 'Please write your comment!';
	}

	if(empty($err)){
		$sql = "INSERT INTO feedbacks (`name`,`text`,`date`) values('$name','$comment',NOW())";
		$ins = mysqli_query($dbc,$sql);

		if($ins){
			echo "Thank you!";
		}

	}else{
		foreach ($err as $key => $value) {
			echo $value;
		}
	}




}

?>
<hr>
FEEDBACKS
<br>
<?php
$sel = "SELECT * from feedbacks";
$exe = mysqli_query($dbc,$sel);
?>
<ol>
<?php
while($row=mysqli_fetch_assoc($exe)){
	echo "<li>".$row['name']."<br>".$row['text']."<br><i>".$row['date']."</i></li>";
}

?>
</ol>
</body>
</html>
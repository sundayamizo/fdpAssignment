<!DOCTYPE html>
<html>
<head>
	<title>Loin Page</title>
</head>
<body>
<p>Login Form</p>




<?php
$dbc = mysqli_connect("localhost","root","","feedb");
if(!$dbc){
	echo "Not connected!";
}
			if (isset($_POST['login-submit'])) {

                  $error = array();
                  if (empty($_POST['email'])) {
                      $error[] = 'You forgot to enter  your email ';
                  } else {
                      if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['email'])) {
                          $email = $_POST['email'];
                      } else {
                           $error[] = 'Your email address is invalid  ';
                      }
                  }
                  if (empty($_POST['password'])) {
                      $error[] = 'Please Enter Your Password ';
                  } else {
                      $password = $_POST['password'];
                      
                  }

                     if (empty($error))
                  {
              		$query_check_credentials = "SELECT * FROM users WHERE (email='$email' AND password='$password')";
                      $result_check_credentials = mysqli_query($dbc, $query_check_credentials);
                      if(!$result_check_credentials){
                          echo 'Query Failed!';
                      }

                      if (@mysqli_num_rows($result_check_credentials) == 1)
                      { 

                             $_SESSION = mysqli_fetch_array($result_check_credentials, MYSQLI_ASSOC);
                             
              				header("Location: feedback.php");

                      }else
                      {

                         echo 'Your Password is incorrect!';
                      }

                  }  else {



              echo '<ol>';
                      foreach ($error as $key => $values) {

                          echo '	<li>'.$values.'</li>';

                      }
                      echo '</ol>';

                  }


                  mysqli_close($dbc);

              }

?>


<form action="login.php" method="post">
	<label>Email: </label>
	<input type="email" name="email">
	<br>
	<label>Password: </label>
	<input type="password" name="password">
	<br>
	<input type="submit" name="login-submit" value="Login" />

</form>

</body>
</html>
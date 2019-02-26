<?php
$connection = mysql_connect("localhost", "root", ""); // Establishing connection with server..
$db = mysql_select_db("college", $connection); // Selecting Database.
$name=$_POST['name1']; // Fetching Values from URL.
$email=$_POST['email1'];
$password= sha1($_POST['password1']); // Password Encryption, If you like you can also leave sha1.
// Check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "Invalid Email.......";
}else{
$result = mysql_query("SELECT * FROM registration WHERE email='$email'");
$data = mysql_num_rows($result);
if(($data)==0){
$query = mysql_query("insert into registration(name, email, password) values ('$name', '$email', '$password')"); // Insert query
if($query){
echo "You have Successfully Registered.....";
}else
{
echo "Error....!!";
}
}else{
echo "This email is already registered, Please try another email...";
}
}
mysql_close ($connection);
?>


<!DOCTYPE html>
<html>
<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--icon for footer-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <!--style for this webbapp//css file-->
    <link rel="stylesheet" type="text/css" href="css/signup.css">
    <script type="text/javascript" src="js/signup.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Roboto|Roboto+Condensed" rel="stylesheet">

  <title>Neophytes | Online Assessment</title>


</head>
<body>
<div class="container">
<div class="main">
<form class="form" method="post" action="#">
<h2>Create Registration Form Using jQuery</h2>
<label>Name :</label>
<input type="text" name="dname" id="name">
<label>Email :</label>
<input type="text" name="demail" id="email">
<label>Password :</label>
<input type="password" name="password" id="password">
<label>Confirm Password :</label>
<input type="password" name="cpassword" id="cpassword">
<input type="button" name="register" id="register" value="Register">
</form>
</div>
</div>
</body>
</html>
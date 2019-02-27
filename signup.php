<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$db = "college" ; // Selecting Database.
$conn = new mysqli($hostname , $username,$password,$db); // Establishing connection with server..

if (isset($_POST['dname']) && isset($_POST['demail'] )) {
  # code...

$name=$_POST['dname']; // Fetching Values from URL.
$email=$_POST['demail'];
$password= sha1($_POST['dpassword']); // Password Encryption, If you like you can also leave sha1.
// Check if e-mail address syntax is valid or not
$email = filter_var($email, FILTER_SANITIZE_EMAIL); // Sanitizing email(Remove unexpected symbol like <,>,?,#,!, etc.)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
echo "Invalid Email.......";
}else{
$result = mysql_query("SELECT * FROM registration WHERE email='$email'");
$data = mysql_num_rows($result);
if(($data)==0){
$sql = "INSERT INTO  registration(name, email, password) values ('$name', '$email', '$password')"; 
// Insert query
if($conn->query($sql) == TRUE){
echo "You have Successfully Registered.....";
}else
{
echo "Error....!!";
}
}else{
echo "This email is already registered, Please try another email...";
}
}
}
$conn -> close();
?>


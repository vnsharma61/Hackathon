<?php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["subject"]))
 {
  $error .= '<p><label class="text-danger">Subject is required</label></p>';
 }
 else
 {
  $subject = clean_text($_POST["subject"]);
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }

 if($error == '')
 {
  $file_open = fopen("contact_data.csv", "a");
  $no_rows = count(file("contact_data.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'sr_no'  => $no_rows,
   'name'  => $name,
   'email'  => $email,
   'subject' => $subject,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $error = '<label class="text-success">Thank you for contacting us</label>';
  $name = '';
  $email = '';
  $subject = '';
  $message = '';
 }
}

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
    <link rel="stylesheet" type="text/css" href="css/style.css">

	<title>NEOPHYTES | ONLINE TESTS </title>
</head>
 <body>


     <!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&--Header Begins--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <a class="navbar-brand" href="">NEOPHYTES</a>
     <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="navbar-nav mr-auto">
         <li class="nav-item active">
           <a class="nav-link" href="main_index.html">Home <span class="sr-only">(current)</span></a>
         </li>
         <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Courses
           </a>
           <div class="dropdown-menu" aria-labelledby="navbarDropdown">
             <a class="dropdown-item" href="#">General Knowledge</a>
             <a class="dropdown-item" href="#">Aptitude Test</a>
             <a class="dropdown-item" href="#">IQ Test</a>
           </div>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="#">About</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="#">Contact</a>
         </li>
       </ul>
       <ul class="navbar-nav ml-auto">
         <a href="#"><button type="button" class="btn btn-outline-dark text-right">Sign In</button></a>
         <a href="#"><button type="button" class="btn btn-outline-dark">Sign Up</button></a>
       </ul>
     </div>
   </nav>

   <!-- Page Title Starts-->
     <section class="pageTitle">
       <div class="container text-left">
         <div class="row">
           <div class="col-md-12">
             <h2 class="text-white">Contact</h2>
           </div>
         </div>
       </div>
     </section>

     <!--Contact Welcome Starts-->
     <section class="contWel">
       <div class="container text center">
         <div class="row">
           <div class="col-md-6">
             <h2>Get in touch with us</h2>
             <div class="sep"></div>
             <p>128-lm street, Paris<br>

     <strong>Phone:</strong> 7569823410<br>
     <strong>Email:</strong> evangelion@gmail.com<br>
     <strong></strong>
</p>
</div>
     <?php echo $error; ?>
     <div class="col-md-6">
       <div class="container-fluid">
       <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php echo $name; ?>" />
       </div>
     <div class="form-group">
      <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
     </div>
     <div class="form-group">
      <input type="text" name="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $subject; ?>" />
     </div>
     <div class="form-group">
      <textarea name="message" class="form-control" rows="5" placeholder="Enter Message"><?php echo $message; ?></textarea>
     </div>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-primary" value="Submit" />
     </div>
    </form>
   </div>
  </div>
</div>
</section>

<!--Footer Section starts-->
<footer class="bg-dark py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <p class="text-white">Copyright 2018 Paradise Design.All rights reserved.</p>
      </div>
      <div class="col-md-6">
        <ul class="social text-white text-right">
          <li>
            <i class="fa fa-facebook-official" aria-hidden="true"></i>
          </li>
          <li>
            <i class="fa fa-instagram" aria-hidden="true"></i>
          </li>
          <li>
            <i class="fa fa-twitter-square" aria-hidden="true"></i>
          </li>
      </div>

    </div>
</footer>

 </body>
</html>

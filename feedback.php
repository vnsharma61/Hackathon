<?php
//index.php

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
  $file_open = fopen("contact_data.csv", "w+");
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

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Roboto|Roboto+Condensed" rel="stylesheet">

  <title>Neophytes | Online Assessment</title>


</head>
 <body>

   <!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&--Header Begins--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
 <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top topnav">
   <a class="navbar-brand" href="">NEOPHYTES</a>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-icon"></span>
   </button>

   <div class="collapse navbar-collapse" id="navbarSupportedContent">
     <ul class="navbar-nav mr-auto">
         <a class="nav-link" href="main_index.html">Home <span class="sr-only">(current)</span></a>
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


       <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#popUpWindow">Log In</button>

     <div class="modal fade" id="popUpWindow">
         <div class="modal-dialog">
             <div class="modal-content">

                 <!-- header -->
                 <div class="modal-header">
                     <h3 class="modal-title mr-auto">Log In</h3>
                     <button type="button" class="close ml-auto" data-dismiss="modal">&times;</button>
                 </div>

                 <!-- body (form) -->
                 <div class="modal-body">
                   <form id="form_id" method="post" name="myform">
                       <label>User Name :</label>
                       <input type="text" name="username" id="username"/>
                       <label>Password :</label>
                       <input type="password" name="password" id="password"/>
                       <input type="button" value="Login" id="submit" onclick="validate()"/>
                   </form>
                  <!--   <form role="form">
                         <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email">
                         </div>
                         <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password">
                         </div>
                     </form>-->
                 </div>

                 <!-- button -->
                <!-- <div class="modal-footer">
                     <button class="btn btn-primary btn-block">Submit</button>
                 </div>-->
               </div>
         </div>
     </div>

 </div>
       <a href="signup.html" target="_blank"><button type="button" class="btn btn-outline-dark">Sign Up</button></a>
     </ul>
   </div>
 </nav>



   <!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&--Header Ends--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->

   <!-- Optional JavaScript -->
       <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
       <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>








  <br />
  <div class="container">
   <h1 align="center">FEEDBACK FORM</h1>
   <br />
   <div class="col-md-6" style="margin:0 auto; float:none;">
    <form method="post">
     <br />
     <?php echo $error; ?>
     <div class="form-group">
      <label>Enter Name</label>
      <input type="text" name="name" placeholder="Enter Name" class="form-control" value="<?php echo $name; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Email</label>
      <input type="text" name="email" class="form-control" placeholder="Enter Email" value="<?php echo $email; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Subject</label>
      <input type="text" name="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $subject; ?>" />
     </div>
     <div class="form-group">
      <label>Enter Message</label>
      <textarea name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?></textarea>
     </div>
     <div class="form-group" align="center">
      <input type="submit" name="submit" class="btn btn-info" value="Submit" />
     </div>
    </form>
   </div>
  </div>

  <!--Footer Section starts-->
  <footer class="bg-dark py-5">
    <div class="container">
      <div class="row">
        <div class="left">
          <p class="text-white">Copyright 2018 Paradise Design.All rights reserved.</p>
        </div>
        <div class="right">
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
  <!--Footer Section Ends-->





 </body>
</html>

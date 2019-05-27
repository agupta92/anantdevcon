<?php

include 'functions.php';

if (!empty($_POST)){

  $data['success'] = true;
  $_POST  = multiDimensionalArrayMap('cleanEvilTags', $_POST);
  $_POST  = multiDimensionalArrayMap('cleanData', $_POST);

  //your email adress 
  $emailTo ="anantdevcon@gmail.com,agupta.92@gmail.com"; //"yourmail@yoursite.com";

  //from email adress
  $emailFrom ="anantdevcon@gmail.com"; //"contact@yoursite.com";

  //email subject
  $emailSubject = "Enquiry by Customer";

  $name = $_POST["name"];
  $email = $_POST["email"];
  $tel = $_POST["tel"];
  $comment = $_POST["comment"];
  if($name == "")
   $data['success'] = false;
 
 if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) 
   $data['success'] = false;


 if($comment == "")
   $data['success'] = false;

 if($data['success'] == true){

  $message = "NAME: $name<br>
  EMAIL: $email<br>
  PHONE: $tel<br>
  COMMENT: $comment";


  $headers  = "MIME-Version: 1.0" . "\r\n"; 
  $headers .= "Content-type:text/plain; charset=utf-8" . "\r\n"; 
  $headers .= "From: <$emailFrom>" . "\r\n";
  $headers .= "Reply-To: $emailFrom\r\n";
  $headers .= "Return-Path: $emailFrom\r\n";
  $headers .= "X-Priority: 3\r\n";
  $headers .= "X-Mailer: PHP". phpversion() ."\r\n" ;

  mail($emailTo, $emailSubject, $message, $headers);

  $data['success'] = true;
  echo json_encode($data);
}
}
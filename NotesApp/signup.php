<?php

//start session 
session_start();

//connect to database
include('connect.php');

//check user inputs

//define error messages
//username not entered
$noAccUsername = "<p>Please create a username.</p>";

//username already exists
$usernameAlreadyExists = "<p>This username is already registered, please login if you already have an account or select a different username to create a new account.</p>";
//email already exists
$emailAlreadyExists = "<p>This email address is already registered, please login if you already have an account.</p>";
//no email entered, invalid email entered
$noAccEmail = "<p>Please enter your email address.</p>";
$invalidAccEmail = "<p>Please enter a valid email address.</p>";
//password not entered
$noAccPassword = "<p>Please create a password.</p>";
//password not correct 
$invalidAccPassword = "<p>This password is invalid, please try again. Password must be between 6 and 15 characters, contain one capital letter and one number.</p>";
//confirm password not entered
$noAccPassword2 = "<p>Please confirm your password.</p>";
//passwords don't match
$differentPasswords = "<p>Passwords do not match. Please try again.</p>";


//get username, email, password, password 2 and store errors in errors variable
//Username
if(empty($_POST["accusername"])){
    $errors .= $noAccUsername;
}else{
    $username = filter_var($_POST["accusername"], FILTER_SANITIZE_STRING);
}

//email
if(empty($_POST["accemail"])){
    $errors .= $noAccEmail;
}else{
    $email = filter_var($_POST["accemail"], FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidAccEmail;  
    }
}

//password
if(empty($_POST["accpassword"])){
    $errors .= $noAccPassword;
 //check password is > 6 characters, has one capital and one number 
}elseif(!(strlen($_POST["accpassword"])>6 and preg_match('/[A-Z]/', $_POST["accpassword"]) and preg_match('/[0-9]/', $_POST["accpassword"]))){
    $errors .= $invalidAccPassword;
}else{
    $password = filter_var($_POST["accpassword"], FILTER_SANITIZE_STRING); 
    //password2
    if(empty($_POST["accpassword2"])){
        $errors .= $noAccPassword2;
    }else{
        $password2 = filter_var($_POST["accpassword2"], FILTER_SANITIZE_STRING);
        //do passwords match - if password is different to password2
        if($password !== $password2){
            $errors .= $differentPasswords;
        }
    }
}
    

//if errors - print error message
if($errors){
    $resultmessage = '<div class="alert alert-warning">' . $errors . '</div>';
    echo $resultmessage;
    exit;
}




//if no errors
//prepare variables for queries
$username = mysqli_real_escape_string($link, $username);
$email = mysqli_real_escape_string($link, $email);
$password = mysqli_real_escape_string($link, $password);

//encrypt password
$password = hash('sha256', $password);

//If username already exists - error 
    //create query
$sql = "SELECT * FROM useraccounts WHERE username = '$username'";
    //run query
$result = mysqli_query($link, $sql);
    //if unsuccessful
if(!$result){
    echo '<div class="alert alert-warning">Error running the query.</div>';
    exit;
}
//if successful, is there a record 
$records = mysqli_num_rows($result);
//if there is a record the username exists - error message - make new username or login. 
if($records){
    $errors .= $usernameAlreadyExists;
}else{
 //create query
$sql = "SELECT * FROM useraccounts WHERE email = '$email'";
    //run query
$result = mysqli_query($link, $sql);
    //if unsuccessful
if(!$result){
    echo '<div class="alert alert-warning">Error running the query.</div>';
    exit;
}
//if successful
$records = mysqli_num_rows($result);
//if there is a record the email exists - error message -login. 
if($records){
    $errors .= $emailAlreadyExists;  
}
}



//Create unique activation code 
$activationkey = bin2hex(openssl_random_pseudo_bytes(16));


//Insert user details and activation code in users table

    //create query
$sql = "INSERT INTO useraccounts (username, email, password, activation) VALUES ('$username', '$email', '$password', '$activationkey')";
    //run query
$result = mysqli_query($link, $sql);

//if unsuccessful
if(!$result){
     echo '<div class="alert alert-warning">Error running the query to insert record in the uaseraccounts table.</div>';
    //debugging
//    echo '<div class="alert alert-danger">' .mysqli_error($link) . '</div>';
     exit;
}


//PHPMailer
    
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

$mail = new PHPMailer();
$mail->isSMTP();
$mail->Host = gethostname();
$mail->SMTPAuth = true;
$mail->Username = 'notesaccount@bryonykimwebdev.com';
$mail->Password = 'g9wI)ZWn+!D6';
$mail->setFrom('notesaccount@bryonykimwebdev.com');
$mail->addAddress($email);
$mail->Subject = 'Confirm Notes account';
$body = file_get_contents('email.html');
$body2 = file_get_contents('email2.html');
$break = file_get_contents('break.html');
$mail->MsgHTML($body . "Dear $username" . $break . "Thank you for creating an account with Notes!" . $break . "Please click on the link below to activate your account:" .  $break . "https://bryonykimwebdev.com/NotesApp/activate.php?email=" . urlencode($email) . "&key=" . $activationkey . $break . "Kind regards"
. $body2);
$mail->IsHTML(true); 
$mail->CharSet="utf-8"; 

//if email sent successfully
if($mail->send()){
    echo '<div class="alert alert-success">Thank you for creating an account! A confirmation email has been sent to the email address provided. Please activate your account by clicking on the activation link in this email.</div>';
}else{
    echo '<div class="alert alert-warning">Account creation unsuccessful. Please try again or contact the support team at notesaccount@bryonykimwebdev.com.</div>'; 
}

?>
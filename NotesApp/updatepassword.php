<!-- This file will be used to update the user's password when they change it on the account settings page. It will receive an ajax call from accountSettings.js -->

<?php
//start session
session_start();

//connect to database
include("connect.php");

//define error messages
//empty field
$noEmail = "<p>Please enter your email address.</p>";
//email doesn't match database
$incorrectEmail = "<p>Email incorrect. Please try again.</p>";
//empty field
$noCurrentPassword = "<p>Please enter your current password.</p>";
//password doesn't match database
$incorrectCurrentPassword = "<p>Password incorrect. Please try again.</p>";
//empty fields
$noNewPassword = "<p>Please enter your new password.</p>";
$noConfirmPassword = "<p>Please confirm your new password.</p>";
//doesn't meet password requirements
$invalidNewPassword = "<p>Your new password must be 6-12 characters, contain 1 number and 1 upper case letter.</p>";
//confirm new password doesn't match new password
$differentNewPasswords = "New password and confirm new password do not match. Please try again.";


//if errors

//missing email address - changePasswordEmail
if(empty($_POST["changePasswordEmail"])){
    $errors .= $noEmail;
}else{
    //store inside variable
    $email = $_POST["changePasswordEmail"];
    
    //filter/sanitize email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        
    //prepare for query
    $email = mysqli_real_escape_string($link, $email);
    
    //check in database if email is correct.
    //get user id
    $user_id = $_SESSION["user_id"];
    
    //create query
    $sql = "SELECT email FROM useraccounts WHERE user_id = '$user_id'";
    
    //run query
    $result = mysqli_query($link, $sql);
    
    //check how many records
    $count = mysqli_num_rows($result);
    
    //if correct should be one record, so if not equal to 1 - error
    if($count !== 1){
        echo "<div class='alert alert-warning mt-5'>There was a problem running the query to find the email in the database.</div>";
    }else{
        //fetch row
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        //retrieve email from row and check if matches email entered, if not
        if($email !== $row["email"]){
            $errors .= $incorrectEmail;
        }  
    }
}

//missing current password. id="currentPassword" 
if(empty($_POST["currentPassword"])){
    $errors .= $noCurrentPassword;
}else{
    //store inside variable
    $currentPassword = $_POST["currentPassword"];
    
    //filter/sanitize password
    $currentPassword = filter_var($currentPassword, FILTER_SANITIZE_STRING);
    
    //prepare for query
    $currentPassword = mysqli_real_escape_string($link, $currentPassword);
    
    //re-hash password 
    $currentPassword = hash('sha256', $currentPassword);
    
    //get user id
    $user_id = $_SESSION["user_id"];
    
    //create query
    $sql = "SELECT password FROM useraccounts WHERE user_id = '$user_id'";
    
    //run query
    $result = mysqli_query($link, $sql);
    
    //check how many records
    $count = mysqli_num_rows($result);
    
    //if correct should be one, so if not - error
    if($count !== 1){
        echo "<div class='alert alert-warning mt-5'>There was a problem running the query to find the password in the database.</div>";
    }else{
        //fetch row
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        //retrieve password from row and check matches password entered, if not
        if($currentPassword !== $row["password"]){
            $errors .= $incorrectCurrentPassword;
        }  
    }
}

//missing new password. name="newPassword" 

//if not entered - error.
if(empty($_POST["newPassword"])){
    $errors .= $noNewPassword;
//check if password is > 6 characters, has one capital and one number 
}elseif(!(strlen($_POST["newPassword"])>6 and preg_match('/[A-Z]/', $_POST["newPassword"]) and preg_match('/[0-9]/', $_POST["newPassword"]))){
    $errors .= $invalidNewPassword;
}else{
    $password = filter_var($_POST["newPassword"], FILTER_SANITIZE_STRING); 
    
    //confirm new password
    if(empty($_POST["confirmNewPassword"])){
        $errors .= $noConfirmPassword;
    }else{
        $password2 = filter_var($_POST["confirmNewPassword"], FILTER_SANITIZE_STRING);
        //do passwords match, if not - error
        if($password !== $password2){
            $errors .= $differentNewPasswords;
        }
    }
}
  

//if errors
if($errors){
    //error
    $errorMessage = "<div class='alert alert-warning mt-5'>$errors</div>";
    echo $errorMessage;
}else{
    //otherwise run query to update password
    
    //prepare password variable for query
    $password = mysqli_real_escape_string($link, $password);
    
    //hash password 
    $password = hash('sha256', $password);
    
    //create query
    $sql = "UPDATE useraccounts SET password = '$password' WHERE user_id = '$user_id'";
    
    //execute query
    $result = mysqli_query($link, $sql);
        
   //if unsuccessful
   if(!$result){
       //error
       echo "<div class='alert alert-warning mt-5'>Password was not updated. Please try again.</div>";
   }else{
       //if successful
       echo "<div class='alert alert-success mt-5'>Password updated successfully!</div>";
   }
}
    
?>
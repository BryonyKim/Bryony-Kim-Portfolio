<!--This file receives user_id, generated resetkey, newpassword1 and newpassword2-->
<!--If all checks are correct, this file will reset the password for the given user_id-->

<?php

//start session
session_start();
//connect to database
include("connect.php");

//checks for user_id and resetkey

    //if user_id or reset key are missing. 
    if(!isset($_POST["user_id"]) || !isset($_POST["resetkey"])){
        //error
        echo '<div class="alert alert-warning">There was an error. Please click on the link in your password reset email.</div>';
        exit;
    }

    //store in variables. 
    $user_id = $_POST['user_id'];
    $key = $_POST['resetkey'];    

    //define a time variable
    $time = time() +60*60*5 - 86400;

    //prepare variables for query
    $user_id = mysqli_real_escape_string($link, $user_id); 
    $key = mysqli_real_escape_string($link, $key); 

    //create query - Check combination of user_id and key exists and resetkey hasn't been used.
    $sql = "SELECT user_id FROM forgottenpassword WHERE resetkey = '$key' AND user_id = '$user_id' AND status = 'pending'";
        
    //run query
    $result = mysqli_query($link, $sql);
        
    //if unsuccessful
    if(!$result){
      //error
      echo '<div class="alert alert-warning mt-5">Error running the query to check the resetkey and user_id.</div>'; 
      exit;
    }

    $count = mysqli_num_rows($result);
    
    if($count == 0){
        //combination doesn't exist - error 
        echo '<div class="alert alert-warning mt-5">Error: Please try again.storeresetpassword.php</div>';
        exit;
    }
       

//check user inputs - fields from form in resetpassword.php

    //error messages
    $noNewPassword = "<p>Please create a password.</p>";
    $invalidNewPassword = "<p>This password is invalid, please try again. Password must be between 6 and 15 characters, contain one capital letter and one number.</p>";
    $noNewPassword2 = "<p>Please confirm your password.</p>";
    $differentPasswords = "<p>Passwords do not match. Please try again.</p>";

    //password
    if(empty($_POST["newpassword"])){
        $errors .= $noNewPassword;
     //check password is > 6 characters, has one capital and one number 
    }elseif(!(strlen($_POST["newpassword"])>6 and preg_match('/[A-Z]/', $_POST["newpassword"]) and preg_match('/[0-9]/', $_POST["newpassword"]))){
        $errors .= $invalidNewPassword;
    }else{
        $password = filter_var($_POST["newpassword"], FILTER_SANITIZE_STRING); 
        //password2
        if(empty($_POST["newpassword2"])){
            $errors .= $noNewPassword2;
        }else{
            $password2 = filter_var($_POST["newpassword2"], FILTER_SANITIZE_STRING);
            //do passwords match? if not
            if($password !== $password2){
                $errors .= $differentPasswords;
            }
        }
    }

    //if errors
    if($errors){
        $resultmessage = '<div class="alert alert-warning">' . $errors . '</div>';
        echo $resultmessage;
    }else{

    //no errors

    //prepare variables for query
    $user_id = mysqli_real_escape_string($link, $user_id);
    $password = mysqli_real_escape_string($link, $password);

    //hash password
    $password = hash('sha256', $password);

    //create query
    $sql = "UPDATE useraccounts SET password = '$password' WHERE user_id = '$user_id'";

    //run query
    $result = mysqli_query($link, $sql);

    //if unsuccessful
    if(!$result){
        echo '<div class="alert alert-warning">Error updating the password.</div>';
    }else{
    //if successful
    //change status of key in forgottenpassword table to 'used'.
    //create query
    $sql = "UPDATE forgottenpassword SET status = 'used' WHERE resetkey = '$key' AND user_id = '$user_id'";
    //run query
    $result = mysqli_query($link, $sql);
    //if unsuccessful
    if(!$result){
        echo '<div class="alert alert-warning">Error updating the status of the resetkey.</div>';
    }else{
        //if successful
        echo '<div class="alert alert-success">Your password has been updated!<br /><a class="text-dark" href="index.php">Login</a></div>';
    }
    }
    }

?>
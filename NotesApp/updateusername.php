<!-- This file will be used to update the user's username when they change it on the account settings page. It will receive an ajax call from accountSettings.js -->

<?php
//start session
session_start();

//connect to database
include("connect.php");

//define error messages
//empty field
$noPassword = "<p>Please enter your password.</p>";
//password doesn't match database
$incorrectPassword = "<p>Password incorrect. Please try again.</p>";
//empty field
$noNewUsername = "<p>Please enter your new username.</p>";

//if errors
//new username
//if no value entered, print error
if(empty($_POST["newUsername"])){
    $errors .= $noNewUsername;
}else{
    $username = filter_var($_POST["newUsername"], FILTER_SANITIZE_STRING); 
}

//password
if(empty($_POST["changeUserPassword"])){
    $errors .= $noPassword;
}else{
    //store inside variable
    $password = $_POST["changeUserPassword"];
    
    //filter/sanitize password
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    
    //prepare for query
    $password = mysqli_real_escape_string($link, $password);
    
    //re-hash password
    $password = hash('sha256', $password);
    
    //get user id
    $user_id = $_SESSION["user_id"];
    
    //create query
    $sql = "SELECT password FROM useraccounts WHERE user_id = '$user_id'";
    
    //run query
    $result = mysqli_query($link, $sql);
    
    //check how many records
    $count = mysqli_num_rows($result);
    
    //if correct should be one, if not 1 - error
    if($count !== 1){
        echo "<div class='alert alert-warning mt-5'>There was a problem running the query to find the password in the database.</div>";
    }else{
        //fetch row 
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        //retrieve password from row and check it matches password entered, if not
        if($password !== $row["password"]){
            $errors .= $incorrectPassword;
        }  
    }
}

//if errors
if($errors){
    //error
    $errorMessage = "<div class='alert alert-warning mt-5'>$errors</div>";
    echo $errorMessage;
}else{

    //update username in database table
    
    //prepare username variable for query
    $username = mysqli_real_escape_string($link, $username);

    //get user_id from session array
    $user_id = $_SESSION["user_id"];

    //create query
    $sql = "UPDATE useraccounts SET username = '$username ' WHERE user_id = '$user_id'";

    //run query
    $result = mysqli_query($link, $sql);

    //if unsuccessful
    if(!$result){
        echo "<div class='alert alert-warning mt-5'>Username not updated. Please try again.</div>";
    }else{
        //if successful
        echo "<div class='alert alert-success mt-5'>Username updated successfully! Please refresh your page.</div>";
    }
}

?>


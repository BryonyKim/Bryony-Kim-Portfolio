<!-- This file will update the user's email when they change it on the account settings page. It will receive an ajax call from accountSettings.js -->

<?php
//start session
session_start();

//connect to database
include("connect.php");

//define error messages
//empty email field
$noEmail = "<p>Please enter your new email address.</p>";
//invalid email
$invalidEmail = "<p>Please enter a valid email address.</p>";
//empty password field
$noPassword = "<p>Please enter your password.</p>";
//password doesn't match database
$incorrectPassword = "<p>Password incorrect. Please try again.</p>";

//check if errors

//missing email address 
if(empty($_POST["changeEmailEmail"])){
    $errors .= $noEmail;
}else{
    //store inside variable.
    $email = $_POST["changeEmailEmail"];
    
    //filter/sanitize email
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors .= $invalidEmail;  
    }
}

//password
//missing current password
if(empty($_POST["changeEmailPassword"])){
    $errors .= $noPassword;
}else{
    //store inside a variable.
    $password = $_POST["changeEmailPassword"];
    
    //filter/sanitize password
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    
    //prepare for query
    $password = mysqli_real_escape_string($link, $password);
    
    //re-hash password
    $password = hash('sha256', $password);
    
    //check in database if password is correct.
       
    //get user id
    $user_id = $_SESSION["user_id"];
    
    //create query
    $sql = "SELECT password FROM useraccounts WHERE user_id = '$user_id'";
    
    //run query
    $result = mysqli_query($link, $sql);
    
    //check how many records we have in the result
    $count = mysqli_num_rows($result);
    
    //if all correct there should be one matching record, so if it does not equal 1 there is an error.
    if($count !== 1){
        echo "<div class='alert alert-warning mt-5'>There was a problem running the query to find the password in the database.</div>";
    }else{
        //fetch the row in the result object
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        //retrieve password from that row and check if matches password entered.
        //if don't match
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
    exit;
}

//get user_id and new email (sent through the ajax call)

//get the user_id from the session variable.
$user_id = $_SESSION["user_id"];

//old email before running the query to update the session variables, so get this from the original session variable.
$oldEmail = $_SESSION["email"];

        
//prepare variable for query
$email = mysqli_real_escape_string($link, $email);

//create query - check if new email exists in the database
$sql = "SELECT * FROM useraccounts WHERE email = '$email'";
//run query
$result = mysqli_query($link, $sql);
//how many rows in the $result
$count = mysqli_num_rows($result);
//if count > 0 email already exists and can't be used - echo error.
if($count>0){
    echo "<div class='alert alert-warning mt-5'>Email address already in use.</div>";
}else{
    //get user_id from session array.
    $user_id = $_SESSION["user_id"];

    //create query
    $sql = "SELECT * FROM useraccounts WHERE user_id = '$user_id'";

    //run query
    $result = mysqli_query($link, $sql);

    //check number of rows.
    $count = mysqli_num_rows($result);

    //if number of rows equals 1
    if($count == 1){
        //fetch the row
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //change session variable to new value
        $_SESSION['username'] = $row['username'];
    }else{
        //error
        echo "<div class='alert alert-warning mt-5'>There was an error retrieving the username and email from the database.</div>";
    }
    
    //variable for username using session array.
    $user = $_SESSION["username"];
    
    //create unique activation code
    $changeEmailActivation = bin2hex(openssl_random_pseudo_bytes(16));  
    
    //insert $changeEmailActivation into useraccounts database table.
    //create query
    $sql = "UPDATE useraccounts SET changeEmailActivation = '$changeEmailActivation' Where user_id = '$user_id'";
    
    //run query
    $result = mysqli_query($link, $sql);
    
    //if error
    if(!$result){
        echo "<div class='alert alert-warning mt-5'>Error storing the change email activation key in the useraccounts table.</div>";
    }else{
        //send email to user, containing a link which will go to the file activatechangeemail.php. 
        
        //needed due to having html content.
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: notesaccount@bryonykimwebdev.com' . "\r\n";

        //body of email
        $message = "<html><body><p style='font-size: 24px; color: coral; font-weight: bold'>Notes</p><br /><p class='text-dark' style='font-size:15px'>Dear " . $user . "</p><br /><p class='text-dark' style='font-size:15px'>You have changed your email address in your Notes account!</p><p class='text-dark' style='font-size:15px'>Please click on the link below to confirm this is your active email address:</p><p class='text-dark' style='font-size:15px'>https://bryonykimwebdev.com/NotesApp/changeemail.php?email=" . urlencode($email) . "&oldemail=" . urlencode($oldEmail) . "&changeEmailActivation=" . $changeEmailActivation . "</p><br /><p class='text-dark' style='font-size:15px'>Kind regards</p><br /><p style='font-size:15px; font-weight: bold; color: coral'>The Notes Team</p></body></html>";
        
        //if successfully sent
        if(mail($email, 'Confirm change of email address with Notes', $message, $headers)){
            echo '<div class="alert alert-success">You have registered a change of email! A confirmation email has been sent to your new email address. Please click on the activation link in this email to confirm your new email address and then re-login.</div>';
            session_destroy();
        }else{
            echo '<div class="alert alert-warning">Change of email address unsuccessful. Please try again or contact the support team at notesaccount@bryonykimwebdev.com.</div>'; 
        }
        session_destroy();
}
    
}

?>
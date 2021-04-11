<?php
//start session 
session_start();
//connect to database
include("connect.php");


//define error messages

//no email entered
$noUsername = "<p>Please enter your username.</p>";

//no password entered
$noPassword = "<p>Please enter your password.</p>";


//get username and password and store errors in errors variable
//Username
if(empty($_POST["username"])){
    $errors .= $noUsername;
}else{
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
}

//password
if(empty($_POST["password"])){
    $errors .= $noPassword;
}else{
    $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING); 
}
    


//if errors
if($errors){
    $resultmessage = '<div class="alert alert-danger">' . $errors . '</div>';
    echo $resultmessage;
}else{
    //prepare variables for query
    $username = mysqli_real_escape_string($link, $username);
    $password = mysqli_real_escape_string($link, $password);
    //rehash password
    $password = hash('sha256', $password);


//run query: check combination of email and password exists
    //create query.
$sql = "SELECT * FROM useraccounts WHERE(username = '$username' AND password = '$password' AND activation = 'activated')";
    //run query
$result = mysqli_query($link, $sql);

//if query unsuccessful
if(!$result){
    echo '<div class="alert alert-danger">Error running query.</div>';
    exit;
}

//check 1 row
$count = mysqli_num_rows($result);
//if number of rows does not equal 1
if($count !== 1){
    //error message - wrong username or password.
    echo '<div class="alert alert-danger">Incorrect username or password. Please try again.</div>';
}else{
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    //set session variables.
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];
    
    //check if remember me box has been ticked. 
    if(empty($_POST["remember"])){
            //links to ajax call on index.js to redirect to notes page.
        echo "success";
    }else{
        //remember me process
        
        
//create two random variables $verification1 and $verification2
        $verification1 = bin2hex(openssl_random_pseudo_bytes(10));
    
        $verification2 = openssl_random_pseudo_bytes(20);
        
//store them in a cookie
     
        //define function
        function f1($a, $b){
            $c = $a . "," . bin2hex($b);
            return $c;
        }
        //set cookie value
        $cookieValue = f1($verification1, $verification2);
        
        //create cookie
        setcookie(
            "rememberme",
            $cookieValue,
            time() + 30*24*60*60
        );
        
        
       //run query to store in rememberme table
        
        function f2($a){
            $b = hash('sha256', $a);
            return $b;
        }
        
        //define variables
        //apply function to verification2
        $f2verification2 = f2($verification2);
        
        //user_id - get this from session variables.
        $user_id = $_SESSION["user_id"];
        
        //expiry 
        $expiry = date("Y-m-d H:i:s", time() + 30*24*60*60);
        
        //create query
        $sql = "INSERT INTO rememberme (verification1, f2verification2, user_id, expiry) VALUES ('$verification1', '$f2verification2', '$user_id', '$expiry')";
        
        //run query
        $result = mysqli_query($link, $sql);
        
        //if unsuccessful
        if(!$result){
            echo '<div class="alert alert-danger>There was an error storing the data to remember your details for next time.</div>';
        }else{
            //success is defined in AJAX call on index.js
           echo "success"; 
        }
    }
}
}

?>
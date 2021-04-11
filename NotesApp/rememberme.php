<?php
//if user not logged in and rememberme cookie exists
if(!isset($_SESSION["user_id"]) && !empty($_COOKIE["rememberme"])){
    
    // cookie details
        //function f1: $a . "," . bin2hex($b);   
        //function f2: hash('sha256', $a);    
    
    //split cookie into two parts using explode() to get array of strings. 
        //parameters - criteria to divide cookie (in this case ','), value of cookie
    //store outputs of exploding in $verification1 and $verification2. 
    
    list($verification1, $verification2) = explode(',', $_COOKIE["rememberme"]);
    
    //convert value of $verification2 from hexidecimal to binary to get original value.
    $verification2 = hex2bin($verification2);
    
    //look in rememberme table in database to match these values with the values stored.
       //$verification2 was hashed.
    $f2verification2 = hash('sha256', $verification2);
    
    
    //look for record with verification1 in rememberme table
   
    //create query
    $sql = "SELECT * FROM rememberme WHERE verification1 = '$verification1'";
    
    //run query
    $result = mysqli_query($link, $sql);
    
    //if unsuccessful:
    if(!$result){
        //error message
        echo '<div class="alert alert-danger">There was an error running the query to look for the verification1 variable in the rememberme table.</div>';
    }else{
        //should have 1 match
        $count = mysqli_num_rows($result);
        //if not 1, echo error.
        if($count !== 1){
            session_destroy();
        }
        //fetch record, store record in variable $row
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        //compare f2verification2 from rememberme table with $f2verification2, if match - log user in.
        if(!hash_equals($row['f2verification2'], $f2verification2)){
        //if don't match
            echo '<div class="alert alert-danger">hash_equals returned false - The 2nd verification variable does not match the table record.</div>';
        }else{
            
            //generate new verification variables and store in a cookie and rememberme table

            //create random variables $verification1 and $verification2 
            $verification1 = bin2hex(openssl_random_pseudo_bytes(10));
    
            $verification2 = openssl_random_pseudo_bytes(20);
        
            //store in cookie
        
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
        
        
           //run query to store them in rememberme table
            //define function f2 for verification2 variable
            function f2($a){
                $b = hash('sha256', $a);
                return $b;
            }

            //define variables
            //apply function to verification2
            $f2verification2 = f2($verification2);

            //user_id - session variables.
            $user_id = $_SESSION["user_id"];

            //expiry - matches cookie
            $expiry = date("Y-m-d H:i:s", time() + 30*24*60*60);

            //create query
            $sql = "INSERT INTO rememberme (verification1, f2verification2, user_id, expiry) VALUES ('$verification1', '$f2verification2', '$user_id', '$expiry')";

            //run query
            $result = mysqli_query($link, $sql);

            //if unsuccessful
            if(!$result){
                //error
                echo '<div class="alert alert-danger">There was an error storing the data to remember your details for next time.</div>';
            }
            
        
            //log user in using session variables. 
            $_SESSION['user_id'] = $row['user_id'];
            //redirect to notes page. 
            header("Location: notes.php");
        }
}
}

?>
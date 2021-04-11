<?php
//Clicks logout. Sends to index.php with GET parameter. 
//GET parameter will be caught by logout.php 


//is user_id session variable set
if(isset($_SESSION["user_id"]) && $_GET["logout"] == 1){
    //destroy session.
    session_destroy();
    
    //destroy rememberme cookie.
    setcookie("rememberme", "", time() - 3600);
}

?>
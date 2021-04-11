<!--The user is redirected to this file after clicking the activation link in the email received after creating an account. -->

<!--Sign-up link contains two GET parameters: email and activation key.-->

<?php
//start session
session_start();

//connect to database
include('connect.php');
?>


<?php  ob_start();  ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <link rel="stylesheet" href="stylesheet.css">
        
        
        <title>Notes App - Account Activation</title>
        
     
</head>
    

 <body>
     
<!--     Navbar  - menu  -->
     
     <nav role="navigation" class="navbar fixed-top navbar-expand navbar-light d-flex">
         
<!-- Brand  -->
         <div class="navbar-brand mr-5" href="index.php">
         <img src="images/LogoMakr_8qk2wC_postit_logo.png" style="height: 30px">
         <a class="navbar-brand p-0 mr-0" href="index.php" id="homeLink">Notes</a>
        </div>
    </nav>
     
    <div class="container-fluid">

    <!-- heading and description    -->
         <div class="jumbotron  text-center mt-5 mb-0" id="description">
            <h1 class="display-4">Account Activation</h1>
         </div>

    <!-- container for notes and buttons  -->
         <div class="contents col-sm-10 col-md-9 col-lg-7 col-xl-5 mx-auto">


<?php

//If email or activation key are missing, show error message 
    
if(!isset($_GET["email"]) || !isset($_GET["key"])){
    echo '<div class="alert alert-warning">There was an error. Please re-click on the activation link in your account confirmation email. </div>';
}else{
   // store them in variables
    $email = $_GET["email"];
    $key = $_GET["key"];
    
    //prepare variables for query
    $email = mysqli_real_escape_string($link, $email); 
    $key = mysqli_real_escape_string($link, $key); 
    
    //If record exists, set activation field to 'activated'.
        //create query
    $sql = "UPDATE useraccounts SET activation = 'activated' WHERE (email = '$email' AND activation = '$key') LIMIT 1";  
    
    //run query
    $result = mysqli_query($link, $sql);
   
    //if query is successful, show success message and invite user to login.
   if(mysqli_affected_rows($link) == 1){
       echo '<div class="alert alert-success text-center">Your account has been activated!<br /><a href="index.php" type="button" class="btn btn-outline-dark mt-3">Login</a></div>';
   }else{
      //show error message
      echo '<div class="alert alert-warning">There was an error activating your account. Please re-click on the activation link in your account confirmation email. </div>';
   } 
}

?>

     </div>
     </div>
     
     <!--     Footer   -->
    
    <div class="footer col-12">
        <div class="row">
        <div class="col text-center">
            <p>Developed by: <br />&copy; <a href="https://bryonykimwebdev.com/">Bryony Kim Web Dev</a> 2020 -  <?php $today = date("Y"); echo $today; ?>.</p>
        </div>
        <div class="col text-center">
            <p>Logo available for free from: <br /><a href="https://logomakr.com/">logomakr.com</a></p>
        </div>
        
       </div>
    </div>   
     
<!-- Optional JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="index.js"></script>
    </body>
</html>
<?php  ob_flush();  ?>
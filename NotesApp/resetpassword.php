<!--receives user_id and key to create new password, taken from link in email.-->


<?php
//start session
session_start();
//connect to database
include("connect.php");
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <link rel="stylesheet" href="stylesheet.css">
        
        <title>Notes App - Reset Password</title>
     
</head>
    
 <body>
      
<!--     Navbar  - menu  -->
     
     <nav role="navigation" class="navbar fixed-top navbar-expand-lg navbar-light d-flex">
         
<!--     Brand  -->
         <div class="navbar-brand mr-5" href="index.php">
             <img src="images/LogoMakr_8qk2wC_postit_logo.png" style="height: 30px">
             <a class="navbar-brand p-0 mr-0" href="index.php" id="homeLink">Notes        
             </a>
         </div>
     </nav>
     
     
     <div class="container-fluid">
     
<!-- heading and description    -->
         <div class="jumbotron  text-center mt-5 mb-0" id="description">
            <h1 class="display-4">Reset Password</h1>

            <div class="mt-5" id="passwordResetMessage"></div>
         </div>
         
         
     <div class="contents col-sm-10 col-md-9 col-lg-7 col-xl-5 mx-auto">
        
<?php

    //if user_id or reset key are missing
    if(!isset($_GET["user_id"]) || !isset($_GET["resetkey"])){
        //error
        echo '<div class="alert alert-warning">There was an error. Please click on the link in your password reset email.</div>';
        exit;
    }

    //store in two variables
    $user_id = $_GET["user_id"];
    $key = $_GET["resetkey"];    

    //define a time variable - time now minus 24 hours. 
        //key only valid for 24 hours.
    $time = time() - 86400;

    //prepare variables for query
    $user_id = mysqli_real_escape_string($link, $user_id); 
    $key = mysqli_real_escape_string($link, $key); 

    //create query - Check combination of user_id and key exists, key is less than 24hours old and key not already used.
    $sql = "SELECT user_id FROM forgottenpassword WHERE resetkey = '$key' AND user_id = '$user_id' AND time > '$time' AND status = 'pending'";
        
    //run query
    $result = mysqli_query($link, $sql);
        
    //if unsuccessful
    if(!$result){
      //error 
      echo '<div class="alert alert-warning mt-5">Error running the query to check the resetkey and user_id.</div>';
      exit;     
    }


    //combination of user_id and key exists if number of rows equals 1.
    $count = mysqli_num_rows($result);
    
    if($count !== 1){
        //if doesn't exist - error.
        echo '<div class="alert alert-warning mt-5">Error: Please try again. Resetpassword.php</div>';
        exit;
    }
       
    //If combination exists and key is valid - show reset password form.
        echo '<form id="resetPasswordForm" method="post">
        
                        <input type="hidden" name="resetkey" id="resetkey" value="$key">
                        
                        <input type="hidden" name="user_id" id="user_id" value="$user_id">
        
                        <div class="form-group">
                            <label for="newpassword" class="sr-only">Password:</label>
                            <input class="form-control mt-3" type="password" name="newpassword" id="newpassword" placeholder="New Password" aria-describedby="passwordHelp" maxlength="12">
                            <small id="passwordHelp" class="form-text text-muted mt-0">Please create a new password.<br /> Passwords must be between 6 and 12 characters, contain one capital letter and one number.</small>
                        </div>
                        
                        <div class="form-group">
                            <label for="newpassword2" class="sr-only">Confirm New Password:</label>
                            <input class="form-control mt-3" type="password" name="newpassword2" id="newpassword2" placeholder="Confirm New Password" aria-describedby="password2Help" maxlength="12">
                            <small id="password2Help" class="form-text text-muted mt-0">Please re-enter your password.</small>
                        </div>
                       
                        <button type="submit" class="btn btn-outline-dark mt-5" name="newPasswordSubmit" id="newPasswordSubmit" style="float: right" value="Send data" data-dismiss="none">Reset Password</button> 
        
        </form>';
        
?>
      
<!--        close contents div  -->
         </div>         
         <!--  close container  -->
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
     
<!--     Ajax Call script tag  -->
     
     <script>
    //script for Ajax call to storeresetpassword.php which will process the form data.
      
    //once submitted
    $("#resetPasswordForm").submit(function(event){
        //prevent default php processing
         event.preventDefault();
        //collect user inputs
        var datatopost = $(this).serializeArray();
        //send to storeresetpassword.php using AJAX
        $.ajax({
            url: "storeresetpassword.php",
            type: "POST",
            data: datatopost,
            //AJAX call successful:
            success: function(data){
                $("#passwordResetMessage").html(data);
            },
            //AJAX call fails:
            error: function(){
                 //show error inside passwordResetMessage div on html form.
                 $("#passwordResetMessage").html("<div class='alert alert-warning'>There was an error with the forgotten password Ajax call. Check the parameters are correct.</div>");
                 }
             });

    });

     </script>

    </body>
</html>
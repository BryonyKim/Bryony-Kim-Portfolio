<?php  
ob_start(); 

//start session
session_start();

//connect to database
include("connect.php");

//logout code - in logout.php file 
include("logout.php");

//remember me code - in rememberme.php file
include("rememberme.php");

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
         
        <title>Notes App - Home</title> 
     
</head>
    

 <body>
     
     
<!--     Navbar  - menu  -->
     
     <nav role="navigation" class="navbar fixed-top navbar-expand-lg navbar-light d-flex">
         
<!--    Brand  -->
         <div class="navbar-brand mr-5" href="index.php">
         <img src="images/LogoMakr_8qk2wC_postit_logo.png" style="height: 30px">
         <a class="navbar-brand p-0 mr-0" href="index.php" id="homeLink">Notes</a>
         </div>


         <div class="nav-item navbar-right" id="Login" ><a class="nav-link" data-toggle="modal" data-target="#loginModal" href="">Login</a>
         </div>
      
     </nav>
     
     <div class="container-fluid">
     
<!--  heading and description    -->
     <div class="jumbotron  text-center my-5" id="description">
        <h1 class="display-4">Notes</h1>
         <p class="lead">Make, store, edit and delete those important notes here so you don't forget a thing and always keep on top of your to do list.</p>
         <hr class="my-4">
         <a class="btn btn-lg btn-outline-dark" role="button" href="" data-toggle="modal" data-target="#createAccountModal">Create Account</a>
         <br />
         <img src="images/LogoMakr_8qk2wC_postit_coral3.jpg" style="height: 80px" class="mt-5">
      </div>
 

<!--     Create Account Modal    -->
         
<form method="post" action="index.php" id="createAccountForm">
     
   <div class="modal" id="createAccountModal" tabindex="-1" role="dialog" aria-labelledby="createAccountModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
       
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
            
                    <button type="button" class="close btn btn-sm mt-1" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="createAccountModalLabel">Create Account</h4>
                    
                    
              <!-- Div for Javascript, php and ajax code -->
                        <div id="createAccountMessage" class="mt-3"></div>    
                    
                    <!--Inputs -->
                    
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="accusername" class="sr-only">Username:</label>
                        <input class="form-control mt-4" type="text" name="accusername" id="accusername" placeholder="Username" aria-describedby="usernameHelp" maxlength="15" value="<?php echo $_POST["accusername"]; ?>">
                        <small id="usernameHelp" class="form-text text-muted mt-0">Please create a username. This will be needed to login to Notes. Max 15 characters.</small> 
                        </div>
                        
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="accemail" class="sr-only">Email:</label>
                        <input class="form-control mt-3" type="email" name="accemail" id="accemail" placeholder="Email Address" aria-describedby="emailHelp" maxlength="50" value="<?php echo $_POST["accemail"]; ?>">
                        <small id="emailHelp" class="form-text text-muted mt-0">Please enter your email address. You will receive an email to activate your account and if ever you need to reset your password.</small>
                        </div>
                        
                        
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="accpassword" class="sr-only">Password:</label>
                        <input class="form-control mt-3" type="password" name="accpassword" id="accpassword" placeholder="Password" aria-describedby="passwordHelp" maxlength="12" value="<?php echo $_POST["accpassword"]; ?>">
                        <small id="passwordHelp" class="form-text text-muted mt-0">Please create a password. You will need this to login to Notes.<br /> Passwords must be between 6 and 12 characters, contain one capital letter and one number. Passwords can be changed in 'account settings' once logged in.</small>
                        </div>
                        
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="accpassword2" class="sr-only">Confirm password:</label>
                        <input class="form-control mt-3" type="password" name="accpassword2" id="accpassword2" placeholder="Confirm Password" aria-describedby="password2Help" maxlength="12" value="<?php echo $_POST["accpassword2"]; ?>">
                        <small id="password2Help" class="form-text text-muted mt-0">Please re-enter your password.</small>
                        </div>
                       
                        <button type="submit" class="btn btn-outline-dark mt-3" name="accSubmit" id="accSubmit" style="float: right" value="Send data" data-dismiss="none">Create Account</button>    
                    
                </div>
            </div>
       </div>  
   </div>
</form>
        
         
<!--     Login Modal    -->
         
   <form method="post" action="index.php" id="loginForm">
       
   <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
            
                    <button type="button" class="close btn btn-sm mt-1" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="loginModalLabel">Login Details</h4> 
                    
                    
                        <!-- Div for Javascript, php and ajax  -->
                        <div id="loginMessage" class="mt-3"></div>

                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="username" class="sr-only">Username:</label>
                        <input class="form-control my-4" type="text" name="username" id="username" placeholder="Username" maxlength="15" value="<?php echo $_POST["username"]; ?>">
                        </div>
                        
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="password" class="sr-only">Password:</label>
                        <input class="form-control mb-2" type="password" name="password" id="password" placeholder="Password" maxlength="12" value="<?php echo $_POST["password"]; ?>">
                        </div>
                    
                        <div class="row mb-2">
                        <!--  Remember me tickbox  -->
                        <div class="checkbox pl-3 text-muted">
                            <label>
                                <input type="checkbox" name="remember" id="remember" style="cursor: pointer"> 
                                Remember me</label>
                        </div>
                        </div>
                        

                        <!-- open sign up modal.-->
                         <button type="button" class="btn btn-outline-dark" data-dismiss="modal" data-toggle="modal" data-target="#createAccountModal">Create Account</button>  

                        <button type="submit" class="btn btn-dark" name="loginSubmit" value="Send data" id="loginSubmit" style="float: right">Login</button> 
                        
                </div>
            </div>
       </div> 
   </div>
  </form> 
         
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
        <script src="index.js"></script>
    </body>
</html>
<?php  ob_flush();  ?>
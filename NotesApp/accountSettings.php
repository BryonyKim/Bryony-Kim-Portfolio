<?php
//If the user clicks back on browser after logging out, redirect to home page.

//restart session variable.
session_start();

//connect to database
include("connect.php");

//user not logged in, ie session variable not set.
if(!isset($_SESSION["user_id"])){
    //redirect to home page
    header("Location: index.php");
}

//query - get username so username on navbar can be updated after user changes username.

//get user_id from session array - won't change as user_id is unique 
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
    //change session variables to new values.
    $_SESSION['username'] = $row['username'];
    $_SESSION['email'] = $row['email'];
//if count does not equal 1
}else{
    //error
    echo "<div class='alert alert-warning mt-5'>There was an error retrieving the username and email from the database.</div>";
}



//username variable using session array.
$user = $_SESSION["username"];

//Email variable using session array. Uupdated in query above.
$email = $_SESSION["email"];
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
        
        
        <title>Notes App - Account Settings</title>
        
     
</head>
    

 <body>
     
     
<!--     Navbar  - menu  -->
     
     <nav role="navigation" class="navbar fixed-top navbar-expand navbar-light d-flex">
         
<!--    Brand  -->
     <div class="navbar-brand mr-5" href="index.php">
     <img src="images/LogoMakr_8qk2wC_postit_logo.png" style="height: 30px">
     <a class="navbar-brand p-0 mr-0" href="index.php" id="homeLink">Notes</a>
    </div>

            <div class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false" id="userLoggedIn" style="min-width: 150px; text-align: right"><b><?php echo $user; ?>&nbsp;</b></a>
                <div class="dropdown-menu" aria-labelledby="userLoggedIn">
                    <a class="dropdown-item" href="notes.php">My Notes</a>
                    <a class="dropdown-item active disabled mt-3 mb-1" href="accountSettings.php">Account Settings</a>
                    <br />
                    <a class="dropdown-item mt-0" href="index.php?logout=1">Logout</a>
                </div>
            </div>
      
     </nav>
     
     <div class="container-fluid">
     
<!--   heading and description    -->
     <div class="jumbotron  text-center mt-5 mb-0" id="description">
        <h1 class="display-4">Account Settings</h1>
     </div>
         
<!-- container for notes and buttons  -->
         <div class="contents col-sm-10 col-md-9 col-lg-7 col-xl-5 mx-auto">    
    
             
<?php
             
echo "<div class='row mx-auto my-2'>
                            
     <div class='input-group'>
       <div class='input-group-prepend'>
          <div class='input-group-text px-1 settingInputs settings'>Username:</div>
        </div>

                            
       <input type='text' class='form-control settings' id='usernameInput' readonly value=" . $row["username"] . ">
                            
       <div class='input-group-append'>
          <div class='input-group-text settings'>
             <a href='#' class='editLink' data-toggle='modal' data-target='#changeUserModal'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-pencil-square' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
              <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
               <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg></a></div>
               </div>
             </div></div>
      
                    
             <div class='row mx-auto'><div class='input-group'>
                <div class='input-group-prepend'>
                    <div class='input-group-text px-1 settingInputs settings'>Password:&nbsp;</div>
                </div>
                <input type='password' class='form-control settings' id='passwordInput' readonly value='**********'>
                <div class='input-group-append'>
                 <div class='input-group-text settings'>
                    <a href='#' class='editLink' data-toggle='modal' data-target='#changePasswordModal'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-pencil-square' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                     <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                     <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg></a>
                     </div>
                     </div>
                </div></div>
                    
                    
                <div class='row mx-auto my-2'><div class='input-group'>
                    <div class='input-group-prepend'>
                        <div class='input-group-text px-1 settingInputs settings'>Email Address:</div>
                    </div>
                    <input type='email' class='form-control settings' id='emailInput' readonly value=" . $row["email"] . ">
                        <div class='input-group-append'>
                            <div class='input-group-text settings'>
                            <a href='#' class='editLink' data-toggle='modal' data-target='#changeEmailModal'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-pencil-square' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                              <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                              <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/></svg></a>
                              </div>
                          </div>
                    </div></div>";

?>
             

             
             
<!--   Modals for change username, change email address and change password  -->
             
             
<!--        Change username modal  -->
<form method="post" action="accountSettings.php" id="changeUserForm">
             
 <div class="modal" id="changeUserModal" tabindex="-1" role="dialog" aria-labelledby="changeUserModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-body">
            <button type="button" class="close btn btn-sm mt-1" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="changeUserModalLabel">Change Username</h4> 


                        <div id="changeUserMessage" class="mt-3"></div>
               
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="changeUsername" class="sr-only">Current username:</label>
                        <input class="form-control mt-4" type="text" name="changeUsername" id="changeUsername" maxlength="15" value="<?php echo $user; ?>" readonly>
                        </div>
                        
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="newUsername" class="sr-only">New username:</label>
                        <input class="form-control my-3" type="text" name="newUsername" id="newUsername" placeholder="New Username" maxlength="15" value="<?php echo $_POST["newUsername"]; ?>">
                        </div>

                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="changeUserPassword" class="sr-only">Password:</label>
                        <input class="form-control mb-2" type="password" name="changeUserPassword" id="changeUserPassword" placeholder="Password" maxlength="12" value="<?php echo $_POST["changeUserPassword"]; ?>">
                        </div>

                        <button type="submit" class="btn btn-outline-dark" name="changeUserSubmit" value="Send data" id="changeUserSubmit" style="float: right">Confirm</button> 
                        
                    
                </div>
            </div>
       </div> 
   </div>   
  </form> 
             
             
<!--        Change email modal  -->
<form method="post" action="accountSettings.php" id="changeEmailForm">
             
<div class="modal" id="changeEmailModal" tabindex="-1" role="dialog" aria-labelledby="changeEmailModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-body">
            <button type="button" class="close btn btn-sm mt-1" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="changeEmailModalLabel">Change Email Address</h4> 


                        <div id="changeEmailMessage" class="mt-3"></div>
                        
<!--                    Username  -->
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="changeEmailUsername" class="sr-only">Username:</label>
                        <input class="form-control mt-4" type="text" name="changeEmailUsername" id="changeEmailUsername" maxlength="15" value="<?php echo $user; ?>" readonly>
                        </div>
                        
<!--                      New  email address  -->
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="changeEmailEmail" class="sr-only">New email address:</label>
                        <input class="form-control my-3" type="email" name="changeEmailEmail" id="changeEmailEmail" placeholder="New Email Address" maxlength="50" value="<?php echo $_POST["changeEmailEmail"]; ?>">
                        </div>
                        
<!--                        Password  -->
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="changeEmailPassword" class="sr-only">Password:</label>
                        <input class="form-control mb-3" type="password" name="changeEmailPassword" id="changeEmailPassword" placeholder="Password" maxlength="12" value="<?php echo $_POST["changeEmailPassword"]; ?>">
                        </div>
                        
                        <button type="submit" class="btn btn-outline-dark" name="changeEmailSubmit" value="Send data" id="changeEmailSubmit" style="float: right">Confirm</button> 
                        
                </div>
            </div>
       </div> 
   </div>  
 </form> 

             
             
<!--        Change password modal  -->
             
<form method="post" action="accountSettings.php" id="changePasswordForm">
    
 <div class="modal" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered">
       <div class="modal-content">
           <div class="modal-body">
            <button type="button" class="close btn btn-sm mt-1" data-dismiss="modal" aria-label="close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="changePasswordModalLabel">Change Password</h4> 
               
                    <div id="changePasswordMessage" class="mt-3"></div>
                    
<!--                    Username  -->
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="changePasswordUsername" class="sr-only">Username:</label>
                        <input class="form-control mt-4" type="text" name="changePasswordUsername" id="changePasswordUsername" placeholder="Username" maxlength="15" value="<?php echo $user; ?>" readonly>
                        </div>
                        
<!--                        email address  -->
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="changePasswordEmail" class="sr-only">Email:</label>
                        <input class="form-control mb-3" type="email" name="changePasswordEmail" id="changePasswordEmail" placeholder="Email Address" maxlength="50" value="<?php echo $_POST["changePasswordEmail"]; ?>">
                        </div>
                        
<!--                        old password  -->
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="currentPassword" class="sr-only">Current password:</label>
                        <input class="form-control mb-3" type="password" name="currentPassword" id="currentPassword" placeholder="Current Password" maxlength="12" value="<?php echo $_POST["currentPassword"]; ?>">
                        </div>
                        
<!--                        New Password  -->
                        <div class="form-group">
                        <!-- label screen readers  -->
                        <label for="newPassword" class="sr-only">New password:</label>
                        <input class="form-control mb-3" type="password" name="newPassword" id="newPassword" placeholder="New Password" maxlength="12" value="<?php echo $_POST["newPassword"]; ?>">
                        </div>
                        
<!--                       Confirm new password  -->
                        <div class="form-group">
                        <!-- label screen readers -->
                        <label for="confirmNewPassword" class="sr-only">Confirm new password:</label>
                        <input class="form-control mb-3" type="password" name="confirmNewPassword" id="confirmNewPassword" placeholder="Confirm New Password" maxlength="12" value="<?php echo $_POST["confirmNewPassword"]; ?>">
                        </div>

                        <button type="submit" class="btn btn-outline-dark" name="changePasswordSubmit" value="Send data" id="changePasswordSubmit" style="float: right">Confirm</button> 
                        
                </div>
            </div>
       </div> 
   </div> 
  </form> 
             
             
             
<!--close contents  -->
             
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
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="accountSettings.js"></script>
    </body>
</html>
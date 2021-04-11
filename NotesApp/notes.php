<?php
//if user clicks back on browser after logging out redirect to home page

//restart session variable.
session_start();

//if user is not logged in
if(!isset($_SESSION["user_id"])){
    //redirect user to home page
    header("Location: index.php");
}
//logged in as username on main menu navbar.
$user = $_SESSION["username"];
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
        
        <title>Notes App - My Notes</title>
     
   </head>
    

 <body>
     
     
<!--     Navbar  - menu  -->
     
     <nav role="navigation" class="navbar fixed-top navbar-expand navbar-light d-flex">
         
<!--    Brand  -->
             <div class="navbar-brand mr-5" href="index.php">
                 <img src="images/LogoMakr_8qk2wC_postit_logo.png" style="height: 30px">
                 <a class="navbar-brand p-0 mr-0" href="index.php" id="homeLink">Notes        
                 </a>
             </div>
    
            <div class="nav-item dropdown"><a class="nav-link dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-haspopup="true" aria-expanded="false" id="userLoggedIn" style="min-width: 150px; text-align: right"><b><?php echo $user; ?>&nbsp;</b></a>
                <div class="dropdown-menu" aria-labelledby="userLoggedIn">
                    <a class="dropdown-item active disabled" href="notes.php">My Notes</a>
                    <a class="dropdown-item mt-3 mb-1" href="accountSettings.php">Account Settings</a>
                    <br />
                    <a class="dropdown-item mt-0" href="index.php?logout=1">Logout</a>
                </div>
            </div>
     </nav>
     
     <div class="container-fluid">
     
<!-- heading and description    -->
     <div class="jumbotron  text-center mt-5 mb-0" id="description">
        <h1 class="display-4">My Notes</h1>
     </div>
         
<!-- container for notes and buttons  -->
         <div class="contents col-xs-12 col-sm-10 col-md-9 col-lg-7 col-xl-5 mx-auto">

<!--    Buttons  -->
     <div class="row mt-0 mb-3">
        <div class="col">
            <button class="btn btn-outline-dark ml-0" id="newnote" name="newnote" type="submit">New Note</button> 
            <button class="btn btn-outline-dark ml-0" id="allnotes" name="allnotes" type="submit">All Notes</button> 
        </div>    
        <div class="col">
            <button class="btn btn-outline-dark mr-0" style="float: right" id="editnote" name="editnote" type="submit">Delete a Note</button> 
            <button class="btn btn-outline-dark mr-0" style="float: right" id="done" name="done" type="submit">Done</button> 
        </div>   
     </div>

             
<!--     Alert message from ajax call    -->
    <div id="error" class="alert alert-warning alert-dismissible show" role="alert" style="display:none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <p id="errorcontent"></p>
    </div>

             
<!-- Text area - new note  -->
    <div class="notepad mx-auto mt-2" id="notepad">
        <textarea class="form-control" id="textArea" rows="5"></textarea>         
    </div>

         
<!--  Note tiles  -->     
    <div class="mx-auto mt-2" id="notearea">
        <!-- Ajax call to retrieve notes from database  -->
    </div>
             
             
            
<!-- Modal - confirm delete note -->
             <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDeleteLabel">Confirm Delete</h5>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete this note?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-dark" style="float:left" id="deleteCancel">Cancel</button>
                            <button type="button" class="btn btn-outline-dark deleteModal" id="deleteContinue">Continue</button>
                        </div>
                    </div>
                </div>
             
             </div>
             
             
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
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <script src="notes.js"></script>
    </body>
</html>
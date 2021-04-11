<?php

//start a session
session_start();

//connect to database
include("connect.php");

//get the user_id. 
$user_id = $_SESSION["user_id"];

//delete any notes that have no content.

//create query to delete empty notes
$sql = "DELETE FROM notes WHERE note = ''";

//run query to delete empty notes
$result = mysqli_query($link, $sql);

//Look for notes corresponding to user_id and order so most recent is at top. 

//create query to get notes
$sql = "SELECT * FROM notes WHERE user_id = '$user_id' ORDER BY time DESC";

//run query
if($result = mysqli_query($link, $sql)){
    //if number of records is greater than 0
    if(mysqli_num_rows($result)>0){
       //extract notes 
       while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
           //variables for echoing notes
           $note = $row['note'];
           $time = $row['time'];
           
           //format time  
           $time = date("F d, Y h:i:s a", $time);
           
           //hide note id for deleting notes
           $note_id = $row['id'];

           echo "<div class='row notecontainer mx-0 px-0'>
                    
                        <div class='col-1 ml-0 mr-3 deletebutton'>
                        <button type='button' class='btn btn-outline-dark mt-2'><svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                          <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                          <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                        </svg></button>
                        </div>
                    
                    
                        <div class='col mr-0 ml-3 pr-0 note' id='$note_id'>
                        <div class='notetext'>$note</div>
                        <div class='timetext text-secondary'>$time</div>
                        </div>
                    
                </div>";
       } 
    }else{
        //alert. You have no notes.
        echo "<div class='alert alert-warning mt-5'>You have no notes. Click on 'add note' to make a new note.</div>";
    }
    
}else{
    //false result - unsuccessful query
     echo "<div class='alert alert-warning mt-5'>An error occured with the query to select the users notes from the database.</div>";
    exit;
}

?>
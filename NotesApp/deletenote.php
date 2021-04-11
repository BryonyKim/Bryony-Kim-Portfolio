<?php
//start session
session_start();

//connect to database
include("connect.php");

//get id of note sent through ajax call
$note_id = $_POST["noteid"];

//for added security, access user_id using session variable.
$user_id = $_SESSION["user_id"];

//run query to delete note from notes database table using note id.
    //create query
$sql = "DELETE FROM notes WHERE id='$note_id' AND user_id = '$user_id'";

    //run query
$result = mysqli_query($link, $sql);

    //if query is unsuccessful
if(!$result){
    //'error' message defined in ajax call on notes.php file 
    echo 'error';
}

?>

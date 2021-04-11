<?php
//start session
session_start();

//connect to database
include("connect.php");

//id of note will be sent through ajax call
    //this is stored in the activenote variable - ajax call on notes.js:  data:{note: $(this).val(), noteid:activenote}
$noteid = $_POST['noteid'];

//new note content will be sent through ajax call.
$notecontent = $_POST['note'];

// Get time - time will be updated to last edited time.
$time = time() + 60*60*5;

//query to update note
//create query
$sql = "UPDATE notes SET note = '$notecontent', time = '$time' WHERE id = '$noteid'";

//run query
$result = mysqli_query($link, $sql);

//if unsuccessful - 'error' links back to ajax call to display warning message.
if(!$result){
    echo 'error';
}

?>

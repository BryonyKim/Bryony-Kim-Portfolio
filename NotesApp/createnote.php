<?php

//start session
session_start();

//connect to database
include("connect.php");

//get user_id
$user_id = $_SESSION["user_id"];

//get current time
$time = time() + 60*60*5;

//run query to create new note.
//create query
    //note content will be updated by ajax call.
$sql = "INSERT INTO notes (user_id, note, time) VALUES ('$user_id', '', '$time')";

//run query
$result = mysqli_query($link, $sql);

//check if successful, if not
if(!$result){
    //return error to ajax call
    echo 'error';
}else{
    //if successful, return id of new note.
    echo mysqli_insert_id($link);
}

?>
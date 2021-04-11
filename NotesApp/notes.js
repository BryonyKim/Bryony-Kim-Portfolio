//execute once page loads

$(function(){
    
   //define variables 
        //id of note
            //activenote - note being edited or created
    var activenote = 0;
    
        //change to edit mode when user clicks on edit button
    var editMode = false;
    
    
   //load notes on page load: send ajax call to loadnotes.php
    $.ajax({
        url: 'loadnotes.php',
        //if ajax call is successful. 
        success: function(data){
           //div for notes in notes.php - id 'notearea' 
            $('#notearea').html(data);
            //call editNote() function so user can make edits
            editNote();
            //call deleteButtons() function so user can click bin to delete
            deleteButtons();
        },
        //if ajax call fails
        error: function(){
            //alert message
            $("#errorcontent").html("There was an error with the Ajax call to load the notes. Please refresh the page.");
            $("#error").fadeIn();
        }
    });
    
    
    //create new note: ajax call to createnote.php
        //execute on clicking 'add note' button - id=newnote
    $("#newnote").click(function(){
        //send ajax call to createnote.php. createnote.php will run query to create new note in table.
        $.ajax({
            url: "createnote.php",
            success: function(data){
                //if error
                if(data == 'error'){
                    //error message on notes.php id=errorcontent
                    $("#errorcontent").html("There was an error creating a new note.");
                    //show collapsible error message div.
                    $("#error").fadeIn();
                    
                    //if note_id is returned - if ajax call is successful.
                   }else{
                       //Update content of note - need id of note - var activenote
                       //update $activenote to id of new note.
                       activenote = data;
                       
                       //empty textarea
                       $("#textArea").val("");
                       
                       
                       //showHide function 
                       //elements in first array are to show, elements in second array are to hide.
                       showHide(["#textArea", "#allnotes"], ["#editnote", "#newnote", "#notearea", "#done"]);
                       
                       //focus in textarea
                       $("#textArea").focus();
                       
                   }
            },
        //if ajax call fails
        error: function(){
            //alert message
            $("#errorcontent").html("There was an error with the Ajax call to create a new note. Please refresh the page.");
            $("#error").fadeIn();
        } 
        });
    });
    
    
    //typing in text area: ajax call to updatenote.php

    $("#textArea").keyup(function(){
         $.ajax({
             url: 'updatenote.php',
             type: "POST",
             //send current note content with id to updatenote.php
             data:{note: $(this).val(), noteid:activenote},
            //if successful
            success: function(data){
                if(data == 'error'){
                    //error message
                  $("#errorcontent").html("There was an error with the Ajax call to update the content of the note in the database. Please check your internet connection and refresh the page.");   
                  $("#error").fadeIn();
                }
            },
            //if ajax call fails
            error: function(){
                //alert message
                $("#errorcontent").html("There was an error with the Ajax call to update the note. Please refresh the page.");
                $("#error").fadeIn();
            }
        });
    });
    
    
    //clicking on 'all notes' button
    $("#allnotes").click(function(){
      //reload notes
        $.ajax({
            url: 'loadnotes.php',
            //if successful 
            success: function(data){
                $('#notearea').html(data);
                
                //showHide function 
                showHide(["#editnote", "#newnote", "#notearea" ], ["#textArea", "#allnotes", "#done"]);
                
                //call editNote() function again so user can click a note to edit it.
                editNote();
                
                //call deleteButtons() function so user can delete notes.
                deleteButtons();
            },
            //if ajax call fails
            error: function(){
                //alert message
                $("#errorcontent").html("There was an error with the Ajax call to reload the notes. Please refresh the page.");
                $("#error").fadeIn();
            }
        });
    });
    
    
    //clicking on 'done' button - load notes again
    $("#done").click(function(){
        
        //exit edit mode
        editMode = false;
        
        //show and hide the various elements. parameters(show, hide)
        showHide(["#newnote", "#editnote"], ["#done", ".deletebutton", "#allnotes"]);
    });
    
    
    
    //clicking on 'edit' button - go to edit mode, show delete buttons
    $("#editnote").click(function(){
        //edit mode - change editMode variable to true.
        editMode = true;
        
        
        //show delete buttons - parameters(show, hide)
        showHide(["#done", ".deletebutton"], ["#newnote", "#allnotes", "#editnote"]);
    });
    
    
    
    
    //functions:
        //functions as code needs to be run whenever a note is created.
    
        //click on note - show text area
        function editNote(){
            //when user clicks on a div of class note.
            $(".note").click(function(){
                //check not in edit mode
                if(!editMode){
                    //update variable activenote to id of the note clicked
                        //note id hidden in div of note on loadnote.php - id='$note_id'
                    activenote = $(this).attr("id");
                    
                   //fill text area with content of note selected. 
                   $("#textArea").val($(this).find('.notetext').text());
                    
                    //showHide elements function 
                    showHide(["#textArea", "#allnotes"], ["#editnote", "#newnote", "#notearea", "#done"]);

                    //focus inside textarea
                    $("#textArea").focus();
                }
            });
        }
    
    
        //when click on delete - delete note
    function deleteButtons(){
       $(".deletebutton").click(function(){
           
            var deleteNote = $(this);
           
            $('#confirmDelete').modal('show');
        
            $("#deleteContinue").click(function(){
                
            $("#confirmDelete").modal('hide');
           
           //database 
                //send corresponding note id to deletenote.php file to delete note with this id.
         $.ajax({
             url: 'deletenote.php',
             type: "POST",
             
                //select deleteNote variable (current selection), next() to get the following div, attr() to get id of that div.
             data:{noteid: deleteNote.next().attr("id")},
            //if successful
            success: function(data){
                if(data == 'error'){
                    //error message
                  $("#errorcontent").html("There was an error with the Ajax call to delete the selected note from the database. Please check your internet connection and refresh the page.");   
                  $("#error").fadeIn();
                }else{
                    //if note deleted successfully
                        //delete html content - delete button and note divs
                    deleteNote.parent().remove();
                }
               
            },
            //if ajax call fails
            error: function(){
                //alert message
                $("#errorcontent").html("There was an error with the Ajax call to delete the note. Please refresh the page.");
                $("#error").fadeIn();
            }
        });
            
        });
           
        $("#deleteCancel").click(function(){
            $("#confirmDelete").modal('hide');
            window.location = "notes.php";
        });
        });
    }  


    
        //function to hide and show certain elements on page.
                // array1 - ids of elements to show
                // array2 - ids of elements to hide. 
    
    function showHide(array1, array2){
        //show elements with ids in array1
        for(i=0; i<array1.length; i++){
            $(array1[i]).show();
        }
        
        //array2 - hide elements with ids in array2
        for(i=0; i<array2.length; i++){
            $(array2[i]).hide();
        }
    };
    
});
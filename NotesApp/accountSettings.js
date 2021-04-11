//Ajax call to updateusername.php to change username from account settings page.

  //once form submitted, execute function, including ajax call. 

$("#changeUserForm").submit(function(event){
      
    
    //prevent default php processing
        event.preventDefault();
    
    //collect user inputs
        var datatopost = $(this).serializeArray();
    
     //send to updateusername.php using AJAX
         $.ajax({
             url: "updateusername.php",
             type: "POST",
             data: datatopost,
             ////AJAX call successful: show error or success message
             success: function(data){
                 if(data){
                     $("#changeUserMessage").html(data);
                 }else{
                     //reload the page. 
                     window.location = "accountSettings.php";
                 }
             },
             //AJAX call fails: show AJAX call error
             error: function(){
                 $("#changeUserMessage").html("<div class='alert alert-warning'>There was an error with the Ajax call to update the username. Check the parameters are correct.</div>");
             }
         });
        
});



//Ajax call to update password. This will go to the updatepassword.php file.

$("#changePasswordForm").submit(function(event){
      
    //prevent default php processing
        event.preventDefault();
    
    //collect user inputs
        var datatopost = $(this).serializeArray();
    
     //send to updatepassword.php using AJAX
         $.ajax({
             url: "updatepassword.php",
             type: "POST",
             data: datatopost,
             ////AJAX call successful: 
             success: function(data){
                 if(data){
                     $("#changePasswordMessage").html(data);
                 }else{
                     window.location = "accountSettings.php";
                 }
             },
             //AJAX call fails: 
             error: function(){
                 $("#changePasswordMessage").html("<div class='alert alert-warning'>There was an error with the Ajax call to update the password. Check the parameters are correct.</div>");
             }
         });
        
});



////Ajax call to update the email address. This will go to the updateemail.php file.

$("#changeEmailForm").submit(function(event){
      
    
    //prevent default php processing
        event.preventDefault();
    
    //collect user inputs
        var datatopost = $(this).serializeArray();
    
     //send to updateemail.php using AJAX
         $.ajax({
             url: "updateemail.php",
             type: "POST",
             data: datatopost,
             ////AJAX call successful: 
             success: function(data){
                 if(data){
                     $("#changeEmailMessage").html(data);
                 }else{
                     window.location = "accountSettings.php";
                 }
             },
             //AJAX call fails: 
             error: function(){
                 $("#changeEmailMessage").html("<div class='alert alert-warning'>There was an error with the Ajax call to update the email address. Check the parameters are correct.</div>");
             }
         });
        
});
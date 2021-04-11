//Ajax call for sign-up/create account form

//once form is submitted
$("#createAccountForm").submit(function(event){
    //prevent default php processing
        event.preventDefault();
    
    //collect user inputs
        var datatopost = $(this).serializeArray();
    
     //send to signup.php using AJAX
         $.ajax({
             url: "signup.php",
             type: "POST",
             data: datatopost,
             ////AJAX call successful: 
             success: function(data){
                 if(data){
                     $("#createAccountMessage").html(data);
                 }
             },
             //AJAX call fails: 
             error: function(){
                 $("#createAccountMessage").html("<div class='alert alert-warning'>There was an error with the Ajax call. Check the parameters are correct.</div>");
             }
         });
        
});


//AJAX call for login form

//once the form is submitted
$("#loginForm").submit(function(event){
    //prevent default php processing
    event.preventDefault();
    //collect user inputs
    var datatopost = $(this).serializeArray();
    //send them to login.php using AJAX
    $.ajax({
             url: "login.php",
             type: "POST",
             data: datatopost,
    //AJAX call successful:
           success: function(data){
                 if(data.includes("success")){
                     window.location = "notes.php";
                 }else{
                     $("#loginMessage").html(data);
                 }
             },
       
    //AJAX call fails: 
         error: function(){
                 $("#loginMessage").html("<div class='alert alert-warning'>There was an error with the Ajax call. Check the parameters are correct.</div>");
             }
         });
        
});


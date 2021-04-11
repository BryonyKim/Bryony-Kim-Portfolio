<?php  ob_start();  ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
      
    <link href="styling.css" rel="stylesheet">

    <title>Bryony Kim Web Dev - Contact</title>
      
    <!--    Quicksand font from google fonts  -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
      
     <meta name="description" content="Bryony Kim Web Dev. A web development portfolio showing web developer skills and example projects. Contact form for all enquiries for Bryony Kim.">
      
  </head>
    

  <body loading="eager">
      
    <nav role="navigation" class="navbar fixed-top navbar-expand nav-tabs navbar-dark d-flex" id="topBar">
        <a class="navbar-brand" href="index.html">
            <img src="images/Logo.jpg" alt="Logo" loading="lazy">
        </a>
        <ul class="navbar-nav flex-grow-1 justify-content-center" id="list">
            <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
            <li class="nav-item"><a class="nav-link" href="projects.html">Projects</a></li>
            <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
        </ul>
      
    </nav>
    
<!--      Page heading  -->
      <div class="jumbotron jumbotron-fluid bg-transparent pb-0">
        <div class="container">
            <h1 class="display-3 text-center pt-2">Contact</h1>  
        </div>
      </div>
      
      
      <div class="container">
        <div class="contents col-11 mx-auto text-center">
         <p>For all enquiries please complete and submit the form below and I will contact you as soon as possible.</p>
         
        <br />
            
        <div class="row">
<!--           form box    -->
        <div class="col-10 mx-auto contactForm">
            
<?php
            
//variables
 //user inputs
 $contactName =  $_POST["name"];
 $contactEmail = $_POST["email"];
 $contactMessage = $_POST["message"];
 //error messages
 $noName = "<p><strong>Please enter your name</strong></p>";
 $noEmail = "<p><strong>Please enter your email address</strong></p>";      
 $invalidEmail = "<p><strong>Please enter a valid email address</strong></p>";
 $noMessage = "<p><strong>Please enter a message to send</strong></p>";
                    
//if form is submitted
if($_POST["submit"]){
    //has name been entered. 
    if(!$contactName){
       //if not 
        $errors .= $noName;
    }else{
        //clean input
         $contactName = filter_var($contactName, FILTER_SANTIZE_STRING);
    }
    
        //has email been entered.
    if(!$contactEmail){
       //if not
        $errors .= $noEmail;
    }else{
        //clean input
         $contactEmail = filter_var($contactEmail, FILTER_SANTIZE_EMAIL);
        //validate email. If not valid, add to $errors
         if(filter_var($contactEmail, FILTER_VALIDATE_EMAIL)){
            $errors .= $invalidEmail;
         }
    }
    
        //has message been entered.
    if(!$contactMessage){
       //if not
        $errors .= $noMessage;
    }else{
        //clean input
         $contactMessage = filter_var($contactMessage, FILTER_SANTIZE_STRING);
    }
    
    //check for errors
    if($errors){
        //if errors
        $resultMessage = '<div class="alert alert-danger" role="alert">' . $errors . '</div>';
    }else{
        //if no errors, send email. 
            //Parameters: receiver(s) of email, subject of email, message, additional header (for use with html content).
        $contactName =  $_POST["name"];
        $contactEmail = $_POST["email"];
        $contactMessage = $_POST["message"];
        $to = "enquiries@bryonykimwebdev.com";
        $subject = "Contact Form - Web Dev";
        $message = "<html><body><p>From: " .  $contactName . "</p>
        <p>Email address: " . $contactEmail . "</p><p>Message: </p>
        <p>" . $contactMessage . "</p></body></html>";
        $headers = "Content-type: text/html";
        //has email been sent.
        if(mail($to, $subject, $message, $headers)){
            //redirect to thank you page
            header("Location: thankYouPage.php");
        }else{
            //email not sent.
             $resultMessage = '<div class="alert alert-warning" role="alert">Your message has not been sent. Please try again later.</div>';
        }
    }
    
    
   //print the resultMessage variable to show errors
    echo $resultMessage;
}
?>  
            
            
<!--            Form  -->
            <form action="contact.php" method="post">
  
<!--                    Name Input          -->
                
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" placeholder="Your Name..." class="form-control inp" value="<?php echo $_POST["name"]; ?>">
                </div>
                
                
 <!--                  Email Input          -->
                <div class="form-group">
                  <label for="email">Email Address:</label>
                  <input type="email" name="email" id="email" placeholder="Your Email Address..." class="form-control inp" value="<?php echo $_POST["email"]; ?>">
                </div>
                
            
<!--                    Message textarea         -->
                <div class="form-group">
                  <label for="message">Your Message:</label>
                  <small id="messageHelp" class="form-text text-muted mb-1 mt-0">Please enter your message here and provide a phone number if appropriate. I will be in touch shortly.</small> 
                  <textarea name="message" id="message" placeholder="Your Message..." class="form-control inp" rows="5" aria-describedby="messageHelp"><?php echo $_POST["message"]; ?></textarea> 
                </div>
                
<!--                  Submit button  -->
                <button type="submit" class="btn" name="submit" value="submit">Send Message</button>
                
            </form>

        </div>

       </div>
         
      <br /><br />    

      <div class="gap"></div>
            
    </div>   
        
          
 </div>    
      
      
<!--footer -->
      <div class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7" id="bks">
                    <p>&copy; Bryony Kim Web Dev 2020 - 2021</p>
                </div>
                <div class="col-sm-5 followme">
                    <p class="mb-0">Follow me on social media</p>
                    <div class="pb-3">
                    <a href="https://www.linkedin.com/in/bryonyseth"><img class="social" src="images/LI-In-Bug.png"></a>
                    <a href="https://twitter.com/BryonyKimWebDev"><img class="social" src="images/2021%20Twitter%20logo%20-%20blue.png"></a>
                    <a href="https://www.instagram.com/bryonykimwebdev/"><img class="social"></a>
                    </div>
                </div>
            </div>  
        </div>
      </div>
      
      

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
      
  
    </body>
</html>
<?php  ob_flush();  ?>

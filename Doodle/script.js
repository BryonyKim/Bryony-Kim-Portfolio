$(function(){
    
    //create dialog box for instructions
    $("#instructions").dialog({
        autoOpen: false
    });
    
    //open dialog when user clicks ? 
    $("#openinfo").click(function(){
        $("#instructions").dialog("open");
    });
    
    //style all buttons as UI buttons
    $("button").button();
    
    //style brush colour selector like button
    $("#brushColour").button();
    
    
//canvas
    
//canvas variables
var inCanvas = false; //is the user in the canvas, initially this is false
var paintMode = "paint"; //either paint or erase. Initially set to paint until user clicks on erase
var canvas = document.getElementById("canvas"); //access canvas element
var context = canvas.getContext("2d"); //return the drawing context
var wrapper = $("#canvasContainer"); //access wrapping div of canvas element
var position = {x:0, y:0}; //coordinates of mouse position. Initially set to top left corner
   
    
//canvas code
    
//open saved file
    //Check if variable exists, if so - access encoded URL
    if(localStorage.getItem("DoodleImg") != null) {
        var img = new Image();
        img.onload = function(){
            context.drawImage (img, 0, 0);
        }
        img.src = localStorage.getItem("DoodleImg");
    };
    
 
//or open blank canvas
  
//set initial drawing parameters
    //line width to initial slider value - 3
    context.lineWidth = 3;
    
    //line joining style
    context.lineJoin = "round";
    
    //line ends style
    context.lineCap = "round";
    
//when user is in canvas container 
    wrapper.mousedown(function(event) {
        //Set variable inCanvas to true
        inCanvas = true; 
        //start drawing capability
        context.beginPath();
        
        //define mouse.x and mouse.y - position of mouse in canvas
        x = (event.pageX - canvas.offsetLeft);
        y = (event.pageY - canvas.offsetTop);
        
        //coordinates of mouse
        context.moveTo(x, y);
    });
    
//If the user moves the mouse while holding the mouse key down
    wrapper.mousemove(function(event) {
        //track mouse coordinates
        x = (event.pageX - canvas.offsetLeft);
        y = (event.pageY - canvas.offsetTop);
        
        //if in canvas
        if(inCanvas == true){
            //painting or erasing
            if (paintMode == "paint") {
                //change colour to colour selected by user
                context.strokeStyle = $("#brushColour").val();
            } else {
                //if erasing, change colour to white
                context.strokeStyle = "white";
            }
            
            //draw line 
            context.lineTo(x, y);
            
            //show line
            context.stroke();
        }
        
    });
    
//When user releases mouse - stop drawing. 
    wrapper.mouseup(function(){
        inCanvas = false;
    });

    
//When user leaves container - stop drawing.
    wrapper.mouseleave(function(){
        inCanvas = false;
    });
    
//When user clicks erase
    $("#erasebtn").click(function(){
        //if in paint mode, change to erase mode.
        if (paintMode == "paint"){
            paintMode = "erase";
        }else{
            //if in erase mode, change to paint.
            paintMode = "paint";
        }
         //toggle between erase mode of button and paint mode of button - styled in stylesheet.
        $(this).toggleClass("buttonErase");
    });
    
    
//Reset button 
    $("#resetbtn").click(function(){
        //clear canvas - clear rectangle between top left corner and bottom right corner
        context.clearRect(0, 0, canvas.width, canvas.height);
        //set paintMode to paint as now a fresh canvas
        paintMode = "paint";
        //reset erase button to paint button by removing erase mode class
        $("#erasebtn").removeClass("buttonErase");
    });
    

//When user clicks save    
    $("#savebtn").click(function(){
        //if browser supports local storage, save variable x and set value to encoded url
        if(typeof(localStorage) != null) {
            localStorage.setItem("DoodleImg", canvas.toDataURL());
        } else {
            //alert message - local storage not supported on browser
            window.alert("Your browser does not support local storage.");
        }
    });
    

//create slider for brush thickness
   //make empty div a ui slider
   $("#slider").slider({
       //define function for when handle of slider is moved
       slide: function(event,ui){
           //set height value of div to value of slider
           $("#example").height(ui.value);
           
           //change line width to that which the user selects using the slider
           context.lineWidth = ui.value;
       },
       //set min and max values for the slider
       min: 3,
       max: 30
   });
    //set starting height value
    $("#example").val(3);
    
    //change line colour to colour selected by user
    $("#brushColour").change(function(){
        //change background colour of example line to colour input selected
        $("#example").css("background-color", $(this).val());
    });
    
//close page load function    
 });

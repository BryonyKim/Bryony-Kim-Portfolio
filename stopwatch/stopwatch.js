$(function(){
    
//variables
var mode = false; //stopwatch is not active initially
var timerCounter = 0; //overall timer - set to 0 initially
var lapCounter = 0; //lap timer - set to 0 initially
var action; //output of setInterval function
var lapNo = 0; //for lap info box - lap number - set to 0 initially
var timerMinutes, timerSeconds, timerCentiseconds, lapMinutes, lapSeconds, lapCentiseconds; //timerCounter and lapCounter will be split into minutes, seconds and centiseconds
    
    
//on page load, hide all buttons, then show start and lap buttons. Hhideshowbuttons function
  hideshowbuttons("#btnStart", "#btnLap");

    
//click start
  $("#btnStart").click(function(){
      //stopwatch is now active, so mode is true
      mode = true;
      
      //show stop and lap buttons
      hideshowbuttons("#btnStop", "#btnLap");   
      
      //start counter function
      startCounter();               
  });
    
   
//click stop
    $("#btnStop").click(function(){
        //show resume and reset buttons
        hideshowbuttons("#btnResume", "#btnReset");   
    
        //stop counters
        clearInterval(action);
    });
    
    
//click resume
    $("#btnResume").click(function(){
        //show stop and lap buttons
        hideshowbuttons("#btnStop", "#btnLap"); 
        
        //restart counter
        startCounter();
    });
    

//click reset
    $("#btnReset").click(function(){
        //reload page
        location.reload();
    });
    
  
//click lap
    $("#btnLap").click(function(){
        //if mode is on
        if (mode == true) {
           //stop lap counter
            clearInterval(action);
            
            //reset lap counter
            lapCounter = 0;
            
            //increase lap number
            lapNo++;
            
            //function to print lap details
            addLap();
            
            //restart lap counter
            startCounter(action);
        }
    });
    
    
    
//functions   
    
    
//hideshowbuttons function. Hide all buttons and show the required two buttons.
    function hideshowbuttons(x, y){
        $("button").hide();
        $(x).show();
        $(y).show();
    }
  
    
//start timer 
    function startCounter(){
        //increase the timerCounter and lapCounter variables by one every 10 miliseconds - convert this to minutes seconds and centiseconds and update the corresponding variables in the spans. Stop counter at 99 mins and reset timerCounter.
       
        action = setInterval(function(){
             timerCounter++;
             if (timerCounter == 100*60*100){
                    timerCounter = 0;
                }
             lapCounter++;
             if (lapCounter == 100*60*100){
                    lapCounter = 0;
                }
            //run update timer function
            updateTimer();
        },10);
    }
  

//Update timer 
   function updateTimer(){
       //Counter variables:
       //1 min = 6000 centiseconds
       timerMinutes = Math.floor(timerCounter/6000);
       //1 second = 100 centiseconds
       timerSeconds = Math.floor((timerCounter%6000)/100);
       //centiseconds is the remainder after calculating minutes and seconds
       timerCentiseconds = (timerCounter%6000)%100;
       
       //Update html values for the main timer:
       $("#timerMin").text(format(timerMinutes));
       $("#timerSec").text(format(timerSeconds));
       $("#timerCent").text(format(timerCentiseconds));
       
       //Lap variables:
       lapMinutes = Math.floor(lapCounter/6000);
       lapSeconds = Math.floor((lapCounter%6000)/100);
       lapCentiseconds = (lapCounter%6000)%100;
       
       //Update html values for the lap timer:
       $("#lapCent").text(format(lapCentiseconds));
       $("#lapSec").text(format(lapSeconds));
       $("#lapMin").text(format(lapMinutes));
    
   } 
    
    
//format timer numbers for double digits
    function format(number){
        if (number<10){
            return '0'+number;
        }else{
            return number;
        }
    }
    
    
//print lap details inside lap box
    function addLap(){
        //div to append to lapInfo box containing two divs, one for lap 'lapnumber' and one for laptime. 
        var lapDetails = '<div class="lap">'+
            '<div class="lapDetailsLaps">'+'Lap ' + lapNo + ':</div>'+
            '<div class="lapDetailsTime">' + format(lapMinutes) + ':' + format(lapSeconds) + ':' + format(lapCentiseconds) + '</div>' + 
            '</div>';

        //append this new div to top of lapInfo box
        $(lapDetails).prependTo("#lapInfo");
     }

    
//close on page load function
});  
    
    

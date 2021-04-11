// click on start button:
//    if playing - reset button
//        reload page
//    if not playing - start button
//        set score to 0
//        show countdown
//        reduce time by 1 sec in loops
//          time left?
//              yes - continue
//              no - gameover
//        change button to reset 
//        generate new question and answers


//click on an answer box
    //if playing
        //correct?
            //yes
                //increase score by 1
                //show correct box for 1 sec
                //generate new question and answer
            //no
                //show try again box for 1 sec



//Define variables

var playing = false; 
var score; 
var action; 
var timeRemaining;
var correctAnswer;
var level = 1;


//click start

document.getElementById("start").onclick = function(){
    
    if(playing == true){
        location.reload(); 
    }else{
        playing = true;
        score = 0; document.getElementById("scoreValue").innerHTML = score;
        
        show("time"); 
        timeRemaining = 60; document.getElementById("timeLeft").innerHTML = timeRemaining; 
        hide("over");
        hide("level");
        document.getElementById("start").innerHTML = "Reset"; 
        
        startCountdown(); 
        
        generateQuestion(); 
    }
}



//answers

for(i=1; i<5; i++){
document.getElementById("a"+i).onclick = function(){ 
    if(playing == true){ 
        if(this.innerHTML == correctAnswer){
            score +=1; 
 document.getElementById("scoreValue").innerHTML = score;
            hide("wrong"); 
            show("correct");
            delayHide1("correct");
            generateQuestion(); 
        }else{ 
            hide("correct");
            show("wrong");
            delayHide1("wrong"); 
        }
    }
}
}



//functions


function startCountdown(){
    action = setInterval (function(){
        timeRemaining -= 1; document.getElementById("timeLeft").innerHTML = timeRemaining; 
            if (timeRemaining <= 10){
                document.getElementById("time").style.color = "rgb( 87, 219, 4)";
            }
            if (timeRemaining == 0){ 
                stopCountdown();
                if (level<9){
                    if (score >= 28){
                        level += 1;
                        show("level"); document.getElementById("level").innerHTML = "<p>Your score is: " + score + "</p><p>Level " + level + "</p>";
                        document.getElementById("levelUp").innerHTML = level;
                    }else{
                        show("over"); document.getElementById("over").innerHTML = "<p>Game Over!</p><p>Your score is: " + score + "</p>";  
                    }
                }else{
                     if (score >= 28){
                       show("over"); document.getElementById("over").innerHTML = "<p>Congratulations!</p><p>Your score is: " + score + "</p>"; 
                        delayReload();
                      }else{
                        show("over"); document.getElementById("over").innerHTML = "<p>Game Over!</p><p>Your score is: " + score + "</p>";  
                      }
                }
                hide("time"); 
                document.getElementById("time").style.color = "black";
                hide("correct"); 
                hide("wrong");
                playing = false; 
                document.getElementById("start").innerHTML = "start";       
            }
    }, 1000); 
}


function stopCountdown(){ 
    clearInterval(action);
}


function show(Id){
    document.getElementById(Id).style.display = "block";
}


function hide(Id){
    document.getElementById(Id).style.display = "none";
}


function delayHide(Id){
    delay = setTimeout(function(){
        hide(Id)}, 3000); 
}


function delayHide1(Id){ 
    delay = setTimeout(function(){
        hide(Id)}, 1000); 
}


function delayReload(){
    delay = setTimeout(function(){
        location.reload()}, 3000);
}


function generateQuestion(){
    if(level == 1){
    var y = 1+ Math.round(Math.random()*9); 
    var z = 1+ Math.round(Math.random()*9); 
    var question = y + " + " + z; 
    correctAnswer = y + z; 
    
    document.getElementById("question").innerHTML = question; 
    
    var correctDiv = 1+ Math.round(Math.random()*3); 
    document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 
    
    var answersArray = [correctAnswer];
    
    for(i=1; i<5; i++){ 
        if(i != correctDiv) { 
            var wrongAnswer;
            do{  
               wrongAnswer = (1+ Math.round(Math.random()*9))+(1+ Math.round(Math.random()*9));
            }while(answersArray.indexOf(wrongAnswer)>-1)       
            
          document.getElementById("a"+i).innerHTML = wrongAnswer; 
          answersArray.push(wrongAnswer);
        }
    }
    }else if(level == 2){
    var y = 1+ Math.round(Math.random()*9); 
    var z = 10+ Math.round(Math.random()*4); 
    var question = y + " + " + z; 
    correctAnswer = y + z; 
    
    document.getElementById("question").innerHTML = question; 
    
    var correctDiv = 1+ Math.round(Math.random()*3); 
    document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 
    
    var answersArray = [correctAnswer];
    
    for(i=1; i<5; i++){ 
        if(i != correctDiv){ 
            var wrongAnswer;
            do{  
               wrongAnswer = (1+ Math.round(Math.random()*9))+(10+ Math.round(Math.random()*4));
            }while(answersArray.indexOf(wrongAnswer)>-1)       
            
          document.getElementById("a"+i).innerHTML = wrongAnswer; 
          answersArray.push(wrongAnswer);
        }
    }
    }else if (level == 3){
        var y = 1+ Math.round(Math.random()*9); 
        var z = 1+ Math.round(Math.random()*9); 
        var question = y + " x " + z; 
        correctAnswer = y*z; 

        document.getElementById("question").innerHTML = question; 

        var correctDiv = 1+ Math.round(Math.random()*3); 
        document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 

        var answersArray = [correctAnswer];

        for(i=1; i<5; i++){ 
            if(i != correctDiv) { 
                var wrongAnswer;
                do{  
                   wrongAnswer = (1+ Math.round(Math.random()*9))*(1+ Math.round(Math.random()*9));
                }while(answersArray.indexOf(wrongAnswer)>-1)       

              document.getElementById("a"+i).innerHTML = wrongAnswer; 
              answersArray.push(wrongAnswer);
            }
        }
    }else if (level ==4){     
        var y = 10+ Math.round(Math.random()*4); 
        var z = 10+ Math.round(Math.random()*4); 
        var question = y + " + " + z; 
        correctAnswer = y+z; 

        document.getElementById("question").innerHTML = question; 

        var correctDiv = 1+ Math.round(Math.random()*3); 
        document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 


        var answersArray = [correctAnswer];

        for(i=1; i<5; i++){ 
            if(i != correctDiv) { 
                var wrongAnswer;
                do{  
                   wrongAnswer = (10+ Math.round(Math.random()*4))+(10+ Math.round(Math.random()*4));
                }while(answersArray.indexOf(wrongAnswer)>-1)       

              document.getElementById("a"+i).innerHTML = wrongAnswer; 
              answersArray.push(wrongAnswer);
            }
        }
    }else if (level == 5){
        var y = 15+ Math.round(Math.random()*4); 
        var z = 10+ Math.round(Math.random()*9); 
        var question = y + " + " + z; 
        correctAnswer = y+z; 

        document.getElementById("question").innerHTML = question; 

        var correctDiv = 1+ Math.round(Math.random()*3); 
        document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 

        var answersArray = [correctAnswer];

        for(i=1; i<5; i++){ 
            if(i != correctDiv) { 
                var wrongAnswer;
                do{  
                   wrongAnswer = (15+ Math.round(Math.random()*4))+(10+ Math.round(Math.random()*9));
                }while(answersArray.indexOf(wrongAnswer)>-1)       

              document.getElementById("a"+i).innerHTML = wrongAnswer; 
              answersArray.push(wrongAnswer);
            }
        }
    }else if (level == 6){
        var y = 1+ Math.round(Math.random()*4); 
        var z = 10+ Math.round(Math.random()*5); 
        var question = y + " x " + z; 
        correctAnswer = y*z; 

        document.getElementById("question").innerHTML = question; 

        var correctDiv = 1+ Math.round(Math.random()*3); 
        document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 

        var answersArray = [correctAnswer];

        for(i=1; i<5; i++){ 
            if(i != correctDiv) { 
                var wrongAnswer;
                do{  
                   wrongAnswer = (1+ Math.round(Math.random()*4))*(10+ Math.round(Math.random()*5));
                }while(answersArray.indexOf(wrongAnswer)>-1)       

              document.getElementById("a"+i).innerHTML = wrongAnswer; 
              answersArray.push(wrongAnswer);
            }
        }
    }else if (level == 7){
        var y = 5+ Math.round(Math.random()*4); 
        var z = 10+ Math.round(Math.random()*4); 
        var question = y + " x " + z; 
        correctAnswer = y*z; 

        document.getElementById("question").innerHTML = question; 

        var correctDiv = 1+ Math.round(Math.random()*3); 
        document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 

        var answersArray = [correctAnswer];

        for(i=1; i<5; i++){ 
            if(i != correctDiv) { 
                var wrongAnswer;
                do{  
                   wrongAnswer = (5+ Math.round(Math.random()*4))*(10+ Math.round(Math.random()*4));
                }while(answersArray.indexOf(wrongAnswer)>-1)       

              document.getElementById("a"+i).innerHTML = wrongAnswer; 
              answersArray.push(wrongAnswer);
            }
        }
    }else if (level == 8){
        var y = 1+ Math.round(Math.random()*29); 
        var z = 20+ Math.round(Math.random()*29); 
        var question = y + " + " + z; 
        correctAnswer = y+z; 

        document.getElementById("question").innerHTML = question; 

        var correctDiv = 1+ Math.round(Math.random()*3); 
        document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 

        var answersArray = [correctAnswer];

        for(i=1; i<5; i++){ 
            if(i != correctDiv){ 
                var wrongAnswer;
                do{  
                   wrongAnswer = (1+ Math.round(Math.random()*29))+(20+ Math.round(Math.random()*29));
                }while(answersArray.indexOf(wrongAnswer)>-1)       

              document.getElementById("a"+i).innerHTML = wrongAnswer; 
              answersArray.push(wrongAnswer);
            }
        }
    }else {
        var y = 1+ Math.round(Math.random()*4); 
        var z = 15+ Math.round(Math.random()*4); 
        var question = y + " x " + z; 
        correctAnswer = y*z; 

        document.getElementById("question").innerHTML = question; 

        var correctDiv = 1+ Math.round(Math.random()*3); 
        document.getElementById("a"+correctDiv).innerHTML = correctAnswer; 

        var answersArray = [correctAnswer];

        for(i=1; i<5; i++){ 
            if(i != correctDiv) { 
                var wrongAnswer;
                do{  
                   wrongAnswer = (1+ Math.round(Math.random()*4))*(15+ Math.round(Math.random()*4));
                }while(answersArray.indexOf(wrongAnswer)>-1)       

              document.getElementById("a"+i).innerHTML = wrongAnswer; 
              answersArray.push(wrongAnswer);
            }
        }
    }
}
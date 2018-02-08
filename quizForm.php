<?php 
session_start();
include("config.php");
include("session.php");
?>


<html>
	<head>
		<title>Dynamic Quiz</title>
		<link type='text/css' rel='stylesheet' href='prototype.css'/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open Sans"/>
	</head>
	<body>
		<div id='container'>
			<div id='title'>
				<h1>Dynamic Quiz</h1>
			</div>
   			<br/>
   			<div id="StudentProgress">
  			<div id="ProgBar"></div>
			</div>	
			<div id="BarLabel">Progress Bar</div>			
			<div id='quiz'></div>
			<div id ='hintBox'></div>
			<div id = 'final'></div>
			<iframe id="instrucVid" scrolling="yes" height="350" width ="500" src=""></iframe>
			<div class='button' id='next'><a href='#'>Next</a></div>
    		<div class='button' id='prev'><a href='#'>Prev</a></div>
    		<!--<div class='button' id='start'> <a href='#'>Start Over</a></div>-->    		
        <div class='button' id='finish'> <a href='#'>Finish</a></div>
			<div class = 'actionButton' id= 'hint'><a href= '#'>Hint</a></div>
			<div class = 'actionButton' id= 'logout'><a href= '#'>Log Out</a></div>
    		<!-- <button class='' id='next'>Next</a></button>
    		<button class='' id='prev'>Prev</a></button>
    		<button class='' id='start'> Start Over</a></button> -->
    	</div>

		<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
    <script type="application/json" src='questions.json'></script>
    
  


  <script>

  	(function() {
  var questions = ""; /*[[{
    "question": "What is 2+5?",
    "choices": [2, 5, 10, 7, 20],
    "subject": "singles addition",
    "hint": "wut",
    "correctAnswer": 3
  }, {
    "question": "What is 3+6?",
    "choices": [3, 6, 9, 12, 18],
    "subject": "singles addition",
    "hint": "wut",
    "correctAnswer": 2
  }, {
    "question": "What is 9+8?",
    "choices": [17, 99, 108, 134, 156],
    "subject":"singles addition",
    "hint": "wut",
    "correctAnswer": 0
  }],//establishes array of questions
   [{
    "question": "What is 3*5?",
    "choices": [2, 5, 10, 15, 20],
    "subject":"singles multiplication",
     "hint": "wut",
    "correctAnswer": 3
  }, {
    "question": "What is 60/5?",
    "choices": [3, 6, 18, 12, 9],
    "subject": "doubles division",
    "hint": "wut",
    "correctAnswer": 3
  }, {
    "question": "What is 156*1?",
    "choices": [1, 99, 108, 134, 156],
    "subject": "doubles multiplication",
    "hint": "wut",
    "correctAnswer": 4
  }]];*/
  var extraQuestions=""; /*[[{
    "question": "What is 4+12?",
    "choices": [12, 15, 16, 17, 20],
    "subject": "singles addition",
    "hint": "wut",
    "correctAnswer": 3
  }, {
    "question": "What is 3+9?",
    "choices": [11, 6, 19, 12, 18],
    "subject": "singles addition",
    "hint": "wut",
    "correctAnswer": 3
  }, {
    "question": "What is 12+8?",
    "choices": [17, 20, 128, 21, 15],
    "subject": "singles addition",
    "hint": "wut",
    "correctAnswer": 1
  }],//establishes array of questions
   [{
    "question": "What is 10*5?",
    "choices": [2, 5, 10, 15, 50],
    "subject": "doubles multiplication",
    "hint": "wut",
    "correctAnswer": 4
  }, {
    "question": "What is 200/25?",
    "choices": [3, 6, 8, 12, 9],
    "subject": "doubles division",
    "hint": "wut",
    "correctAnswer": 2
  }, {
    "question": "What is 20*4?",
    "choices": [1, 99, 80, 134, 156],
    "subject": "doubles multiplication",
    "hint": "wut",
    "correctAnswer": 2
  };*/
  questions = loadQuestions(1);
  extraQuestions = loadQuestions(2);
  var questionCounter = 0;//question number
  var hasAdded = 0;
  var catagory = 0;//array number
  var maxCatagories = questions.length;
  var selections = []; //Array containing user choices
  var quiz = $('#quiz'); //Quiz div object
  var questionQueue = [];//Quis Ques up to displ(ay
    var catNum = [];
    var catScores = [];
    var hintBox = $('#hintBox');//hint box div object
    var final = $('#final');
    var hintsUsed = [maxCatagories-1];
    var hintDisplayed = false;
    var progress = 0;
    var percentage = 0;
    for(i = 0; i<questions.length; i++){
      catScores[i] = 0;
      catNum[i] = 0;
    }
   
  
    // Display initial question
    console.log("GOT HERE");
    $('#instrucVid').hide();
    $('#hintBox').hide();
    $('#logout').hide();
    $('#finish').hide();
    $('#final').hide();
    displayQues();

  
  // Click handler for the 'next' button
   $('#next').on('click', function (e){
    e.preventDefault();
    
    // Suspend click listener during fade animation
    /*if(quiz.is(':animated')) {        
      return false;
    }*/
    choose();
    
    // If no user selection, progress is stopped
    if (isNaN(selections[questionCounter])) {
      alert('Please make a selection!');
    } 
    /*else if (selections[i] !== questions[i].correctAnswer){
      if (selections[i] !== questions[i].correctAnswer){
        var extraNext =  createQuestionElement(extraQuestions, catagory, questionCounter2);
        questionQueue.push(extraNext);
        questionCounter2++;
      }
      var nextQuestion = createQuestionElement(questions, catagory, questionCounter1);
      questionQueue.push(nextQuestion);
      questionCounter1++;*/
      else{
        questionCounter++;
        hintDisplayed = false;
        hintBox.hide();
      displayQues();
    }
  });
  
  // Click handler for the 'prev' button
  $('#prev').onclick=function(){
    //e.preventDefault();
    
    /*if(quiz.is(':animated')) {
      return false;
    }*/
    choose();
    //make so it can't go back to a previous catagory
    questionCounter--;
    displayQues();
  };

 $('#finish').on('click', function (e){
    //e.preventDefault();
    
    /*if(quiz.is(':animated')) {
      return false;
    }*/
    for (var i = 0; i < maxCatagories; i++){
    	percentage += catScores[i]-(hintsUsed[i]*.5);
   		var obj =
    	{
        "catagory": i,
        "correct": catScores[i],
        "wrong":catNum[i]-catScores[i],
        "hintsUsed": hintsUsed[i],
        "catQuestions":catNum[i]
    	};

    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    var text = "";
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        text= this.responseText;
        
    }
};
xmlhttp.open("GET", "http://localhost/saveResults.php?x="+dbParam, false);
xmlhttp.send();//is it not sending?
}
    
    questionCounter = 0;



    $('#logout').show();
});
$('#logout').onclick=function(){
    //e.preventDefault();
    
    /*if(quiz.is(':animated')) {
      return false;
    }*/

   /* <?php

   header("logout.php");
   ?>*/
  };


  $('#hint').on('click', function (e){ 
//how to do hint boolean? global variable
  if (hintDisplayed ===true)
  {
    alert("Hint is already given!")
  }
  else{
  hintDisplayed = true;
  hintsUsed[catagory]++;
  displayHint(questions, catagory, questionCounter-(catagory*questions[catagory].length));//check that this is write when ques are added
}}); 
  
  // Click handler for the 'Start Over' button
  /*$('#start').onclick = function() {
    //e.preventDefault();
    
    /*if(quiz.is(':animated')) {
      return false;
    }*/
    //questionCounter = 0;
    //selections = [];
    /*questionQueue = [];
    selections = [];
    var nextQuestion;
    for (var i = 0; i <questions[catagory].length; i++){
      nextQuestion = createQuestionElement(questions[catagory][i]);
      questionQueue.push(nextQuestion);
    }
    displayQues();
    $('#start').hide();
  };*/

  
  // Creates and returns the div that contains the questions and 
  // the answer selections
  function loadQuestions(num){
    if (num == 1){
    obj = { "table":"questions"};
  }
  else {
    obj = { "table":"extra_questions"};
  }

    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    var text = "";
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        text= JSON.parse(this.responseText);
        
    }
};
xmlhttp.open("GET", "http://localhost/quiz.php?x="+dbParam, false);
xmlhttp.send();//is it not sending?
if (text!= ""){
  return text;
}
  }

  function createQuestionElement(array, cat, index) {
    var qElement = $('<div>', {
      id: 'question'
    });
    
    var header = $('<h2>Question ' + (index + 1) + ':</h2>');
    qElement.append(header);
    
    var question = $('<p>').append(array[cat][index].question);
    qElement.append(question);
    
    var radioButtons = createRadios(array, cat, index);
    qElement.append(radioButtons);
    
    return qElement;
  }
  
  // Creates a list of the answer choices as radio inputs
  function createRadios(array, catagory, index) {
    var radioList = $('<ul>');
    var item;
    var input = '';
    for (var i = 0; i < array[catagory][index].choices.length; i++) {
      item = $('<li>');
      input = '<input type="radio" name="answer" value=' + i + ' />';
      input += array[catagory][index].choices[i];
      item.append(input);
      radioList.append(item);
    }
    return radioList;
  }
  
  // Reads the user selection and pushes the value to an array
  function choose() {
    selections[questionCounter] = +$('input[name="answer"]:checked').val();
  }

  
  function progressMove(lastprogress, progress) {
  var elem = document.getElementById("ProgBar");   
  var width = 1;
  var id = setInterval(frame, lastprogress);
  function frame() {
    if (width >= progress) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
    }
  }
}


  function displayHint(array, catagory, index){
  var hint = $('<div>', {      id: 'hint'    });    
  hint.append(array[catagory][index].hint);
  if (hintBox.length){
    hintBox.empty();
    hintBox.append(hint);
  }
  else{
    hintBox.append(hint);}
  hintBox.show();
  $('#hintBox').show();
}

  function displayVid(){

    var obj = { "catagory":catagory};

    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    var video = "";
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        video= this.responseText;
        
    }
};
xmlhttp.open("GET", "http://localhost/getVideo.php?x="+dbParam, false);
xmlhttp.send();//is it not sending?

if (video!= ""){
     //var video = "https://www.youtube.com/embed/Fe8u2I3vmHU";
     $('#instrucVid').attr("src", video);
     $('#instrucVid').show();
     } 
  }
  
  // Displays next requested element
  function displayQues() {
    var lastprogress = progress;
    if (questionCounter === 0){
       var nextQuestion;
       var toAdd = questions[catagory].length;
    for (i = 0; i<questions[catagory].length; i++){
      nextQuestion = createQuestionElement(questions, catagory, i);
      questionQueue.push(nextQuestion);
    }
    }
    progress = 100/(questionQueue.length*(questionCounter+1));
    //progressMove(lastprogress, progress);
    quiz.hide(function() {
      $('#question').remove();
      if (hintDisplayed == true){            
          $('#hintBox').remove();
          $('#hint').remove();    
          hintDisplayed = false;  
        }
      //if(questionCounter < questions.length){
        //var nextQuestion = createQuestionElement(questionCounter);
        if(questionCounter<questionQueue.length){
           displayVid();
          quiz.append(questionQueue[questionCounter]).show();
         
        if (!(isNaN(selections[questionCounter]))) {//so if selections[questionCounter] is null it doesn't move
          $('input[value='+selections[questionCounter]+']').prop('checked', true);
        }
        
        // Controls display of 'prev' button--should I even keep it? Given that this is supposed to be constant?
        if(questionCounter >= 1){
          $('#prev').show();
        } else if(questionCounter === 0){
          
          $('#prev').hide();
          $('#next').show();
        }
      }
        else {
        calcScore();//fix: check user group. if not dynamic, get random next number

        /*quiz.append(scoreElem).show();
        $('#next').hide();
        $('#prev').hide();*/
      }
    });
  }

  function calcPercentage(){
    var percen;
    var sumScores=0;
    var sumQuestions=0;
    for (var s = 0; s< maxCatagories; s++){
        sumScores +=(catScores[s]-(hintsUsed[s]*.5));
        sumQuestions += catNum[s];
      }
      percen = sumScores/sumQuestions;
      return percen;
  }

  // Computes score and returns a paragraph element to be displayed
  //make more flexible so it can have more than 2 catagories
  function calcScore() {
    var score = $('#final');
    $('#next').hide();
    $('#prev').hide();
    $('#hint').hide();
    $('#instrucVid').hide();
    if(questionCounter>=questionQueue.length&&catagory===(maxCatagories-1)&&hasAdded===1){//end of questions
      var index = 0;
      var numCorrect = 0;
      var numWrong = 0;
      var sum = 0;
      for (var s = 0; s< maxCatagories; s++){
        sum +=catNum[s];
      }
        for (var i = sum; i < selections.length; i++) {
      if (selections[i] === parseInt(extraQuestions[catagory][index].correctAnswer)) {
        numCorrect++;
        index++;
      }
      else{
        numWrong++;
        index++;
      }
    }
      catScores[catagory]+=numCorrect;
      catNum[catagory] += numWrong+numCorrect;
      percentage = calcPercentage();
      final.append('Final score is: '+percentage*100);
      questionCounter = 0;
      //percentage = ((catScores[0]-hintsUsed[catagory]*.5)+catScores[1])/selections.length;
      
      final.show();
       $('#finish').show();
      //return score;
    }
    else if (questionCounter>=questionQueue.length&&hasAdded===1&&catagory<=(maxCatagories-1)){//1 catagory is done
      var index = 0;
      var numCorrect = 0;
      var numWrong = 0;
      var sum = 0;
      for (var s = 0; s< maxCatagories; s++){
        sum +=catNum[s];
      }
        for (var i = sum; i < selections.length; i++) {
      if (selections[i] === parseInt(extraQuestions[catagory][index].correctAnswer)) {
        numCorrect++;
        index++;
      }
      else{
        numWrong++;
        index++;
      }
    }
      catScores[catagory]+=numCorrect;
      catNum[catagory] += numWrong+numCorrect;
      catagory++;
      var temp;
       for (var i = 0; i<questions[catagory].length; i++){
        temp = createQuestionElement(questions, catagory, i)
        questionQueue.push(temp);
      }
      hasAdded = 0;
      displayQues();
      $('#next').show();
    }

    else{//if catagory is 0 or 1 and hasAdded is false
    var numCorrect = 0;
    var numWrong = 0;
    var index = 0;
    var sum = 0;
    for (var s = 0; s< maxCatagories; s++){
        sum +=catNum[s];
      }
    for (var i = sum; i < selections.length; i++) {
      if (selections[i] === parseInt(questions[catagory][index].correctAnswer)) {
        numCorrect++;
        index++;
      }
      else{
        numWrong++;
        index++;
      }
    }
    catNum[catagory] = numWrong+numCorrect;
    catScores[catagory]+=numCorrect;
    var scoreRatio = (numWrong+(hintsUsed*.5))/catNum[catagory];
    if (scoreRatio ===0&&catagory<=maxCatagories-1){
      catagory++;
      hasAdded = 0;
      var temp;
      for (var i = 0; i<questions[catagory].length; i++){
      temp = createQuestionElement(questions, catagory, i)
      questionQueue.push(temp);
      
    }
     $('#next').show();
     $('#hint').show();
     //hintsUsed = 0;
    displayQues();
    }
     else if (scoreRatio ===0&&catagory===maxCatagories-1){//end
      percentage = calcPercentage();
      final.append('Final score is: '+percentage*100);
      questionCounter = 0;
      //$('#start').show();
      final.show();
      $('#finish').show();
     
    }
    else{//add from extraQuestions
    var temp;
    var newquestions = Math.round(scoreRatio*questions[catagory].length;)
    for (var i = 0; i<scoreRatio; i++){
      temp = createQuestionElement(extraQuestions, catagory, i)
      questionQueue.push(temp);
    }
    hasAdded=1;
     $('#next').show();
     $('#hint').show();
     //hintsUsed = 0;
    displayQues();
  }
  }
}
function calcScoreAlt(){//For the non-dynamic option
  //get number of total questions
  //get number of total extraquestions
  
  
}
function shuffle(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}
}
)();
</script>

		<!--<script type='text/javascript' src='prototype.js'></script>-->
</body>
    </html>



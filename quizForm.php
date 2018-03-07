<?php 
//session_start();
include("config.php");
include("session.php");
?>


<html>
	<head>
		<title>Dynamic Quiz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
        <div class="alert alert-success fade in" id = "right">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Success!</strong> Indicates a successful or positive action.
            </div>
            <div class="alert alert-warning fade in" id="wrong">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Warning!</strong> Indicates a warning that might need attention.
</div>
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
 
  questions = loadQuestions();
  //extraQuestions = loadQuestions(2);
  var questionCounter = 0;//question number
  var hasAdded = 0;
  var initial=1;
  var nextAdd = initial;
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
    $('#right').hide();
    $('#wrong').hide();
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
      //saveQuestions();
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

   //header("logout.php");
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
  function loadQuestions(){
    var obj = { "table":"questions"};

    var dbParam = JSON.stringify(obj);
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

  function saveQuestions(){
    /*

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
xmlhttp.open("POST",saveComments.php, false);
xmlhttp.send("catagory="+i+"&correct="+catScores[i]+"&wrong="+(catNum[i]-catScores[i])+"&hintsUsed="
  +hintsUsed[i]+"&catQuestions="+catNum[i]);//is it not sending?*/

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
  function loadQueue()
  {
  var nextQuestion;
      
    for (i = catNum[catagory]; i<nextAdd; i++){
      nextQuestion = createQuestionElement(questions, catagory, i);
      questionQueue.push(nextQuestion);
    }

  }

  function displayQues() {
    var lastprogress = progress;
    if (hasAdded === 0){
      loadQueue();
      hasAdded = 1;
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
        if(selections.length<questionQueue.length){
           displayVid();
          quiz.append(questionQueue[selections.length]).show();
         
        if (!(isNaN(selections[selections.length]))) {//so if selections[questionCounter] is null it doesn't move
          $('input[value='+selections[selections.length]+']').prop('checked', true);
        }
        
        // Controls display of 'prev' button--should I keep it? is it even relevant?
        if(selections.length !== null){
          $('#prev').show();
        } 
        else{
          
          $('#prev').hide();
          $('#next').show();
        }
      }
        else {
        calcScore();
        /*quiz.append(scoreElem).show();
        $('#next').hide();
        $('#prev').hide();*/
      }
    });
  }

  /*function calcPercentage(){
    var percen;
    var sumScores=0;
    var sumQuestions=0;
    for (var s = 0; s< maxCatagories; s++){
        sumScores +=(catScores[s]-(hintsUsed[s]*.5));
        sumQuestions += catNum[s];
      }
      percen = sumScores/sumQuestions;
      return percen;
  }*/

  // Computes score and returns a paragraph element to be displayed
  //make more flexible so it can have more than 2 catagories
 
function calcScore() {//attenuated version--tell them when more content is added
    var score = $('#final');
    $('#next').hide();
    $('#prev').hide();
    $('#hint').hide();
    $('#instrucVid').hide();
    var sum = 0;
    var numWrong = 0;
    var numCorrect = 0;
      for (var s = 0; s==catagory; s++){
        sum +=catNum[s];
      }
      var index = 0;
      for (var i = sum; i < selections.length; i++) {
      if (selections[i] === parseInt(questions[catagory][catNum[catagory]+index].correctAnswer)) {
        numCorrect++;
        index++;
      }
      else{
        numWrong++;
        index++;
      }
    }
    catNum[catagory]+=(numWrong+numCorrect);
    catScores[catagory]+=(numCorrect);
    var scoreRatio;
    if (numWrong ==0 && hintsUsed==0)
    {
      scoreRatio = 0;
    }
    else{
      scoreRatio = (selections.length-sum)/(numWrong+hintsUsed);
    }
    nextAdd = Math.round(scoreRatio*(numWrong+numCorrect));
    if ((catNum[catagory]+nextAdd)>questions[catagory].length){
      catagory++; 
      hasAdded = 0;
      nextAdd = initial;
      displayQues();
    }
    else if (((catNum[catagory]+nextAdd)>questions[catagory].length)&&catagory===maxCatagories-1){//final percentage and display
      var sum2;
      for (var s = 0; s==catagory; s++){
        sum2 +=catScores[s];
      }
      percentage = selections.length/sum2;
        final.append('Final score is: '+percentage*100);
        questionCounter = 0;
      //percentage = ((catScores[0]-hintsUsed[catagory]*.5)+catScores[1])/selections.length;
      
        final.show();
       $('#finish').show();
    }
    else{
    displayQues();
  }
}


function calcScoreAlt(){//For the non-dynamic option--GETS OPTION TO SEE MORE MATERIAL
  //get number of total questions
  
  
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



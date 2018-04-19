<?php 
session_start();
include("config.php");
include("session.php");
?>


<html>
	<head>
		<title>Dynamic Quiz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link type='text/css' rel='stylesheet' href='prototype.css'/>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open Sans"/>
    
	</head>
	<body >
    <div id='title'>
        <h1>Dynamic Quiz</h1>
      </div>
		<div class='container-fluid'>
      <div id ='main'>
        <div class = "row">
      <div class = "col-md-2">
      </div>
      <div class="col-md-9">
      </br>
      <iframe id="instrucVid" scrolling="yes" src=""></iframe>
      </div>

    </div>

        </br>
      <div class = "col-md-1">
      </div>
      <div class = "col-md-11">
      <div id='container'>
      
     <div class = "row">
      <div class = "col-md-12">
        </br>

        <div id='quiz' style = "padding:20px;"></div>
        
        
    </div>
  </br>
    <div class = "row">
      <div class = "col-md-1">
      </div>
      <div class="col-md-10">
      </br>
        <button type="button" class="btn btn-info" id='next' style="position:relative;float:left;">Next</button>
        <button type="button" class="btn btn-primary" id ='finish' style="position:relative;float:left;top:35px;left:400px;">Finish</button>
        <button type="button" class="btn btn-success" id='hint' style="position:relative; float:right;">Hint</button>
      </div>

     <!-- <div class = "col-md-4" style = "top:35px;">-->
      
    <!--</div>-->
    </div>
    </br>
        <div class="row">
          <div class = "col-md-1">
      </div>
      <div class = "col-md-11">
      <div id ='hintBox' style = "width:90%"></div>
      </div>
    </div>
     <div class="col-md-11" style = "top:40px;">
        <div class="alert alert-success alert-dismissible fade in" id = "right">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
     <strong>Correct!</strong> Great job!
            </div>
            <div class="alert alert-warning alert-dismissible fade in" id="wrong">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Not quite!</strong> We may want to revisit this. 
    
  </div>
  </div>
   
    </div>

    </div>
     


      
    		<!--<div class='button' id='prev'><a href='#'>Prev</a></div>-->
</div> 

</div>
 <div id = 'sidebar' style = "float:right; width:35%; background-color:#EBFFE6; padding-top:30px;">
  <div id = sidetitle style = "color:black" id = "sidebarlist">
    <div class = catBox style = "background-color:white;">
    <div style = "font-family: 'Lucida Sans Unicode', Lucida Grande, sans-serif; float:center; font-weight: bold; font-size:30px; color:#003300;">Catagory Results</div></div>
  </div>
      <div class = row>
       <div class="col-md-12" id =sidelist>
      <!--<div class = "catBox" style = "float:right; height:100px;">-->
      </div>
        
      </div>
      <div class = row>
        <div id = 'final'></div>
      </div>

      </div>

      </div>

</div>

		
		<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>
    <script type="application/json" src='questions.json'></script>
    
  


  <script>

  	(function() {

  var group = parseInt(getGroup());
  var questions = "";
 
  //extraQuestions = loadQuestions(2);
  var questionCounter = parseInt('<?php echo $_SESSION["questionCounter"] ?>');//question number
  var initial=parseInt('<?php echo $_SESSION["initial"] ?>');
  var nextAdd = parseInt('<?php echo $_SESSION["nextAdd"] ?>');
  var lastAdd = parseInt('<?php echo $_SESSION["lastAdd"] ?>');
  var catagory = parseInt('<?php echo $_SESSION["catagory"] ?>');//array number
  questions = <?php echo $_SESSION["questions"] ?>;
  var listCat = $("#sidelist");

  var maxCatagories = parseInt(maxCat());
  var selections = <?php echo $_SESSION["selections"] ?>; //Array containing user choices
  var quiz = $('#quiz'); //Quiz div object
  var questionQueue = [];//Quis Ques up to displ(ay
    var catNum = <?php echo $_SESSION["catNum"] ?>;
    var catScores = <?php echo $_SESSION["catScores"] ?>;
    var masteryRate=1;
    var hintBox = $('#hintBox');//hint box div object
    var final = $('#final');
    var currHintsUsed =  parseInt('<?php echo $_SESSION["currHintsUsed"] ?>');
    var hintsUsed = <?php echo $_SESSION["hintsUsed"] ?>;
    var hintDisplayed = false;
    //var progress = 0;
    var percentage = 0;
    if (catScores.length == 0 && catNum.length == 0 && hintsUsed.length ==0){
   catScores[1] = 0;
   catNum[1] = 0;
   hintsUsed[1] = 0;
 }
   
  
    // Display initial question
    console.log("GOT HERE");
    $('#right').hide();
    $('#wrong').hide();
    $('#instrucVid').hide();
    $('#hintBox').hide();
    //$('#logout').hide();
    $('#finish').hide();
    $('#final').hide();
    displayQues();
    displayVid();

  loadSidebar();
  // Click handler for the 'next' button
    function loadSidebar(){//get it to load name and score
      for (i = 1; i<=maxCatagories; i++){
        var bgcolor;
        if (i == catagory){
            bgcolor = "#376c2d"
        }
        else{
          bgcolor = "#B1FFC0"
        }
        var quesanswered;
        var score;
        if (catNum[i] == undefined||catNum[i] == 0){
          quesanswered = 0;
          score = 0;
        }
        else{
          quesanswered = catNum[i];
          score = ((catScores[i]/catNum[i])*100);
        }
        var name = catInfo(i).catName;
        listCat.append("</br> <div class = catBox style = 'background-color:"+bgcolor+";'> <h4 style = 'font-weight:bold;'>Catagory "+(i)+": "+name+"</h4> <div class = catBox style = 'background-color: white;color:#003300;'> Questions answered: "+quesanswered+"<div style = 'float:right;'> Current score: "+score+"</div></div></div>");
      }

    }


   $('#next').on('click', function (e){
    e.preventDefault();
    $(this).attr("disabled", "disabled");
    
    // Suspend click listener during fade animation
    /*if(quiz.is(':animated')) {        
      return false;
    }*/
    choose();
    
    // If no user selection, progress is stopped
    if (isNaN(selections[questionCounter-1])) {
      alert('Please make a selection!');
    } 
      else{
        if (selections[questionCounter-1] === parseInt(questions[questionCounter-1].correctAnswer)){
          $('#right').show();
        }
        else {
          $('#wrong').show();
        }
        questionCounter++;
        catNum[catagory]++;
        nextAdd--;
        hintDisplayed = false;
        hintBox.hide();
        
        setTimeout(function(){ displayQues() }, 3000);
      

    }
  });
  
  // Click handler for the 'prev' button
  $('#prev').onclick=function(){
  
    choose();
    questionCounter--;
    displayQues();
  };
   $('#finish').on('click', function (e){
  
    $.ajax({
         type:"POST",
         url: "logout.php"
    }); 
  });


  $('#hint').on('click', function (e){ 
//how to do hint boolean? global variable
  if (hintDisplayed ===true)
  {
    alert("Hint is already given!")
  }
  else{
  hintDisplayed = true;
  currHintsUsed++;
  displayHint(questions);//check that this is write when ques are added
}}); 
  
  
  
  // Creates and returns the div that contains the questions and 
  // the answer selections
  function getGroup(){
    xmlhttp = new XMLHttpRequest();
    var text = "";
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        text= this.responseText;
    }
};
xmlhttp.open("POST", "getGroup.php", false);
xmlhttp.send();//is it not sending?
if (text!= ""){
  return text;
}
  }
  function maxCat(){
    xmlhttp = new XMLHttpRequest();
    var text = "";
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        text= this.responseText;
    }
};
xmlhttp.open("POST", "maxcat.php", false);
xmlhttp.send();//is it not sending?
if (text!= ""){
  return text;
}
}

  
  function loadQuestions(){
    var obj = { "table":"questions",
                "catagory":catagory,
                 "quesNum":catNum[catagory]};

    var dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    var text = "";
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        text= JSON.parse(this.responseText);
    }
};
xmlhttp.open("GET", "quiz.php?x="+dbParam, false);
xmlhttp.send();//is it not sending?
if (text!= ""){
  return text;
}
  }


  function catInfo(cat){
    var obj = {"catagory":cat};

    var dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    var text = "";
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        text= JSON.parse(this.responseText);
    }
};
xmlhttp.open("GET", "catInfo.php?x="+dbParam, false);
xmlhttp.send();//is it not sending?
if (text!= ""){
  return text;
}
  }

  function setSessions(){
     $.ajax({
         type:"POST",
         url: "setSessions.php",
         data: { quesCount : questionCounter, 
           cat: catagory,
          ques : JSON.stringify(questions),
          quesq: JSON.stringify(questionQueue),
          selec: JSON.stringify(selections),
          cats:JSON.stringify(catScores),
          catn:JSON.stringify(catNum),
          hintsU: JSON.stringify(hintsUsed),
          currhintsu: currHintsUsed,
          nAdd: nextAdd,
          lAdd :lastAdd
         },
         success:function(response){
          alert("what you got back"+JSON.parse(response));
         },
        error: function(xhr, status, error) {
        alert(xhr.responseText);
        }
    });     
  }

  function saveQuestions(){
      var obj = {
        "catagory": catagory,
        "correct": catScores[catagory],
        "wrong":catNum[catagory]-catScores[catagory],
        "hintsUsed": hintsUsed[catagory], 
        "catNum":catNum[catagory]
      };

    dbParam = JSON.stringify(obj);
    xmlhttp = new XMLHttpRequest();
    var text = "";
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        text= this.responseText;
        
    }
};
xmlhttp.open("POST","saveResults.php", false);
xmlhttp.send(dbParam);//is it not sending?*/

  }

  function createQuestionElement(array/*, cat, index*/) {
    var qElement = $('<div>', {
      id: 'question'
    });
    
    var header = $('<h3>Question ' + (questionCounter) + ':</h2>');
    qElement.append(header);
    
    var question = $('<h4 style = "padding-bottom:10px;">').append(array/*[cat][index]*/.question);
    qElement.append(question);
    
    var radioButtons = createRadios(array/*, cat, index*/);
    qElement.append(radioButtons);
    
    return qElement;
  }
  
  // Creates a list of the answer choices as radio inputs
  function createRadios(array/*, catagory, index*/) {
    var radioList = $('<ul>');
    var item;
    var input = '';
    for (var i = 0; i < array/*[catagory][index]*/.choices.length; i++) {
      item = $('<h5> ');
      input = '<input type="radio" name="answer" value= ' + (i+1) + ' />';
      input += '   '+array/*[catagory][index]*/.choices[i];
      item.append(input);
      radioList.append(item);
    }
    return radioList;
  }
  
  // Reads the user selection and pushes the value to an array
  function choose() {
    selections[questionCounter-1] = +$('input[name="answer"]:checked').val();
  }

  /*
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
}*/


  function displayHint(array/*, catagory, index*/){
  var hint = $('<div>', {      id: 'hint'    });    
  hint.append(array[questionCounter-1].hint);
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
xmlhttp.open("GET", "getVideo.php?x="+dbParam, false);
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
    //for (i = catNum[catagory]; i<nextAdd; i++){
      if (questions.length<questionCounter){
      questions.push(loadQuestions());
    }
      if(questions.length>questionQueue.length){
        for (var i = questionQueue.length; i < questions.length; i++){
      nextQuestion = createQuestionElement(questions[i]);
      questionQueue.push(nextQuestion);
    }
    }
    //}

  }

  function displayQues() {
    $('#right').fadeOut();
    $('#wrong').fadeOut();
    if(nextAdd>0){
    //var lastprogress = progress;
    //if (hasAdded === 0){
      loadQueue();
      //hasAdded = 1;
    //}
    //progress = 100/(questionQueue.length*(questionCounter+1));
    //progressMove(lastprogress, progress);
   // quiz.hide(function() {

      $('#question').remove();
      if (hintDisplayed == true){            
          $('#hintBox').remove();
          $('#hint').remove();    
          hintDisplayed = false;  
        }
      //if(questionCounter < questions.length){
        //var nextQuestion = createQuestionElement(questionCounter);
        
           //displayVid();
          quiz.append(questionQueue[selections.length]).show();
         
        if (!(isNaN(selections[selections.length]))) {//so if selections[questionCounter] is null it doesn't move
          $('input[value='+selections[selections.length]+']').prop('checked', true);
        }
        
        // Controls display of 'prev' button--should I keep it? is it even relevant?
      
          
          $('#prev').hide();
          setSessions();
          setTimeout('$("#next").removeAttr("disabled")', 500);
          $('#next').show();

      }
      else{
        if (group == 0){
        calcScore();
      }
      else{
        calcScoreAlt();
      }
      listCat.empty();
        loadSidebar();
      setSessions();
      setTimeout('$("#next").removeAttr("disabled")', 500);
      $('#next').show();
      }
    //});
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
    //$('#instrucVid').hide();
    var numWrong = 0;
    var numCorrect = 0;
    var catTotal = parseInt(catInfo(catagory).numQues);//change catInfo to return more info for the boxes
    var sum = selections.length-lastAdd;
    hintsUsed[catagory] += currHintsUsed;
      for (var i = sum; i < selections.length; i++) {
      if (selections[i] === parseInt(questions[i].correctAnswer)) {
        numCorrect++;
      }
      else{
        numWrong++;
      }
    }
    //catNum[catagory]+=(numWrong+numCorrect);
    catScores[catagory]+=(numCorrect);
    var scoreRatio;
    if (numWrong ==0 && currHintsUsed==0)
    {
      scoreRatio = 0;
    }
    else{
      scoreRatio = (numWrong+0.5*currHintsUsed)/(lastAdd);
    }
    nextAdd = Math.round(scoreRatio*(catNum[catagory]));
    lastAdd= nextAdd;
    currHintsUsed=0;
    if (((catNum[catagory]+nextAdd)>catTotal||nextAdd==0)&&catagory===maxCatagories){
    $('#instrucVid').hide();//final percentage and display
      var sum2 = 0;
      for (var s = 1; s<=catagory; s++){
        sum2 +=catScores[s];
      }
      percentage = sum2/selections.length;
        final.append('Overall score is: '+percentage*100+'. If you are ready to log out, please press finish.');
        questionCounter = 0;
      //percentage = ((catScores[0]-hintsUsed[catagory]*.5)+catScores[1])/selections.length;
        setSessions();
        final.show();
        saveQuestions();
        listCat.empty();
        loadSidebar();
        $('#hint').remove();
        $('#next').remove();
        $('#quiz').remove();
       $('#finish').show();
    }
    else if (nextAdd == 0 || ((catNum[catagory]+nextAdd)>catTotal)){
      $('#instrucVid').hide();
      saveQuestions();
      catagory++;
      nextAdd = initial;
      lastAdd = initial;
      hintsUsed[catagory]=0;
      catNum[catagory] = 0;
      catScores[catagory] = 0;
      setSessions();
      displayVid();
      displayQues();
    }
    else{
    displayQues();
  }
  //$('#next').show();
    $('#prev').hide();
    $('#hint').show();
}


function calcScoreAlt(){
  var score = $('#final');
    $('#next').hide();
    $('#prev').hide();
    $('#hint').hide();
    var numWrong = 0;
    var numCorrect = 0;
    var catTotal = parseInt(catInfo(catagory).numQues);
    var sum = selections.length-lastAdd;
    hintsUsed[catagory] += currHintsUsed;
      for (var i = sum; i < selections.length; i++) {
      if (selections[i]=== parseInt(questions[i].correctAnswer)) {
        numCorrect++;
      }
      else{
        numWrong++;
      }
    }
    //catNum[catagory]+=(numWrong+numCorrect);
    catScores[catagory]+=(numCorrect);
    var scoreRatio;
    /*if (numWrong ==0 && currHintsUsed==0)
    {
      scoreRatio = 0;
    }
    else{
      scoreRatio = (lastAdd)/(numWrong+0.5*currHintsUsed);
    }*/
    //Display Continue option

    nextAdd = initial;
    if (catTotal-(catNum[catagory]+nextAdd)<0){
      nextAdd = catTotal-catNum[catagory];
    }
    lastAdd= nextAdd;
    currHintsUsed=0;
    if (nextAdd==0&&catagory===maxCatagories){
    $('#instrucVid').hide();//final percentage and display
      var sum2 = 0;
      for (var s = 1; s<=catagory; s++){
        sum2 +=catScores[s];
      }
      percentage = sum2/selections.length;
        final.append('Overall score is: '+percentage*100+'. If you are ready to log out, please press finish.');
        questionCounter = 0;
      //percentage = ((catScores[0]-hintsUsed[catagory]*.5)+catScores[1])/selections.length;
        
        final.show();
        saveQuestions();
        listCat.empty();
        loadSidebar();
        $('#next').hide();
        $('#hint').hide();
        $('#quiz').remove();
       $('#finish').show();
    }
    else if (nextAdd== 0){//fix it so it just adds rest?
      //show alert for next catagory
      $('#instrucVid').hide();
      saveQuestions();
      catagory++;
      nextAdd = initial;
      lastAdd = initial;
      hintsUsed[catagory]=0;
      catNum[catagory] = 0;
      catScores[catagory] = 0;
      displayVid();
      displayQues();
    }
    else{
    if (confirm("You have finished this section. However, there are more questions available to you in this catagory. Would you like to try them? Press OK to add more questions, press cancel to continue to the next catagory.")) {
      $('#next').show();
      $('#hint').show();
      displayQues();
        
    } 
    else if (catagory===maxCatagories){
    $('#instrucVid').hide();//final percentage and display
      var sum2 = 0;
      for (var s = 1; s<=catagory; s++){
        sum2 +=catScores[s];
      }
      percentage = sum2/selections.length;
        final.append('Overall score is: '+percentage*100+'. If you are ready to log out, please press finish.');
        questionCounter = 0;
      //percentage = ((catScores[0]-hintsUsed[catagory]*.5)+catScores[1])/selections.length;
        
        final.show();
        saveQuestions();
        $('#next').hide();
        $('#hint').hide();
        $('#quiz').remove();
       $('#finish').show();
    }

    else {
      saveQuestions();
      catagory++;
      nextAdd = initial;
      lastAdd = initial;
      hintsUsed[catagory]=0;
      catNum[catagory] = 0;
      catScores[catagory] = 0;
      $('#hint').show();
      displayVid();
      displayQues();
        
    }
    //document.getElementById("demo").innerHTML = txt;
}
  //$('#next').show();
    //$('#prev').hide();
    //$('#hint').show();
  
}

}
)();
</script>

		<!--<script type='text/javascript' src='prototype.js'></script>-->
</body>
    </html>



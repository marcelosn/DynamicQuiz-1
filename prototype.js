(function() {
  var questions = [[{
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
  }]];
  var extraQuestions = [[{
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
  }]];
  var questionCounter = 0;//question number
  var hasAdded = 0;
  var catagory = 0;//array number
  var maxCatagories = 2;
  var selections = []; //Array containing user choices
  var quiz = $('#quiz'); //Quiz div object
  var questionQueue = [];//Quis Ques up to displ(ay
    var catNum = [];
    var catScores = [];
    var hintBox = $('#hintBox');//hint box div object
    var final = $('#final');
    var hintsUsed = 0;
    var hintDisplayed = false;
    for(i = 0; i<questions.length; i++){
      catScores[i] = 0;
      catNum[i] = 0;
    }
  
    // Display initial question
    $('#instrucVid').hide();
    $('#hintBox').hide();
    final.hide();
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
    questionCounter--;
    displayQues();
  };

  $('#hint').on('click', function (e){ 
//how to do hint boolean? global variable
  if (hintDisplayed ===true)
  {
    alert("Hint is already given!")
  }
  else{
  hintDisplayed = true;
  hintsUsed++;
  displayHint(questions, catagory, questionCounter-(catagory*questions[catagory].length));//check that this is write when ques are added
}}); 
  
  // Click handler for the 'Start Over' button
  $('#start').onclick = function() {
    //e.preventDefault();
    
    /*if(quiz.is(':animated')) {
      return false;
    }*/
    //questionCounter = 0;
    //selections = [];
    questionQueue = [];
    selections = [];
    var nextQuestion;
    for (var i = 0; i <questions[catagory].length; i++){
      nextQuestion = createQuestionElement(questions[catagory][i]);
      questionQueue.push(nextQuestion);
    }
    displayQues();
    $('#start').hide();
  };

  
  // Creates and returns the div that contains the questions and 
  // the answer selections
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
     var video = "https://www.youtube.com/embed/Fe8u2I3vmHU";
     $('#instrucVid').attr("src", video);
     $('#instrucVid').show(); 
  }
  
  // Displays next requested element
  function displayQues() {
    if (questionCounter === 0){
       var nextQuestion;
       var toAdd = questions[catagory].length;
    for (i = 0; i<questions[catagory].length; i++){
      nextQuestion = createQuestionElement(questions, catagory, i);
      questionQueue.push(nextQuestion);
    }
    }
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
        
        // Controls display of 'prev' button
        if(questionCounter >= 1){
          $('#prev').show();
        } else if(questionCounter === 0){
          
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

  // Computes score and returns a paragraph element to be displayed
  //make more flexible so it can have more than 2 catagories
  function calcScore() {
    var score = $('#final');
    $('#next').hide();
    $('#prev').hide();
    $('#hint').hide();
    $('#instrucVid').hide();
    var percentage;
    if(questionCounter>=questionQueue.length&&catagory===(maxCatagories-1)&&hasAdded===1){//end of questions
      var index = 0;
      var numCorrect = 0;
      var numWrong = 0;
      var sum = 0;
      for (var s = 0; s< maxCatagories; s++){
      	sum +=catNum[s];
      }
        for (var i = sum; i < selections.length; i++) {
      if (selections[i] === extraQuestions[catagory][index].correctAnswer) {
        numCorrect++;
        index++;
      }
      else{
        numWrong++;
        index++;
      }
    }
      catScores[catagory]+=numCorrect - hintsUsed*.5;
      catNum[catagory] = numWrong+numCorrect;
      percentage = (catScores[0]+catScores[1])/selections.length;
      final.append('Your final score is: '+percentage*100);
      questionCounter = 0;
      final.show();
      return score;
    }
    else if (questionCounter>=questionQueue.length&&hasAdded===1&&catagory<(maxCatagories-1)){//1 catagory is done
      var index = 0;
      var numCorrect = 0;
      var numWrong = 0;
      var sum = 0;
      for (var s = 0; s< maxCatagories; s++){
      	sum +=catNum[s];
      }
        for (var i = sum; i < selections.length; i++) {
      if (selections[i] === extraQuestions[catagory][index].correctAnswer) {
        numCorrect++;
        index++;
      }
      else{
        numWrong++;
        index++;
      }
    }
      catScores[catagory]+=numCorrect-hintsUsed*.5;
      catagory++;
      catNum[catagory] = numWrong+numCorrect;
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
      if (selections[i] === questions[catagory][index].correctAnswer) {
        numCorrect++;
        index++;
      }
      else{
        numWrong++;
        index++;
      }
    }
    catNum[catagory] = numWrong+numCorrect;
    var finalScore = numCorrect-(hintsUsed*.5);
    var scoreRatio = Math.round(numWrong+(hintsUsed*.5)/numCorrect);
    catScores[catagory] +=finalScore;
    if (scoreRatio ===0&&catagory<maxCatagories-1){
      catagory++;
      hasAdded = 0;
      var temp;
      for (var i = 0; i<questions[catagory].length; i++){
      temp = createQuestionElement(questions, catagory, i)
      questionQueue.push(temp);
      
    }
     $('#next').show();
     $('#hint').show();
     hintsUsed = 0;
    displayQues();
    }
     else if (scoreRatio ===0&&catagory===maxCatagories){//end
     	var sumScores = 0;
     for (var s = 0; s< maxCatagories; s++){
      	sumScores +=catScores[s];
      }
      percentage = sumScores/selections.length;
      final.append('Final score is: '+percentage*100);
      questionCounter = 0;
      $('#start').show();
      final.show();
      return score;
    }
    else{//add from extraQuestions
    var temp;
    for (var i = 0; i<scoreRatio; i++){
      temp = createQuestionElement(extraQuestions, catagory, i)
      questionQueue.push(temp);
    }
    hasAdded=1;
     $('#next').show();
     $('#hint').show();
     hintsUsed = 0;
    displayQues();
  }
  }
}
})();
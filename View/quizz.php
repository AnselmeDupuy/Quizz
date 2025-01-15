
  <form method="post" id="quizz-form">
    <div class="row mb-3">
      <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Quizz Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="quizz-name" placeholder="">
      </div>
      <div class="btn-group" role="group" style="width: 2em;">
        <button type="button" class="btn btn-primary dropdown-toggle" id="question-number-btn" data-bs-toggle="dropdown" aria-expanded="false">
          nombres de questions
        </button>
        <ul class="dropdown-menu" id="number-question-dropdown">
        
        </ul>
      </div>
    </div>


    
    <div  id="question-form">

    </div>


    <button type="submit" class="btn btn-primary" name="quizz_button" id="create-quizz-btn">Submit</button>
  </form>




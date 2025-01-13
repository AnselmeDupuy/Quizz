
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


  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const quizzForm = document.querySelector('#quizz-form')
      const questionNbBtn = document.querySelector('#question-number-btn')
      const quizzBtn = document.querySelector('#create-quizz-btn')
      const dropdownQuestion = documennt.querySelector("#number-question-dropdown")


      dropdownQuestion.addEventListener('click', () => {
        for (let i = 0; i < 10; i++) {
          dropdownQuestion.
        }
        <li><a class="dropdown-item" href="?nombreQuestion=x">Dropdown link</a></li>
      })

      questionNbBtn.addEventListener('click', async () => {

      })



  })

  </script>

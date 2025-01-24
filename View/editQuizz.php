    <form method="post" id="quizz-edit-form">
    <div class="row mb-3">
        <label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Quizz Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control form-control-lg" id="quizz-name" placeholder="">
        </div>

        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="spinner-border text-primary d-none" role="status" id="spinner">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>



        <table class="table" id="list-quizz">
            <tbody>

            </tbody>
        </table>



        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center" id="pagination">

                </ul>
            </nav>
        </div>


        <div class="btn-group" role="group" style="width: 2em;">
            <button type="button" class="btn btn-primary" id="edit-submit-button">
            Submit
            </button>
        </div>
    </div>






    <ul class="list-group">
        <li class="list-group-item" role="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">${quizzes.id} ${quizzes.title} ${quizzes.user_id} ${quizzes.published === 1 ? 'published' : 'not published'} <i class="fa-solid fa-chevron-down"></i><i class="fa-solid fa-chevron-right d-none"></i> </li> 
    </ul>
    <div class="row">
    <div class="row">
        <div class="collapse multi-collapse" id="multiCollapseExample1">
        <div class="card card-body">
            Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
        </div>
    </div>
    <div class="row">
        <div class="collapse multi-collapse" id="multiCollapseExample2">
        <div class="card card-body">
            Some placeholder content for the second collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
        </div>
    </div>
    </div>


    <div class="row">
        <div class="collapse multi-collapse-${quizzes.id}" id="multiCollapseExample1">
        <div class="card card-body">
            Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
        </div>
    </div>
    <div class="row">
        <div class="collapse multi-collapse-${quizzes.id}" id="multiCollapseExample2">
        <div class="card card-body">
            Some placeholder content for the second collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
        </div>
        </div>
    </div>





    
    <script src='javaScript/component/editQuizz.js' type="module"></script>
    <script src="javaScript/services/editQuizz.js" type="module"></script>
    <script type="module">
        import {refreshList} from "./javaScript/component/editQuizz.js"

    document.addEventListener('DOMContentLoaded', async () => {
        const previousLink = document.querySelector('#previous-link')
        const nextLink = document.querySelector('#next-link')

        await refreshList()
    })
</script>
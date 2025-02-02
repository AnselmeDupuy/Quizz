    <form method="post" id="quizz-edit-form">
    <div class="row mb-3">
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

        <button type="button" style="    
            position: fixed;
            bottom: 40px;
            left: 40px;
            width: 200px;
            z-index: 1000;" 
        class="btn btn-primary" id="edit-submit-button">
                Enregistrer
        </button>

        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center" id="pagination">

                </ul>
            </nav>
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






import {getQuizz, getQuestion, getAnswers} from '../services/editQuizz.js'

export const refreshList = async (page = 1) => {
    const spinner = document.querySelector('#spinner')
    const listElement = document.querySelector('#list-quizz')

    spinner.classList.remove('d-none')

    const data = await getQuizz(page)

    const total = data.count?.total || 0

    const listContent = data.results.map((quizz) => `
    <ul class="list-group">
        <li class="list-group-item quizz-list" role="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse-${quizz.id}" data-editQuizz-id="${quizz.id}"
         aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">${quizz.id} ${quizz.title} ${quizz.user_id} ${quizz.published === 1 ? 'published' : 'not published'} 
         <i class="fa-solid fa-chevron-down"></i><i class="fa-solid fa-chevron-right d-none"></i> </li> 
    </ul>
    <div class="row">
        <div class="row">
        <div class="collapse multi-collapse-${quizz.id}" id="collapse-container-${quizz.id}">
            <div class="card card-body">
                <p class="multi-collapse${quizz.id}">TEST</p>
            </div>
        </div>
        </div>
    </div>
    `)

    listElement.querySelector('tbody').innerHTML = listContent.join('')

    document.querySelector('#pagination').innerHTML = getPagination(total)

    handlePaginationNavigation(page, Math.ceil(total / 5))

    spinner.classList.add('d-none')
}

const getPagination = (total) => {
    const countPages =  Math.ceil(total / 5)
    let paginationButton = []
        paginationButton.push(` <li class="page-item"><a class="page-link" href="#" id="previous-link">Précédent</a></li>`)

    for (let i = 1; i <= countPages; i++){
        paginationButton.push(`<li class="page-item"><a data-page="${i}" class="page-link pagination-btn" href="#">${i}</a></li>`)
    }

    paginationButton.push(` <li class="page-item"><a class="page-link" href="#" id="next-link">Suivant</a></li>`)

    return paginationButton.join('')
}

const handlePaginationNavigation = (page, countPages) => {
    const previousLink = document.querySelector('#previous-link')
    const nextLink = document.querySelector('#next-link')
    const paginationBtns = document.querySelectorAll('.pagination-btn')

    previousLink.addEventListener('click', async () => {
        if (page > 1 ){
            page--
            await refreshList(page)
        }
    })

    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshList(pageNumber)
        })
    }

    const quizzList = document.querySelectorAll('.quizz-list')
    for (let i = 0; i < quizzList.length; i++){
        quizzList[i].addEventListener('click', async (e) => {
            const quizzId = e.target.getAttribute('data-editQuizz-id')
            const questions = await getQuestion(quizzId)

            console.log(quizzId)
            console.log(questions)

            const container = document.getElementById(`collapse-container-${quizzId}`)

            container.innerHTML = ''

            try {
                for (let i = 0; i < questions.quizzId.length; i++) {
                    const answers = await getAnswers(questions.id)
                    console.log(questions.quizzId[i].id, questions.quizzId[i].question)

                    const question = document.createElement('div')
                    question.classList.add('row')
                    question.innerHTML = `
                        <div class="card card-body">
                            <p class="multi-collapse${quizzId}">${questions.quizzId[i].id}</p>
                        </div>
                    `
                    container.appendChild(question)
                }
            } catch (error) {
                console.error('Error fetching answers:', error)
            }
        })
    }

    nextLink.addEventListener('click', async () => {
        if (page < countPages){
            page++
            await refreshList(page)
        }
    })
}



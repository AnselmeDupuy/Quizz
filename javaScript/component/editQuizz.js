
import {getQuizz, getQuestion, getAnswers} from '../services/editQuizz.js'

export const refreshList = async (page = 1) => {
    const spinner = document.querySelector('#spinner')
    const listElement = document.querySelector('#list-quizz')

    spinner.classList.remove('d-none')

    const data = await getQuizz(page)

    const total = data.count?.total || 0

    const listContent = data.results.map((quizz) => `
    <ul class="list-group">
        <li class="list-group-item quizz-list" style="height: 4em; display: flex; align-items: center; border-radius: 15px;" role="button" data-bs-toggle="collapse" data-bs-target=".multi-collapse-${quizz.id}" data-editQuizz-id="${quizz.id}" 
         aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Quizz Title: <input value="${quizz.title}" style="border:none; width: 80%; margin-left: 1em; margin-right: 1em;"></input> <i class="fa-solid fa-chevron-down fa-lg"></i><i class="fa-solid fa-chevron-right fa-lg d-none"></i></li>
    </ul>
    <div class="row">
        <div class="row">
        <div class="collapse multi-collapse-${quizz.id}" id="collapse-container-${quizz.id}">

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

    try {

    for (let i = 0; i < quizzList.length; i++){
        quizzList[i].addEventListener('click', async (e) => {

            const quizzId = e.target.getAttribute('data-editQuizz-id')
            const questions = await getQuestion(quizzId)
            const container = document.getElementById(`collapse-container-${quizzId}`)

            container.innerHTML = ``

            for (let y = 0; y < questions.quizzId[0].length; y++){
                const questionContainer = document.createElement('div')
                questionContainer.classList.add('row')
                const  questionsData = questions.quizzId[0][y]

                questionContainer.innerHTML = ``

                questionContainer.innerHTML = `
                <div>
                <span style="margin-bottom: 1em; margin-top: 1em; color:blue; margin-left: 2em;" class="input-group-text multi-collapse-${quizzId}">Question: <input style="margin-left: 2em; width: 80%; border: none;" value="${questionsData.question}"></input></span>
                </div>
                <div id="answer-container-${questionsData.id}">
                </div>
                `
                container.appendChild(questionContainer)
            

                const answers = await getAnswers(questionsData.id)

                for (let j = 0; j < answers['question-id'][0].length; j++) {
                    const answer = answers['question-id'][0][j]

                    const answerContainer = document.createElement('div')
                    answerContainer.classList.add('row')
                    answerContainer.innerHTML = ``
                    answerContainer.innerHTML = `
                        <div style="margin: 0.3em; margin-left: 4em; background-color:#F8F8F8;" class="card card-body draggable" draggable="true" style="margin-left: 2em">
                            <div>
                                <span style="border:none;" class="input-group-text">Answer: <input type="text" style="width: 100%; margin-left: 0.5em;" value="${answer.text}"></input></span>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="correct-answer-${answer.id}" ${answer.correct === 1 ? 'checked' : ' '}>
                                <label class="form-check-label" for="flexSwitchCheckDefault">Correct</label>
                            </div>
                        </div>
                    `
                    document.getElementById(`answer-container-${questionsData.id}`).appendChild(answerContainer)
                }
            }
        })
    }
    } catch (error) {
        console.error('Error fetching answers:', error)
    }

    nextLink.addEventListener('click', async () => {
        if (page < countPages){
            page++
            await refreshList(page)
        }
    })
}




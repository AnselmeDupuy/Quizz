import {getQuizz} from '../services/editQuizz.js'

export const refreshList = async (page = 1) => {
    const spinner = document.querySelector('#spinner')
    const listElement = document.querySelector('#list-quizz')

    spinner.classList.remove('d-none')

    const data = await getQuizz(page)

    const quizzes = data.results[0];
    const total = data.results[1]?.total || 0;

    const listContent = data.results.map((quizzes) => `
                            <ul class="list-group">
                                <li class="list-group-item">${quizzes.id} ${quizzes.title} ${quizzes.user_id} ${quizzes.published === 1 ? 'published' : 'not published'}</li>
                            </ul>
    `)
    

    listElement.querySelector('tbody').innerHTML = listContent.join('')

    document.querySelector('#pagination').innerHTML = getPagination(total)

    handlePaginationNavigation(page)

    spinner.classList.add('d-none')
}

const getPagination = (total) => {
    const countPages =  Math.ceil(total / 20)
    let paginationButton = []
        paginationButton.push(` <li class="page-item"><a class="page-link" href="#" id="previous-link">Précédent</a></li>`)

    for (let i = 1; i <= countPages; i++){
        paginationButton.push(`<li class="page-item"><a data-page="${i}" class="page-link pagination-btn" href="#">${i}</a></li>`)
    }

    paginationButton.push(` <li class="page-item"><a class="page-link" href="#" id="next-link">Suivant</a></li>`)

    return paginationButton.join('')
}

const handlePaginationNavigation = (page) => {
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

    nextLink.addEventListener('click', async () => {
        page++
        await refreshList(page)
    })
}

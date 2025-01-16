import {countPage, getQuizz} from "../services/editQuizz.js";

const getUser = (user) => {
    const line = document.createElement('tr')
    line.innerHTML = `
    <td>${user.id}</td>
    <td>${user.usernamme}</td>
    <td>${user.group_id}</td>
    <td>${user.enabled}</td>

    <td><a href="index.php?component=user&action=edit&id=${user.id}"><i class="fa-solid fa-pen-to-square text-primary ms-2"></i></a></td>
    `
    return line
}

export const refreshPageusers = async (page) => {
    const spinner = document.querySelector('#spinner')
    const tableElement = document.querySelector('#liste-user')
    const tbody = tableElement.querySelector('tbody')

    spinner.classList.remove('d-none')

    const data = await getusers(page)
    tbody.innerHTML = ''
    for (let i = 0; i < data.results.length; i++) {
        tbody.appendChild(getRowuser(data.results[i]))
    }
    getPagination(data.count.nbusers, page)
    spinner.classList.add('d-none')
}

const getPagination = (total, page) => {
    const nbPage = countPage(total)
    const paginationElement = document.querySelector('#pagination')
    paginationElement.innerHTML = ''
    paginationElement.innerHTML += '<li class="page-item"><a class="page-link" href="#" id="prev-link">Previous</a></li>'

    for(let i = 0; i < nbPage; i++) {
        const PagNbElement = `<li class="page-item"><a class="page-link nb-page-link" href="#" data-page="${i+1}">${i+1}</a></li>`
        paginationElement.innerHTML += PagNbElement
    }
    paginationElement.innerHTML += '<li class="page-item"><a class="page-link" href="#" id="next-link">Next</a></li>'
    handlePaginationClick(page)
}

const handlePaginationClick = (curentPage) => {
    const nextLink = document.querySelector('#next-link')
    const previousLink = document.querySelector('#prev-link')
    const nbPageLink = document.querySelectorAll('.nb-page-link')

    previousLink.addEventListener('click', async () => {
        if(curentPage > 1) {
            curentPage--
            await refreshPageusers(curentPage)
        }
    })
    nextLink.addEventListener('click', async () => {
        curentPage++
        await refreshPageusers(curentPage)
    })

    nbPageLink.forEach(btn => {
        btn.addEventListener('click', async (e) => {
            await refreshPageusers(e.target.getAttribute("data-page"))
        })
    })
}
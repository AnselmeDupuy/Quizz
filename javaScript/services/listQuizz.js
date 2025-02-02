export const getQuizz = async (currentPage = 1) => {
    const response = await fetch(`index.php?component=listQuizz&page=${currentPage}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
    }

    return await response.json()
}

export const getQuestion = async (quizzId) => {
    const response = await fetch(`index.php?component=listQuizz&object=question&quizz-id=${quizzId}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
    }

    return await response.json()


}

export const getAnswers = async (questionId) => {
    const response = await fetch(`index.php?component=listQuizz&object=answer&question-id=${questionId}`, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
    }

    return await response.json()
}


export const updateQuizz = async (form, quizzId, title, published) => {
    const data = new FormData(form)

    const response = await fetch(`index.php?component=listQuizz&action=updateQuizz`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: data
    })

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
    }

    return await response.json()
}

export const updateQuestion = async (form, questionId, question, multi) => {
    const data = new FormData(form)
    const response = await fetch(`index.php?component=listQuizz&action=updateQuestion`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: data
    })

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
    }

    return await response.json()
}

export const updateAnswer = async (form, answerId, text, correct, points) => {
    const data = new FormData(form)
    const response = await fetch(`index.php?component=listQuizz&action=updateAnswer`, {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: data
    })

    if (!response.ok) {
        throw new Error(`HTTP error! status: ${response.status}`)
    }

    return await response.json()
}
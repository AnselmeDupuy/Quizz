export const getQuizz = async (currentPage = 1) => {
    const response = await fetch(`index.php?component=editQuizz&page=${currentPage}`, {
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
    const response = await fetch(`index.php?component=editQuizz&object=question&quizz-id=${quizzId}`, {
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
    const response = await fetch(`index.php?component=editQuizz&object=answer&question-id=${questionId}`, {
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

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

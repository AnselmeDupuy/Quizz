export const getQuizz = async () => {
    const res = await fetch(`index.php?component=editQuizz`, {
        method: 'GET',
        headers: {
            'X-Requested-Width': 'XMLHttpRequest'
        }
    })
    return await res.json()
}
const getQuizz = (quizz) => {
    const line = document.createElement('tr')
    line.innerHTML = `
    <td>${quizz.id}</td>
    <td>${quizz.quizzname}</td>
    <td>${quizz.group_id}</td>
    <td>${quizz.enabled}</td>
    `
    return line
}
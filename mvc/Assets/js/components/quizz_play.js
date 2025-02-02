import { getPlayQuizz } from "../services/play_quizz.js"

export const contentQuizz = async (id) => {
    try {
        const data = await getPlayQuizz(id)

        const tabList = document.getElementById("myTab")
        const tabContent = document.getElementById("myTabContent")

        tabList.innerHTML = ""
        tabContent.innerHTML = ""

        let i = 0
        while (i <= data.length) {
            
            const tabItem = document.createElement("li")
            const questionContent = document.createElement("div")

            tabItem.classList.add("nav-item")
            tabItem.setAttribute("role", "presentation")


            if (i === data.length){
                tabItem.innerHTML = `
                    <button
                        class="nav-link disabled ${i === 0 ? "active" : ""}"
                        id="results-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#results-content"
                        type="button" role="tab"
                        aria-controls="results-content"
                        aria-selected="false"
                        disabled
                    >
                    Résultats
                    </button>
                `
                tabList.appendChild(tabItem)
                questionContent.classList.add("tab-pane", "fade")
                
                questionContent.setAttribute("id", `results-content`)
                questionContent.setAttribute("role", "tabpanel")
                questionContent.setAttribute("aria-labelledby", `results`)
                questionContent.innerHTML = `
                    
                    <div style="width: 50%; margin: auto; text-align: center;">
                        <canvas id="my-chart" width="400" height="400"></canvas>
                    </div>
                `
                tabContent.appendChild(questionContent)


            } else {
                tabItem.innerHTML = `
                    <button
                        class="nav-link disabled ${i === 0 ? "active" : ""}"
                        id="question-${i + 1}"
                        data-bs-toggle="tab"
                        data-bs-target="#question-${i + 1}-content"
                        type="button" 
                        role="tab"
                        aria-controls="question-${i + 1}-content"
                        aria-selected="${i === 0}"
                    >
                    Question ${i + 1}
                    </button>
                `
                tabList.appendChild(tabItem)
                

                questionContent.classList.add("tab-pane", "fade")
                if (i === 0) {
                    questionContent.classList.add("show", "active")
                }
                questionContent.setAttribute("id", `question-${i + 1}-content`)
                questionContent.setAttribute("role", "tabpanel")
                questionContent.setAttribute("aria-labelledby", `question-${i + 1}-tab`)

                if(data[i]['type'] === 0){
                    questionContent.innerHTML = `
                        <form id="form-question-${i + 1}">
                            <div class="mb-3">
                                <label>${data[i]['title']}</label>
                                
                                ${data[i]['responses']
                                    .map(
                                        (response, j) => `
                                    <div class="form-check">
                                        <input class="form-check-input response" type="radio" name="question-${i+1}" 
                                            id="question-${i+1}-answer-${j}" value="${response['id']}">
                                        <label class="form-check-label" for="question-${i+1}-answer-${j}">
                                            ${response['title']}
                                        </label>
                                    </div>
                                `
                                    )
                                    .join("")}
                            </div>
                                
                            </div>
                        </form>
                    `
                } else {
                    questionContent.innerHTML = `
                        <form id="form-question-${i + 1}">
                            <div class="mb-3">
                                <label>${data[i]['title']}</label>
                                
                                ${data[i]['responses']
                                    .map(
                                        (response, j) => `
                                    <div class="form-check">
                                        <input class="form-check-input response" type="checkbox" value="${response['id']}" id="question-${i+1}-answer-${j}" name="question-${i+1}">
                                        <label class="form-check-label" for="question-${i+1}-answer-${j}">
                                            ${response['title']}
                                        </label>
                                    </div>
                                `
                                    )
                                    .join("")}
                            </div>
                                
                            </div>
                        </form>
                    `
                }
                tabContent.appendChild(questionContent)
            }
            i++

        }

    } catch (error) {
        console.error("Erreur dans contentQuizz :", error)
    }
}


export const doingQuizz = async (id) => {
    const nextBtn = document.querySelector('#next-btn')
    const previousBtn = document.querySelector('#previous-btn')
    
    const btn = document.querySelectorAll('.nav-link')
    const content = document.querySelectorAll('.tab-pane')

    const progressElement = document.querySelector('#progress')
    const progressBarElement = document.querySelector('#progress-bar')

    const resultsTab = document.querySelector('#results-tab')
    const userResponses = []
    let correctCount = 0
    let incorrectCount = 0
    let totalPoints = 0
    let userPoints = 0

    const data = await getPlayQuizz(id)

    let activeQuestion = 0
    let activePourcentageQuestion = 0
    const pourcentagePerQuestion = 100 / data.length

    previousBtn.addEventListener('click', () => {
        changeQuestion('previous')
        
        activePourcentageQuestion = activePourcentageQuestion - pourcentagePerQuestion
        updateProgressBar(activePourcentageQuestion)

        userResponses.splice(activeQuestion,1)
    })

    nextBtn.addEventListener('click', () => {

        const form = document.querySelector(`#form-question-${activeQuestion + 1 }`)
        const btnsRadio = form.querySelectorAll('.response')

        const toastElement = document.getElementById('toast')
  
        const toast = new bootstrap.Toast(toastElement)


        let reponseTrouvee = false
        if (btnsRadio[0].type === 'radio') {
            for (let i = 0; i < btnsRadio.length; i++) {
                if (btnsRadio[i].checked) {
                    const label = document.querySelector(`label[for="${btnsRadio[i].id}"]`)
                    const respeonsePerQuestion = []
                    
                    respeonsePerQuestion.push(label.textContent.trim())  
                    userResponses.push(respeonsePerQuestion)
                
                    reponseTrouvee = true
                    changeQuestion('next')
            
                    activePourcentageQuestion = activePourcentageQuestion + pourcentagePerQuestion
                    updateProgressBar(activePourcentageQuestion)
                    
                    break
                }
            }
        } else if (btnsRadio[0].type === 'checkbox') {
            const checkedCheckboxes = []
            
            for (let i = 0; i < btnsRadio.length; i++) {
                if (btnsRadio[i].checked) {
                    let label = document.querySelector(`label[for="${btnsRadio[i].id}"]`)
                    
                    if (label) {
                        checkedCheckboxes.push(label.textContent.trim())
                    }
                }
            }
        
            if (checkedCheckboxes.length > 0) {
                userResponses.push(checkedCheckboxes)
                reponseTrouvee = true
                changeQuestion('next')
                activePourcentageQuestion += pourcentagePerQuestion
                updateProgressBar(activePourcentageQuestion)
            }
        
        }
        
        
        if (reponseTrouvee == false) {
            toast.show()
            return
        }
      
    })

    const updateProgressBar = (value) => {
        
        progressElement.setAttribute('aria-valuenow', value)
        progressBarElement.style = `width: ${value}%`
        progressBarElement.innerHTML = `${value}%`
    }

    const changeQuestion = (action) => {
        btn[activeQuestion].classList.remove('active')
        btn[activeQuestion].setAttribute('aria-selected', 'false')
        content[activeQuestion].classList.remove('show', 'active')
        btn[activeQuestion].disabled = true

        if (action === 'next') {
            activeQuestion = activeQuestion + 1

        } else {
            activeQuestion = activeQuestion - 1
 
        }
        
        btn[activeQuestion].classList.add('active')
        btn[activeQuestion].setAttribute('aria-selected', 'true')
        content[activeQuestion].classList.add('show', 'active')
        btn[activeQuestion].removeAttribute("disabled")

        previousBtn.disabled = false
        if (activeQuestion === 0) {
            previousBtn.disabled = true

        }

        if (activeQuestion === data.length) {
            previousBtn.disabled = true
            nextBtn.disabled = true
            
            
            for (let i = 0; i < userResponses.length; i++) {
                const userAnswer = userResponses[i]
  
                const questionResponses = data[i].responses
                
                for (let y = 0; y < questionResponses.length; y++) {
                    totalPoints = totalPoints + questionResponses[y].points

                }
                for (let j = 0; j < userAnswer.length; j++) {
                    const userAnswerText = userAnswer[j]

                    const correctResponse = questionResponses.find(response => response.title === userAnswerText)
                    
                    if (correctResponse && correctResponse.statut === 1) {
                        correctCount++
                        userPoints = userPoints + correctResponse.points
                    } else {
                        incorrectCount++
                    } 
                }                
                
            }                
            const ctx = document.getElementById('my-chart')
            const res = document.getElementById('results-content')

            const resContent = document.createElement("div")

            resContent.innerHTML = `
                Vous avez eu ${userPoints} sur ${totalPoints}
                    
                `
            res.appendChild(resContent)
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                labels: ['Bonne réponses', 'Mauvaises Réponses'],
                datasets: [{
                    data: [correctCount, incorrectCount],
                    
                }]
                },
                options: {
                    responsive: true
                    }
            })
        }
    }
}

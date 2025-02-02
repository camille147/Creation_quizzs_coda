export const addQuestion = () => {
    const addButton = document.getElementById("add_button")
    const accordeon = document.getElementById("accordionExample")
    
    let addsQuestion = Array.from(document.querySelectorAll(".add-rep")); // Conversion initiale en tableau
    let question = 2
    
    const attachAddResponseListeners = () => {
        // Attacher des gestionnaires d'événements à chaque bouton "add-rep"
        addsQuestion.forEach((addResponse) => {
            let response = 2; // Compteur pour les réponses
            // Vérifier si le gestionnaire est déjà attaché
            if (!addResponse.dataset.listenerAttached) {
                addResponse.dataset.listenerAttached = "true"; // Éviter les doublons d'attachements

                addResponse.addEventListener("click", (e) => {
                    e.preventDefault();
                    response++;
                    const idCurentQuestion = addResponse.dataset.id; 
                    const currentDivQuestion = document.getElementById(`question_${idCurentQuestion}_reps`)

                    const newDivResponse = document.createElement('div')
                    newDivResponse.id = `question_${idCurentQuestion}_rep_${response}`
                    const divContentResponse = []

                    divContentResponse.push(`

                        <div class="row">
                            <div class="col-2">
                                <div class="mt-4">
                                    <h4>Réponse ${response}</h4>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="mt-4">
                                    <div class="form-check form-switch">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            id="question_${idCurentQuestion}_rep_${response}_statut"
                                            name="question_${idCurentQuestion}_rep_${response}_statut"
                                        >
                                        <label class="form-check-label" for="flexSwitchCheckChecked">Bonne réponse</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="question_${idCurentQuestion}_rep_${response}_title" class="form-label">Réponse ${response} Titre</label>
                                    <input type="text" class="form-control" id="question_${idCurentQuestion}_rep_${response}_title" name="question_${idCurentQuestion}_rep_${response}_title" >                    
                                </div>
                            </div>
                        
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="question_${idCurentQuestion}_rep_${response}_nb_points" class="form-label">Réponse ${response} Nombre de points</label>
                                    <input type="text" class="form-control" id="question_${idCurentQuestion}_rep_${response}_nb_points" name="question_${idCurentQuestion}_rep_${response}_nb_points" >
                                </div>
                            </div>
                        </div>
                
                        `)
                    newDivResponse.innerHTML = divContentResponse
            
                    currentDivQuestion.appendChild(newDivResponse)
                    console.log(`Bouton + cliqué (ID: ${idCurentQuestion}) ${response}`);
                });
            }
        });
    };

    // Appeler la fonction pour attacher les gestionnaires d'événements aux boutons déjà présents
    attachAddResponseListeners()
    addButton.addEventListener('click', () => {
        question = question + 1
        
        const newDiv = document.createElement('div')
        newDiv.classList.add('accordion-item')
       
        const divContent = []

        divContent.push(`
            <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse${question}" aria-expanded="true" aria-controls="collapse${question}">
                            Question ${question} 
                        </button>
                    </h2>
                    <div id="collapse${question}" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <label for="question_${question}_title" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="question_${question}_title" name="question_${question}_title" value="" required>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input
                                            class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            id="question_${question}_published"
                                            name="question_${question}_published"
                                    >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Publié</label>
                                </div>
                            </div>
                            
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_${question}" id="question_${question}_pls_rep" checked>
                                <label class="form-check-label" for="question_${question}_pls_rep">
                                    Plusieurs bonnes réponses
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_${question}" id="question_${question}_seule_rep">
                                <label class="form-check-label" for="question_${question}_seule_rep">
                                    1 seule bonne réponse
                                </label>
                            </div>
                            <div id="question_${question}_reps" data-id="${question}">
                                <div id="question_${question}_rep_1">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="mt-4">
                                                <h4>Réponse 1</h4>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mt-4">
                                                <div class="form-check form-switch">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        role="switch"
                                                        id="question_${question}_rep_1_statut"
                                                        name="question_${question}_rep_1_statut"
                                                    >
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Bonne réponse</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_${question}_rep_1_title" class="form-label">Réponse 1 Titre</label>
                                                <input type="text" class="form-control" id="question_${question}_rep_1_title" name="question_${question}_rep_1_title" >                    
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_${question}_rep_1_nb_points" class="form-label">Réponse 1 Nombre de points</label>
                                                <input type="text" class="form-control" id="question_${question}_rep_1_nb_points" name="question_${question}_rep_1_nb_points">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div id="question_${question}_rep_2">
                                    <div class="row">
                                        <div class="col-2">
                                            <div class="mt-4">
                                                <h4>Réponse 2</h4>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="mt-4">
                                                <div class="form-check form-switch">
                                                    <input
                                                        class="form-check-input"
                                                        type="checkbox"
                                                        role="switch"
                                                        id="question_${question}_rep_2_statut"
                                                        name="question_${question}_rep_2_statut"
                                                    >
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Bonne réponse</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_${question}_rep_2_title" class="form-label">Réponse 2 Titre</label>
                                                <input type="text" class="form-control" id="question_${question}_rep_2_title" name="question_${question}_rep_2_title" >                    
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_${question}_rep_2_nb_points" class="form-label">Réponse 2 Nombre de points</label>
                                                <input type="text" class="form-control" id="question_${question}_rep_2_nb_points" name="question_${question}_rep_2_nb_points" >
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <button type="button" class="btn btn-primary add-rep" id="question_${question}_add_rep" data-id="${question}">+</button>
                        </div>
                    </div>



            `)
           
            newDiv.innerHTML = divContent
            
            accordeon.appendChild(newDiv)
            const newAddRepButton = newDiv.querySelector(".add-rep");
            addsQuestion.push(newAddRepButton); // Ajouter le bouton au tableau
            attachAddResponseListeners(); // Réattacher les gestionnaires d'événements
           
    })

}


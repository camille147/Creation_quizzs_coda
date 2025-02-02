<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Modification de la question n°<?php echo $question['Numero_question'] ?? ''; ?></div>
        
        <form action="" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php  echo $question['title'] ?? ''; ?>" required>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Num de quest</label>
                <input type="text" class="form-control" id="num_quest" name="num_quest" value="<?php  echo $question['Numero_question'] ?? ''; ?>" required>
            </div>
            
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="published"
                            name="published"
                            <?php  echo (!empty($question['published'])) ? 'checked' : null ; ?>
                    >
                    <label class="form-check-label" for="flexSwitchCheckChecked">Question publiée/dépubliée</label>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-check form-switch">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="type"
                            name="type"
                            <?php  echo (!empty($question['type'])) ? 'checked' : null ; ?>
                    >
                    <label class="form-check-label" for="flexSwitchCheckChecked">2 Rep/ plus</label>
                </div>
            </div>
            <button type="button" id="add_response_button"class="btn btn-primary" name="<?php echo $action; ?>_button_question">Add a response</button>


            <div class="mb-3">
                <table class="table" id="list-responses">
                    <thead>
                        <tr>
                            <th scope="col">Intitulé</th>
                            <th scope="col">Bonne reponse ?</th>
                            <th scope="col">Nb de points</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($question['responses'] as $response): ?>
                            <tr>
                                <td>
                                    <div class="mb-3">
                                        <span 
                                            id="response_title_text_<?php echo $response['id']?>"
                                            class="form-label d-inline-block" 
                                            onclick="showInput(<?php echo $response['id']?>)" 
                                            style="cursor: pointer;">
                                            <?php echo $response['title'] ?? ''; ?>
                                        </span>

                                        <input 
                                            type="text" 
                                            class="form-control d-none" 
                                            id="response_title_input_<?php echo $response['id']?>" 
                                            value="<?php echo trim($response['title'] ?? ''); ?>" 
                                            name="response_title_<?php echo $response['id'] ?>" 
                                            onblur="saveText(<?php echo $response['id']?>)" 
                                            required>
                                    </div>
                                </td> 
                                <td>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input
                                                    class="form-check-input statut"
                                                    type="checkbox"
                                                    role="switch"
                                                    id="statut_<?php echo $response['id']?>"
                                                    name="statut_<?php echo $response['id'] ?>"
                                                    <?php echo (!empty($response['statut'])) ? 'checked' : null ; ?>
                                            >
                                            <label class="form-check-label" for="statut_<?php echo $response['id']?>"></label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <label for="points_<?php echo $response['id'] ?>" class="form-label visually-hidden"></label>
                                        <input type="number" class="form-control w-25" id="points_<?php echo $response['id'] ?>" name="points_<?php echo $response['id'] ?>" value="<?php echo $response['points'] ?? 0; ?>" required>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-3 d-flex justify-content-end">
                                        <a href="index.php?component=question_admin&action=delete&id=<?php echo $response['id']; ?>&id_quizz=<?php echo $response['question_id']; ?>" type="button" class="btn btn-outline-danger delete-link">Supprimer</a>
                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
            </div>

            

            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="<?php echo $action; ?>_button">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<style>
  /* Applique une couleur verte au switch */
  .statut:checked {
    background-color: #28a745; /* Couleur verte */
    border-color: #28a745;
  }
</style>
<script>
    const textElement = document.getElementById('response_title_text');
    const inputElement = document.getElementById('response_title_input');

    function showInput(id) {
        var textElement = document.getElementById('response_title_text_' + id);  
        var inputElement = document.getElementById('response_title_input_' + id);  

        textElement.classList.add('d-none');
        inputElement.classList.remove('d-none');

        inputElement.value = textElement.textContent.trim();
        inputElement.focus();
    }

    

    function saveText(id) {
    var textElement = document.getElementById('response_title_text_' + id);
    var inputElement = document.getElementById('response_title_input_' + id);

    textElement.textContent = inputElement.value.trim();

    textElement.classList.remove('d-none');
    inputElement.classList.add('d-none');

    
}
document.querySelector('#add_response_button').addEventListener('click', () => {
    let tableBody = document.querySelector('#list-responses tbody');
    let newRowId = Date.now(); // Utilisation d'un timestamp pour identifier chaque nouvelle réponse

    let newRow = `
        <tr id="row_${newRowId}">
            <td>
                <div class="mb-3">
                    <input 
                        type="text" 
                        class="form-control" 
                        id="response_title_input_${newRowId}" 
                        name="responses_${newRowId}" 
                        required>
                </div>
            </td> 
            <td>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input
                                class="form-check-input statut"
                                type="checkbox"
                                role="switch"
                                id="statut_${newRowId}"
                                name="responses_${newRowId}"
                        >
                        <label class="form-check-label" for="statut_${newRowId}"></label>
                    </div>
                </div>
            </td>
            <td>
                <div class="mb-3">
                    <input type="number" class="form-control w-25" id="points_${newRowId}" name="responses_${newRowId}" value="0" required>
                </div>
            </td>
            <td>
                <div class="mb-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-outline-danger delete-response" data-id="${newRowId}">Supprimer</button>
                </div>
            </td>
        </tr>`;

    tableBody.insertAdjacentHTML('beforeend', newRow);
            
})


</script>
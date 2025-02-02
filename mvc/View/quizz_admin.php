<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Modifier du quizz n°<?php echo $quizz['id'] ?? ''; ?></div>
        <div class="mb-3 d-flex justify-content-first">
            <a href="index.php?component=quizzs_admin" type="button" class="btn btn-primary" >Retour</a>
        </div>
        <form action="" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php  echo $quizz['title'] ?? ''; ?>" required>
            </div>

            
            
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="published"
                            name="published"
                            <?php  echo (!empty($quizz['published'])) ? 'checked' : null ; ?>
                    >
                    <label class="form-check-label" for="flexSwitchCheckChecked">Compte actif</label>
                </div>
            </div>

            <div class="mb-3">
                <table class="table" id="list-quizzs">
                    <thead>
                        <tr>
                            <th scope="col">N° de question</th>
                            <th scope="col">Intitulé</th>
                        </tr>
                    </thead>
                    <tbody>
            <?php foreach ($quizz['questions'] as $question): ?>
                <tr>
                    <td><?php echo $question['Numero_question']; ?></td> 
                    <td><?php echo $question['title']; ?></td>
                    <td>
                        <div class="mb-3 d-flex justify-content-end">
                            <a href="index.php?component=question_admin&action=edit_question&id=<?php echo $question['id']; ?>" type="button" class="btn btn-primary" >Modifier</a>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3 d-flex justify-content-end">
                            <a href="index.php?component=quizz_admin&action=delete&id=<?php echo $question['id']; ?>&quizz_id=<?php echo $quizz['id']; ?>" type="button" class="btn btn-outline-danger delete-link">Supprimer</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <button type="button" id="add_question_button"class="btn btn-primary" name="<?php echo $action; ?>_button_question">Add a question</button>

        </tbody>
                </table>
                
            </div>

            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="<?php echo $action; ?>_button">Enregistrer</button>
            </div>
        </form>
    </div>
</div>



<script type="module">
    
    const confirmDeleteQuizz = () => {
        const isConfirmedDeleteQuizz = window.confirm("Voulez-vous vraiment supprimer ce quizz ?")
        return isConfirmedDeleteQuizz
    }


    document.addEventListener('DOMContentLoaded', async() => {
        document.querySelector('#list-quizzs').addEventListener('click', (e) => {
            if (e.target.classList.contains('delete-link')) {
                e.preventDefault()
    
                if (confirmDeleteQuizz()) {
                    window.location.href = e.target.getAttribute('href')
                }
            }
        })

        document.querySelector('#add_question_button').addEventListener('click', () => {
            
            console.log('add question')
        })


    })
        
</script>
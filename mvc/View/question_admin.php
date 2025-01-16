<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Modifier du quizz n°<?php echo $question['Numero_question'] ?? ''; ?></div>
        
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
                    <td><?php echo $response['title']; ?></td> 
                    <td>
                        <a href="#">
                            <?php echo $response['statut']
                                ? '<i class="fa-solid fa-check text-success enabled-icon" data-id="'.$response['id'].'"></i>'
                                : '<i class="fa-solid fa-xmark enabled-icon text-danger" data-id="'.$response['id'].'"></i>'; ?>
                        </a>
                        <div class="spinner-border spinner-border-sm d-none" role="status" id="enabled-spinner">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                    <td><?php echo $response['points']; ?></td>

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
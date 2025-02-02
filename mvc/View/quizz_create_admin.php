<?php
/**
 * @var string $action
 */
require("_partials/errors.php")
?>
<div class="row">
    <div class="col">
        <div class="h1 pt-2 pb-2 text-center">Création d'un quizz</div>
        <form action="" method="post">
            <div class="mb-3">
                <label for="quizz_title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="quizz_title" name="quizz_title" value="" required>
            </div>
            
            
            <div class="mb-3">
                <div class="form-check form-switch">
                    <input
                            class="form-check-input"
                            type="checkbox"
                            role="switch"
                            id="quizz_published"
                            name="quizz_published"
                    >
                    <label class="form-check-label" for="flexSwitchCheckChecked">Publié</label>
                </div>
            </div>

            <div class="accordion mb-3" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                            Question 1 
                        </button>
                    </h2>
                    <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <label for="question_1_title" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="question_1_title" name="question_1_title" value="" required>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input
                                            class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            id="question_1_published"
                                            name="question_1_published"
                                    >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Publié</label>
                                </div>
                            </div>
                            
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_1" id="question_1_pls_rep" checked>
                                <label class="form-check-label" for="question_1_pls_rep">
                                    Plusieurs bonnes réponses
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_1" id="question_1_seule_rep">
                                <label class="form-check-label" for="question_1_seule_rep">
                                    1 seule bonne réponse
                                </label>
                            </div>
                            <div id="question_1_reps" data-id="1">
                                <div id="question_1_rep_1">
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
                                                        id="question_1_rep_1_statut"
                                                        name="question_1_rep_1_statut"
                                                    >
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Bonne réponse</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_1_rep_1_title" class="form-label">Réponse 1 Titre</label>
                                                <input type="text" class="form-control" id="question_1_rep_1_title" name="question_1_rep_1_title" >                    
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_1_rep_1_nb_points" class="form-label">Réponse 1 Nombre de points</label>
                                                <input type="text" class="form-control" id="question_1_rep_1_nb_points" name="question_1_rep_1_nb_points">
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div id="question_1_rep_2">
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
                                                        id="question_1_rep_2_statut"
                                                        name="question_1_rep_2_statut"
                                                    >
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Bonne réponse</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_1_rep_2_title" class="form-label">Réponse 2 Titre</label>
                                                <input type="text" class="form-control" id="question_1_rep_2_title" name="question_1_rep_2_title" >                    
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_1_rep_2_nb_points" class="form-label">Réponse 2 Nombre de points</label>
                                                <input type="text" class="form-control" id="question_1_rep_2_nb_points" name="question_1_rep_2_nb_points" >
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <button type="button" class="btn btn-primary add-rep" id="question_1_add_rep" data-id="1">+</button>
                        </div>
                    </div>
                </div>
                
                
                
                
                
                
                
                
                
                
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                        Question 2
                    </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                            <div class="mb-3">
                                <label for="question_2_title" class="form-label">Titre</label>
                                <input type="text" class="form-control" id="question_2_title" name="question_2_title" value="" required>
                            </div>

                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input
                                            class="form-check-input"
                                            type="checkbox"
                                            role="switch"
                                            id="question_2_published"
                                            name="question_2_published"
                                    >
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Publié</label>
                                </div>
                            </div>
                            
                            
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_2" id="question_2_pls_rep" checked>
                                <label class="form-check-label" for="question_2_pls_rep">
                                    Plusieurs bonnes réponses
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_2" id="question_2_seule_rep">
                                <label class="form-check-label" for="question_2_seule_rep">
                                    1 seule bonne réponse
                                </label>
                            </div>
                            <div id="question_2_reps" data-id="2">
                                <div id="question_2_rep_1">
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
                                                        id="question_2_rep_1_statut"
                                                        name="question_2_rep_1_statut"
                                                    >
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Bonne réponse</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_2_rep_1_title" class="form-label">Réponse 2 Titre</label>
                                                <input type="text" class="form-control" id="question_2_rep_1_title" name="question_2_rep_1_title" >                    
                                            </div>
                                        </div>
                                        
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_2_rep_1_nb_points" class="form-label">Réponse 1 Nombre de points</label>
                                                <input type="text" class="form-control" id="question_2_rep_1_nb_points" name="question_2_rep_1_nb_points" >
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div id="question_2_rep_2">
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
                                                        id="question_2_rep_2_statut"
                                                        name="question_2_rep_2_statut"
                                                    >
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Bonne réponse</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_2_rep_2_title" class="form-label">Réponse 2 Titre</label>
                                                <input type="text" class="form-control" id="question_2_rep_2_title" name="question_2_rep_2_title" >                    
                                            </div>
                                        </div>
                                    
                                        <div class="col-4">
                                            <div class="mb-3">
                                                <label for="question_2_rep_2_nb_points" class="form-label">Réponse 2 Nombre de points</label>
                                                <input type="text" class="form-control" id="question_2_rep_2_nb_points" name="question_2_rep_2_nb_points" >
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <button type="button" class="btn btn-primary add-rep" id="question_2_add_rep" data-id="2">+</button>
                        </div>
                    
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="add_button">Add a question</button>
            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-success" name="">Enregistrer</button>
            </div>
        </form>
    </div>
</div>

<!--<script src="./Assets/js/services/quizzs_admin.js" type="module"></script>-->
<script src="./Assets/js/components/quizz_create_admin.js" type="module"></script>


<script type="module">
    import {addQuestion} from "./Assets/js/components/quizz_create_admin.js";

    document.addEventListener('DOMContentLoaded', () => {
        addQuestion()
        //addResponse()
        console.log('ç apasse')


    })
        
</script>
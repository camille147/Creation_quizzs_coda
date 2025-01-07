

<?php
/**
 * @var array $quizzs
*/
?>
<div class="row">
    <div class="col">
        <div class="row">
            <div class="mb-3 d-flex justify-content-end">
                <a href="index.php?component=user" type="button" class="btn btn-primary" ><i class="fa fa-plus me-2"></i>Connexion Admin</a>
            </div>
        </div>
        <div class="h1 pt-2 pb-2 text-center">Liste des Quizz disponibles</div>
        
        <table class="table">
            <thead>
            <tr>
                <th scope="col">N° de quizz</th>
                <th scope="col">Titre</th>
                
            </tr>
            </thead>
            <tbody>
             <?php foreach ($quizzs as $quizz): ?>
                <tr>
                    <th scope="row"><?php echo $quizz['id']; ?></th>
                    <td><?php echo $quizz['title']; ?></td>
                    
                </tr>
            <?php endforeach;; ?>
            </tbody>
        </table>
        
        <div class="row">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center" id="pagination">
                    
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="./assets/js/components/user.js" type="module"></script>
<script src="./assets/js/services/user.js" type="module"></script>

<script>
import {handleEnabledClick} from "./Assets/js/components/user.js";


document.addEventListener('DOMContentLoaded', () => {
    handleEnabledClick()
})
</script>
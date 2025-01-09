

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
        <div class="row col d-flex justify-content-center">
            <div class="spinner-border text-warning d-none" id="spinner" role="status">
                 <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        
        <table class="table" id="list-quizzs">
            <thead>
            <tr>
                <th scope="col">N° de quizz</th>
                <th scope="col">Titre</th>
                
            </tr>
            </thead>
            <tbody>
             
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



<script src="./Assets/js/services/quizzs.js" type="module"></script>
<script src="./Assets/js/components/quizzs.js" type="module"></script>

<script type="module">
        import { refreshList } from "./Assets/js/components/quizzs.js";

        document.addEventListener('DOMContentLoaded', async() => {
            
            let currentPage = 1
            refreshList(currentPage)
            
        });
    </script>
                
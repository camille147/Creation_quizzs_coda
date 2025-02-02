<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
      <div class="row mt-2">
        <div class="col">
          <div id="progress" class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar" id="progress-bar" style="width: 0%">0%</div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <!-- Les onglets de questions seront ajoutés ici -->
           
        </ul>
        <div class="tab-content" id="myTabContent">
          <!-- Les contenus des onglets seront ajoutés ici -->
        </div>
      </div>

      <div class="mt-2 d-flex justify-content-between">
        <div>
          <button class="btn btn-primary" type="button" id="previous-btn" disabled>Précédente</button>
        </div>
        <div>
          <button class="btn btn-primary" type="button" id="next-btn">Suivante</button>
        </div>
      </div>

      <div class="d-flex justify-content-center">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" id="toast">
          <div class="toast-header">
            <strong class="me-auto">Questionnaire de culture générale</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
            Vous n'avez pas coché de réponse
          </div>
        </div>
      </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossOrigin="anonymous"></script>
  </body>
</html>


<script src="./Assets/js/components/quizz_play.js" type="module"></script>


<script type="module">

    import {contentQuizz, doingQuizz} from "./Assets/js/components/quizz_play.js";

    document.addEventListener('DOMContentLoaded', async () => {
        const urlParams = new URLSearchParams(window.location.search);
        const quizzId = urlParams.get('id'); // Récupérer l'ID depuis l'URL
        
         await contentQuizz(quizzId); // Passer l'ID
         await doingQuizz(quizzId)
         console.log("ça passe")
        
    });
        
</script>
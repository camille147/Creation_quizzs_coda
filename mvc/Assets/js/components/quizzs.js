// Importation des fonctions et utilitaires nécessaires
import { getQuizzs } from "../services/quizzs.js";
import { showToast } from "./shared/toast.js";

// Fonction principale pour rafraîchir la liste des quizzs
export const refreshList = async (page) => {
    const spinner = document.querySelector('#spinner');
    const listElement = document.querySelector('#list-quizzs');

    spinner.classList.remove('d-none'); // Affiche le spinner
    console.log('avanttry')

    try {
        console.log('hello')
        const data = await getQuizzs(page);
        console.log(data.results)
        console.log('Quizzs récupérés :', data);
    
        // Vérifie la validité des données reçues
        if (!data || !data.results || !Array.isArray(data.results)) {
            throw new Error('Les données reçues sont invalides ou mal formatées.');
        }
    
    
        // Construction des lignes du tableau avec les données des quizzs
        const listContent = data.results
        .map(
            (quizz) => `
                <tr>
                    <td>${quizz.id}</td>
                    <td>${quizz.title}</td>
                </tr>`
        );
        console.log('list')
    
        // Mise à jour du tableau HTML
        listElement.querySelector('tbody').innerHTML = listContent.join('');
    
        // Mise à jour de la pagination
        document.querySelector('#pagination').innerHTML = getPagination(data.count.total);
    
        // Gestion des événements de navigation
        handlePaginationNavigation(page);
    } catch (error) {
        console.error('Erreur lors de la récupération des quizzs :', error.message);
        listElement.querySelector('tbody').innerHTML = '<tr><td colspan="2">Erreur lors du chargement des données</td></tr>';
    } finally {
        spinner.classList.add('d-none'); // Cache le spinner
    }
    
};

// Fonction pour générer les boutons de pagination
const getPagination = (total) => {
    const countPages = Math.ceil(total / 2); // Nombre total de pages (20 éléments par page)
    let paginationButton = [];

    // Bouton "Précédent"
    paginationButton.push(`<li class="page-item"><a class="page-link" href="#" id="previous-link">Précédent</a></li>`);

    // Boutons numérotés pour chaque page
    for (let i = 1; i <= countPages; i++) {
        paginationButton.push(`<li class="page-item"><a data-page="${i}" class="page-link pagination-btn" href="#">${i}</a></li>`);
    }

    // Bouton "Suivant"
    paginationButton.push(`<li class="page-item"><a class="page-link" href="#" id="next-link">Suivant</a></li>`);

    return paginationButton.join(''); // Retourne le HTML des boutons
};

// Fonction pour gérer les événements de navigation dans la pagination
const handlePaginationNavigation = (page) => {
    const previousLink = document.querySelector('#previous-link');
    const nextLink = document.querySelector('#next-link');
    const paginationBtns = document.querySelectorAll('.pagination-btn');

    // Gestion du bouton "Précédent"
    previousLink?.addEventListener('click', async () => {
        if (page > 1) {
            page--; // Décrémente la page
            console.log('compo_quizzs_previous')
            await refreshList(page); // Rafraîchit la liste
        }
    });

    // Gestion des boutons numérotés
    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshList(pageNumber)
        })
    }

    // Gestion du bouton "Suivant"
    nextLink?.addEventListener('click', async () => {
        page++; // Incrémente la page
        console.log('compo_quizzs_next')

        await refreshList(page); // Rafraîchit la liste
    });
};

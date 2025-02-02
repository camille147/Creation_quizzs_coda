import { getQuizzsAdmin } from "../services/quizzs_admin.js"
import {toggleEnabledUser} from "../services/quizzs_admin.js"
import {showToast} from "./shared/toast.js"

export const refreshListAdmin = async (page) => {
    const spinner = document.querySelector('#spinner')
    const listElement = document.querySelector('#list-quizzs')

    spinner.classList.remove('d-none')

    try {
        const data = await getQuizzsAdmin(page)
        const listContent = []

        for (let i = 0; i < data.results.length; i++) {
            listContent.push(`
                <tr>
                    <td>${data.results[i].id}</td>
                    <td>${data.results[i].title}</td>
                    <td>
                        <a href="#">
                            ${data.results[i].published
                                ? `<i class="fa-solid fa-check text-success enabled-icon" data-id="${data.results[i].id}"></i>`
                                : `<i class="fa-solid fa-xmark enabled-icon text-danger" data-id="${data.results[i].id}"></i>`}
                        </a>
                        <div class="spinner-border spinner-border-sm d-none" role="status" id="enabled-spinner">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3 d-flex justify-content-end">
                            <a href="index.php?component=quizz_admin&action=edit&id=${data.results[i].id}" type="button" class="btn btn-warning">Modifier</a>
                        </div>
                    </td>
                    <td>
                        <div class="mb-3 d-flex justify-content-end">
                            <a href="index.php?component=quizzs_admin&action=delete&id=${data.results[i].id}" type="button" class="btn btn-outline-danger delete-link">Supprimer</a>
                        </div>
                    </td>
                </tr>`
            )
        }

        listElement.querySelector('tbody').innerHTML = listContent.join('')

        document.querySelector('#pagination').innerHTML = getPaginationAdmin(data.count.total)
        handlePaginationNavigationAdmin(page)

        handleEnabledClick()

    } catch (error) {
        console.error('Erreur lors de la récupération des quizzs:', error)
    } finally {
        spinner.classList.add('d-none')
    }
    document.querySelector('#list-quizzs').addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-link')) {
            e.preventDefault()
    
            if (confirmDeleteQuizz()) {
                window.location.href = e.target.getAttribute('href')
            }
        }
    });
    
    
}

const getPaginationAdmin = (total) => {      
    const countPages = Math.ceil(total /2)
    let paginationButton = []

          
    paginationButton.push(`<li class="page-item"><a class="page-link" href="#" id="previous-link">Précédent</a></li>`)

    for (let i = 1; i <= countPages; i++) {
        paginationButton.push(`<li class="page-item"><a data-page="${i}" class="page-link pagination-btn" href="#">${i}</a></li>`)
    }

    paginationButton.push(`<li class="page-item"><a class="page-link" href="#" id="next-link">Suivant</a></li>`)

    return paginationButton.join('')
}

const handlePaginationNavigationAdmin = (page) => {
    const previousLink = document.querySelector('#previous-link')
    const nextLink = document.querySelector('#next-link')
    const paginationBtns = document.querySelectorAll('.pagination-btn')

    previousLink.addEventListener('click', async () => {
        if (page > 1) {
            page--
            await refreshListAdmin(page)
        }
    })

    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshListAdmin(pageNumber)
        })
    }

    nextLink.addEventListener('click', async () => {
        page++
        await refreshListAdmin(page)
    })
}



export const confirmDeleteQuizz = () => {
    const isConfirmedDeleteQuizz = window.confirm("Voulez-vous vraiment supprimer ce quizz ?")
    return isConfirmedDeleteQuizz
}



export const handleEnabledClick = () => {
    const enabledIcons = document.querySelectorAll(".enabled-icon")

    enabledIcons.forEach(enabledIcon => {
        enabledIcon.addEventListener('click', async (e) => {
            e.preventDefault()
            const userId = e.target.getAttribute('data-id')

            try {
                const result = await toggleEnabledUser(userId)
                if (result.success){
                    if (e.target.classList.contains('fa-check')) {
                        e.target.classList.remove('fa-check', 'text-success')
                        e.target.classList.add('fa-xmark', 'text-danger')
                    } else {
                        e.target.classList.add('fa-check', 'text-success')
                        e.target.classList.remove('fa-xmark', 'text-danger')
                    }
                } 
            } catch (error) {
                console.error('Erreur lors de la bascule du statut:', error)
            }
        })
    })
}

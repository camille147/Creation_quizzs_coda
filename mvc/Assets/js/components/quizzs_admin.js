import { getQuizzsAdmin } from "../services/quizzs_admin.js"

export const refreshListAdmin = async (page) => {
    const spinner = document.querySelector('#spinner')
    const listElement = document.querySelector('#list-quizzs')

    spinner.classList.remove('d-none')
    //console.log("bonjour")
    const data = await getQuizzsAdmin(page)
    console.log(data)
    const listContent = []

    
    for (let i = 0; i < data.results.length; i++) {
        listContent.push( `
            <tr>
                <td>${data.results[i].id}</td>
                <td>${data.results[i].title}</td>
                <td>
                    <a href="#">
                        ${data.results[i].published
                            ? `<i class="fa-solid fa-check text-success enabled-icon" data-id="${data.results[i].id}"></i>`
                            : `<i class="fa-solid fa-xmark enabled-icon text-danger" data-id="${data.results[i].id}"></i>`}
                    </a>
                </td>
                <td>
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="index.php?component=quizz_admin&id=${data.results[i].id}" type="button" class="btn btn-primary" >Modifier</a>
                    </div>
                </td>
                <td>
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="index.php?component=quizz_admin&id=${data.results[i].id}" type="button" class="btn btn-primary" >Supprimer</a>
                    </div>
                </td>


            </tr>`
        )
    
        listElement.querySelector('tbody').innerHTML = listContent.join('')
    
        document.querySelector('#pagination').innerHTML = getPaginationAdmin(data.count.total)
        handlePaginationNavigationAdmin(page)
        spinner.classList.add('d-none')

    }
    
}

const getPaginationAdmin = (total) => {      
    const countPages = Math.ceil(total / 2)
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

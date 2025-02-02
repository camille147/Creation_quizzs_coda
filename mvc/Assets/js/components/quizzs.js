import { getQuizzs } from "../services/quizzs.js"

export const refreshList = async (page) => {
    const spinner = document.querySelector('#spinner')
    const listElement = document.querySelector('#list-quizzs')

    spinner.classList.remove('d-none')

    const data = await getQuizzs(page)
    const listContent = []

    
    for (let i = 0; i < data.results.length; i++) {
        listContent.push( `
            <tr>
                <td>${data.results[i].id}</td>
                <td>${data.results[i].title}</td>
                <td>
                    <div class="mb-3 d-flex justify-content-end">
                        <a href="index.php?component=play_quizz&id=${data.results[i].id}" type="button" class="btn btn-info">Faire</a>
                    </div>
                </td>
            </tr>`
        )
    
        listElement.querySelector('tbody').innerHTML = listContent.join('')
    
        document.querySelector('#pagination').innerHTML = getPagination(data.count.total)
        handlePaginationNavigation(page)
        spinner.classList.add('d-none')

    }
    
}

const getPagination = (total) => {      
    const countPages = Math.ceil(total / 2)
    let paginationButton = []

          
    paginationButton.push(`<li class="page-item"><a class="page-link" href="#" id="previous-link">Précédent</a></li>`)

    for (let i = 1; i <= countPages; i++) {
        paginationButton.push(`<li class="page-item"><a data-page="${i}" class="page-link pagination-btn" href="#">${i}</a></li>`)
    }

    paginationButton.push(`<li class="page-item"><a class="page-link" href="#" id="next-link">Suivant</a></li>`)

    return paginationButton.join('')
}

const handlePaginationNavigation = (page) => {
    const previousLink = document.querySelector('#previous-link')
    const nextLink = document.querySelector('#next-link')
    const paginationBtns = document.querySelectorAll('.pagination-btn')

    previousLink.addEventListener('click', async () => {
        if (page > 1) {
            page--
            await refreshList(page)
        }
    })

    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async (e) => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshList(pageNumber)
        })
    }

    nextLink.addEventListener('click', async () => {
        page++
        await refreshList(page)
    })
}

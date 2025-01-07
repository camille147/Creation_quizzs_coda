const getPagination = (total) =>{
    const countPages = Math.ceil(total/20)
    let paginationButton = [] 
    paginationButton.push( `<li class="page-item"><a class="page-link" href="#" id = "previous-link">Précédent</a></li>`)

    for (let i = 0; i <= countPages; i++) {
        paginationButton.push(`<li class="page-item"><a data-page = "${i}" class="page-link pagination-btn" href="#">${i}</a></li>`)
    }

    paginationButton.push( `<li class="page-item"><a class="page-link" href="#" id = "next-link">Suivant</a></li>`)

    return paginationButton.join('')


}

const handlePaginationNavigation = (page) => {
    const previousLink = document.querySelector('#previous-link')
    const nextLink = document.querySelector('#next-link')
    const paginationBtns = document.querySelectorAll('.pagination-btn')

    previousLink.addEventListener('click', async(e) => {
        e.preventDefault
        if (page > 1){
            page--
            await refreshList(page)
        }
    })

    for (let i = 0; i < paginationBtns.length; i++){
        paginationBtns[i].addEventListener('click', async() => {
            const pageNumber = e.target.getAttribute('data-page')
            await refreshList(pageNumber)
        })
    }

    nextLink.addEventListener('click', async() => {
        page++
        await refreshList(page)
    })
}
export const getQuizzs = async(currentPage = 1) => {
    const response = await fetch(`index.php?component=persons&page=${currentPage}`, {         
        headers: {
            'Content-Type' : 'application/json'
        },
    })
    return await response.json()
}
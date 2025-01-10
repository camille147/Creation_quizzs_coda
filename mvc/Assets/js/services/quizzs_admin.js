export const getQuizzsAdmin = async (currentPage) => {
    try {
        const response = await fetch(`index.php?component=quizzs_admin&page=${currentPage}`, {         
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
        })
        //console.log(response)
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`)
        }
        
        return await response.json()
    } catch (error) {
        console.error('Erreur dans getQuizzsAdmin :')
        throw error;
        
    }
};

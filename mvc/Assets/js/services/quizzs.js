export const getQuizzs = async (currentPage) => {
    try {
        const response = await fetch(`index.php?component=quizzs&page=${currentPage}`, {         
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
        })

        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`)
        }
        
        return await response.json()
    } catch (error) {
        console.error('Erreur dans getQuizzs :')
        throw error;
        
    }
};

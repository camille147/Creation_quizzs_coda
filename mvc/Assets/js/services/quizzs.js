export const getQuizzs = async (currentPage) => {
    try {
        console.log('error')

        const response = await fetch(`index.php?component=quizzs&page=${currentPage}`, {         
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
        });
        console.log('error')


        if (!response.ok) {
            console.log('error')

            throw new Error(`Erreur HTTP : ${response.status}`);
        }
        
        
       

        return await response.json();
    } catch (error) {
        console.error('Erreur dans getQuizzs :');
        console.log('catch')
        throw error;
        
    }
};

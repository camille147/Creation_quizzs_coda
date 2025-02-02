
export const getPlayQuizz = async (id) => {
    try {
        const response = await fetch(`index.php?component=play_quizz&id=${id}`, {         
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
        console.error('Erreur dans getPlayQuizz :', error)
        throw error
    }
};

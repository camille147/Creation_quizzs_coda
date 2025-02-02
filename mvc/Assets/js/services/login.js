export const login = async (username, pass) => {
    try {
        const response = await fetch('index.php?component=login', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            method: 'POST',
            body: new URLSearchParams({
                username: username,
                password: pass
            })
        })
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`)
        }

        return await response.json()

    } catch (error) {
        console.error('Erreur dans login :', error)
        throw error
    }
};

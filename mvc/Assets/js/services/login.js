export const login = async (username, pass) => {
    try {
        console.log(0);
        const response = await fetch('index.php?component=login', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
            method: 'POST',
            body: new URLSearchParams({
                username: username,
                password: pass
            })
        });

        console.log(1);
        
        // Vérifie si la réponse est correcte
        if (!response.ok) {
            throw new Error(`Erreur HTTP : ${response.status}`);
        }

        console.log(2);
        //console.log(await response)
        //console.log(response.headers.get('Content-Type'));
        //console.log(await response.text())
        //console.log("await")


       // console.log(await response.json())
       // console.log("json pass")


        // Affiche la réponse brute pour débogage
        //const data = await response.json();  // Utilise text() pour examiner la réponse 
        //console.log("wait")

        //console.log(data);  // Cela te permet de voir le contenu brut de la réponse
        //console.log("attention")
        
        // Si la réponse est censée être JSON
        ///try {
           // const jsonData = JSON.parse(data);  // Parse manuellement si nécessaire
            //console.log(jsonData);
            //return jsonData;
       // } catch (error) {
         //   console.error('Erreur de parsing JSON :', error);
       // }
       return await response.json();

    } catch (error) {
        console.error('Erreur dans login :', error);
        throw error;
    }
};

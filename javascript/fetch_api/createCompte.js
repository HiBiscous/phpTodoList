console.log('CREATE_COMPTE.js')

document.querySelector('.createCompteForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    const response = await fetch('/phpTodolist/view/traitementForm/traitementCreateCompte.php', {
        method: 'POST',
        body: formData
    });

    if (response.ok) {
        const jsonResponse = await response.json();
        if (jsonResponse.success) {
            console.error(jsonResponse);
            // alert(jsonResponse.message)
            // setTimeout(() => {
            window.location = '/phpTodolist/view/authentification/connection.php';
            // }, 3000);
        }
    } else {
        console.log(jsonResponse.message);
        console.error('Une erreur est survenue lors de la soumission du formulaire.');
    }
})

document.querySelector('.connectForm').addEventListener('submit', async (e) => {
    console.log(e.preventDefault());
    const formData = new FormData(e.target);
    console.log(formData);
    const response = await fetch('/phpTodolist/view/traitementForm/traitementConnection.php', {
        method: 'POST',
        body: formData,

    });

    if (response.ok) {

        const jsonResponse = await response.json();
        // return jsonResponse;
        if (jsonResponse.success) {
            console.error(jsonResponse.success);
            // alert(jsonResponse.message)
            // setTimeout(() => {
            window.location = '/phpTodolist/view/tasks/note.php';
            // }, 3000);

        }
    } else {
        console.error('Une erreur est survenue lors de la soumission du formulaire.');
    }
})

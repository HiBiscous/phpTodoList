console.log('UPDATE.js');
document.querySelector('.updateForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    let task_id = document.getElementById('edit_task_id').value;
    let task_description = document.getElementById('edit_task_description').value;

    const formData = new FormData(e.target);
    formData.append('tasks_id', task_id);
    formData.append('tasks_description', task_description);

    const response = await fetch('/phpTodolist/view/traitementForm/updateTask.php', {
        method: 'POST',
        body: formData,
    });

    if (response.ok) {
        const jsonResponse = await response.json();

        // return jsonResponse;
        if (jsonResponse.success) {
            window.location = '/phpTodolist/view/tasks/note.php';
            popup_close();
        }
    } else {
        console.log(jsonResponse.message);
        console.error('Une erreur est survenue lors de la soumission du formulaire.');
    }
})

<div id="popup_div">
    <div class="popup-flex">
        <h2 class="popup-title">Modifier la tâche</h2>
        <button class="btn" onclick="popup_close()">Close</button>
    </div>
    <form action="/phptodolist/view/tasks/traitementForm/updateTask.php" class="edit-note-content updateForm">
        <div class="popup-flex">
            <input type="hidden" id="edit_task_id" name="id_tasks">
            <input type="text" id="edit_task_title" name="title" class="input-container">
            <input type="text" id="edit_task_description" name="description" class="input-container">

            <!--<button type="button" class="btn btn-submit" onclick="submitNewTask()">Enregistrer</button>-->
            <input type="submit" value="Valider" class="btn">
        </div>
    </form>
</div>
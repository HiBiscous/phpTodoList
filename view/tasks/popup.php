<div class="popup-background glass"></div>

<div id="popup_edit">
    <div class="nav-popup">
        <h2 class="title-popup">Modifier la tâche</h2>
        <button class="btn btn-close" onclick="popup_close()">Close</button>
    </div>
    <form action="../traitementForm/updateTask.php" class="edit-note-content updateForm">
        <div class="main-popup">
            <input type="hidden" id="edit_task_id">
            <input type="text" id="edit_task_description" name="tasks_description">
            <!--<button type="button" class="btn btn-submit" onclick="submitNewTask()">Enregistrer</button>-->
            <input type="submit" value="Valider" class="btn btn-submit">
        </div>
    </form>
</div>
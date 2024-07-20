console.log('POPUP.js');
/**
 * this function rescue the notes value when the button is clicked
 * the note is display in a popup div
 * 
 * @param {string} task_id 
 * @param {string} task_description 
 */
function popup_open(task_id) {
  const task = tasks.find(task => task.id_tasks == task_id);
  document.getElementById('id_tasks').value = task.id_tasks;
  document.getElementById('edit_task_title').value = task.title;
  document.getElementById('edit_task_description').value = task.description;
  document.getElementById('popup_div').style.display = 'block';
};

/**
 * This function close the popup form
 */
function popup_close() {
  document.getElementById('popup_div').style.display = 'none';
}

/**
 * this function submit new task
 * The function use the formData object to create a new form with the new value
 *
 * the fetch method is used to make HTTP request to get or send data on a server
 * fetch must have the url to which you want to send the request and options as method / headers / body ...
 * fetch returns a "promise" that will be resolved when the answer is available
 * then() is used to define what to do with the response once it has been received.
 */
// function submitNewTask() {
//   //get new values elements
//   let task_id = document.getElementById('edit_task_id').value;
//   let task_description = document.getElementById('edit_task_description').value;

//   //FormData() is a class witch construct new form
//   //formData is now a object
//   let formData = new FormData();
//   //formData.append(name, value)
//   formData.append('tasks_id', task_id);
//   formData.append('tasks_description', task_description);

//   //is a asynchronous function
//   fetch('../view/updateTask.php', {
//     method: 'POST',
//     body: formData
//   })

//     //response will be treat as text
//     .then(response => response.text())
//     .then(data => {
//       location.reload();
//     })

//   popup_close();
// }

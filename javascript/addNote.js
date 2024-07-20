console.log('ADD NOTE.js');
const button = document.querySelector('.btn-add');
const form = document.querySelector('.add-note-form');


button.addEventListener("click", () => {
    form.classList.remove('hidden');
    form.classList.add('show');
    console.log(form);
})

//***************** textarea auto height *******************************************
/**
 *  This function is used to adjust the height of the textarea according to the content
 * @param {*} oEvent 
 */
function setTailleHeight() {
    var textarea = 'auto';

    //resets the textarea height to its default value.
    this.style.height = textarea;

    //If the height is greater than zero, this means there is content in the textarea.
    if (this.scrollHeight > 0) {

        //This sets the height of the textarea to the total height of the content.
        textarea = (this.scrollHeight) + 'px';
        this.style.height = textarea;
    }

    //check if textarea is empty
    if (this.value == "") {

        //then this resets the textarea height to its default value.
        this.style.removeProperty("height");
    }
}

// This method is used to add an event listener once the DOM has been loaded.
//The callback function will be executed when the DOM is fully loaded.
document.addEventListener('DOMContentLoaded', function () {
    //access to the form via his id
    var form = document.forms['taskForm'],
        arr = form.getElementsByClassName("description-input");

    // loop all textarea element in the array
    for (let textarea of arr) {

        //callback the function setTailleHeight each time the user enters text in the textarea.
        textarea.addEventListener('input', setTailleHeight);
        //adjust the height of the textarea
        setTailleHeight.call(textarea, true);
    }
});

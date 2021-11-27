var admin = new AdminControl();

function showModificationForm(id) {
    let updatePostDiv = document.querySelector('#updateForm' + id);
    let modifyPostState = localStorage.getItem('modifyPostState');

        if (modifyPostState === 'show') {
            updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('modifyPostState', 'hide');
        }
        if (modifyPostState === 'hide' || modifyPostState == null) {
            updatePostDiv.style.display = 'block';
            localStorage.clear();
            localStorage.setItem('modifyPostState', 'show');
        }
}
class AdminControl {
    constructor() {
        this.newPostDiv = document.querySelector('#newPost');
        this.checkPostDiv = document.querySelector('#checkPost');
        this.checkCommentDiv = document.querySelector('#checkComment');
        this.checkUserDiv = document.querySelector('#checkUser');
        this.updatePostDiv = document.querySelector('.updatePost');
        
        this.btnNewPost = document.querySelector('#newPostJs');
        this.btnCheckPost = document.querySelector('#checkPostJs');
        this.btnCheckComment = document.querySelector('#checkCommentJs');
        this.btnCheckUser = document.querySelector('#checkUserJs');
        this.btnModifyPost = document.querySelector('.modifyPost');

        this.btnNewPost.addEventListener('click', (e) => {this.newPostControl(e)});
        this.btnCheckPost.addEventListener('click', (e) => {this.checkPostControl(e)});
        this.btnCheckComment.addEventListener('click', (e) => {this.checkCommentControl(e)});
        this.btnCheckUser.addEventListener('click', (e) => {this.checkUserControl(e)});
        this.btnModifyPost.addEventListener('click', (e) => {this.modifyPostControl(e)});

        window.onload = this.newPostControl(e);
        window.onload = this.checkPostControl(e);
        window.onload = this.checkCommentControl(e);
        window.onload = this.checkUserControl(e);
        window.onload = this.modifyPostControl(e); 
    }

    newPostControl(e) {
        e.preventDefault();
        var newPostState = localStorage.getItem('newPostState');

        if (newPostState === 'show') {
            e.preventDefault();
            this.newPostDiv.style.display = 'none';
            this.checkPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('newPostState', 'hide');
        };
        if (newPostState === 'hide' || newPostState == null) {
            this.newPostDiv.style.display = 'block';
            this.checkPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('newPostState', 'show');
        };
    };

    checkPostControl(e) {
        e.preventDefault();
        var checkPostState = localStorage.getItem('checkPostState');

        if (checkPostState === 'show') {
            this.checkPostDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkPostState', 'hide');
        };
        if (checkPostState === 'hide' || checkPostState == null) {
            this.checkPostDiv.style.display = 'block';
            this.newPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkPostState', 'show');
        };
    };

    checkCommentControl(e) {
        e.preventDefault();
        var checkCommentState = localStorage.getItem('checkCommentState');

        if (checkCommentState === 'show') {
            this.checkCommentDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            this.checkPostDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkCommentState', 'hide');
        };
        if (checkCommentState === 'hide' || checkCommentState == null) {
            this.checkCommentDiv.style.display = 'block';
            this.newPostDiv.style.display = 'none';
            this.checkPostDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkCommentState', 'show');
        };
    };

    checkUserControl(e) {
        e.preventDefault();
        var checkUserState = localStorage.getItem('checkUserState');

        if (checkUserState === 'show') {
            this.checkUserDiv.style.display = 'none';
            this.checkPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkUserState', 'hide');
        };
        if (checkUserState === 'hide' || checkUserState == null) {
            this.checkUserDiv.style.display = 'block';
            this.checkPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkUserState', 'show');
        };
    };

    modifyPostControl(e) {
        e.preventDefault();
        var modifyPostState = localStorage.getItem('modifyPostState');

        if (modifyPostState === 'show') {
            this.updatePostDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('modifyPostState', 'hide');
        };
        if (modifyPostState === 'hide' || modifyPostState == null) {
            this.updatePostDiv.style.display = 'block';
            this.checkUserDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('modifyPostState', 'show');
        };
    };
}
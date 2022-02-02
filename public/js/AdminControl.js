// Fonctionnement des boutons du panneau d'administration
class AdminControl {
    constructor() {
        this.newPostDiv = document.querySelector('#newPost');
        this.checkPostDiv = document.querySelector('#checkPost');
        this.checkCommentDiv = document.querySelector('#checkComment');
        this.checkUserDiv = document.querySelector('#checkUser');
        
        this.btnNewPost = document.querySelector('#newPostJs');
        this.btnCheckPost = document.querySelector('#checkPostJs');
        this.btnCheckComment = document.querySelector('#checkCommentJs');
        this.btnCheckUser = document.querySelector('#checkUserJs');

        this.btnNewPost.addEventListener('click', (e) => {this.newPostControl(e)});
        this.btnCheckPost.addEventListener('click', (e) => {this.checkPostControl(e)});
        this.btnCheckComment.addEventListener('click', (e) => {this.checkCommentControl(e)});
        this.btnCheckUser.addEventListener('click', (e) => {this.checkUserControl(e)});
        // On charge les fonctions au chargement de la fenêtre pour éviter le double clic
        window.onload = this.newPostControl();
        window.onload = this.checkPostControl();
        window.onload = this.checkCommentControl();
        window.onload = this.checkUserControl();
        window.onload = this.modifyPostControl(); 
    }
    // Affichage de la liste des articles
    checkPostControl(e) {
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
        }
    }
    // Affichage du formulaire de création d'un article
    newPostControl(e) {
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
        }
        if (newPostState === 'hide' || newPostState == null) {
            this.newPostDiv.style.display = 'block';
            this.checkPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('newPostState', 'show');
        }
    }
    // Affichages de la liste des commentaires
    checkCommentControl(e) {
        var checkCommentState = localStorage.getItem('checkCommentState');

        if (checkCommentState === 'show') {
            this.checkCommentDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            this.checkPostDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkCommentState', 'hide');
        }
        if (checkCommentState === 'hide' || checkCommentState == null) {
            this.checkCommentDiv.style.display = 'block';
            this.newPostDiv.style.display = 'none';
            this.checkPostDiv.style.display = 'none';
            this.checkUserDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkCommentState', 'show');
        }
    }
    // Affichage de la liste des utilisateurs
    checkUserControl(e) {
        var checkUserState = localStorage.getItem('checkUserState');

        if (checkUserState === 'show') {
            this.checkUserDiv.style.display = 'none';
            this.checkPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkUserState', 'hide');
        }
        if (checkUserState === 'hide' || checkUserState == null) {
            this.checkUserDiv.style.display = 'block';
            this.checkPostDiv.style.display = 'none';
            this.checkCommentDiv.style.display = 'none';
            this.newPostDiv.style.display = 'none';
            this.updatePostDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('checkUserState', 'show');
        }
    }
}
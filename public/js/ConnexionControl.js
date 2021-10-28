class ConnexionControl {
    constructor () {
        this.btnLogIn = document.querySelector("#connexion");
        this.btnSignIn = document.querySelector("#registration");
        this.logInDiv = document.querySelector("#logIn");
        this.signInDiv = document.querySelector("#signIn");

        this.btnLogIn.addEventListener('click', (e) => {
            this.logInControl(e)
        });
        this.btnSignIn.addEventListener('click', (e) => {
            this.signInControl(e)
        });
    }

    logInControl(e) {
        e.preventDefault();
        var logInState = localStorage.getItem('logInState');

        if (logInState === 'show') {
            e.preventDefault();
            this.logInDiv.style.display = 'none';
            this.signInDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('logInState', 'hide');
        };
        if (logInState === 'hide' || logInState == null) {
            e.preventDefault();
            this.logInDiv.style.display = 'block';
            this.signInDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('logInState', 'show');
        };
    }

    signInControl(e) {
        e.preventDefault();
        var signInState = localStorage.getItem('signInState');

        if (signInState === 'show') {
            e.preventDefault();
            this.logInDiv.style.display = 'none';
            this.signInDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('signInState', 'hide');
        };
        if (signInState === 'hide' || signInState == null) {
            e.preventDefault();
            this.signInDiv.style.display = 'block';
            this.logInDiv.style.display = 'none';
            localStorage.clear();
            localStorage.setItem('signInState', 'show');
        };
    }
}
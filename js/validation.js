const registerForm = document.querySelector('#registerForm');

registerForm.addEventListener('submit', async (e) => {
    e.preventDefault();

    const passwordInput = document.querySelector('#register-password');
    const password = passwordInput.value;

    // Vérification des critères du mot de passe
    if (!/[A-Z]/.test(password)) {
        console.log('Le mot de passe doit contenir au moins une lettre majuscule (Uppercase missing).');
        return;
    }

    if (!/[0-9]/.test(password)) {
        console.log('Le mot de passe doit contenir au moins un chiffre (Number missing).');
        return;
    }

    if (!/[!@#$%^&*]/.test(password)) {
        console.log('Le mot de passe doit contenir au moins un caractère spécial (Special char missing).');
        return;
    }

    if (password.length < 16) {
        console.log('Le mot de passe est trop court, il doit contenir au moins 16 caractères (Too short, password must be at least 16 characters long).');
        return;
    }

    // Le mot de passe a passé toutes les vérifications
    // Envoi du formulaire vers le serveur
    const formElement = e.target;
    const formData = new FormData(formElement);

    try {
        const response = await fetch(formElement.action, {
            method: formElement.method,
            body: formData
        });

        if (response.ok) {
            // Redirection vers la page de succès ou autre traitement
            window.location.href = 'home.php';
        } else {
            // Affichage de l'erreur retournée par le serveur
            const errorData = await response.json();
            console.log(errorData.error);
        }
    } catch (error) {
        console.log("Une erreur s'est produite lors de l'envoi du formulaire.", error);
    }
});
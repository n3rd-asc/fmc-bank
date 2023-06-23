// const registerForm = document.querySelector('#registerForm');
// const errorSpan = document.querySelector('#errorSpan');

// registerForm.addEventListener('submit', async (e) => {
//     e.preventDefault();

//     const passwordInput = document.querySelector('#register-password');
//     const password = passwordInput.value;

//     // Vérification des critères du mot de passe
//     if (!/[A-Z]/.test(password)) {
//         errorSpan.textContent = 'Le mot de passe doit contenir au moins une lettre majuscule (Uppercase missing).';
//         return;
//     }

//     if (!/[0-9]/.test(password)) {
//         errorSpan.textContent = 'Le mot de passe doit contenir au moins un chiffre (Number missing).';
//         return;
//     }

//     if (!/[!@#$%^&*]/.test(password)) {
//         errorSpan.textContent = 'Le mot de passe doit contenir au moins un caractère spécial (Special char missing).';
//         return;
//     }

//     if (password.length < 16) {
//         errorSpan.textContent = 'Le mot de passe est trop court, il doit contenir au moins 16 caractères.';
//         return;
//     }

//     // Le mot de passe a passé toutes les vérifications
//     // Envoi du formulaire vers le serveur
//     const formElement = e.target;
//     const formData = new FormData(formElement);

//     try {
//         const response = await fetch(formElement.action, {
//             method: formElement.method,
//             body: formData
//         });

//         if (response.ok) {
//             // Redirection vers le tableau de bord home.php
//             window.location.href = 'home.php';
//         } else {
//             // Affichage de l'erreur
//             const errorData = await response.json();
//             errorSpan.textContent = errorData.error;
//         }
//     } catch (error) {
//         console.log("Une erreur s'est produite lors de l'envoi du formulaire.", error);
//     }
// });

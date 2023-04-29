const emailInput = document.getElementById('email');
const passwordInput = document.getElementById('password');
const passwordAgainInput = document.getElementById('password-again');
const errorFormDiv = document.getElementById('error-form');

emailInput.addEventListener('blur', () => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailInput.value)) {
    errorFormDiv.innerHTML = "Format d'email invalide";
    emailInput.style.borderColor = "red";
    errorFormDiv.style.color = "red";
  } else {
    errorFormDiv.innerHTML = "";
    emailInput.style.borderColor = "";
  }
});

passwordInput.addEventListener('blur', () => {
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
  if (!passwordRegex.test(passwordInput.value)) {
    errorFormDiv.innerHTML = "Le mot de passe doit contenir au moins 8 caractères dont 1 lettre majuscule, 1 lettre minuscule, 1 symbole et 1 chiffre";
    passwordInput.style.borderColor = "red";
    errorFormDiv.style.color = "red";
  } else if (passwordAgainInput.value !== "" && passwordAgainInput.value !== passwordInput.value) {
    errorFormDiv.innerHTML = "Les mots de passe ne correspondent pas";
    passwordAgainInput.style.borderColor = "red";
    errorFormDiv.style.color = "red";
  } else {
    errorFormDiv.innerHTML = "";
    passwordInput.style.borderColor = "";
    passwordAgainInput.style.borderColor = "";
  }
});

passwordAgainInput.addEventListener('blur', () => {
  if (passwordAgainInput.value !== passwordInput.value) {
    errorFormDiv.innerHTML = "Les mots de passe ne correspondent pas";
    passwordAgainInput.style.borderColor = "red";
    errorFormDiv.style.color = "red";
  } else {
    errorFormDiv.innerHTML = "";
    passwordAgainInput.style.borderColor = "";
  }
});

const passwordInput = document.getElementById('password');
const errorFormDiv = document.getElementById('error-form');

passwordInput.addEventListener('blur', () => {
  const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@#$%^&+=!])(?=.*[^\w\s]).{8,}$/;
  if (!passwordRegex.test(passwordInput.value)) {
    errorFormDiv.innerHTML = "Le mot de passe doit contenir au moins 8 caractères dont 1 lettre majuscule, 1 lettre minuscule, 1 symbole et 1 chiffre";
    passwordInput.style.borderColor = "red";
    errorFormDiv.style.color = "red";
  } else {
    errorFormDiv.innerHTML = "";
    passwordInput.style.borderColor = "";
  }
});

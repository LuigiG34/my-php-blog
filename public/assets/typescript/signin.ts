const emailInput = document.getElementById('email');
const errorFormDiv = document.getElementById('error-form');

emailInput.addEventListener('blur', () => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailInput.value)) {
    errorFormDiv.innerHTML = "Format d'email invalide";
    errorFormDiv.style.color = "red";
    emailInput.style.borderColor = "red";
  } else {
    errorFormDiv.innerHTML = "";
    emailInput.style.borderColor = "";
  }
});
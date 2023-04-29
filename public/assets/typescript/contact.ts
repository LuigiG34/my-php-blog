const form = document.querySelector('form');
const prenom = document.querySelector('#prenom');
const nom = document.querySelector('#nom');
const email = document.querySelector('#email');
const message = document.querySelector('#message');
const errorDiv = document.querySelector('#error-form');

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const checkInput = (input, regex, errorMessage) => {
  const isValid = regex.test(input.value.trim());
  if (!isValid) {
    input.classList.add('border-danger');
    errorDiv.innerHTML = errorMessage;
    errorDiv.style.color = 'red';
  } else {
    input.classList.remove('border-danger');
    errorDiv.innerHTML = '';
  }
};

prenom.addEventListener('blur', () => {
  checkInput(prenom, /^[a-zA-Z\s]*$/, 'Le prénom ne doit contenir que des lettres et des espaces.');
});

nom.addEventListener('blur', () => {
  checkInput(nom, /^[a-zA-Z\s]*$/, 'Le nom ne doit contenir que des lettres et des espaces.');
});

email.addEventListener('blur', () => {
  checkInput(email, emailRegex, 'Veuillez entrer une adresse email valide.');
});

message.addEventListener('blur', () => {
  const isValid = message.value.trim().length >= 20;
  if (!isValid) {
    message.classList.add('border-danger');
    errorDiv.innerHTML = 'Le message doit contenir au moins 20 caractères.';
    errorDiv.style.color = 'red';
  } else {
    message.classList.remove('border-danger');
    errorDiv.innerHTML = '';
  }
});

const emailInput = document.getElementById('email')
const errorFormDiv = document.getElementById('error-form')

emailInput.addEventListener('blur', () => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailInput.value)) {
    errorFormDiv.innerHTML = "Invalid email format";
    emailInput.style.borderColor = "red";
    errorFormDiv.style.color = "red";
  } else {
    errorFormDiv.innerHTML = "";
    emailInput.style.borderColor = "";
  }
});
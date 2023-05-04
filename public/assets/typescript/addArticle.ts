const categorieSelect = document.getElementById('categorie');
const titreInput = document.getElementById('titre');
const chapoTextarea = document.getElementById('chapo');
const contenuTextarea = document.getElementById('contenu');
const imgInput = document.getElementById('img');
const errorFormDiv = document.getElementById('error-form');

categorieSelect.addEventListener('blur', () => {
  if (categorieSelect.value === "") {
    errorFormDiv.innerHTML = "Veuillez sélectionner une catégorie";
    errorFormDiv.style.color = "red";
    categorieSelect.style.borderColor = "red";
  } else {
    errorFormDiv.innerHTML = "";
    categorieSelect.style.borderColor = "";
  }
});

titreInput.addEventListener('blur', () => {
  if (titreInput.value === "") {
    errorFormDiv.innerHTML = "Veuillez saisir un titre";
    errorFormDiv.style.color = "red";
    titreInput.style.borderColor = "red";
  } else {
    errorFormDiv.innerHTML = "";
    titreInput.style.borderColor = "";
  }
});

chapoTextarea.addEventListener('blur', () => {
  if (chapoTextarea.value === "") {
    errorFormDiv.innerHTML = "Veuillez saisir un chapô";
    errorFormDiv.style.color = "red";
    chapoTextarea.style.borderColor = "red";
  } else {
    errorFormDiv.innerHTML = "";
    chapoTextarea.style.borderColor = "";
  }
});

contenuTextarea.addEventListener('blur', () => {
  if (contenuTextarea.value === "") {
    errorFormDiv.innerHTML = "Veuillez saisir un contenu";
    errorFormDiv.style.color = "red";
    contenuTextarea.style.borderColor = "red";
  } else {
    errorFormDiv.innerHTML = "";
    contenuTextarea.style.borderColor = "";
  }
});

imgInput.addEventListener('blur', () => {
  if (imgInput.files.length === 0) {
    errorFormDiv.innerHTML = "Veuillez sélectionner une image";
    errorFormDiv.style.color = "red";
    imgInput.style.borderColor = "red";
  } else {
    errorFormDiv.innerHTML = "";
    imgInput.style.borderColor = "";
  }
});
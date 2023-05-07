window.addEventListener('load', () => {
    let boutons = document.querySelectorAll('.form-check-input');

    for(let bouton of boutons){
        bouton.addEventListener('click', activer);
    }
})

/**
 * send request with data-id value, update "actif"
 */
function activer()
{
    let xmlhttp = new XMLHttpRequest;

    xmlhttp.open('GET', '/admin/activeCommentaire/'+this.dataset.id);

    xmlhttp.send();
}
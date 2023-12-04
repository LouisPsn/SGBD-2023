window.onload = () => {
    new DataTable('#example');
}

function changerAffichageAjout() {
    let select = document.getElementById("selection");
    let value = select.options[select.selectedIndex].value;
    switch (value) {
        case "ajout_etudiant":
            document.getElementById("form-ajout-etudiant").className = "";
            document.getElementById("form-ajout-voiture").className = "d-none";
            document.getElementById("form-ajout-ville").className = "d-none";
            document.getElementById("form-modification-etudiant").className = "d-none";
            document.getElementById("form-modification-voiture").className = "d-none";
            break;
        case "ajout_voiture":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "";
            document.getElementById("form-ajout-ville").className = "d-none";
            document.getElementById("form-modification-etudiant").className = "d-none";
            document.getElementById("form-modification-voiture").className = "d-none";
            break;
        case "ajout_ville":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "d-none";
            document.getElementById("form-ajout-ville").className = "";
            document.getElementById("form-modification-etudiant").className = "d-none";
            document.getElementById("form-modification-voiture").className = "d-none";
            break;
        case "modification_etudiant":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "d-none";
            document.getElementById("form-ajout-ville").className = "d-none";
            document.getElementById("form-modification-etudiant").className = "";
            document.getElementById("form-modification-voiture").className = "d-none";
            break;
        case "modification_voiture":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "d-none";
            document.getElementById("form-ajout-ville").className = "d-none";
            document.getElementById("form-modification-etudiant").className = "d-none";
            document.getElementById("form-modification-voiture").className = "";
            break;
    }
}


var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
})
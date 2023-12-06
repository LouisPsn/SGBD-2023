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
            document.getElementById("form-modification-mot-de-passe").className = "d-none";
            break;
        case "ajout_voiture":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "";
            document.getElementById("form-ajout-ville").className = "d-none";
            document.getElementById("form-modification-etudiant").className = "d-none";
            document.getElementById("form-modification-voiture").className = "d-none";
            document.getElementById("form-modification-mot-de-passe").className = "d-none";
            break;
        case "ajout_ville":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "d-none";
            document.getElementById("form-ajout-ville").className = "";
            document.getElementById("form-modification-etudiant").className = "d-none";
            document.getElementById("form-modification-voiture").className = "d-none";
            document.getElementById("form-modification-mot-de-passe").className = "d-none";
            break;
        case "modification_etudiant":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "d-none";
            document.getElementById("form-ajout-ville").className = "d-none";
            document.getElementById("form-modification-etudiant").className = "";
            document.getElementById("form-modification-voiture").className = "d-none";
            document.getElementById("form-modification-mot-de-passe").className = "d-none";
            break;
        case "modification_voiture":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "d-none";
            document.getElementById("form-ajout-ville").className = "d-none";
            document.getElementById("form-modification-etudiant").className = "d-none";
            document.getElementById("form-modification-voiture").className = "";
            document.getElementById("form-modification-mot-de-passe").className = "d-none";
            break;
        case "modification_mot_de_passe":
            document.getElementById("form-ajout-etudiant").className = "d-none";
            document.getElementById("form-ajout-voiture").className = "d-none";
            document.getElementById("form-ajout-ville").className = "d-none";
            document.getElementById("form-modification-etudiant").className = "d-none";
            document.getElementById("form-modification-voiture").className = "d-none";
            document.getElementById("form-modification-mot-de-passe").className = "";
            break;
    }
}



function changerAffichageStats() {
    let select = document.getElementById("selection");
    let value = select.options[select.selectedIndex].value;
    switch (value) {
        case "classement_villes":
            document.getElementById("stat1").className = "col";
            document.getElementById("stat2").className = "d-none";
            document.getElementById("stat3").className = "d-none";
            document.getElementById("stat4").className = "d-none";
            break;
        case "classement_conducteurs":
            document.getElementById("stat1").className = "d-none";
            document.getElementById("stat2").className = "col";
            document.getElementById("stat3").className = "d-none";
            document.getElementById("stat4").className = "d-none";
            break;
        case "moyenne_passagers":
            document.getElementById("stat1").className = "d-none";
            document.getElementById("stat2").className = "d-none";
            document.getElementById("stat3").className = "col";
            document.getElementById("stat4").className = "d-none";
            break;
        case "moyenne_distances":
            document.getElementById("stat1").className = "d-none";
            document.getElementById("stat2").className = "d-none";
            document.getElementById("stat3").className = "d-none";
            document.getElementById("stat4").className = "col";
            break;
    }
}


var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
    myInput.focus()
})
    let interventions = [];

let id;


document.querySelectorAll(".reservation").forEach(function (element) {
    element.addEventListener("click", async function () {
        document.querySelector(".nomClientIntervention").innerHTML = element.textContent;

        id = element.id;

        let data = await (await fetch(`http://sae.test/assets/php/request/getOperationListForIntervention.php?id=${element.id}`)).json()

        document.querySelectorAll(".aIntervention").forEach(function (element) {
            element.remove();
        });

        let parent = document.querySelector(".left");

        data.forEach(function (element) {
            let libelle = getLibelle(element.codeop.trim());

            parent.innerHTML += `<section class="aIntervention"><p>${libelle}</p><img src="../assets/img/not%20done.png" alt=""></section>`;
        });
    });
});

document.querySelector(".addIntervention").style.display = "none";

document.querySelector("#typeIntervention").addEventListener("change", function () {
    if (this.value !== "0") {
        document.querySelector(".addIntervention").style.display = "block";
    } else {
        document.querySelector(".addIntervention").style.display = "none";
    }
});

document.querySelector(".validerIntervention").addEventListener("click", async function () {
    for (const element of interventions) {
        await (await fetch(`http://sae.test/assets/php/request/addIntervention.php?id=${id}&codeop=${getIdLibelle(element)}`)).json();
    }
    window.reload();
});

document.querySelector(".addIntervention").addEventListener("click", function () {
    let type = getSelectValue("typeIntervention");
    interventions.push(type);

    console.log(type)


    let parent = document.querySelector(".left");

    parent.innerHTML += `<section class="aIntervention"><p>${type}</p><img src="../assets/img/not%20done.png" alt=""></section>`;

});

function getLibelle(libelle){
    switch (libelle.trim()) {
        case "ChangPneuAVG":
            return "changement pneu avant gauche";
        case "Vidange":
            return "vidange";
        case "Nettoyage":
            return "nettoyage";
        case "DemontBoitVitesse":
            return "démontage boite de vitesse";
        case "ChangPneuAVD":
            return "changement pneu avant droit";
    }
}

function getIdLibelle(libelle){
    switch (libelle) {
        case "changement pneu avant gauche":
            return "ChangPneuAVG";
        case "vidange":
            return "Vidange";
        case "nettoyage":
            return "Nettoyage";
        case "démontage boite de vitesse":
            return "DemontBoitVitesse";
        case "changement pneu avant droit":
            return "ChangPneuAVD";
    }
}

function getSelectValue(selectId)
{
    let selectElmt = document.getElementById(selectId);
    return selectElmt.options[selectElmt.selectedIndex].value;
}
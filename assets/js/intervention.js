let interventions = [];
let id;
let deletedInterventions = [];
let operations = [];

document.querySelectorAll(".reservation").forEach(function (element) {
    element.addEventListener("click", async function () {
        document.querySelector(".nomClientIntervention").innerHTML = element.textContent;
        document.querySelector(".heureIntervention").innerHTML = document.querySelector(".timeDate").textContent;
        document.querySelector("#popUpRDV").style.display = "inherit";
        id = element.id;

        let data = await (await fetch(`http://sae.test/assets/php/request/getOperationListForIntervention.php?id=${element.id}`)).json()

        document.querySelectorAll(".aIntervention").forEach(function (element) {

            element.remove();
        });

        let parent = document.querySelector(".left");

        data.forEach(function (element) {

            let bigElement = document.createElement("section");
            bigElement.classList.add("aIntervention");

            let libelleElement = document.createElement("p");
            libelleElement.textContent = element.codeop;
            bigElement.appendChild(libelleElement);

            let img = document.createElement("img");
            img.classList.add("removeItem");
            img.src = "../assets/img/not%20done.png";
            img.addEventListener("click", function () {
                let libelle = this.parentElement.firstElementChild.textContent;
                deletedInterventions.push(libelle);
                this.parentElement.remove();
            });

            bigElement.appendChild(img);
            parent.appendChild(bigElement);
        });
    });
});

document.querySelector(".close").addEventListener("click", function () {
    document.querySelector("#popUpRDV").style.display = "none";
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
        await (await fetch(`http://sae.test/assets/php/request/addIntervention.php?id=${id}&codeop=${element}`)).json();
    }
    for(const element of deletedInterventions){
        await (await fetch(`http://sae.test/assets/php/request/deleteIntervention.php?id=${id}&codeop=${element}`)).json();
    }
    interventions = [];
    deletedInterventions = [];
    document.querySelector("#popUpRDV").style.display = "none";
});

document.querySelector(".addIntervention").addEventListener("click", async function () {
    let type = getSelectValue("typeIntervention");
    let alreadyExist = false;
    document.querySelectorAll(".aIntervention").forEach(function (element) {
        if (element.firstElementChild.textContent === type) {
            alreadyExist = true;
        }
    });
    if (!alreadyExist) {
        interventions.push(type);
        let parent = document.querySelector(".left");

        let section = document.createElement("section");
        section.classList.add("aIntervention");

        let p = document.createElement("p");
        p.textContent = type;

        let img = document.createElement("img");
        img.classList.add("removeItem");
        img.src = "../assets/img/not%20done.png";
        img.alt = "reminterventionLeftove";
        img.addEventListener("click", function () {
            let libelle = this.parentElement.firstElementChild.textContent;
            deletedInterventions.push(libelle);
            this.parentElement.remove();
        });

        section.appendChild(p);
        section.appendChild(img);
        parent.appendChild(section);
    }else{
        alert("Cette intervention est déjà présente");
    }
});
function getSelectValue(selectId)
{
    let selectElmt = document.getElementById(selectId);
    return selectElmt.options[selectElmt.selectedIndex].value;
}

getData();
async function getData(){
    operations = await (await fetch("http://sae.test/assets/php/request/getOperations.php")).json();
}
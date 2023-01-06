Operations=[]
let prixOperation = [];

let prixTotalIntervention = 0.0;

let operationForOneInervention =[];

function operationSelect(Operations) {
    for (let i = 0; i < Operations.length; i++) {
        let operation = Operations[i];
        let option = document.createElement("option");
        option.value = operation.codeop;
        option.text = operation.libelleop;
        document.getElementById("operations").appendChild(option);
    }
}

async function init() {
    idContactCourant = -2;


    let ops = await (await fetch(`http://sae.test/assets/php/request/getOperations.php`)).json();
    setOperation(ops);

    operationSelect(Operations);

    let positionidOpe = 0;
    for (let i = 0; i < Operations.length; i++) {
        if (Operations[i].id === idOpe) {
            positionidOpe = i;


        }
    }
    let newOperation = document.createElement("section");
    let newH2 = document.createElement("h2")
    let newContent = document.createTextNode(Operations[positionidOpe].id);
    let supprsection = document.createElement("section");
    supprsection.classList.add("buttonSupprOpe");
    supprsection.id = Operations[positionidOpe].id;

    let textSuppre = document.createTextNode("-");
    supprsection.appendChild(textSuppre);
    supprsection.addEventListener('click', supprOperations);

    newH2.appendChild(newContent)
    newOperation.id = Operations[positionidOpe].id
    newOperation.classList.add("interventionRDV")
    newOperation.appendChild(newH2);
    newOperation.appendChild(supprsection);
    let sectionOperationRDV = document.getElementById("interventionRDV");
    sectionOperationRDV.appendChild(newOperation);
    operationForOneInervention.push(Operations[positionidOpe].id);
    prixOperation.push(Operations[positionidOpe].codetarif);
}


function supprOperations(){
    let idrequest = this.getAttribute('id');
    let positionI=operationForOneInervention.indexOf(idrequest);
    if (positionI > -1) {
        operationForOneInervention.splice(positionI, 1);
        prixOperation.splice(positionI,1);
    }
    console.log("operationForOneIntervention",operationForOneInervention);
    console.log("prixOperation",prixOperation);
    document.getElementById(idrequest).classList.add("hidden");
    changerPrix();
}

function rafraichir(idOpe) {
    let positionidOpe=0;
    for (let i = 0; i < Operations.length; i++) {
        if (Operations[i].codeop===idOpe){
            positionidOpe=i;
        }
    }
    let newOperation = document.createElement("section");
    let newH2 = document.createElement("h2")
    let newContent = document.createTextNode(Operations[positionidOpe].codeop);
    let supprsection = document.createElement("section");
    supprsection.classList.add("buttonSupprOpe");
    supprsection.id =Operations[positionidOpe].codeop;

    let textSuppre = document.createTextNode("-");
    supprsection.appendChild(textSuppre);
    supprsection.addEventListener('click', supprOperations);

    newH2.appendChild(newContent)
    newOperation.id = Operations[positionidOpe].codeop
    newOperation.classList.add("interventionRDV")
    newOperation.appendChild(newH2);
    newOperation.appendChild(supprsection);
    let sectionOperationRDV = document.getElementById("interventionRDV");
    sectionOperationRDV.appendChild(newOperation);
    operationForOneInervention.push(Operations[positionidOpe].codeop);
    prixOperation.push(Operations[positionidOpe].codetarif);

    document.cookie = "operationForOneInervention=" + operationForOneInervention;
    document.cookie = "prixTotal=" + prixIntervention;
    console.log(operationForOneInervention);
    changerPrix()
}

async function changerPrix(){
    prixTotalIntervention=0.0;
    let data =await (await fetch(`http://sae.test/assets/php/request/getCountHorraire.php`)).json();
    if(prixOperation.length===0){
        prixOperation=0.0;
    }
    else{
        for (let codePrix of prixOperation) {
            codePrix = codePrix.toString();
            if (codePrix.length === 1) {
                codePrix += ' ';
            }
            for (let info of data) {

                if (info['codetarif'] === codePrix) {

                    prixTotalIntervention += parseFloat(info['couthoraireactuelht']);
                }
            }
        }
    }
    document.getElementById("prixIntervention").innerHTML=prixTotalIntervention.toFixed(2);
}








Operations=[
/*    { "id":"ChangPneuAVG",
    "libelleop":"chPnAVG",
    "dureeop":0.3,
    "codetarif":5 }
,

    { "id":"Vidange",
        "libelleop":"VidFiltHuil",
        "dureeop":1.3,
        "codetarif":4 }
    ,

    { "id":"ChangPneuAVD",
        "libelleop":"ChPnAVD",
        "dureeop":0.3,
        "codetarif":5}
    ,
    { "id":"Nettoyage",
        "libelleop":"Nettoy",
        "dureeop":0.1,
        "codetarif":2}
    ,
    { "id":"DemontBoitVitesse" ,
        "libelleop":"DmtBVits",
        "dureeop":2,
        "codetarif":7}*/
];

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

    // let positionidOpe = 0;
    // for (let i = 0; i < Operations.length; i++) {
    //     if (Operations[i].codeop === idOpe) {
    //         positionidOpe = i;
    //     }
    // }
    // let newOperation = document.createElement("section");
    // let newH2 = document.createElement("h2")
    // let newContent = document.createTextNode(Operations[positionidOpe].codeop);
    // let supprsection = document.createElement("section");
    // supprsection.classList.add("buttonSupprOpe");
    // supprsection.id = Operations[positionidOpe].codeop;
    //
    // let textSuppre = document.createTextNode("-");
    // supprsection.appendChild(textSuppre);
    // supprsection.addEventListener('click', supprOperations);
    //
    // newH2.appendChild(newContent)
    // newOperation.id = Operations[positionidOpe].codeop
    // newOperation.classList.add("interventionRDV")
    // newOperation.appendChild(newH2);
    // newOperation.appendChild(supprsection);
    // let sectionOperationRDV = document.getElementById("interventionRDV");
    // sectionOperationRDV.appendChild(newOperation);
    // operationForOneInervention.push(Operations[positionidOpe].codeop);
    // prixOperation.push(Operations[positionidOpe].codetarif);
}

function supprOperations(){
    let idrequest = this.getAttribute('id');
    let positionI=operationForOneInervention.indexOf(idrequest);
    if (positionI > -1) {
        operationForOneInervention.splice(positionI, 1);
        prixOperation.splice(positionI,1);
    }
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
    changerPrix()
}


async function changerPrix(){
    prixTotalIntervention=0.0;
    let data =await (await fetch(`http://sae.test/assets/php/request/getCountHorraire.php`)).json();
    if(prixOperation.length===0){
        prixOperation=0;
    }
    else{
        for (let codePrix of prixOperation) {
            codePrix = codePrix.toString();
            if (codePrix.length === 1) {
                codePrix += ' ';
            }
            for (let info of data) {
                if(info.codetarif.trim()===codePrix.trim()){
                    console.log(info.couthoraireactuelht);
                    console.log(typeof info.couthoraireactuelht);
                    prixTotalIntervention+=parseInt(info.couthoraireactuelht);
                }

                /*for (let i of info) {
                    if (i.codetarif === codePrix) {
                        prixTotalIntervention += parseFloat(info[i].couthoraireactuelht);
                    }
                }*/
                /*if (info.codetarif === codePrix) {
                    prixTotalIntervention += parseFloat(info.codetarif);
                    console.log(info.codetarif)
                }*/
            }
        }
    }
    document.getElementById("prixIntervention").innerHTML=prixTotalIntervention.toFixed(2);
}


function setOperation(data){
    for(let element in data){
        Operations.push(data[element]);
    }
}
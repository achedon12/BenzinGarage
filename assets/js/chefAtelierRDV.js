Operations=[
    { "id":"ChangPneuAVG",
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
        "codetarif":7}
]
let prixOperation = [];

let prixTotalIntervention = 0.0;

let operationForOneInervention =[];


function operationSelect(Operations) {
    for (let i = 0; i < Operations.length; i++) {
        let operation = Operations[i];
        let option = document.createElement("option");
        option.value = operation.id;
        option.text = operation.id ;
        document.getElementById("operations").appendChild(option);
    }
}

function init() {
    idContactCourant = -2;
    operationSelect(Operations);
}




function supprOperations(){
    let idrequest = this.getAttribute('id');
    let positionI=operationForOneInervention.indexOf(idrequest);
    if (positionI > -1) {
        operationForOneInervention.splice(positionI, 1);
    }
    console.log(operationForOneInervention);

    document.getElementById(idrequest).classList.add("hidden");

}

function rafraichir(idOpe) {
    let positionidOpe=0;
    for (let i = 0; i < Operations.length; i++) {
        if (Operations[i].id===idOpe){
            positionidOpe=i;
        }
    }
    let newOperation = document.createElement("section");
    let newH2 = document.createElement("h2")
    let newContent = document.createTextNode(Operations[positionidOpe].id);
    let supprsection = document.createElement("section");
    supprsection.classList.add("buttonSupprOpe");
    supprsection.id =Operations[positionidOpe].id;

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
    // console.log(operationForOneInervention);

    document.cookie = "operationForOneInervention=" + operationForOneInervention;
    document.cookie = "prixTotal=" + prixIntervention;

    changerPrix()


}


async function changerPrix(){
    prixTotalIntervention=0.0;
    let data =await (await fetch(`http://benzingarage.test/assets/php/request/getCountHorraire.php`)).json();
    for (let codePrix of prixOperation) {
        // console.log(codePrix);
        // console.log("test : ",data);
        codePrix=codePrix.toString();
        if(codePrix.length===1){
            codePrix+=' ';
        }
        for (let info of data) {

            if (info['codetarif']===codePrix){

                prixTotalIntervention += parseFloat(info['couthoraireactuelht']);
            }
        }



        // console.log(data);
        document.getElementById("prixIntervention").innerHTML=prixTotalIntervention.toFixed(2);

    }
}




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
let idOperation;


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
    // Dans un deuxième temps, on ira chercher les contacts avec une requête AJAX, on se contente pour l'instant
    // d'afficher la liste préchargée
    operationSelect(Operations);
}

function rafraichir(idOpe) {
    let positionidOpe=0;
    for (let i = 0; i < Operations.length; i++) {
        if (Operations[i].id===idOpe){
            positionidOpe=i;
        }
    }
    console.log(typeof(positionidOpe));
    let newOperation = document.createElement("section");
    let newH2 = document.createElement("h2")
    let newContent = document.createTextNode(Operations[positionidOpe].id);
    newH2.appendChild(newContent)
    newOperation.classList.add("interventionRDV")
    newOperation.appendChild(newH2);
    let sectionOperationRDV = document.getElementById("interventionRDV");
    sectionOperationRDV.appendChild(newOperation);
}

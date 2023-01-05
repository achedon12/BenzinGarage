let id;
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
            parent.appendChild(bigElement);
        });
    });
});

document.querySelector(".close").addEventListener("click", function () {
    document.querySelector("#popUpRDV").style.display = "none";
});


document.querySelector("#typeIntervention").addEventListener("change", function () {
    if (this.value !== "0") {
        document.querySelector(".addIntervention").style.display = "block";
    } else {
        document.querySelector(".addIntervention").style.display = "none";
    }
});

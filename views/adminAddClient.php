<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../assets/css/utilisateurAdministrateur.css">
    <link rel="stylesheet" href="../assets/css/adminAddClient.css"></link>
</head>
<body>
<nav>
    <img src="../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="#" >Accueil</a></li>
        <li class="hover"><a href="#">Utilisateur</a></li>
        <li><a href="#">Tarification</a></li>
        <li><a href="#">Stock</a></li>
        <li><a href="#">Intervention</a></li>
        <li><a href="#">Deconnexion</a></li>
    </ul>
</nav>
<main>
    <aside>
        <section class="liste">
            <a href="#" class="aListeOptionAdmin"><p>Tableau de bord</p></a>

            <a href="#" class=" aListeOptionAdmin hoverli "><p>Client</p></a>
            <section class="sousListeSection">
                <a class="hoverliSousList" href="#"><p>Ajouter un client</p></a>
                <a href=""><p>Modifier un client</p></a>
                <a href=""><p>Supprimer un client</p></a>
            </section>
            <a href="#" class="aListeOptionAdmin"><p>Garage</p></a>
        </section>
    </aside>
    <section class="addClientWindow">
        <section class="sectionCenterAddClient">
            <form>
            <h1>Créer un client</h1>

                <h2>Nom di client</h2>
                <input type="text">

                <h2>Prénom du client</h2>
                <input type="text">

                <h2>Age du client</h2>
                <input type="text">

                <h2>Téléphone du client</h2>
                <input type="text">

                <h2>Email du client</h2>
                <input type="text">
            </form>
        </section>
    </section>
</main>

</body>
</html>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Supprimer un client</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../assets/css/utilisateurAdministrateur.css">
    <link rel="stylesheet" href="../assets/css/adminAddClient.css">
    <link rel="stylesheet" href="../assets/css/adminEditClient.css">
    <link rel="stylesheet" href="../assets/css/adminRemoveClient.css">

</head>
<body>
    <nav>
        <img src="../assets/img/logo.png" alt="logo">
        <ul>
            <li><a href="/accueil/admin" >Accueil</a></li>
            <li class="hover"><a href="/admin/utilisateur">Utilisateur</a></li>
            <li><a href="#">Tarification</a></li>
            <li><a href="#">Stock</a></li>
            <li><a href="/admin/interventionPlanning">Intervention</a></li>
            <li><a href="#">Deconnexion</a></li>
        </ul>
    </nav>
    <main>
        <aside>
            <section class="liste">
                <a href="utilisateur" class="aListeOptionAdmin"><p>Tableau de bord</p></a>

                <a href="addClient" class=" aListeOptionAdmin hoverli "><p>Client</p></a>
                <section class="sousListeSection">
                    <a  href="/admin/addClient"><p>Ajouter un client</p></a>
                    <a  href="/admin/editClient"><p>Modifier un client</p></a>
                    <a class="hoverliSousList" href="/admin/removeClient"><p>Supprimer un client</p></a>
                </section>
                <a href="/admin/addEmploye" class="aListeOptionAdmin"><p>Garage</p></a>
            </section>
        </aside>
        <section class="windowEditClient">
            <section class="listClient">
                <a href="#">Mr Dupont</a>
                <a href="#">Mme De L'arbre</a>
                <a href="#">Mr Jean</a>
                <a href="#">Mme Delettre</a>
                <a href="#">Mme Louise</a>
                <a href="#">Mr Marquis</a>
                <a href="#">Mme Loise</a>
                <a href="#">test</a>
            </section>


            <section class="infoClient">
                <section class="infoClientDel">
                    <p>Nom : Mr Jean-Marc Dupont</p>
                    <p>Téléphone : 06 48 89 15 32</p>
                    <p>Age : 46 ans</p>
                    <p>Voiture : Citroën C4</p>
                    <p>Plaque 25 - D8E - FT</p>
                    <button type="button" onclick=""> Supprimer le client</button>
                </section>
            </section>

        </section>
    </main>

</body>
</html>


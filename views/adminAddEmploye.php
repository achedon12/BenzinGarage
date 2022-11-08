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
            <a href="/admin/utilisateur" class="aListeOptionAdmin"><p>Tableau de bord</p></a>

            <a href="/admin/addClient" class=" aListeOptionAdmin  "><p>Client</p></a>
            <a href="/admin/addEmploye" class="aListeOptionAdmin hoverli"><p>Garage</p></a>
            <section class="sousListeSection">
                <a class="hoverliSousList" href="/admin/"><p>Ajouter un employé</p></a>
                <a href="/admin/"><p>Modifier un employé</p></a>
                <a href="/admin/"><p>Supprimer un employé</p></a>
            </section>
        </section>
    </aside>
    <section class="addClientWindow">
        <section class="sectionCenterAddClient">
            <form>
                <h1>Créer un employé</h1>
                <section class="inputAddClient">
                    <h2>Nom de l'employé : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Prénom de l'employé : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Age de l'employé : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Téléphone de l'employé : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Email de l'employé : </h2>
                    <input type="text">
                </section>
                <section class="inputAddClient">
                    <h2>Rôle de l'employé : </h2>
                    <input type="text">
                </section>
                <input type="submit" class="submitFormAddClient" value="Créer un employé">
            </form>
        </section>
    </section>
</main>

</body>
</html>
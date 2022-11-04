<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/accueilAdmin.css">
    <link rel="stylesheet" href="../assets/css/utilisateurAdministrateur.css">
    <link rel="stylesheet" href="../assets/css/adminAddClient.css">
    <link rel="stylesheet" href="../assets/css/adminEditClient.css">
</head>
<body>
<nav>
    <img src="../assets/img/logo.png" alt="logo">
    <ul>
        <li><a href="/accueil/admin">Accueil</a></li>
        <li class="hover"><a href="/admin/utilisateur">Utilisateur</a></li>
        <li><a href="#">Tarification</a></li>
        <li><a href="#">Stock</a></li>
        <li ><a href="/admin/interventionPlanning">Intervention</a></li>
        <li><a href="#">Deconnexion</a></li>
    </ul>
</nav>
<main>
    <aside>
        <section class="liste">
            <a href="#" class="aListeOptionAdmin"><p>Tableau de bord</p></a>

            <a href="#" class=" aListeOptionAdmin hoverli "><p>Client</p></a>
            <section class="sousListeSection">
                <a  href="/admin/addClient"><p>Ajouter un client</p></a>
                <a class="hoverliSousList"  href="#"><p>Modifier un client</p></a>
                <a href=""><p>Supprimer un client</p></a>
            </section>
            <a href="#" class="aListeOptionAdmin"><p>Garage</p></a>
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
            <form action="">
                <label>Prénom<input type="text" id="prenomUser" name="prenom" /></label>



            </form>
        </section>


    </section>
</main>

</body>
</html>
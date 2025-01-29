<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/png" href="../Content/images/logo2.png" />
    <link rel="stylesheet" href="../Content/css/header.css" /> 
    <link rel="stylesheet" href="../Content/css/end_foter.css" />  
    <link rel="stylesheet" href="../Content/css/haha.css" />  
    <link rel="stylesheet" href="../Content/css/login_cnx.css" />  

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Perform Vision</title>
</head>
<body>

<header>
<div class="container">    
    <nav>
        <img src="../Content/images/logo2.png" alt="Perform Vision" class="logo_perform_vision">
        
        <button class="hamburger" onclick="toggleMenu()">☰</button>
        <ul class="nav-links">


            <li class="dropdown">
                <a class="nav-item">Fonctionnalités Admin ▼</a>
                <div class="dropdown-content">
                    <a href="index.php?controller=promouvoir">Promouvoir des formateurs en modérateurs</a>
                    <a href="">Ajouter des activités à la société</a>
                </div>
            </li>

            <li class="dropdown">
            <a class="nav-item">Liste Formateur ▼</a>
                <div class="dropdown-content">
                    <a href="index.php?controller=client">Liste Formateur</a>
                    <a href="index.php?controller=formateur&action=option">Espace Formateur</a>
                </div>
            </li>
            <li class="nav-item"><a href="index.php?controller=activite">Activité</a></li>
            <li class="nav-item"><a href="#" class="nav-link">À propos de Nous</a></li>

            

            <li class="nav-item">
                <button type="button" role="button" class="btn" id="displayForm" onclick="openLoginPage()">se connecter</button>
                <button type="button" role="button" class="btn" id="registerButtonInside"onclick="opensignPage()">S'inscrire </button>
            </li>
        </ul>
    </nav>
</div>

</header>

<script>
        function opensignPage() {
            // Ouvrir la page de connexion
            window.location.href = "index.php?controller=connexion&action=dologin";
        }

            function openLoginPage() {
            // Ouvrir la page de inscription
            window.location.href = "index.php?controller=inscription&action=inscription";
            }
</script>




<script>
function toggleMenu() {
    var x = document.querySelector(".nav-links");
    if (x.style.display === "block") {
        x.style.display = "none";
    } else {
        x.style.display = "block";
    }
}
</script>

	


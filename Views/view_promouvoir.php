<?php 



?>
   

		<link rel="stylesheet" href="../Content/css/client.css" />
		<link rel="stylesheet" href="../Content/css/header.css" />
		<link rel="stylesheet" href="../Content/css/end_foter.css" />
        <link href="http://fonts.cdnfonts.com/css/wittierly" rel="stylesheet">
        <style>  @import url('http://fonts.cdnfonts.com/css/wittierly');</style>
        <link rel="preconnect" href="https://fonts.googleapis.com">    


    
        <header>
<div class="container">    
    <nav>
        <img src="../Content/images/logo2.png" alt="Perform Vision" class="logo_perform_vision">
        
        <button class="hamburger" onclick="toggleMenu()">☰</button>
        <ul class="nav-links">


            <li class="dropdown">
                <a class="nav-item">Fonctionnalités Admin ▼</a>
                <div class="dropdown-content">
                    <a href="view_promouvoir.php">Promouvoir des formateurs en modérateurs</a>
                    <a href="">Ajouter des activités à la société</a>
                </div>
            </li>

            <li class="dropdown">
            <a class="nav-item">Liste Formateur ▼</a>
                <div class="dropdown-content">
                    <a href="view_client.php">Liste Formateur</a>
                    <a href="view_formateur.php">Espace Formateur</a>
                </div>
            </li>
            <li class="nav-item"><a href="#">Activité</a></li>
            <li class="nav-item"><a href="#" class="nav-link">À propos de Nous</a></li>

            <li class="dropdown">
            <a class="nav-item">FR ▼</a>
                <div class="dropdown-content">
                    <a href="view_anglais.php">ANG</a>


                </div>
            </li>

            <li class="nav-item">
                <button type="button" role="button" class="btn" id="displayForm" onclick="openLoginPage()">se connecter</button>
                <button type="button" role="button" class="btn" id="registerButtonInside"onclick="opensignPage()">S'inscrire </button>
            </li>
        </ul>
    </nav>
</div>

</header>

       <!---- c  /*liste des formateur/*-- --->
       <div class="gallary" id="Gallary">
    <h1>Nos<span>Formateurs</span></h1>
    <?php 
    $m = Model::getModel();
    $t = $m->listeFormateur(); 
    $i = 0; // Initialiser un compteur
    foreach ($t as $formateur): 
        if ($i % 3 === 0): // Fermer la balise </div> après chaque troisième itération
            if ($i > 0): // Ne pas afficher </div> avant la première itération
                echo '</div>';
            endif;
            echo '<div class="gallary_image_box">';
        endif;
    ?>
    <div class="gallary_image">
        <img src="../Content/images/client" width="100" height="400">
        <h3><?php echo $m->getNomFormateur($formateur) . ' ' . $m->getPrenomFormateur($formateur); ?></h3>
        <p><?php echo $m->getNomThemeParUtilisateur($formateur); ?></p>
        <a href="javascript:void(0);" onclick="connectToTrainer('<?php echo $m->getNomFormateur($formateur); ?>')" class="gallary_btn">Promouvoir</a>
    </div>
    <?php 
        $i++; 
    endforeach; 
    echo '</div>'; // Fermer la dernière balise </div>
    ?>
</div>
   

    
    <script>
        function connectToTrainer(trainerName) {
        AnimationPlaybackEventwindow.location.href = 'view_contactTrainer.php?trainer=' + encodeURIComponent(trainerName);
        }
    </script>

<!--ajouter footer --->
<?php  ?>
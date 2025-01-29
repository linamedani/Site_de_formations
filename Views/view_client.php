<?php 
require 'view_begin.php';
?>
   

		<link rel="stylesheet" href="/Content/css/client.css" />
		<link rel="stylesheet" href="/Content/css/header.css" />
		<link rel="stylesheet" href="/Content/css/end_footer.css" />

        <link href="http://fonts.cdnfonts.com/css/wittierly" rel="stylesheet">
        <style>  @import url('http://fonts.cdnfonts.com/css/wittierly');</style>
        <link rel="preconnect" href="https://fonts.googleapis.com">    


        <main>
<section class="home">
     <div class="home_txt">
            <h1>Trouver un formateur facilement </h1>
           
         <div class="search-container">
            <input type="text" placeholder="Laissez-nous vous guider..." name="search">
            <button type="submit">Recherche</button>
        </div>

    </div>
        <img src="/Content/images/bg2.png" alt="Ordinateur" class="home_img">
</section>
</main>
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
        <img src="Content/images/client" width="100" height="400">
        <h3><?php echo $m->getNomFormateur($formateur) . ' ' . $m->getPrenomFormateur($formateur); ?></h3>
        <p><?php echo $m->getNomThemeParUtilisateur($formateur); ?></p>
        <a href="javascript:void(0);" onclick="connectToTrainer('<?php echo $m->getNomFormateur($formateur); ?>')" class="gallary_btn">Se connecter</a>
    </div>
    <?php 
        $i++; 
    endforeach; 
    echo '</div>'; // Fermer la dernière balise </div>
    ?>
</div>
   
<script>
    function connectToTrainer(trainerName) {
    // Option 1: Rediriger vers une nouvelle page avec le nom du formateur dans l'URL
    window.location.href = 'index.php?controller=contactTrainer&trainer=' + encodeURIComponent(trainerName);

    // Option 2: Ouvrir un modal sur la même page
    // Ici, vous pouvez écrire le code pour ouvrir un modal et afficher le nom du formateur
}
</script>
<?php require "view_end.php";?>
 
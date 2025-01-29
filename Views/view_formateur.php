<?php 
require "view_begin.php";

//require_once "../Controllers/Controller_connexion.php"; 
$m = Model::getModel();


?>
<link rel="stylesheet" href="../Content/css/haha.css">

<section class="home">
            <div class="home_txt">
            <h1>Bienvenue sur votre espace formateur chez performVision </h1>
            <?php  if (isset($_SESSION['roles']) && in_array('admin', $_SESSION['roles']) && in_array('formateur', $_SESSION['roles']) && count($_SESSION['roles']) === 2): ?>
             <a href="Views/view_formateur.php"style="color: white; font-weight: bold;font-family: 'Arial', sans-serif;font-size: 25px;text-decoration: none;">Je suis un formateur, </a>
                    <a href="?controller=admin&action=admin"style="color: white; font-weight: bold;font-family: 'Arial', sans-serif;font-size: 25px;text-decoration: none;"> Je suis un admin</a>
                <?php endif; ?>
                  
                
            </div>
                <img src="Content/images/bg2.png" alt="Ordinateur" class="home_img">

    <div class="form-container">
    <div class="title-frame">
        <h2>Ma fiche d'informations</h2>
    </div>
        <div class="forms-wrapper"> 
        <!-- Premier formulaire à droite -->
                <!-- block1 -->
                
            <div class="form-part right-form block1">
            
            <h3> Veuillez renseigner les informations suivantes : </h3>
        
            <div class=partie1>   
                <form action="?controller=formateur&action=option" method="post">
                <div class = 'cv_client'>
        
                    <h4> <em>Mon CV & Mon attestation </em> </h4>   
                    <label for="attestation" id="label_upload">Téléchargez votre attestation juste içi :                 
                        
                        <a href="Controllers/Controller_upload.php" target="_blank">Télécharger</a> 
                        <img src="Content/images/fichier.png" alt="Ordinateur" class="fa fa-download" style="width: 30px; height: 30px;">

                    </label> <br><br> 
                    
                    <label for="cv" id='cv_input'>Sélectionnez votre CV : 
                        <input type="file" name="cv"   >    
                        <img src="Content/images/cv.png" alt="Ordinateur" class="fas fa-file taille-image"style="width: 30px; height: 40px;">

                    </label>
                    
                    
                    </div>

                </div>
                        <!-- theme-->

                    <div class="theme">
                            <h4> <em> Thème de ma compétence : </em></h4>
                            
                    <p> <label for="theme"> choisir parmi les thémes qui existent déjà :
                    <select id="theme_choix" name="theme_choix">
                        <?php 
                        $themes = $m->getThemes();
                        
                        if (isset($themes ) && is_array($themes )) {
                            foreach ($themes as $t) {?>
                                <option value='<?=$t?>'><?=$t?></option>
                           <?php }
                        } else {
                            echo "<option value=''>Aucun thème trouvé</option>";
                        }
                    ?> 
                              
                        </select>  <br>
                        <br> si vous trouvez pas le théme veuillez saisir un nouveau : <br>
                <input type="text" class="btn_saisie" name="saisie_theme" >
                        </label> 
                    </p>
                    </div>
                        <!-- categorie -->

                        <div class="categorie">
                            <h4> <em> Catégorie de ma compétence : </em></h4>
                        <p> <label for="competence"> Ajouter votre compétence 
                        <select id="choix_categorie" name="choix_categorie">
                            
                            <?php 
                            $categories = $m->getCategorie();
                            if (isset($categories ) && is_array($categories )) {
                                foreach ($categories as $c) {
                                    echo "<option value='" . $c . "'>" . $c . "</option>";
                                }
                            } else {
                                echo "<option value=''>Aucun thème trouvé</option>";
                            }
                        ?> 
                        </select> <br>
                        <br> si vous trouvez pas la compétence veuillez saisir une nouvelle : <br>
                        <input type="text" name="compétence" class="btn_saisie"/> </label>
                        </p>
                            
                    </div>

            </div>

        <!-- Deuxième formulaire à gauche -->

        <div class="form-part left-form">
    <h3> Veuillez renseigner les informations suivantes : </h3>
                           <!-- expertise -->


        <div class="expertise ">

        <h4> <em> Mon expertise professionnelle dans cette compétence : </em></h4>
        <p>  <label for="expertisepro" >Niveau : 
        <select id="choix_niveau" name="choix">     
            <?php 
            $niveau = $m->getNiveaux();
            if (isset($niveau ) && is_array($niveau )) {
                foreach ($niveau as $n) {
                    echo "<option value='" . $n . "'>" . $n . "</option>";
                }
            } else {
                echo "<option value=''>Aucun thème trouvé</option>";
            }
        ?> 
        </select>   
        </label> 
        </p>
        <br>
    <label for="duree" class= "btn_commun"> la durée de votre expérience :
        <input type="text" id="dureeExp" name="dureeExp" > </label>

<label for="commentaire"> laisser un commentaire :

    <label for="commentaire"> laisser un commentaire :

<input type="text" class="commentaire" name="commentaire" placeholder="pas obligatoire">

    </div>
                <!-- sous_categorie -->

                <div class="sous_categorie">
                    <h4> <em> la sous-catégorie de ma compétence : </em></h4>
                    <p> <label for="sous_catégorie"> saisir la sous catégories de votre compétence :
                        <select id="choix_sous_categorie" name="choix_sous_categorie">
                        
                            <?php 
                            $niveau = $m->getSousCategorie();
                            if (isset($niveau ) && is_array($niveau )) {
                                foreach ($niveau as $s) {
                                    echo "<option value='" . $s . "'>" . $s . "</option>";
                                }
                            } else {
                                echo "<option value=''>Aucun thème trouvé</option>";
                            }
                        ?> 
                        </select>  <br>
                        <br> ou bien choisir parmi les compétences qui existent déjà   <br> 
                        <input type="text" class="btn_saisie" name="saisie_sous" /> 
                        <input type="hidden" name="idCategorieCompose" value="">                             
                            
                        </label>
                    </p>
                </div>
                                <!-- block  experience -->

                 <div class="experience">
                        <h4> <em> Mon experience dans cette compétence :</em></h4>
                <p> <label for="expertisepro" >Niveau : 
                <select id="choix_niveau" name="choix_niveau">     
                    <?php 
                    $niveau = $m->getNiveaux();
                    if (isset($niveau ) && is_array($niveau )) {
                        foreach ($niveau as $n) {
                            echo "<option value='" . $n . "'>" . $n . "</option>";
                        }
                    } else {
                        echo "<option value=''>Aucun thème trouvé</option>";
                        }
                ?> 
                </select>   
                </label>
                </p>
                <br>
            <label for="duree" class= "btn_commun"> la durée de votre expérience :
                <input type="text" id="dureeExp" name="dureeExp" > </label><br>
        

            <label for="commentaire"> laisser un commentaire (pas obligatoire) : <br>
                <input type="text" class="commentaire" name="commentairee_Exper" > </label>
        
            </div>
                
        </div>
    </div>

        <div id="envoie">
        <input type="submit" value="Enregistrer   Compétence et Thème" class="submit-button">
        </div>

        <div id="tableau">
<h2>Tableau des données soumises</h2>
        <table>
            <tr>
                <th>Nom du champ</th>
                <th>Valeur</th>
            </tr>
            <?php
            // Afficher les données du formulaire à partir de la session
            $_SESSION['formData']= $_POST;
            if (isset($_SESSION['formData'])) {
                foreach ($_SESSION['formData'] as $field => $value) {
                    echo "<tr>";
                    echo "<td>$field</td>";
                    echo "<td>$value</td>";
                    echo "</tr>";
                }
                // Effacer les données de la session après les avoir affichées
                // unset($_SESSION['formData']);
            }
            ?>
        </table>
</div>
    <?php 
   
   session_unset();
     ?>
<?php 
    require "view_begin.php";
    ?>
    <link rel="stylesheet" href="../Content/css/activite.css">
    <link href="http://fonts.cdnfonts.com/css/wittierly" rel="stylesheet">
    <style>  @import url('http://fonts.cdnfonts.com/css/wittierly');</style>
    <link rel="preconnect" href="https://fonts.googleapis.com">                               
    <title> Petits Plats Dans Les Grands</title>
    </head>
    <body class="home">
            


        <div id="header" class="not-sticky">
            <div class="container">
                
                    <div class="header-container">
                    
                    </div>
                </div>
            </div>
        </div>
        <main>
                <div class="container-xxl">
                    <div class="rootline"></div>
                </div>
                
                <div id="c54973" class="frame frame-default frame-type-sngpackage_deuxcolonnes frame-layout-0">
                </div>
                    
                    
                <div class="row">
                <div class="col-md-6">
                <div id="c54974" class="frame frame-default frame-type-sngpackage_bloch1 frame-layout-0">
                    
                
            <div class="bloc--title bloc--h1" >
                <div class="bloc--title-container">
                    <h1>Tous les Activité de Perform-Vision </h1>
                
                </div>
            </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="content_text">
                <div id="c54975" class="frame frame-default frame-type-text frame-layout-0">
                    <p class="align-justify"> Chez Perform Vision, notre engagement est de fournir une éducation et une formation de qualité supérieure. Notre équipe d'experts passionnés et dynamiques est dédiée à vous guider dans votre parcours d'apprentissage, en vous apportant un savoir-faire inégalé et une expérience pratique dans divers domaines. Nous croyons fermement en la puissance de l'éducation pour transformer des vies, c'est pourquoi nos formateurs, riches d'une vaste expérience, sont non seulement des enseignants mais 
                        aussi des mentors dévoués. Que ce soit pour des formations professionnelles, 
                        des ateliers spécialisés ou du coaching personnalisé, Perform Vision est votre partenaire 
                        idéal pour atteindre l'excellence et le succès dans votre carrière

                    <p class="align-justify">Chez Perform Vision, nous sommes dédiés à l'excellence sous toutes ses formes, qu'il s'agisse <strong> d'éducation </strong>,de<strong> réparation des distributeur </strong>,<strong> Menage et nettoyage </strong></p>
                   <h2>Nos activite actuel</h2>
                    

    <!-- Liste des activités -->
    <div id="activitesTable">
    <table>
        <thead>
            <tr>
                <th>Activité Ajouter</th>
            </tr>
        </thead>
        <tbody id="listeActivites">
          <li class="align-justify"><strong>Menage,</strong></li>
         <li class="align-justify"><strong>distributeur automatique</strong></li>
         <h2>Ajouter une nouvelle Activité</h2>

        <!-- Champ pour télécharger une image -->
        <input type="file" id="imageActivite" accept="image/*">
        <!-- Les activités ajoutées apparaîtront ici -->
        <button onclick="ajouterActivite()">Ajouter Activité</button>
        <div id="ajouterActivite">
        <input type="text" id="nomActivite" placeholder="Nom de l'activité">
    </div>
        </tbody>
    </table>
</div>                  

                </div>   
                </div>
                </div>

    
                </div>

            


    <div class="content_textpic">
        

                    
                
                <div class="csc-header csc-header-n1">
                    <h2 class="">
                    <CEnter>Activité</CEnter> 
                    </h2>
                </div>
                    

    


        </main>

        

        
            
            




    <span 
    id="votre_id1" class="target">
    </span>
    <span 
    id="votre_id2" class="target">
    </span>
    <span 
    id="votre_id3" class="target">
    </span>
    <span
    id="votre_id4" class="target">
    </span>
    <div class="cadre_diapo">
    <div class="interieur_diapo">
    
        <div
            class=description><span>Menage</span><img src="../Content/images/manage.jpg" width="1000" height="500"alt>
        </div>
        <div 
            class=description><span>distributeur automatique</span><img src="../Content/images/bani.jpg"width="1000" height="500" alt>
        </div>      
    
    </div>
        <ul     
                    class="navigation_diapo">
                        
                        <li>
                            <a href="#votre_id2"><img src="../Content/images/manage.jpg" width="100" height="80"  alt></a>
                        </li>
                        <li>
                            <a href="#votre_id3"><img src="../Content/images/bani.jpg"width="100" height="80"  alt></a>
                        </li>
                        
        </ul>
                    </div>


 <script>
      function ajouterActivite() {
    var nomActivite = document.getElementById('nomActivite').value;
    var imageActivite = document.getElementById('imageActivite').files[0];
    var galerie = document.querySelector('.navigation_diapo');
    var diapo = document.querySelector('.interieur_diapo');






    
    if (imageActivite) {
        var reader = new FileReader();
        reader.onload = function (event) {
            var uniqueId = 'votre_id' + Date.now(); // Crée un ID unique

            // Création et ajout de l'image dans le diaporama
            var imgDiapo = new Image(1000, 500);
            imgDiapo.src = event.target.result;
            var divDescription = document.createElement('div');
            divDescription.className = 'description';
            divDescription.appendChild(imgDiapo);
            diapo.appendChild(divDescription);

            // Création et ajout de l'image dans la navigation
            var imgNav = new Image(100, 80);
            imgNav.src = event.target.result;
            var a = document.createElement('a');
            a.href = '#' + uniqueId;
            a.appendChild(imgNav);
            var li = document.createElement('li');
            li.appendChild(a);
            galerie.appendChild(li);

            // Ajout de l'ID cible à l'élément de la diapositive
            var span = document.createElement('span');
            span.id = uniqueId;
            span.className = 'target';
            diapo.appendChild(span);
        };
        reader.readAsDataURL(imageActivite);

    }
    var nomActiviteValue = document.getElementById('nomActivite').value;
    if (nomActiviteValue) {
        var listItem = document.createElement('li');
        listItem.className = 'align-justify';
        listItem.innerHTML = '<strong>' + nomActiviteValue + '</strong>';
        document.getElementById('listeActivites').appendChild(listItem);
    }
}




    </script>
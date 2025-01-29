<?php require 'view_begin.php'; ?>
    <!-- categorie-home section starts  -->

    <section class="categorie-home" id="categorie-home">

        <h1 class="heading"> <span>Catégories</span> </h1>

        <div class="box-container">
            <?php
                if (isset($listCategories) && ($listCategories != null)) {
                    $i=0;
                    foreach ($listCategories as $key => $categorie) {
                        ?>
                            <div class="box" style="<?php $i++; if ($i > 6) echo "display: none;"; ?>">
                                <h3><?php echo e($categorie["categorie_nom"]) ?></h3>

                                <img width="200" src=<?php echo (!isset($categorie["categorie_img"]) ||  $categorie["categorie_img"]== null) ?  "Content/images/categorie.png" : ("uploads/images/".$categorie["categorie_img"])?> >
                                
                                <!--
                                <hr style="border-top: 1px solid gray;"/>

                                <a href="./view_categorie_detail.php?id_categorie=<?php //ehco $categorie["categorie_id"]; ?>" class="btn"> 
                                    Voir plus ... <span class="fas fa-chevron-right"></span> 
                                </a>
                                -->
                            </div>
                        <?php
                    }
                }
            ?>
        </div>

        <div style="cursor: pointer;text-align: right;" onclick="voirPlusDetail();">
                <span class="btn" id="btn-voir-plus"> 
                    <img width="25" src="Content/images/voir_plus.svg"> 
                    <span class="txt"> Voir plus ...</span> <span class="fas fa-chevron-right"></span> 
                </span>
        </div>
    </section>

    <!-- categorie-home section ends -->

    <!-- about section starts  -->

    <section class="about" id="about">

        <h1 class="heading"> <span>À Propos</span> </h1>
        <div class="row">
            <div class="content">
                <h3>Nous prenons soin de votre formation</h3>
                <p>Chez Perform Vision, nous sommes fiers de collaborer avec une équipe 
                    dynamique d'experts passionnés, prêts à vous guider tout au long de votre parcours 
                    d'apprentissage. Nos formateurs possèdent une vaste expérience dans leurs 
                    domaines respectifs, apportant non seulement un savoir-faire approfondi mais
                    aussi une passion indéniable pour l'éducation.
                </p>
                <!-- <a href="#" class="btn"> Lire plus <span class="fas fa-chevron-right"></span> </a> -->
            </div>

            <div class="image">
                <img src="Content/images/equipe_perform-vision.jpg" alt="">
            </div>

        </div>

    </section>

    <!-- Fin de la section À PROPOS -->

    
    <!-- Section avis des clients  -->
    <section class="review" id="review">
        
        <h1 class="heading"> <span>Avis des clients</span> </h1>

        <div class="box-container">

            <div class="box">
                <img src="Content/images/client-1.png" alt="">
                <h3>Zoubir</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">Nous avons choisi Perform Vision pour le 
                    professionnalisme et la réactivité de leurs équipes,
                    les possibilité de personnalisation et la facilité de 
                    prise en main de la plateforme.</p>
            </div>

            <div class="box">
                <img src="Content/images/client-2.png" alt="">
                <h3>Fatiha</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">Nous avons choisi Perform Vision pour sa facilité 
                    de prise en main pour nos apprenants et son ergonomie. Investir 
                dans Perform Vision a été positif, leur équipe est très réactive.</p>
            </div>

            <div class="box">
                <img src="Content/images/client-3.png" alt="">
                <h3>Omar</h3>
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <p class="text">INCROYAAABLE LES GAAARS.</p>
            </div>

        </div>

    </section>

    <script>
        let voirPlus = true;
        function voirPlusDetail() {
            let btnTxt = document.querySelector("#btn-voir-plus .txt");
            let fasBtnVP = document.querySelector("#btn-voir-plus span.fas");

            voirPlus = !voirPlus;
            let txt = "";

            if (voirPlus){
                txt = "Voir plus ...";
                fasBtnVP.classList.remove("fa-chevron-up");
                fasBtnVP.classList.add("fa-chevron-right");    
            }
            else{
                txt = "Voir moins";
                fasBtnVP.classList.remove("fa-chevron-right");
                fasBtnVP.classList.add("fa-chevron-up");
            }
            btnTxt.innerHTML = txt;

            //Afficher ou cacher les catégories ....
            let listOfCategoriesBoxes = document.querySelectorAll(".categorie-home .box-container .box");
            for (let i=5; i<listOfCategoriesBoxes.length; i++){
                listOfCategoriesBoxes[i].style["display"] = (voirPlus ? "none" : "grid");
            }
        }
    </script>

    <!-- fin de la section Avis des clients -->


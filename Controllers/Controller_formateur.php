<?php 
   


    class Controller_formateur extends Controller
    {
        public function action_option() {
            $m = Model::getModel();
            // Dans le contrôleur
            $data= [];
            $var_theme='';
            $var_catego= '';
            $var_souscat= '';
            $id_cate= '';
            $id_cate2= ''; 
            $var_expertise= '';
            $var_nv_expertise= '';
            $var_commentaire_expertise='';
            $var_experiance= '';
            $var_nv_experiance= '';
            $var_commentaire_experiance= '';
            $var_cv= '';
            $nv_expertise= '';
            $nv_experiance= '';
            //$mail = $_SESSION["user"];
            $msg = '';
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                

                // inserer Sous categorie 

                if (isset($_POST['saisie_sous'])) {
                    $var_souscat =  htmlspecialchars($_POST['saisie_sous']);
                    // Appel de la méthode pour insérer une nouvelle catégorie
                    $m->ajouterSousCategorie($var_souscat);

                }
                else {
                    $var_souscat =  htmlspecialchars($_POST['choix_sous_categorie']);
                }

                $id_cate2 = $m->getIdCategorie( $var_souscat) ;

                
                // inserer categorie 

                if (isset($_POST['compétence'])) {
                    $var_catego  =  htmlspecialchars($_POST['compétence']);
                    // Appel de la méthode pour insérer une nouvelle catégorie
                    $m->ajouterCategorie( $var_catego, $id_cate2);
                }

                else{
                    $var_catego  =  htmlspecialchars($_POST['choix_categorie']);
                    
                }

                $id_cate = $m->getIdCategorie($var_catego) ; 
               
               
               // $id_utilisateur = $_SESSION['user']; 
                // theme 


                if (isset($_POST['saisie_theme'])) {
                    $var_theme =  htmlspecialchars($_POST['saisie_theme']) ;
                    // Appel de la méthode pour insérer une nouveau théme 
                    $m->ajouterTheme( $var_theme, $id_cate);

                }
               
                else {
                    $var_theme =  htmlspecialchars($_POST['theme_choix']);
                }
                $id_theme = $m->getIdTheme($var_theme);


                
               
                if (isset($_POST['choix_niveau'])&& isset($_POST['commentaire_Exper']) && isset($_POST['dureeExp'])&& isset($_POST['nbSession'])) {
                    $var_nbSession = $_POST['nbSession'] ; 
                    $var_experiance =  htmlspecialchars($_POST['dureeExp']) ;
                    $var_commentaire_expertise = $_POST['commentaire_Exper'];
                    $nv_experiance = $_POST['choix_niveau'];


                }
               
                if (isset($_POST['dureeExp']) && isset($_POST['commentaire']) && isset($_POST['choix']) ) {
                    $var_expertise =  htmlspecialchars($_POST['dureeExp']) ;
                    $var_commentaire_expertise = $_POST['commentaire'];
                    $nv_expertise = $_POST['choix'];
    
                }
                if (isset($_POST['cv'])){
                    $var_cv= $_POST['cv'];
                }
               
            }

            else {$msg='ereeuuuuur';}
            
            
            $data = [ "var_theme" => $var_theme,
            "var_catego" =>$var_catego,
            "var_souscat" => $var_souscat,
            "var_expertise" =>$var_expertise,
            "var_nv_expertisee" => $var_nv_expertise,
            "var_commentaire_expertise" =>$var_commentaire_expertise,
            "var_experiance" => $var_experiance,
            "var_nv_experiance" =>$var_nv_experiance,
            "var_commentaire_experiance" =>$var_commentaire_experiance,
             "msg"=>$msg,
             "cv" => $var_cv] ;

            $this->render("formateur", $data);
        }  

        public function action_default() {
            $this->action_option();
        }
          
    }
?>
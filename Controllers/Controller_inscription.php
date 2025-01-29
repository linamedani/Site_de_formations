<?php 
class Controller_inscription extends Controller {
    


    public function action_inscription()
   {
    $m = Model::getModel();
    $msg  = '';
        
        $data=[];
      
        
        if (!empty($_POST['registration-type']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['passwordConf']) && isset($_POST['nom']))
         {
            $email      = e($_POST['mail']);
            $password   = e($_POST['password']);
            $passwordConf = e($_POST['passwordConf']);
            $nom        = e($_POST['nom']);
            $prenom     = e($_POST['prenom']);
            $linkedin    = e($_POST['linkedin']);
            $societe  = e($_POST['societe']);
            $role      = e($_POST['registration-type']);
            
            

            if (!(empty($_POST['societe'])) && $role === 'client') {
                // L'utilisateur a choisi le rôle de client et a fourni le nom de la société
            
                // Vérifier si l'email existe déjà
                if ($m->emailExists($email)) {
                    $msg = '<p style="color:red; text-align:center;">Le mail existe déjà.</p>';
                } else {
                    // Vérifier si les mots de passe correspondent
                    if ($password != $passwordConf) {
                        $msg = '<p style="color:red; text-align:center;">Les mots de passe ne sont pas identiques.</p>';
                    } else {
                        // Tout est correct, insérer les données du client dans la base de données
                        if($m->insertClientData($email, $password, $nom, $prenom, $societe)){
                        $msg = '<p style="color:green; text-align:center;">Votre compte a été créé. Connectez-vous <a href="?controller=connexion">ICI</a></p>';}
                    }
                }
            }
            
            
            else if (!(empty($_POST['linkedin'])) && $role === 'formateur') {
                // L'utilisateur a choisi le rôle de formateur et a fourni un lien LinkedIn
            
                // Vérifier si l'email existe déjà
                if ($m->emailExists($email)) {
                    $msg = '<p style="color:red; text-align:center;">Le mail existe déjà.</p>';
                } else {
                    // Vérifier si les mots de passe correspondent
                    if ($password != $passwordConf) {
                        $msg = '<p style="color:red; text-align:center;">Les mots de passe ne sont pas identiques.</p>';
                    } else {
                        // Tout est correct, insérer les données du formateur dans la base de données
                        if($m->insertFormateurData($email, $password, $nom, $prenom, $linkedin)){
                        $msg = '<p style="color:green; text-align:center;">Votre compte a été créé. Connectez-vous <a href="?controller=connexion&action=dologin">ICI</a></p>';}
                    }
                }
            }
            

               
        }
    
    else{
        $msg='';
    }
        $data = [
            'msg' => $msg
            
        ];
        $this->render('inscription', $data);
        
    
    }
  
    public function action_default()
      {
          $this->action_inscription();
      }
     
        }

?>

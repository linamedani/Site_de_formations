
<?php
require_once "Controller.php";

class Controller_connexion extends Controller{

 
  public function action_dologin()
  {
    
    $m = Model::getModel();
    
    $message = " ";
    $data=[];
    $roles=[];
   if(isset($_POST["mail"]) && (isset($_POST["password"])) && !(empty($_POST["mail"])) && !(empty($_POST["password"]))
   ){
      $login = $_POST["mail"];
      $mdp = $_POST["password"];
      if($m->userExist($login)){
      $pass = $m->getMdpfromEmail($login);
      //$motDePasseHache=password_hash($pass['password'],PASSWORD_DEFAULT);
     
                if(password_verify($mdp,$pass["password"])){
                  ob_clean();
                  $roles=$m->roleUtilisateur($login);
                  $taille= count($roles);
                  $id_utilisateur=$m->getIDfromEmail($login);
                  if ($taille > 1 and in_array("formateur", $roles) and in_array("admin", $roles)){
                    
                    unset($_SESSION['message']);
                    $_SESSION['id'] = $id_utilisateur;
                    $_SESSION['roles'] = $roles;
                    header('Location: index.php?controller=formateur');
                      
               }
                  if ($m->formateurExist($login)){
                     header('Location: index.php?controller=formateur');

                }
                  if ($taille ===1 and in_array("client",$roles)){
                    header('Location: index.php?controller=client');

                }
                  if ($taille ===1 and in_array("admin",$roles)){
                    header('Location: Views/view_admin.php');

                }
              }
              if(!(password_verify($mdp, $pass['password']))  ){
                $message='mot de passe invalide';
              }
        
            }
             if(!($m->userExist($login))){
                    $message = "Veuillez-vous inscrire";
                    
                 }
  }
  else{
    $message='Remplissez tous les champs';
  }
  
  
  $data = [
    "message"=>$message];
    $this->render("login", $data);
  
 }
 

   public function action_default()
    {
        $this->action_dologin();
    }
} ?>

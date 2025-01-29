<?php
require_once "Controller.php";

class Controller_client extends Controller{
    
    public function action_client()

  {
    
    $data=[];
    $message='';
    $m=' ';
    $t='';
    $m = Model::getModel();
    
    $t=$m->listeFormateur();
    
    /*foreach($t as $formateur){
      $nom= $m->getNomFormateur($formateur);
      $prenom= $m->getPrenomFormateur($formateur);
      $competence=$m->getCompetence($formateur);
      $niveau=$m->getNiveau($formateur);
    }*/

    
    $message='rien';
    $data = [
        "t"=>$t];
    $this->render("client", $data);

  }
    public function action_default()
    {
        $this->action_client();
    }

}
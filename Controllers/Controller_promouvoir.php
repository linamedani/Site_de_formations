<?php

class Controller_promouvoir extends Controller
{

    public function action_promotion() {
        $m = Model::getModel();
        

        //$formateurId = $_POST["id_utilisateur"];
        $result = 1; // $this->$m->promoteFormateurToModerateur($formateurId);
        $data=["result"=>$result];
        $this->render("promouvoir",$data);
    }
    public function action_default() {
        $this->action_promotion();
    }
    
}
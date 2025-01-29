

<?php

class Controller_activite extends Controller
{
    public function action_activite(){
       $data=[];
        $this->render("activite", $data);
    }
    
    public function action_default()
    {
        $this->action_activite();
    }

}
<?php

class Controller_admin extends Controller
{
    public function action_admin(){
       $data=[];
        $this->render("admin", $data);
    }
    
    public function action_default()
    {
        $this->action_admin();
    }

}
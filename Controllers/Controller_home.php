
<?php

class Controller_home extends Controller
{
    public function action_home(){
        $data["listCategories"] = Model::getModel()->getCategorieInformations();

        $this->render("home", $data);
    }
    
    public function action_default()
    {
        $this->action_home();
    }

}
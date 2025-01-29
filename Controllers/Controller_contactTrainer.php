
<?php

class Controller_contactTrainer extends Controller
{
    public function action_contact(){
        $data = [];

        $this->render("contactTrainer", $data);
    }

    public function action_enregistrer_message(){
        extract($_POST);

        /*  
        echo "Formateur : $formateur<br/>";
        echo "Nom : $name<br/>";
        echo "Email : $email<br/>";
        echo "Phone : $phone<br/>";
        echo "Message : $message<br/>";

        die();
        */

        Model::getModel()->saveMessage($formateur, $name, $email, $phone, $message);

        header('Location: index.php?controller=client&error=0&notificationMessage=Message enregistré avec succès');
    }
    
    public function action_default()
    {
        $this->action_contact();
    }

}
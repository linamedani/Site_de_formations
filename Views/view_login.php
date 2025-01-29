<?php require 'view_begin.php';


 ?>

<div class="background-image">
        <img src="../Content/images/bg2.png" alt="Background Image">
</div>
<main   class="connect">
    <div class="ct">
    <h1>Connexion</h1>
    
    <form action="?controller=connexion&action=dologin" method="POST" >
    
    

    <p><?= $message ?> </p>
    
        <div class="ct_txt">
            <input type="email" class="form-control" name="mail"placeholder="email" />

        </div>
        <div class="ct_txt">
            <input type="password" class="form-control" name="password"placeholder="password" />
        </div>
        <input type="submit" value="Connexion" class="b_connect">
        <div class="ask">
        vous n'avez pas de compte ?<a href=?controller=inscription&action=inscription> Inscriviez vous </a>
        </div>
    </form>
    </div>

</main>

  <!--ajouter footer --->

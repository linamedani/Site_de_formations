<?php require 'Views/view_begin.php'; ?>
<div class="background-image">
        <img src="Content/images/bg2.png" alt="Background Image">
</div>
   

<main class="connect">
    <div class="ct">
        <h1>Inscription</h1>
    <p> <?= $msg ?> </p>
   
    
        <form action="" method="post">

            <label for="registration-type">Je suis :
                <select id="registration-type" name="registration-type">
                    <option value="" required> </option>
                    <option value="formateur" required>Formateur</option>
                    <option value="client" required>Client</option>
                </select>
            </label>
            </br>

            <!-- Champs communs -->
            <div id="email" style="display:none;" class="ct_txt">
                <input type="email" class="form-control-signup" name="mail" placeholder="email*" required pattern="[a-zA-Z0-9.-]+@[a-zA-Z0-9.-]+.[a-zA-Z.]{2,15}">

            <div id="password" style="display:none;" class="ct_txt">
                <input type="password" class="form-control-signup" name="password" placeholder="password*" required>
            </div>

            <div id="passwordc" style="display:none;" class="ct_txt">
                <input type="password" class="form-control-signup" name="passwordConf" placeholder="Confirmer le mot de passe*" required>
            </div>

            <div id="nom" style="display:none;" class="ct_txt">
                <input type="text" class="form-control-signup" name="nom" placeholder="Nom*" required>
            </div>

            <div id="prenom" style="display:none;" class="ct_txt">
                <input type="text" class="form-control-signup" name="prenom" placeholder="Prénom*" required>
            </div>

            <div id="societe" style="display:none;" class="ct_txt">
                <input type="text" class="form-control-signup" name="societe" placeholder="Société">
            </div>

            <div id="linkedin" style="display:none;" class="ct_txt">
                <input type="text" class="form-control-signup" name="linkedin" placeholder="Linkedin">
            </div>
            <input type="submit" value="S'inscrire" class="b_connect"/>

            <div class="ask">
                Déjà un compte ? <a href="?controller=connexion&action=dologin">Se connecter</a>
            </div>
        </form>
    </div>
</main>
<script>
                
                function resetFields() {
                    // Masquer tous les champs
                    document.getElementById('email').style.display = 'none';
                    document.getElementById('password').style.display = 'none';
                    document.getElementById('passwordc').style.display = 'none';
                    document.getElementById('nom').style.display = 'none';
                    document.getElementById('prenom').style.display = 'none';
                    document.getElementById('societe').style.display = 'none';
                    document.getElementById('linkedin').style.display = 'none';
                }

                function showFields(type) {
                    // Afficher les champs spécifiques en fonction du type
                    resetFields();

                    if (type === 'formateur') {
                        document.getElementById('email').style.display = 'block';
                        document.getElementById('password').style.display = 'block';
                        document.getElementById('passwordc').style.display = 'block';
                        document.getElementById('nom').style.display = 'block';
                        document.getElementById('prenom').style.display = 'block';
                        document.getElementById('linkedin').style.display = 'block';
                    } else if (type === 'client') {
                        document.getElementById('email').style.display = 'block';
                        document.getElementById('password').style.display = 'block';
                        document.getElementById('passwordc').style.display = 'block';
                        document.getElementById('nom').style.display = 'block';
                        document.getElementById('prenom').style.display = 'block';
                        document.getElementById('societe').style.display = 'block';
                    }
                }

                document.getElementById('registration-type').onchange = function () {
                    // Appeler showFields lors du changement de la sélection
                    showFields(this.value);
                };

                // Appeler resetFields pour initialiser l'affichage
                resetFields();
            </script>

        <!--ajouter footer --->
       
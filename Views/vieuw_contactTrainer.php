
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contactez le Formateur</title>
    <style>
        /* Styles de base pour la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #02c4c4;

        }

        /* Styles pour le formulaire de contact */
        .contact-form {
            background: #fff;
            padding: 2em;
            border-radius: 4px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .contact-form h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 1em;
        }

        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 0.5em;
            border: 1px solid #ddd;
            margin-bottom: 1em;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .contact-form input[type="submit"] {
            background: #009afd;
            color: #02c4c4;
            border: none;
            padding: 0.7em;
            cursor: pointer;
            border-radius: 4px;
            transition: background 0.3s ease;
        }

        .contact-form input[type="submit"]:hover {
            background: #007acc;
            color: #02c4c4;

        }   
    </style>
</head>
<body style="background-image: url('../Content/images/messagerie.jpg'); background-size: cover; background-position: center;">

<body>

    <div class="contact-form">

        <h1>Contactez Notre formateur <?php echo htmlspecialchars(isset($_GET['trainer']) ? $_GET['trainer'] : 'Inconnu'); ?></h1>

        <form action="../form_scripts/enregistrer_message.php" method="post">
            <input type="text" name="name" placeholder="Votre nom (facultatif)">
            <input type="email" name="email" placeholder="Votre adresse email (facultatif)">
            <input type="text" name="phone" placeholder="Votre numéro de téléphone (facultatif)">
            <input type="hidden" name="formateur" value="<?php echo $_GET["trainer"];?>">
            <textarea name="message" placeholder="Tapez votre message ici..." required></textarea>
        
            <input type="submit" value="Envoyer le message">
        </form>
</div>

</body>
</html>





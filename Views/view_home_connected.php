
<?php require "view_begin.php"; ?>
<?php require_once "../Controllers/Controller_connexion.php"; ?>
<?php session_start(); ?>

<h1> 
    ssss
</h1>




<?php if(isset($_SESSION['roles']) && in_array('formateur', $_SESSION['roles'])): ?>
    <a href="view_formateur.php">Formateur</a>
<?php endif; ?>

<?php if(isset($_SESSION['roles']) && in_array('admin', $_SESSION['roles'])): ?>
    <a href="view_client.php">Client</a>
<?php endif; ?>


<?php require "view_end.php"; ?>
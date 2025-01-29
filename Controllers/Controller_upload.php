<?php
$cheminAttestation = "C:\wamp64\www\perform-vision\Attestation_de_Formateur.pdf"; // Remplacez par le chemin réel de votre attestation

// Vérifiez si le fichier existe
if (file_exists($cheminAttestation)) {
    // Configuration des en-têtes pour le téléchargement
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="nom-de-l-attestation.pdf"');

    // Lire et afficher le fichier
    readfile($cheminAttestation);
} else {
    echo "Le fichier d'attestation n'existe pas.";
}
?>

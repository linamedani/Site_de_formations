<?php

function PGCD($a, $b) {
    while ($b !== 0) {
        list($a, $b) = [$b, $a % $b];
    }
    return $a;
}

function inv_mod($a, $b) {
    $u = 0;
    $v = 1;
    $r = $b;
    $new_r = $a;

    // Utilisation de la fonction PGCD pour calculer le PGCD de $a et $n
    $pgcd = PGCD($a, $b);

    if ($pgcd !== 1) {
        // $a n'a pas d'inverse modulaire dans Z/nZ
        throw new Exception("a n'a pas d'inverse modulaire dans Z/nZ");
    }

    while ($new_r != 0) {
        $quotient = (int)($r / $new_r);
        list($u, $v) = [$v, $u - $quotient * $v];
        list($r, $new_r) = [$new_r, $r - $quotient * $new_r];
    }

    // Si $u est négatif, ajouter $n pour obtenir l'inverse modulaire positif
    if ($u < 0) {
        $u += $b;
    }

    return $u;
}


function PrimalOptimale($n) {
    if ($n < 2) {
        return false;
    }
    if ($n == 2) {
        return true;
    }
    if ($n % 2 == 0) {
        return false;
    }
    for ($i = 3; $i <= floor(sqrt($n)); $i += 2) {
        if ($n % $i == 0) {
            return false;
        }
    }
    return true;
}

function exponentiation_modulaire_rapide($x, $n, $m) {
    $resultat = 1;
    $x = $x % $m;

    while ($n > 0) {
        // Si le bit le moins significatif de $n est 1
        if ($n % 2 == 1) {
            $resultat = ($resultat * $x) % $m;
        }
        
        // Réduction de $n par deux (décalage à droite)
        $n = (int)($n / 2);

        // Mise à jour de $x pour le prochain itéré
        $x = ($x * $x) % $m;
    }

    return $resultat;
}

function taille_paquet($n) {
    $aille = 1;
    while ($n >= pow(26, $aille)) {
        $aille++;
    }
    return $aille;
}

function GenRclef() {
    // Générer deux nombres premiers aléatoires pour p et q
    $p = PremierAleatoire();
    $q = PremierAleatoire();

    // Générer un exposant aléatoire e qui est premier avec (p-1)*(q-1)
    $phi = ($p - 1) * ($q - 1);
    $e = ExposantAleatoire($phi);

    $n = $p * $q;
    $d = inv_mod($e, $phi);

    $cle_publique = [$n, $e];
    $cle_privee = [$n, $d];

    return [
        "PUBLIQUE" => $cle_publique,
        "PRIVE" => $cle_privee
    ];
}

function PremierAleatoire() {
    // Générer un nombre premier aléatoire
    $nombre = rand(50, 100); // Vous pouvez ajuster la plage selon vos besoins
    while (!PrimalOptimale($nombre)) {
        $nombre = rand(50, 100);
    }
    return $nombre;
}

function ExposantAleatoire($phi) {
    // Générer un exposant aléatoire qui est premier avec $phi
    $e = rand(2, $phi - 1);
    while (pgcd($e, $phi) != 1) {
        $e = rand(2, $phi - 1);
    }
    return $e;
}



function chiffrement_RSA($message) {
    $cles = GenRclef();
    $cle_publique = $cles["PUBLIQUE"];

    list($n, $e) = $cle_publique;
    $taille_paquet = taille_paquet($n);
    $blocs = [];

    // Convertir chaque caractère en bloc numérique
    for ($i = 0; $i < strlen($message); $i++) {
        $blocs[] = ord($message[$i]);
    }

    // Chiffrer chaque bloc numérique et stocker le résultat
    $chiffre = array_map(function ($bloc) use ($e, $n) {
        return exponentiation_modulaire_rapide($bloc, $e, $n);
    }, $blocs);

    // Retourner le résultat sous forme de chaîne avec des tirets
    return implode('-', $chiffre);
}

function dechiffrement_RSA($message_chiffre) {
    $cles = GenRclef();
    $cle_privee = $cles["PRIVE"];
    
    list($n, $d) = $cle_privee;
    $blocs_chiffres = explode('-', $message_chiffre);
    $blocs_dechiffres = array_map(function ($bloc_chiffre) use ($d, $n) {
        return exponentiation_modulaire_rapide($bloc_chiffre, $d, $n);
    }, $blocs_chiffres);

    // Convertir chaque bloc déchiffré en caractère
    $message_dechiffre = '';
    foreach ($blocs_dechiffres as $bloc_dechiffre) {
        $message_dechiffre .= chr($bloc_dechiffre);
    }

    return $message_dechiffre;
}



?>

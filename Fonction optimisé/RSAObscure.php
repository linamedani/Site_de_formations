<?php

class RSAObscure
{
    private $clePrive;
    private $clePublic;

    public function __construct($clePrive, $clePublic)
    {
        $this->clePrive = openssl_pkey_get_private(file_get_contents($clePrive));
        $this->clePublic = openssl_pkey_get_public(file_get_contents($clePublic));
    }

    //Temps d'exécution : O(len($message))
    public function encrypt($message, $cle=null)
    {
        openssl_public_encrypt($message, $encrypted_data, $cle==null ? $this->clePublic : $cle);
        return base64_encode($encrypted_data);
    }

    public function decrypt($message_chiffre, $cle=null)
    {
        openssl_private_decrypt(base64_decode($message_chiffre), $decrypted_data, $cle==null ? $this->clePrive: $cle);
        return $decrypted_data;
    }

}

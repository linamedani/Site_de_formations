<?php

require 'cle_prive.pem';
require 'cle_public.pem';

class RsaObscure
{
    private $clePrive;
    private $clePublic;

    public function __construct($clePrive, $clePublic)
    {
        $this->clePrive = openssl_pkey_get_private(file_get_contents('c:\Users\pc\Documents\SAE_Perform\cle_prive.pem'));
        $this->clePublic = openssl_pkey_get_public(file_get_contents('c:\Users\pc\Documents\SAE_Perform\cle_public.pem'));
    }

    public function encrypt($motDePasse)
    {
        openssl_public_encrypt($motDePasse, $encrypted_data, $this->clePublic);
        return base64_encode($encrypted_data);
    }

    public function decrypt($motDePasseDecr)  
    {
        openssl_private_decrypt(base64_decode($motDePasseDecr), $decrypted_data, $this->clePrive);
        return $decrypted_data;
    }

}




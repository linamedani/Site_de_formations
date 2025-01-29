<?php
	require 'RSAObscure.php';

	$rsaSecurity = new RSAObscure('./cle_prive.pem', './cle_public.pem');

	$message = "Hello everyone, how are you ?";

	echo "Message Originale : $message<br>";

	$t0 = microtime();
	$messageCrypte = $rsaSecurity->encrypt($message);
	$t1 = microtime();

	$time = (double)$t1 - (double)$t0;
	echo "<br/>Le message est crypté en : $time microseconds";

	echo "<br/><br/>Message crypté : ";
	print_r($messageCrypte);

	$mmm = $rsaSecurity->decrypt( $messageCrypte );

	echo "<br/><br/>";
	echo "Message Décrypté : ";
	print_r($mmm);

	echo "<br/><br/>";
	if ($message === $mmm){
		echo "CORRECT";
	}
	else{
		echo "INCORRECT";
	}
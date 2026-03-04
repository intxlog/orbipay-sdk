<?php

namespace Com\Alacriti\Checkout\Client\Api;


use Com\Alacriti\Checkout\Client\ApiClient;
use Com\Alacriti\Checkout\Client\Model\ConfirmPaymentTokenRequest;
use Com\Alacriti\Checkout\Client\Model\PaymentToken;
use Com\Alacriti\Checkout\Client\Model\PaymentVO;
use Com\Alacriti\Checkout\Client\Model\Error;
use Com\Alacriti\Checkout\Client\Util\EncryptionUtil;
use Com\Alacriti\Checkout\Client\ApiException;

class InvocationContext extends BaseRequest
{
	public function __construct($apiKey, $clientPrivateKey, $serverPublicKey, $idempotentRequestKey){

	    	echo "<script>console.log('Inside invc');</script>";
	    	echo "<script>console.log('Raw private key (first 50 chars): " . substr($clientPrivateKey, 0, 50) . "');</script>";

	    	// Try to decode the private key and check if it's valid PEM
	    	$decodedPrivateKey = base64_decode($clientPrivateKey, true);
	    	echo "<script>console.log('Base64 decode succeeded: " . ($decodedPrivateKey !== false ? 'yes' : 'no') . "');</script>";

	    	if ($decodedPrivateKey !== false && (strpos($decodedPrivateKey, 'BEGIN PRIVATE KEY') !== false || strpos($decodedPrivateKey, 'BEGIN RSA PRIVATE KEY') !== false)) {
	    		echo "<script>console.log('Using decoded private key (is valid PEM)');</script>";
	    		$privKey = $decodedPrivateKey;
	    	} elseif (strpos($clientPrivateKey, 'BEGIN PRIVATE KEY') !== false || strpos($clientPrivateKey, 'BEGIN RSA PRIVATE KEY') !== false) {
	    		echo "<script>console.log('Key is already PEM format, using as-is');</script>";
	    		$privKey = $clientPrivateKey;
	    	} else {
	    		echo "<script>console.log('Wrapping private key with PEM headers');</script>";
	    		// Treat as raw base64 key body and wrap with headers
	    		$pkBody = preg_replace("/[\r\n\s]*/", "", $clientPrivateKey);
	    		$pkBody = str_replace(["-----BEGINPRIVATEKEY-----", "-----ENDPRIVATEKEY-----"], "", $pkBody);
	    		$privKey = "-----BEGIN PRIVATE KEY-----\n" . chunk_split($pkBody, 64, "\n") . "-----END PRIVATE KEY-----";
	    	}

	    	// Same for public key
	    	$decodedPublicKey = base64_decode($serverPublicKey, true);
	    	if ($decodedPublicKey !== false && (strpos($decodedPublicKey, 'BEGIN PUBLIC KEY') !== false || strpos($decodedPublicKey, 'BEGIN RSA PUBLIC KEY') !== false)) {
	    		echo "<script>console.log('Using decoded public key (is valid PEM)');</script>";
	    		$pubKey = $decodedPublicKey;
	    	} elseif (strpos($serverPublicKey, 'BEGIN PUBLIC KEY') !== false || strpos($serverPublicKey, 'BEGIN RSA PUBLIC KEY') !== false) {
	    		echo "<script>console.log('Key is already PEM format, using as-is');</script>";
	    		$pubKey = $serverPublicKey;
	    	} else {
	    		echo "<script>console.log('Wrapping public key with PEM headers');</script>";
	    		// Treat as raw base64 key body and wrap with headers
	    		$pbBody = preg_replace("/[\r\n\s]*/", "", $serverPublicKey);
	    		$pbBody = str_replace(["-----BEGINPUBLICKEY-----", "-----ENDPUBLICKEY-----"], "", $pbBody);
	    		$pubKey = "-----BEGIN PUBLIC KEY-----\n" . chunk_split($pbBody, 64, "\n") . "-----END PUBLIC KEY-----";
	    	}

	    	echo "<script>console.log('Final private key (first 50 chars): " . substr($privKey, 0, 50) . "');</script>";

	    	$this->setClPrivKey($privKey);
        	$this->setCoPubKey($pubKey);
        	$this->setClientApiKey($apiKey);
        	$this->setIdempotentRequestKey($idempotentRequestKey);
	    	echo "<script>console.log('Exiting invc');</script>";


		}

} 

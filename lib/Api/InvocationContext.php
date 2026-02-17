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

        	// Strip any existing PEM headers/whitespace and re-wrap properly
        	$pkBody = preg_replace("/[\r\n\s]*/", "", $clientPrivateKey);
        	$pkBody = str_replace(["-----BEGINPRIVATEKEY-----", "-----ENDPRIVATEKEY-----"], "", $pkBody);
        	$privKey = "-----BEGIN PRIVATE KEY-----\n" . chunk_split($pkBody, 64, "\n") . "-----END PRIVATE KEY-----";

        	$pbBody = preg_replace("/[\r\n\s]*/", "", $serverPublicKey);
        	$pbBody = str_replace(["-----BEGINPUBLICKEY-----", "-----ENDPUBLICKEY-----"], "", $pbBody);
        	$pubKey = "-----BEGIN PUBLIC KEY-----\n" . chunk_split($pbBody, 64, "\n") . "-----END PUBLIC KEY-----";
	    	$this->setClPrivKey($privKey);
        	$this->setCoPubKey($pubKey);
        	$this->setClientApiKey($apiKey);
        	$this->setIdempotentRequestKey($idempotentRequestKey);
	    	echo "<script>console.log('Exiting invc');</script>";


		}

} 

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

        	$pk1 = base64_decode($clientPrivateKey);
        	$pk2 = preg_replace("/[\r\n]*/","",$pk1);
	    	$pk2 = str_replace("-----BEGIN PRIVATE KEY-----","-----BEGIN PRIVATE KEY-----\n",$pk2);
        	$pk2 = str_replace("-----END PRIVATE KEY-----","\n-----END PRIVATE KEY-----",$pk2);
        	$privKey = $pk2;
        	$pb1 = base64_decode($serverPublicKey);
        	$pb2 = preg_replace("/[\r\n]*/","",$pb1);
	    	$pb2 = str_replace("-----BEGIN PUBLIC KEY-----","-----BEGIN PUBLIC KEY-----\n",$pb2);
        	$pb2 = str_replace("-----END PUBLIC KEY-----","\n-----END PUBLIC KEY-----",$pb2);
        	$pubKey = $pb2;
	    	$this->setClPrivKey($privKey);
        	$this->setCoPubKey($pubKey);
        	$this->setClientApiKey($apiKey);
        	$this->setIdempotentRequestKey($idempotentRequestKey);


		}

} 

<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/5/17
 * Time: 1:48 PM
 */

namespace Com\Alacriti\Checkout\Client\Api;


use Com\Alacriti\Checkout\Client\ApiClient;
use Com\Alacriti\Checkout\Client\Model\ConfirmAddFundAcctRequest;
use Com\Alacriti\Checkout\Client\Model\FundingAccountToken;
use Com\Alacriti\Checkout\Client\Model\Error;
use Com\Alacriti\Checkout\Client\Model\ResponseHeader;
use Com\Alacriti\Checkout\Client\Model\ConfirmAddFundAcctResponse;
use Com\Alacriti\Checkout\Client\Util\EncryptionUtil;
use Com\Alacriti\Checkout\Client\ApiException;
use Com\Alacriti\Checkout\Client\Api\InvocationContext;

class FundingAccount extends BaseRequest
{
    private $fundingAccountToken;
    private $digiSign;
    private $customFields;
    private $idAccount;

    function __construct($idAccount = null)
    {
        $this->idAccount = $idAccount;
    }
    /**
     * @return mixed
     */
    public function getFundingAccountToken()
    {
        return $this->fundingAccountToken;
    }

    /**
     * @param mixed $fundingAccountToken
     */
    public function setFundingAccountToken($fundingAccountToken)
    {
        $this->fundingAccountToken = $fundingAccountToken;
    }

    /**
     * @return mixed
     */
    public function getDigiSign()
    {
        return $this->digiSign;
    }

    /**
     * @param mixed $digiSign
     */
    public function setDigiSign($digiSign)
    {
        $this->digiSign = $digiSign;
    }

    /**
     * @return mixed
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * @param mixed $customFields
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;
    }

    public function withCustomFields($customFields){
        $this->customFields = $customFields;
        return $this;
    }

    public function withToken($fundingAccountToken, $digiSign){
        if(gettype($fundingAccountToken) === 'string'){
            $new_fundingAccountToken = new FundingAccountToken();
            $new_fundingAccountToken->setToken($fundingAccountToken);
            $this->fundingAccountToken = $new_fundingAccountToken;
        }else if(gettype($fundingAccountToken) === 'object'){
            $this->fundingAccountToken = $fundingAccountToken;
        }

        $this->digiSign= $digiSign;
        return $this;
    }

  public function forClient($clientId, $signatureKey, $clientApiKey=0){
        $this->setClientId($clientId);
        $this->setSignatureKey($signatureKey);
        if($clientApiKey != 0)
        {
        echo "<script>console.log('Received valid client Api Key');</script>";
        $this->setClientApiKey($clientApiKey);
        }
        return $this;
    }

   public function withKeys($privKey, $pubKey){
        echo "<script>console.log('in withKey');</script>";
        $this->setClPrivKey($privKey);
        $this->setCoPubKey($pubKey);
        return $this;
    }

    public function forPartner($clientId, $signatureKey){
        $this->setClientId($clientId);
        $this->setSignatureKey($signatureKey);
        return $this;
    }

    public function add(InvocationContext $inv, $liveMode="NA"){
        echo "<script>console.log('in add() with invocation context');</script>";
	if(!($liveMode == "NA")){
        echo "<script>console.log('in add() with live mode: ".$liveMode."');</script>";
        $this->setLiveMode($liveMode);
        }
        else{
            echo "<script>console.log('live mode param is not set');</script>";
        }
        if ($this->isNullOrEmptyString($this->getClientId())){
            throw new ApiException('Missing required parameter "client_id" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->getSignatureKey())){
            throw new ApiException('Missing required parameter "signature_key" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->fundingAccountToken)){
            throw new ApiException('Missing required parameter "token" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->digiSign)){
            throw new ApiException('Missing required parameter "digi_sign" when calling confirmAddFundingAccount');
        }

        try{
           debug_to_console("in Add() function"); 
	//   $decryptedToken = EncryptionUtil::decrypt($this->fundingAccountToken->getToken());
        //    EncryptionUtil::verify($decryptedToken,$this->digiSign);

	   $decryptedToken = EncryptionUtil::decrypt($this->fundingAccountToken->getToken(),$inv->getClPrivKey());
           echo "<script>console.log('decryptedToken: ".$decryptedToken."');</script>";
             EncryptionUtil::verify($decryptedToken,$this->digiSign,$inv->getCoPubKey());

            $confirmAddFundingAccountRequest = new ConfirmAddFundAcctRequest();
            $confirmAddFundingAccountRequest->setCustomFields($this->customFields);

            $fundingAccountToken = new FundingAccountToken();
            $fundingAccountToken->setToken(EncryptionUtil::encrypt($decryptedToken,$inv->getCoPubKey()));
	    $this->fundingAccountToken = $fundingAccountToken;
            $confirmAddFundingAccountRequest->setFundingAccountToken($fundingAccountToken);

            $this->digiSign = EncryptionUtil::sign($decryptedToken,$inv->getClPrivKey());

            if($inv->getClientApiKey() == null && $liveMode == 0){
                $apiClient = new ApiClient($this->getClientId(), $this->getSignatureKey());
            }
            else{
                $apiClient = new ApiClient($this->getClientId(), $this->getSignatureKey(), $inv->getClientApiKey(), $this->getLiveMode(), $inv->getIdempotentRequestKey());
            }

            $fundingAccountApi =  new FundingAccountApi($apiClient);
            $account_add = new ConfirmAddFundAcctResponse();

            //return $fundingAccountApi->confirmAddFundingAccount($this->getClientId(),$this->digiSign,$confirmAddFundingAccountRequest, false, null);

            $response = $fundingAccountApi->confirmAddFundingAccount($this->getClientId(),$this->digiSign,$confirmAddFundingAccountRequest, false, null);
            $rh1 = $this->wrapResponseHeaders($response[2]);
            $account_add = $response[0];
            $account_add->setResponseHeader($rh1);

            return $account_add;

        }catch (\Exception $e){
            //throw new ApiException('unable to confirmAddFundingAccount'.$e);
            echo "<script>console.log('Exception occured: ".$e->getResponseBody()."');</script>";
	    //throw $e;

                try{
                       $errorbody = $e->getResponseBody();
                       $errorheaders = $e->getResponseHeaders();
                       $rh1 = $this->wrapResponseHeaders($errorheaders);
                       $errorjson = json_decode($errorbody);
                       if (!is_object($errorjson)){
                           echo "<script>console.log('error body is not a json object');</script>";
			   $account_add = new ConfirmAddFundAcctResponse();                           
                           $ee = new Error();
                           $ee->setCode($e->getResponseCode());
                           $ee->setMessage($e->getResponseBody());
                           $account_add->setError($ee);
                           $account_add->setResponseHeader($rh1);
                           return $account_add;
                        }else {
		           $errorcode = $errorjson->errors[0]->code;
                           $errormessage = $errorjson->errors[0]->message;
                           //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                           $errorfield = $errorjson->errors[0]->field;
                           $account_add = new ConfirmAddFundAcctResponse();
                           $ea = new Error();

                           $ea->setCode($errorcode);
                           $ea->setMessage($errormessage);
                           $ea->setField($errorfield);
                           $account_add->setError($ea);
                           $account_add->setResponseHeader($rh1);
                           return $account_add;
			}
                }catch (\Exception $er){
                        echo "<script>console.log('Exception occured: ".$er->getMessage()."');</script>";
                        throw $er;

                 }
       } catch (\ApiException $ae){
            //throw new ApiException('unable to confirmAddFundingAccount'.$e);
            echo "<script>console.log('Exception occured: ".$ae->getResponseBody()."');</script>";
            //throw $e;

                try{
                        $errorbody = $ae->getResponseBody();
                        $errorheaders = $e->getResponseHeaders();
                        $rh1 = $this->wrapResponseHeaders($errorheaders);
                        $errorjson = json_decode($errorbody);
                        if (!is_object($errorjson)){
                           echo "<script>console.log('error body is not a json object');</script>";
                           $account_add = new ConfirmAddFundAcctResponse();
                           $ee = new Error();
                           $ee->setCode($ae->getResponseCode());
                           $ee->setMessage($ae->getResponseBody());
                           $account_add->setError($ee);
                           $account_add->setResponseHeader($rh1);
                           return $account_add;
                        }else {
                           $errorcode = $errorjson->errors[0]->code;
                           $errormessage = $errorjson->errors[0]->message;
                           //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                           $errorfield = $errorjson->errors[0]->field;
                           $account_add = new ConfirmAddFundAcctResponse();
                           $ea = new Error();

                           $ea->setCode($errorcode);
                           $ea->setMessage($errormessage);
                           $ea->setField($errorfield);
                           $account_add->setError($ea);
                           $account_add->setResponseHeader($rh1);
                           return $account_add;
                        }			
                }catch (\ApiException $aer){
                        echo "<script>console.log('Exception occured: ".$aer->getMessage()."');</script>";
                        throw $aer;

                 }
       }

    }

    public function update(InvocationContext $inv, $liveMode="NA"){
	echo "<script>console.log('in update() with invocation context');</script>";
        if(!($liveMode == "NA")){
        echo "<script>console.log('in update() with live mode: ".$liveMode."');</script>";
        $this->setLiveMode($liveMode);
        }
        else{
            echo "<script>console.log('live mode param is not set');</script>";
        }
        if ($this->isNullOrEmptyString($this->getClientId())){
            throw new ApiException('Missing required parameter "client_id" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->getSignatureKey())){
            throw new ApiException('Missing required parameter "signature_key" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->fundingAccountToken)){
            throw new ApiException('Missing required parameter "token" when calling confirmAddFundingAccount');
        }

        if ($this->isNullOrEmptyString($this->digiSign)){
            throw new ApiException('Missing required parameter "digi_sign" when calling confirmAddFundingAccount');
        }

        try{
     		debug_to_console("in Update() function");       
	   // $decryptedToken = EncryptionUtil::decrypt($this->fundingAccountToken->getToken());
           // EncryptionUtil::verify($decryptedToken,$this->digiSign);
	   $decryptedToken = EncryptionUtil::decrypt($this->fundingAccountToken->getToken(),$inv->getClPrivKey());
           echo "<script>console.log('decryptedToken: ".$decryptedToken."');</script>";
           EncryptionUtil::verify($decryptedToken,$this->digiSign,$inv->getCoPubKey());

            $confirmAddFundingAccountRequest = new ConfirmAddFundAcctRequest();
            $confirmAddFundingAccountRequest->setCustomFields($this->customFields);

            $fundingAccountToken = new FundingAccountToken();
            $fundingAccountToken->setToken(EncryptionUtil::encrypt($decryptedToken,$inv->getCoPubKey()));
            $this->fundingAccountToken = $fundingAccountToken;
            $confirmAddFundingAccountRequest->setFundingAccountToken($fundingAccountToken);

            //$this->digiSign = EncryptionUtil::sign($decryptedToken);
	    $this->digiSign = EncryptionUtil::sign($decryptedToken,$inv->getClPrivKey());
            if($inv->getClientApiKey() == null && $liveMode == 0){
                $apiClient = new ApiClient($this->getClientId(), $this->getSignatureKey());
            }
            else{
                $apiClient = new ApiClient($this->getClientId(), $this->getSignatureKey(), $inv->getClientApiKey(), $this->getLiveMode(), $inv->getIdempotentRequestKey());
            }
            $fundingAccountApi =  new FundingAccountApi($apiClient);
            $account_update = new ConfirmAddFundAcctResponse();

            echo '<script>console.log("Account: "+'.$this->idAccount.')</script>';

            //return $fundingAccountApi->confirmAddFundingAccount($this->getClientId(),$this->digiSign,$confirmAddFundingAccountRequest, true, $this->idAccount);
            $response = $fundingAccountApi->confirmAddFundingAccount($this->getClientId(),$this->digiSign,$confirmAddFundingAccountRequest, true, $this->idAccount);

            $rh1 = $this->wrapResponseHeaders($response[2]);
            $account_update = $response[0];
            $account_update->setResponseHeader($rh1);

            return $account_update;

        }catch (\Exception $e){
            echo "<script>console.log('Exception occured: ".$e->getResponseBody()."');</script>";
//        throw $e;

                try{
                        $errorbody = $e->getResponseBody();
                        $errorheaders = $e->getResponseHeaders();
                        $rh1 = $this->wrapResponseHeaders($errorheaders);
                        $errorjson = json_decode($errorbody);
                        if (!is_object($errorjson)){
                           echo "<script>console.log('error body is not a json object');</script>";
                           $account_update = new ConfirmAddFundAcctResponse();
                           $ee = new Error();
                           $ee->setCode($e->getResponseCode());
                           $ee->setMessage($e->getResponseBody());
                           $account_update->setError($ee);
                           $account_update->setResponseHeader($rh1); 
                           return $account_update;
                        }else {
                           $errorcode = $errorjson->errors[0]->code;
                           $errormessage = $errorjson->errors[0]->message;
                           //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                           $errorfield = $errorjson->errors[0]->field;
                           $account_update = new ConfirmAddFundAcctResponse();
                           $ea = new Error();

                           $ea->setCode($errorcode);
                           $ea->setMessage($errormessage);
                           $ea->setField($errorfield);
                           $account_update->setError($ea);
                           $account_update->setResponseHeader($rh1); 
                           return $account_update;
                        }
                }catch (\Exception $ex){
                        echo "<script>console.log('Exception occured: ".$ex->getMessage()."');</script>";
                        throw $ex;

                 }
        } catch (\ApiException $ae){
            echo "<script>console.log('Exception occured: ".$ae->getResponseBody()."');</script>";
//        throw $e;

                try{

                        $errorbody = $ae->getResponseBody();
                        $errorheaders = $e->getResponseHeaders();
                        $rh1 = $this->wrapResponseHeaders($errorheaders);
                        $errorjson = json_decode($errorbody);
                        if (!is_object($errorjson)){
                           echo "<script>console.log('error body is not a json object');</script>";
                           $account_update = new ConfirmAddFundAcctResponse();
                           $ee = new Error();
                           $ee->setCode($ae->getResponseCode());
                           $ee->setMessage($ae->getResponseBody());
                           $account_update->setError($ee);
                           $account_update->setResponseHeader($rh1); 
                           return $account_update;
                        }else {
                           $errorcode = $errorjson->errors[0]->code;
                           $errormessage = $errorjson->errors[0]->message;
                           //echo "<script>console.log('Error message is: ".$errormessage."');</script>";
                           $errorfield = $errorjson->errors[0]->field;
                           $account_update = new ConfirmAddFundAcctResponse();
                           $ea = new Error();

                           $ea->setCode($errorcode);
                           $ea->setMessage($errormessage);
                           $ea->setField($errorfield);
                           $account_update->setError($ea);
                           $account_update->setResponseHeader($rh1); 
                           return $account_update;
                        }
                }catch (\ApiException $aex){
                        echo "<script>console.log('Exception occured: ".$aex->getMessage()."');</script>";
                        throw $aex;

                 }
        }

    }

    public function wrapResponseHeaders($responseHeaders = []){
        echo "<script>console.log('in wrapResponseHeaders');</script>";
        $rh = new ResponseHeader();
        $rh->setClientKey($responseHeaders['client_key']);
        $rh->setRequestUuid($responseHeaders['request_uuid']);
        $rh->setRequestTimestamp($responseHeaders['request_timestamp']);
        $rh->setResponseCode($responseHeaders['response_code']);
        $rh->setIdempotentRequestKey($responseHeaders['idempotent_request_key']);
        return $rh;
    }
}


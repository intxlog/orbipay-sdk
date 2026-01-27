<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/5/17
 * Time: 1:47 PM
 */

namespace Com\Alacriti\Checkout\Client\Api;


class BaseRequest
{
    private $clientId;
    private $signatureKey;
    private $clientApiKey;
    private $liveMode;
    private $coPubKey;
    private $clPrivKey;
    private $idempotentRequestKey;


    public function getCoPubKey()
    {
        return $this->coPubKey;
    }


    public function setCoPubKey($coPubKey)
    {
        $this->coPubKey = $coPubKey;
    }

    public function getClPrivKey()
    {
        return $this->clPrivKey;
    }


    public function setClPrivKey($clPrivKey)
    {
        $this->clPrivKey = $clPrivKey;
    }


    
    public function getClientApiKey()
    {
        return $this->clientApiKey;
    }

    
    public function setClientApiKey($clientApiKey)
    {
        $this->clientApiKey = $clientApiKey;
    }

    
    public function getLiveMode()
    {
        return $this->liveMode;
    }


    public function setLiveMode($liveMode)
    {
        $this->liveMode = $liveMode;
    }
	
    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $partnerId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getSignatureKey()
    {
        return $this->signatureKey;
    }

    /**
     * @param mixed $signatureKey
     */
    public function setSignatureKey($signatureKey)
    {
        $this->signatureKey = $signatureKey;
    }

    public function getIdempotentRequestKey()
    {
        return $this->idempotentRequestKey;
    }

    /**
     * @param mixed $idempotentRequestKey
     */
    public function setIdempotentRequestKey($idempotentRequestKey)
    {
        $this->idempotentRequestKey = $idempotentRequestKey;
    }

    public function isNullOrEmptyString($string){
        return (!isset($string) || trim($string)==='');
    }

}

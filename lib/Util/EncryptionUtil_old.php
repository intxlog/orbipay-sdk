<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/4/17
 * Time: 2:26 PM
 */

namespace Com\Alacriti\Checkout\Client\Util;

use Com\Alacriti\Checkout\Client\ApiException;
use Com\Alacriti\Checkout\Client\Util\PropertiesUtil;

class EncryptionUtil
{
    static $publicKey = null;
    static $privateKey = null;


    public static function encrypt($message){
        $crypted = null;
        if(openssl_public_encrypt($message, $crypted, self::$publicKey)){
            return base64_encode($crypted);
        }else{
            throw new ApiException('Failed to encrypt.');
        }
    }

    public static function decrypt($crypted){
        $decrypted = null;
        if(openssl_private_decrypt(base64_decode($crypted), $decrypted,self::$privateKey)){
            return $decrypted;
        }else{
            throw new ApiException('Failed to decrypt.');
        }
    }

    public static function sign($data){
        $signature = null;
        if(openssl_sign($data,$signature,self::$privateKey)){
            return base64_encode($signature);
        }else{
            throw new ApiException('Failed to sign.');
        }
    }

    public static function verify($data,$signature){
        if(openssl_verify($data,base64_decode($signature),self::$publicKey)){
            return true;
        }else{
            throw new ApiException('Failed to verify.');
        }
    }

}

$publicKeyFile = null;
$privateKeyFile = null;

try{
    global $publicKeyFile, $privateKeyFile ;

    $publicKeyFilePath = PropertiesUtil::getProperty(PropertiesUtil::CHECKOUT_PUBLIC_KEY_LOCATION);
    $privateKeyFilePath = PropertiesUtil::getProperty(PropertiesUtil::CLIENT_PRIVATE_KEY_LOCATION);

    $publicKeyFile = fopen($publicKeyFilePath,'r');
    $privateKeyFile = fopen($privateKeyFilePath,'r');

    $publicKeyString = fread($publicKeyFile,filesize($publicKeyFilePath));
    $privateKeyString = fread($privateKeyFile,filesize($privateKeyFilePath));

    $passPhrase = PropertiesUtil::getProperty(PropertiesUtil::CLIENT_PRIVATE_KEY_PASSWORD);

    EncryptionUtil::$publicKey = openssl_get_publickey($publicKeyString);
    EncryptionUtil::$privateKey = openssl_get_privatekey($privateKeyString,$passPhrase);
}catch (\Exception $e){
    error_log($e);
    throw new ApiException('Unable to read properties file.');
}finally{
    if($publicKeyFile !== null){
        fclose($publicKeyFile);
    }

    if($privateKeyFile !== null){
       fclose($privateKeyFile);
    }
}

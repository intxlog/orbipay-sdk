<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/4/17
 * Time: 2:26 PM
 */

namespace Com\Alacriti\Checkout\Client\Util;

use Com\Alacriti\Checkout\Client\Constants\APIConstants;
use Com\Alacriti\Checkout\Client\ApiException;

class HashUtil
{
    static $publicKey = null;
    static $privateKey = null;
    const ENCODE_TYPE = 'utf-8';
    const SEPARATOR = ':';
    const CHECKOUT_HEADERS = ['client_id','digi_sign'];

    public static function checkConnection(){
        echo "<script>console.log('in chkconnction method');</script>";
    }

    public static function encrypt($message,$publicKey){
       echo "<script>console.log('in encrypt method');</script>";
     $crypted = null;
         $pubKeyFinal = openssl_get_publickey($publicKey);
         //echo "<script>console.log('after pub final ".$pubKeyFinal."');</script>";
        if(openssl_public_encrypt($message, $crypted, $pubKeyFinal)){
        echo "<script>console.log('after encrypt');</script>";
        //$encrypted = base64_encode($crypted);
        //echo "<script>console.log('encrypted message ".$encrypted."');</script>";
        
            return base64_encode($crypted);
        }else{
            throw new ApiException('Failed to encrypt.');
        }
    }

    public static function decrypt($crypted,$privateKey){
        echo "<script>console.log('in decrypt method');</script>";
        $decrypted = null;
        $privateKeyfinal = openssl_get_privatekey($privateKey);
    //echo "<script>console.log('after priv final ".$privateKeyfinal."');</script>";
        if(openssl_private_decrypt(base64_decode($crypted), $decrypted, $privateKeyfinal)){
        echo "<script>console.log('after decrypt');</script>";   
     return $decrypted;
        }else{
            throw new ApiException('Failed to decrypt.');
        }
    }

    public static function sign($data,$privateKey){
        $signature = null;
        if(openssl_sign($data,$signature,$privateKey)){
            return base64_encode($signature);
        }else{
            throw new ApiException('Failed to sign.');
        }
    }

    public static function verify($data,$signature,$publicKey){
        if(openssl_verify($data,base64_decode($signature),$publicKey)){
            return true;
        }else{
            throw new ApiException('Failed to verify.');
        }
    }

}
/*
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
*/

<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/4/17
 * Time: 2:26 PM
 */

namespace Com\Alacriti\Checkout\Client\Util;
//require_once('/../../vendor/autoload.php');
use Com\Alacriti\Checkout\Client\ApiException;
use Com\Alacriti\Checkout\Client\Util\PropertiesUtil;



use phpseclib3\Crypt\PublicKeyLoader;



class EncryptionUtil
{
    static $publicKey = null;
    static $privateKey = null;

    public static function encrypt($message,$publicKey){
    echo "<script>console.log('in encrypt method');</script>";
	//  $crypted = null;
    //      $pubKeyFinal = openssl_get_publickey($publicKey);
    //      //echo "<script>console.log('after pub final ".$pubKeyFinal."');</script>";
    //     if(openssl_public_encrypt($message, $crypted, $pubKeyFinal)){
	// 	echo "<script>console.log('after encrypt');</script>";
	// 	//$encrypted = base64_encode($crypted);
	// 	//echo "<script>console.log('encrypted message ".$encrypted."');</script>";

    //         return base64_encode($crypted);
    //     }else{
    //         echo openssl_error_string();
    //         throw new ApiException('Failed to encrypt.');
    //     }
    $public = PublicKeyLoader::load($publicKey);
    $crypted = $public->withPadding(\phpseclib3\Crypt\RSA::ENCRYPTION_PKCS1)
                      ->encrypt($message);
    return base64_encode($crypted);

    }

    // public static function decrypt($crypted,$privateKey){
    //     echo "<script>console.log('in decrypt method::::::::');</script>";
	//     $decrypted = null;
    //     $privateKeyfinal = openssl_get_privatekey($privateKey);
	// //echo "<script>console.log('after priv final ".$privateKeyfinal."');</script>";
    //     if(openssl_private_decrypt(base64_decode($crypted), $decrypted, $privateKeyfinal)){
    //     echo "<script>console.log('after decrypt');</script>";   
	//  return $decrypted;
    //     }else{
    //         echo "<script>console.log('in else case:::::s');</script>";
    //         echo openssl_error_string();
    //         throw new ApiException('Failed to decrypt.');
    //     }
    // }

    // public static function decryptTest($crypted,$privateKey){
    //     echo "<script>console.log('in decrypt New method::::::::');</script>";
	//     $decrypted = null;
    // $privateKeyfinal = openssl_get_privatekey($privateKey);
	// //echo "<script>console.log('after priv final ".$privateKeyfinal."');</script>";
    //     if(openssl_private_decrypt(base64_decode($crypted), $decrypted, $privateKeyfinal)){
    //     echo "<script>console.log('after decrypt');</script>";   
	//  return $decrypted;
    //     }else{
    //         echo "<script>console.log('in else NEw case:::::s');</script>";
    //         echo openssl_error_string();
    //         throw new ApiException('Failed to decrypt.');
    //     }
    // }


    public static function decrypt($crypted,$privateKey){
        echo "<script>console.log('in decrypt method');</script>";
        // echo "<script>console.log('Type of crypted: " . gettype($crypted) . "');</script>";
        // echo "<script>console.log('Crypted first 50 chars: " . substr((string)$crypted, 0, 50) . "');</script>";
        // echo "<script>console.log('Private key first 50 chars: " . substr($privateKey, 0, 50) . "');</script>";
        // echo "<script>console.log('Private key length: " . strlen($privateKey) . "');</script>";

        try {
            $private = PublicKeyLoader::load($privateKey);
            echo "<script>console.log('Key loaded successfully');</script>";
            $tkn = $private->withPadding(\phpseclib3\Crypt\RSA::ENCRYPTION_PKCS1)
                           ->decrypt(base64_decode($crypted));
            return $tkn;
        } catch (\Exception $e) {
            echo "<script>console.log('Error loading key: " . $e->getMessage() . "');</script>";
            throw $e;
        }
    }

    public static function sign($data,$privateKey){
        $signature = null;
        if(openssl_sign($data,$signature,$privateKey,OPENSSL_ALGO_SHA256)){
            return base64_encode($signature);
        }else{
            echo openssl_error_string();
            throw new ApiException('Failed to sign.');
        }
    }

    public static function verify($data,$signature,$publicKey){
        echo "<script>console.log('Verify - Data: " . substr($data, 0, 50) . "');</script>";
        echo "<script>console.log('Verify - Signature first 50 chars: " . substr($signature, 0, 50) . "');</script>";
        echo "<script>console.log('Verify - Public key first 50 chars: " . substr($publicKey, 0, 50) . "');</script>";
        $pubKeyResource = openssl_get_publickey($publicKey);
        echo "<script>console.log('Public key resource: " . (is_resource($pubKeyResource) || is_object($pubKeyResource) ? 'valid' : 'invalid') . "');</script>";
        if(openssl_verify($data,base64_decode($signature),$pubKeyResource,OPENSSL_ALGO_SHA256)){
            return true;
        }else{
            echo openssl_error_string();
            throw new ApiException('Failed to verify.');
        }
        // $private = PublicKeyLoader::load($publicKey);
        // $res = $private->withHash("sha256")->withMGFHash('sha1')
        //                ->verify($data,base64_decode($signature));
        // if($res){
        //     echo "<script>console.log('Sign verification successful');</script>";
        // }else{
        //     echo openssl_error_string();
        //     echo "<script>console.log('Sign verification failed');</script>";
        // }
        // return $res;
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
?>
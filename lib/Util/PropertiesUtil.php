<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/4/17
 * Time: 2:26 PM
 */

namespace Com\Alacriti\Checkout\Client\Util;
use \Com\Alacriti\Checkout\Client\ApiException;
use \Com\Alacriti\Checkout\Client\Checkout;


class PropertiesUtil
{
    const CHECKOUT_API_SERVICE_URL = 'CHECKOUT_API_SERVICE_URL';
    const CHECKOUT_TLS_CERTIFICATE_LOCATION = 'CHECKOUT_TLS_CERTIFICATE_LOCATION';
    const CHECKOUT_PUBLIC_KEY_LOCATION = 'CHECKOUT_PUBLIC_KEY_LOCATION';
    const CLIENT_PRIVATE_KEY_LOCATION = 'CLIENT_PRIVATE_KEY_LOCATION';
    const CLIENT_PRIVATE_KEY_PASSWORD = 'CLIENT_PRIVATE_KEY_PASSWORD';
    const CLIENT_API_KEY = 'CLIENT_API_KEY';
    const LIVE_MODE = 'LIVE_MODE';

    static $properties = '';

    public static function  getProperty($property){

         if(self::$properties == null){

            throw new ApiException('Properties are missing.');
        }
        return self::$properties[$property];
    }
    public static function  checkProperty($property){
         if(self::$properties == null){

            throw new ApiException('Properties are missing.');
        }
//	var_dump(array_key_exists($property, self::$properties));
	if( array_key_exists($property, self::$properties) ){
		return true;
	}else { return false; }

	}
}

$propertiesFile = null;


try{
    $propertiesStream = Checkout::getPropertiesStream();
    if($propertiesStream != null){
            $json = json_decode($propertiesStream,true);
            PropertiesUtil::$properties = $json;
    }
    else{
        global $propertiesFile;
        $propertiesFilePath = Checkout::getPropertiesFilePath();

        if($propertiesFilePath == false){
            $propertiesFilePath = getenv('orbipay_checkout_config');
        }

        if($propertiesFilePath == false){
            throw new ApiException('properties file path and env variable orbipay_checkout_config is missing');
        }

        $propertiesFile = fopen($propertiesFilePath,'r');
        $str = fread($propertiesFile, filesize($propertiesFilePath));

        $json = json_decode($str,true);
        //print_r('this is json');
        // print_r($json);
        PropertiesUtil::$properties = $json;
    }

}catch (\Exception $e){
    error_log($e);
    throw new ApiException('Unable to read properties file.');
}finally{
    if($propertiesFile !== null){
        fclose($propertiesFile);
    }
}


<?php
/**
 * Created by PhpStorm.
 * User: parvezk
 * Date: 16/3/19
 * Time: 7:27 PM
 */

namespace Com\Alacriti\Checkout\Client;

class Checkout
{
    private static $path = "";
    private static $str = "";

    public static function initProperties($propertiesFilePath){

        if($propertiesFilePath == null){
            throw new ApiException('Invalid properties file path:'+ $propertiesFilePath);
        }
	
        self::$path = $propertiesFilePath;
    }


    public static function initPropertiesStream($propertiesArg){
       if($propertiesArg != null){
	    
			self::$str = $propertiesArg;
    	}
	else {
            throw new ApiException('Invalid properties Stream');
	}	
    }

    public static function getPropertiesFilePath(){
        return self::$path;
    }

    public static function getPropertiesStream(){
        return self::$str;
    }

}

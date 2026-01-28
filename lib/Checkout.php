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

        echo "<script>console.log('in initProperties:::".$propertiesFilePath."');</script>";
        if($propertiesFilePath == null){
	    echo "<script>console.log('Invalid properties file path!');</script>";
            throw new ApiException('Invalid properties file path:'+ $propertiesFilePath);
        }
	
        self::$path = $propertiesFilePath;
    }


    public static function initPropertiesStream($propertiesArg){
       if($propertiesArg != null){
	    
			echo "<script>console.log('in initProperties with StreamReader:::');</script>";
			self::$str = $propertiesArg;
    	}
	else {
	    echo "<script>console.log('Invalid properties Stream');</script>";
            throw new ApiException('Invalid properties Stream');
	}	
    }

    public static function getPropertiesFilePath(){
	   echo "<script>console.log('in getPropertiesFilePath:".self::$path."');</script>";
        return self::$path;
    }

    public static function getPropertiesStream(){
       echo "<script>console.log('in getPropertiesStream');</script>";
        return self::$str;
    }

}

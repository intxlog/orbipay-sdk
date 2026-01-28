<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/4/17
 * Time: 2:25 PM
 */

namespace Com\Alacriti\Checkout\Client\Util;


use Com\Alacriti\Checkout\Client\Constants\APIConstants;
use Com\Alacriti\Checkout\Client\ApiException;

class AuthenticationUtilNew
{
    const ENCODE_TYPE = 'utf-8';
    const SEPARATOR = ':';
    const CHECKOUT_HEADERS = ['client_id','digi_sign'];


    public static function computeHMACSHA256Hash($url, $method, $queryParams,
                                                 $postData, $headerParams, $signatureKey){

       echo "<script>console.log('in computeHMACSHA256Hash ');</script>";

        $authenticationString = '';


        $indexOfSubPath = strpos($url,APIConstants::APP_URL_BASE);

        if($indexOfSubPath === false){
            throw new ApiException('Invalid CHECKOUT_API_SERVICE_URL.');
        }

        $lengthOfSubPath = strlen($url) - $indexOfSubPath;

        $subPath = substr($url,$indexOfSubPath,$lengthOfSubPath);

        $authenticationString .= trim((strtoupper($method) . self::SEPARATOR));

        $authenticationString .= trim(($subPath . self::SEPARATOR));

        $authenticationString .= self::getQueryString($queryParams);

        $authenticationString .= self::getHeaderString($headerParams);


        if(isset($postData) && trim($postData) !== '' && $postData !== 'null'){
            $authenticationString .= $postData;
        }

        return self::generateHash($authenticationString, $signatureKey);
    }

    private static function getQueryString($queryParams){

        $queryString = '';
        ksort($queryParams);
        $countOfQueryParams = count($queryParams);

        $i = 0;
        foreach($queryParams as $key => $value) {
            if($i !== ($countOfQueryParams-1)){
                $queryString .= ($key.'='.$value.'&');
            }else{
                $queryString .= ($key.'='.$value);
            }
            ++$i;
        }
        return $queryString . self::SEPARATOR;
    }

    private static function getHeaderString($headerParams){
        $headerString = '';
        ksort($headerParams);
        $filteredHeaders = [];
        foreach($headerParams as $key => $value) {
            if (in_array($key, self::CHECKOUT_HEADERS)) {
                $filteredHeaders[$key] = $value;
            }
        }


        $i = 0;
        $countOfFilteredHeaderParams = count($filteredHeaders);
        foreach($filteredHeaders as $key => $value) {
            if ($i !== ($countOfFilteredHeaderParams - 1)) {
                $headerString .= ($key . '=' . $value . '&');
            } else {
                $headerString .= ($key . '=' . $value);
            }
            ++$i;

        }
        return $headerString . self::SEPARATOR;
    }

    private static function generateHash($data, $key){
        echo "<script>console.log('in generateHash ');</script>";
        try{
            return base64_encode(hash_hmac ( 'sha256' , $data , $key,true));
        }catch (\Exception $e){
            throw new ApiException('Unable to generate hash.');
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: saikrishnar
 * Date: 12/5/17
 * Time: 12:18 PM
 */

namespace Com\Alacriti\Checkout\Client\Constants;


class APIConstants
{
    const ENCODE_TYPE = 'utf-8';
    const SEPARATOR = ':';
    //const CHECKOUT_HEADERS = ['client_id','digi_sign'];
    const APP_URL_BASE = "/app";
    const OPCO_HASH_ALGORITHM = "OPCO1-HMAC-SHA256";
    const OPAY1_AUTHORIZATION_SCHEME = "OPAY1-HMAC-SHA256";
    const HMAC_ALGORITHM = "HmacSHA256";
    const USER_AGENT = "co-php-sdk-v5.4.0";
    const LIVE_MODE_TRUE = "true";
    const LIVE_MODE_FALSE = "false";
    const LIVE_MODE_LOCAL = "local";
    const LIVE_MODE_DEVITG = "devitg";
    const LIVE_MODE_QA = "qa";
    const SANDBOX_API_SERVICE_URL = "https://sbapico.billerpayments.com/app/opco/v5/service";
    const PRODUCTION_API_SERVICE_URL = "https://apico.billerpayments.com/app/opco/v5/service";
   const LOCAL_API_SERVICE_URL = "http://10.112.242.19:15443/app/opco/v5/service";
   const DEVITG_API_SERVICE_URL = "https://devitgapico.billerpayments.com/app/opco/v5/service";
   const QA_API_SERVICE_URL = "https://qaapico.billerpayments.com/app/opco/v5/service";
}

# Com\Alacriti\Checkout\Client\ChargeApi

All URIs are relative to *https://sbjsco.billerpayments.com/app/opco/v1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**confirmCharge**](ChargeApi.md#confirmCharge) | **POST** /charges/confirm-charge | Confirm Charge


# **confirmCharge**
> \Com\Alacriti\Checkout\Client\Model\Charge confirmCharge($partner_id, $token_id, $digi_sign, $confirm_charge_request)

Confirm Charge

The Confirm Charge API takes the token_id and process the payment request by initiating the debit of funds from the funding account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$api_instance = new Com\Alacriti\Checkout\Client\Api\ChargeApi();
$partner_id = "partner_id_example"; // string | Unique partner Identifier, for example  cli_example5852kw555
$token_id = "token_id_example"; // string | One time usage token issued by Checkout, for example KrsxtD6BAyNFTutlbvZibxf4Gb0bU8U+/+DU+KmoecKAYY41b+5kyABM3/gzWg9mgzTtlkSqlavJVrL+RWOfw223Ef3Nw4jV4J2XdWntvOJOldybKk7/4SgBRdllakp4i+Iuk/SEmaEWMj/UC0vy930gpNTrCpCbZQtJtmHqjjA8bHIcnKf5F7LSmlPK6ND7xSlGdi1g9aOmmGiN2ZktZkCXzYormZLjX1SElC9cxHmygdLt2zCqhLBr0wEGBsaYCFOTrFTYRsUcLs4IHR8lixlG1IhPtoDolRxxuLyRic+ZgM2KxcPvQXJgplL8n/szBNlteT28SXTxLPzFtB+TFA==
$digi_sign = "digi_sign_example"; // string | Generated Digital Signature for data using private key, for example BQYpeA50hrxKGjQs76oLRyTTbTEbFslxlZDkePpP6pz2gLFeSY9YekAnBP4BzacDz46kCLaQDIoGEUlY0ujlSD/3YoxRVmuvXGkSsG+7tHQidrwCmYa0qTGXM1xRq9x7Q77T8mV/rV9cuOIYr9Y9bjkpSi8XyDHwBBLzibCYOl7LG1loQA4CJ7cs8WKhqdPn1kR7gtl2AFbGp+BLuN1mvMYNiXfwsS1OYMzj0pEdDDL5xz8wRYjHSemixE2MzkUSSEzSCHrRz8KPG508uQ17i7KdszcWQjvwhow3NtCdHxYvXuv/tq0FJoCTJk92TtTe006viXQg5wu+KuUrO3yW1Q==
$confirm_charge_request = new \Com\Alacriti\Checkout\Client\Model\ConfirmChargeRequest(); // \Com\Alacriti\Checkout\Client\Model\ConfirmChargeRequest | This JSON contains all the attributes to Confirm Charge.

try {
    $result = $api_instance->confirmCharge($partner_id, $token_id, $digi_sign, $confirm_charge_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling ChargeApi->confirmCharge: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **partner_id** | **string**| Unique partner Identifier, for example  cli_example5852kw555 |
 **token_id** | **string**| One time usage token issued by Checkout, for example KrsxtD6BAyNFTutlbvZibxf4Gb0bU8U+/+DU+KmoecKAYY41b+5kyABM3/gzWg9mgzTtlkSqlavJVrL+RWOfw223Ef3Nw4jV4J2XdWntvOJOldybKk7/4SgBRdllakp4i+Iuk/SEmaEWMj/UC0vy930gpNTrCpCbZQtJtmHqjjA8bHIcnKf5F7LSmlPK6ND7xSlGdi1g9aOmmGiN2ZktZkCXzYormZLjX1SElC9cxHmygdLt2zCqhLBr0wEGBsaYCFOTrFTYRsUcLs4IHR8lixlG1IhPtoDolRxxuLyRic+ZgM2KxcPvQXJgplL8n/szBNlteT28SXTxLPzFtB+TFA&#x3D;&#x3D; |
 **digi_sign** | **string**| Generated Digital Signature for data using private key, for example BQYpeA50hrxKGjQs76oLRyTTbTEbFslxlZDkePpP6pz2gLFeSY9YekAnBP4BzacDz46kCLaQDIoGEUlY0ujlSD/3YoxRVmuvXGkSsG+7tHQidrwCmYa0qTGXM1xRq9x7Q77T8mV/rV9cuOIYr9Y9bjkpSi8XyDHwBBLzibCYOl7LG1loQA4CJ7cs8WKhqdPn1kR7gtl2AFbGp+BLuN1mvMYNiXfwsS1OYMzj0pEdDDL5xz8wRYjHSemixE2MzkUSSEzSCHrRz8KPG508uQ17i7KdszcWQjvwhow3NtCdHxYvXuv/tq0FJoCTJk92TtTe006viXQg5wu+KuUrO3yW1Q&#x3D;&#x3D; |
 **confirm_charge_request** | [**\Com\Alacriti\Checkout\Client\Model\ConfirmChargeRequest**](../Model/ConfirmChargeRequest.md)| This JSON contains all the attributes to Confirm Charge. |

### Return type

[**\Com\Alacriti\Checkout\Client\Model\Charge**](../Model/Charge.md)

### Authorization

Authorization Header is required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)


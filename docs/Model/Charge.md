# Charge

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**charge_id** | **string** | Id is a unique identifier assigned to a payment in OrbiPay-Checkout system. | [optional] 
**confirmation_number** | **string** | A unique reference assigned to the charge by Orbipay-Checkout system for any future communications | [optional] 
**charge_status** | **string** | Status of the charge | [optional] 
**charge_amount** | **string** | Amount fields are of format N [9, 2] with . as decimal separator         (for e.g. 100.20). | [optional] 
**charge_amount_currency** | **string** | 3 character ISO currency code should be provided in currencyCode3d field defaulted to USD if its not populated. | [optional] 
**charge_date** | **string** | payment date should be in mm/dd/yyyy. | [optional] 
**custom_fields** | **object** |  | [optional] 
**funding_account_info** | [**\Com\Alacriti\Checkout\Client\Model\FundingAccountInfo**](FundingAccountInfo.md) |  | [optional] 
**customer_info** | [**\Com\Alacriti\Checkout\Client\Model\CustomerInfo**](CustomerInfo.md) |  | [optional] 
**customer_account_info** | [**\Com\Alacriti\Checkout\Client\Model\CustomerAccountInfo**](CustomerAccountInfo.md) |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)



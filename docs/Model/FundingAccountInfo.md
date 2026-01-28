# FundingAccountInfo

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | Id is a unique identifier assigned to the funding account in OrbiPay-Checkout system. | [optional] 
**aba_routing_number** | **string** | ABA Routing Number is mandatory for Bank Accounts. | [optional] 
**account_issuing_institution_name** | **string** |  | [optional] 
**account_number** | **string** | Account Number field is expected to be a unique field for the accounts in partner system. | 
**currency_code3d** | **string** | 3 character ISO currency code should be provided in currencyCode3d field default to USD. | 
**account_type** | **string** | Account Type indicates the type of a funding account. | [optional] 
**account_subtype** | **string** | &#39;Account Sub Type indicates the sub type of a funding account.&#39; | [optional] 
**expiry_date** | **string** | Expiry date of the account is of format mm/yy | [optional] 
**card_cvv_number** | **string** | Card CVV/CVV2 number is conditional and needs to be passed when adding or editing a Card as a funding account. | [optional] 
**account_holder_name** | **string** |  | [optional] 
**address** | [**\Com\Alacriti\Checkout\Client\Model\AddressInfo**](AddressInfo.md) |  | [optional] 
**save_for_future_use** | **string** | true to use funding account for future payments, false otherwise. | [optional] 
**nickname** | **string** | The nickname by which a customer might want to identify the account. | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)



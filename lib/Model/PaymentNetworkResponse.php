<?php
/**
 * Created by PhpStorm.
 * User: parvezk
 * Date: 5/14/18
 * Time: 4:18 PM
 */

namespace Com\Alacriti\Checkout\Client\Model;

use \ArrayAccess;

/**
 * PaymentNetworkResponse Class Doc Comment
 *
 * @category    Class
 * @package     Com\Alacriti\Checkout\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */

class PaymentNetworkResponse implements ArrayAccess
{
    const DISCRIMINATOR = null;
    /**
     * The original name of the model.
     * @var string
     */
    protected static $swaggerModelName = 'PaymentNetworkResponse';

    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $swaggerTypes = [
        'payment_auth_code' => 'string',
        'payment_response_code' => 'string',
        'payment_response_msg' => 'string'
    ];

    protected static $swaggerFormats = [
        'payment_auth_code' => null,
        'payment_response_code' => null,
        'payment_response_msg' => null
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'payment_auth_code' => 'payment_auth_code',
        'payment_response_code' => 'payment_response_code',
        'payment_response_msg' => 'payment_response_msg'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'payment_auth_code' => 'setPaymentAuthCode',
        'payment_response_code' => 'setPaymentResponseCode',
        'payment_response_msg' => 'setPaymentResponseMsg'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'payment_auth_code' => 'getPaymentAuthCode',
        'payment_response_code' => 'getPaymentResponseCode',
        'payment_response_msg' => 'getPaymentResponseMsg'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['payment_auth_code'] = isset($data['payment_auth_code']) ? $data['payment_auth_code'] : null;
        $this->container['payment_response_code'] = isset($data['payment_response_code']) ? $data['payment_response_code'] : null;
        $this->container['payment_response_msg'] = isset($data['payment_response_msg']) ? $data['payment_response_msg'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return true;
    }

    /**
     * Gets payment_auth_code
     * @return string
     */
    public function getPaymentAuthCode()
    {
        return $this->container['payment_auth_code'];
    }

    /**
     * Sets payment_auth_code
     * @param string $payment_auth_code
     * @return $this
     */
    public function setPaymentAuthCode($payment_auth_code)
    {

        $this->container['payment_auth_code'] = $payment_auth_code;

        return $this;
    }

    /**
     * Gets payment_response_code
     * @return string
     */
    public function getPaymentResponseCode()
    {
        return $this->container['payment_response_code'];
    }

    /**
     * Sets payment_response_code
     * @param string $payment_response_code
     * @return $this
     */
    public function setPaymentResponseCode($payment_response_code)
    {

        $this->container['payment_response_code'] = $payment_response_code;

        return $this;
    }

    /**
     * Gets payment_response_msg
     * @return string
     */
    public function getPaymentResponseMsg()
    {
        return $this->container['payment_response_msg'];
    }

    /**
     * Sets payment_response_msg
     * @param string $payment_response_msg
     * @return $this
     */
    public function setPaymentResponseMsg($payment_response_msg)
    {

        $this->container['payment_response_msg'] = $payment_response_msg;

        return $this;
    }


    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Com\Alacriti\Checkout\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Com\Alacriti\Checkout\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}

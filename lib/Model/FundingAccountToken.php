<?php
/**
 * Created by PhpStorm.
 * User: parvezk
 * Date: 4/11/18
 * Time: 12:37 PM
 */

namespace Com\Alacriti\Checkout\Client\Model;


class FundingAccountToken extends BaseToken
{
    /**
     * The original name of the model.
     * @var string
     */
    protected static $swaggerModelName = 'FundingAccountToken';

    /**
     * Array of property to type mappings. Used for (de)serialization
     * @var string[]
     */
    protected static $swaggerTypes = [
        'token' => 'string'
        //'custom_fields' => 'object'
    ];

    protected static $swaggerFormats = [
        'token' => null
        //'custom_fields' => null
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
        'token' => 'token'
        //'custom_fields' => 'custom_fields'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'token' => 'setToken'
        //'custom_fields' => 'setCustomFields'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'token' => 'getToken'
        //'custom_fields' => 'getCustomFields'
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
        parent::__construct();
        $this->container['token'] = isset($data['token']) ? $data['token'] : null;
        //$this->container['custom_fields'] = isset($data['custom_fields']) ? $data['custom_fields'] : null;
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
     * Gets token
     * @return string
     */
    public function getToken()
    {
        return $this->container['token'];
    }

    /**
     * Sets token
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->container['token'] = $token;
        return $this;
    }

    /**
     * Gets tokenized amount
     * @return string
     */
    public function getCustomFields()
    {
        return $this->container['custom_fields'];
    }

    /**
     * Sets custom fields
     * @param string $custom_fields
     * @return $this
     */
    public function setCustomFields($custom_fields)
    {
        $this->container['custom_fields'] = $custom_fields;
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

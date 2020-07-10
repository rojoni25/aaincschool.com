<?php
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace SquareConnect\Model;

use \ArrayAccess;
/**
 * CatalogDiscount Class Doc Comment
 *
 * @category Class
 * @package  SquareConnect
 * @author   Square Inc.
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://squareup.com/developers
 */
class CatalogDiscount implements ArrayAccess
{
    /**
      * Array of property to type mappings. Used for (de)serialization 
      * @var string[]
      */
    static $swaggerTypes = array(
        'name' => 'string',
        'discount_type' => 'string',
        'percentage' => 'string',
        'amount_money' => '\SquareConnect\Model\Money',
        'pin_required' => 'bool',
        'label_color' => 'string'
    );
  
    /** 
      * Array of attributes where the key is the local name, and the value is the original name
      * @var string[] 
      */
    static $attributeMap = array(
        'name' => 'name',
        'discount_type' => 'discount_type',
        'percentage' => 'percentage',
        'amount_money' => 'amount_money',
        'pin_required' => 'pin_required',
        'label_color' => 'label_color'
    );
  
    /**
      * Array of attributes to setter functions (for deserialization of responses)
      * @var string[]
      */
    static $setters = array(
        'name' => 'setName',
        'discount_type' => 'setDiscountType',
        'percentage' => 'setPercentage',
        'amount_money' => 'setAmountMoney',
        'pin_required' => 'setPinRequired',
        'label_color' => 'setLabelColor'
    );
  
    /**
      * Array of attributes to getter functions (for serialization of requests)
      * @var string[]
      */
    static $getters = array(
        'name' => 'getName',
        'discount_type' => 'getDiscountType',
        'percentage' => 'getPercentage',
        'amount_money' => 'getAmountMoney',
        'pin_required' => 'getPinRequired',
        'label_color' => 'getLabelColor'
    );
  
    /**
      * $name The discount's name. Searchable.
      * @var string
      */
    protected $name;
    /**
      * $discount_type Indicates whether the discount is a fixed amount or percentage, or entered at the time of sale. See [CatalogDiscountType](#type-catalogdiscounttype) for all possible values.
      * @var string
      */
    protected $discount_type;
    /**
      * $percentage The percentage of the discount as a string representation of a decimal number, using a `.` as the decimal separator and without a `%` sign. A value of `7.5` corresponds to `7.5%`. Specify a percentage of `0` if `discount_type` is `VARIABLE_PERCENTAGE`.  Do not include this field for amount-based or variable discounts.
      * @var string
      */
    protected $percentage;
    /**
      * $amount_money The amount of the discount. Specify an amount of `0` if `discount_type` is `VARIABLE_AMOUNT`.  Do not include this field for percentage-based or variable discounts.
      * @var \SquareConnect\Model\Money
      */
    protected $amount_money;
    /**
      * $pin_required Indicates whether a mobile staff member needs to enter their PIN to apply the discount to a payment in the Square Point of Sale app.
      * @var bool
      */
    protected $pin_required;
    /**
      * $label_color The color of the discount's display label in the Square Point of Sale app.
      * @var string
      */
    protected $label_color;

    /**
     * Constructor
     * @param mixed[] $data Associated array of property value initializing the model
     */
    public function __construct(array $data = null)
    {
        if ($data != null) {
            if (isset($data["name"])) {
              $this->name = $data["name"];
            } else {
              $this->name = null;
            }
            if (isset($data["discount_type"])) {
              $this->discount_type = $data["discount_type"];
            } else {
              $this->discount_type = null;
            }
            if (isset($data["percentage"])) {
              $this->percentage = $data["percentage"];
            } else {
              $this->percentage = null;
            }
            if (isset($data["amount_money"])) {
              $this->amount_money = $data["amount_money"];
            } else {
              $this->amount_money = null;
            }
            if (isset($data["pin_required"])) {
              $this->pin_required = $data["pin_required"];
            } else {
              $this->pin_required = null;
            }
            if (isset($data["label_color"])) {
              $this->label_color = $data["label_color"];
            } else {
              $this->label_color = null;
            }
        }
    }
    /**
     * Gets name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
  
    /**
     * Sets name
     * @param string $name The discount's name. Searchable.
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    /**
     * Gets discount_type
     * @return string
     */
    public function getDiscountType()
    {
        return $this->discount_type;
    }
  
    /**
     * Sets discount_type
     * @param string $discount_type Indicates whether the discount is a fixed amount or percentage, or entered at the time of sale. See [CatalogDiscountType](#type-catalogdiscounttype) for all possible values.
     * @return $this
     */
    public function setDiscountType($discount_type)
    {
        $this->discount_type = $discount_type;
        return $this;
    }
    /**
     * Gets percentage
     * @return string
     */
    public function getPercentage()
    {
        return $this->percentage;
    }
  
    /**
     * Sets percentage
     * @param string $percentage The percentage of the discount as a string representation of a decimal number, using a `.` as the decimal separator and without a `%` sign. A value of `7.5` corresponds to `7.5%`. Specify a percentage of `0` if `discount_type` is `VARIABLE_PERCENTAGE`.  Do not include this field for amount-based or variable discounts.
     * @return $this
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
        return $this;
    }
    /**
     * Gets amount_money
     * @return \SquareConnect\Model\Money
     */
    public function getAmountMoney()
    {
        return $this->amount_money;
    }
  
    /**
     * Sets amount_money
     * @param \SquareConnect\Model\Money $amount_money The amount of the discount. Specify an amount of `0` if `discount_type` is `VARIABLE_AMOUNT`.  Do not include this field for percentage-based or variable discounts.
     * @return $this
     */
    public function setAmountMoney($amount_money)
    {
        $this->amount_money = $amount_money;
        return $this;
    }
    /**
     * Gets pin_required
     * @return bool
     */
    public function getPinRequired()
    {
        return $this->pin_required;
    }
  
    /**
     * Sets pin_required
     * @param bool $pin_required Indicates whether a mobile staff member needs to enter their PIN to apply the discount to a payment in the Square Point of Sale app.
     * @return $this
     */
    public function setPinRequired($pin_required)
    {
        $this->pin_required = $pin_required;
        return $this;
    }
    /**
     * Gets label_color
     * @return string
     */
    public function getLabelColor()
    {
        return $this->label_color;
    }
  
    /**
     * Sets label_color
     * @param string $label_color The color of the discount's display label in the Square Point of Sale app.
     * @return $this
     */
    public function setLabelColor($label_color)
    {
        $this->label_color = $label_color;
        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->$offset);
    }
  
    /**
     * Gets offset.
     * @param  integer $offset Offset 
     * @return mixed 
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }
  
    /**
     * Sets value based on offset.
     * @param  integer $offset Offset 
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }
  
    /**
     * Unsets offset.
     * @param  integer $offset Offset 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
  
    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        } else {
            return json_encode(\SquareConnect\ObjectSerializer::sanitizeForSerialization($this));
        }
    }
}

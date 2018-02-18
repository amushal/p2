<?php
namespace Mushal;

use DWA;

class MyForm extends DWA\Form
{
    const DISCOUNT_FIELD = "discount";
    const TAX_FIELD = "tax";

/*
* Returns boolean if given value contains only letters/numbers/spaces
* @param $value
* @return bool
*/
    protected function alphaNumeric($value)
    {
        $valid = true;
        if ($value != '')
            return ctype_alnum(str_replace(' ', '', $value));

        return $valid;
    }
    /**
     * Returns boolean if the given value is a valid email address
     */
    protected function email($value)
    {
        $valid = true;
        if ($value != '')
            $valid = filter_var($value, FILTER_VALIDATE_EMAIL);

        return $valid;
    }

    /**
     * Returns boolean if the given value is a valid URL
     */
    protected function url($value)
    {
        # Version 2
        $valid = true;
        if ($value != '')
            $valid = filter_var($value, FILTER_VALIDATE_URL);

        return $valid;
    }

    /**
     * Returns true if given parameter is optional
     */
    private function isOptional($fieldname)
    {
        if ($fieldname == self::DISCOUNT_FIELD || $fieldname == self::TAX_FIELD) {
            return true;
        }
    }

    /**
     * Returns value if the given value is GREATER THAN (non-inclusive) the given parameter
     */
    protected function min($value, $parameter, $fieldname)
    {
        //exclude optional fields if empty
        if ($this->isOptional($fieldname) && $value == '')
            return true;

        return floatval($value) > floatval($parameter);
    }

    /**
     * Returns value if the given value is LESS THAN (non-inclusive) the given parameter
     */
    protected function max($value, $parameter, $fieldname)
    {
        if ($this->isOptional($fieldname) && $value == '')
            return true;

        return floatval($value) < floatval($parameter);
    }

    /**
     * Returns boolean if given value contains only positive whole numbers
     * @param $value
     * @return bool
     */
    protected function float($value)
    {
        return filter_var($value, FILTER_VALIDATE_FLOAT);
    }

    /**
     * Returns boolean if given value contains only numbers
     */
    protected function numeric($value)
    {
        # Check if value (sans decimals) is numeric
        $numeric = ctype_digit(str_replace([' ', '.'], '', $value));

        # A valid number should have either 0 or 1 decimals
        $oneOrNoneDecimal = in_array(substr_count($value, '.'), [0, 1]);

        return $numeric and $oneOrNoneDecimal;
    }

} # end of class
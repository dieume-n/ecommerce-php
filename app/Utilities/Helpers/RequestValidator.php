<?php

namespace App\Utilities\Helpers;

use illuminate\Database\Capsule\Manager as Capsule;

class RequestValidator
{
    private static $error = [];
    private static $error_messages = [
        'string' => 'The :attribute field cannot contain numbers or special characters',
        'required' => 'The :attribute field cannot be empty',
        'minLength' => 'The :attribute field must be a minimum of :policy characters',
        'maxLength' => 'The :attribute field must be a maximum of :policy characters',
        'mixed' => 'The :attribute field contain only letters, numbers, dash and space',
        'number' => 'The :attribute field cannot contain letter',
        'email' => 'Email address is not valid',
        'unique' => 'The :attribute is already taken, please try another one'
    ];

    /**
     * Check if value exist in DB
     *
     * @param string $column
     * @param string $value
     * @param mixed $policy
     * @return bool
     */
    protected static function unique($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return !Capsule::table($policy)->where($column, '=', ucfirst($value))->exists();
        }
        return true;
    }
    /**
     * Enforce data requirement a value must be provided
     *
     * @param string $column
     * @param mixed $value
     * @param mixed $policy
     * @return bool
     */
    protected static function required($column, $value, $policy)
    {
        return $value !== null && !empty($value);
    }

    /**
     * Enforce characters length
     *
     * @param string $column
     * @param mixed $value
     * @param int $policy
     * @return bool
     */
    protected static function minLenght($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return strlen($value) >= $policy;
        }
        return true;
    }

    /**
     * Max number of character
     *
     * @param string $column
     * @param string $value
     * @param int $policy
     * @return bool
     */
    protected static function maxLength($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return strlen($value) <= $policy;
        }
        return true;
    }

    /**
     * Check if input is email
     *
     * @param string $column
     * @param string $value
     * @param string $policy
     * @return bool
     */
    public static function email($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return false;
            };
        }
        return true;
    }

    /**
     * Allow multiple characters
     *
     * @param string $column
     * @param string $value
     * @param mixed $policy
     * @return bool
     */
    public static function mixed($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            if (!preg_match('/^[A-Za-z0-9 .,_~\-!@#\&%\^\'\*\(\)]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Allows letters only
     *
     * @param string $column
     * @param string $value
     * @param mixed $policy
     * @return bool
     */
    public static function string($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            if (!preg_match('/^[A-Za-z ]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Allo numbers only
     *
     * @param string $column
     * @param mixed $value
     * @param mixed $policy
     * @return bool
     */
    public static function number($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            if (!preg_match('/^[0-9.]+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    public function abide(array $dataAndValues, array $policies)
    {
        foreach ($dataAndValues as $column => $value) {
            if (in_array($column, array_keys($policies))) {
                // perform validation
                self::doValidation([
                    'column' => $column,
                    'value' => $value,
                    'policies' => $policies[$column]
                ]);
            }
        }
    }

    /**
     * Perform validatation dynamically
     *
     * @param array $data
     * @return void
     */
    private static function doValidation(array $data)
    {
        $column = $data['column'];
        foreach ($data['policies'] as $rule => $policy) {
            $valid = call_user_func_array([self::class, $rule], [$column, $data['value'], $policy]);
            if (!$valid) {
                self::setError(
                    str_replace(
                        [':attribute', ':policy', '_'],
                        [$column, $policy, ' '],
                        self::$error_messages[$rule]
                    ),
                    $column
                );
            }
        }
    }

    /**
     * Set specific error Messages
     *
     * @param [type] $error
     * @param [type] $key
     * @return void
     */
    private static function setError($error, $key = null)
    {
        if ($key) {
            self::$error[$key][] = $error;
        } else {
            self::$error[] = $error;
        }
    }
    /**
     * Check if error exists
     *
     * @return boolean
     */
    public function hasError()
    {
        return count(Self::$error) > 0 ? true : false;
    }

    /**
     * Return all validation errors
     *
     * @return array
     */
    public function getErrorMessages()
    {
        return self::$error;
    }
}

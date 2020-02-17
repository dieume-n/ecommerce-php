<?php

namespace App\Utilities\Helpers;

use illuminate\Database\Capsule\Manager as Capsule;

class RequestValidator
{
    protected function unique($column, $value, $policy)
    {
        if ($value != null && !empty($value)) {
            return !Capsule::table($policy)->where($column, '=', $value)->exists();
        }
        return true;
    }
}

<?php

namespace App\Utilities\Helpers;

class Redirect
{
    /**
     * Redirect to a given page
     *
     * @param strinf $location
     * @return void
     */
    public static function to($location)
    {
        header("location: $location");
    }

    /**
     * Redirect bact to the current page
     *
     * @return void
     */
    public static function back()
    {
        $uri = $_SERVER['REQUEST_URI'];
        header("location: $uri");
    }
}

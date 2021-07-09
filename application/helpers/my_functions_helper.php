<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('pre')) {

    function pre($arg, $exit = TRUE) {
        echo "<pre>";
        print_r($arg);
        echo "</pre>";
        if ($exit)
            die();
    }

}




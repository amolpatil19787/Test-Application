<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('url')) {

    function url($param = TRUE)
    {
        if ($param) {
            return 'http://www.acquiscent.com/TestApplication';
        }
        return 'http://www.test.acquiscent.com/TestApplication';
    }

}
?>
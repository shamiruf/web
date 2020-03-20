<?php

    /**
     * Check if value is not empty
     * 
     * @param $value value
     */
    function isNotEmpty($value) {
        return strlen($value) != 0;
    }

    /**
     * Check if value contains letters and spaced
     * 
     * @param $value value
     */
    function isLettersAndSpaced($value) {
        return preg_match("/^[a-zA-Z ]*$/", $value);
    }

    /**
     * Check if value contains is email
     * 
     * @param $value value
     */
    function isEmail($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

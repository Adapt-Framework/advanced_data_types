<?php

namespace extensions\advanced_data_types;

/* Prevent Direct Access */
defined('ADAPT_STARTED') or die;

$adapt = $GLOBALS['adapt'];

/* Add validators */
$adapt->sanitize->add_validator(
    'xml',
    function($value){
        if ((is_object($value) && $value instanceof xml) || (is_string($value) && xml::is_xml($value))){
            return true;
        }
        return false;
    }
);

$adapt->sanitize->add_validator(
    'ip4',
    '^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$'
);

$adapt->sanitize->add_validator(
    'ip6',
    '^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$'
);

$adapt->sanitize->add_validator(
    'email_address',
    '^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$'
);

$adapt->sanitize->add_validator(
    'name',
    '^[A-Za-z]+([ \'-][A-Za-z]+)*$'
);

/* Add formatters */
$adapt->sanitize->add_formatter(
    'name',
    function($value){
        $value = strtolower($value);
        $breaks = array(" ", "'", "-");
        foreach($breaks as $break){
            $parts = explode($break, $value);
            for($i = 0; $i < count($parts); $i++){
                if (strlen($parts[$i]) == 1){
                    $parts[$i] = strtoupper($part[$i]);
                }elseif(strlen($parts[$i]) > 1){
                    $parts[$i] = strtoupper(substr($parts[$i], 0, 1)) . substr($parts[$i], 1);
                }
            }
            $value = implode($break, $parts);
        }
        return $value;
    }
);


/* Add Unformatters */


?>
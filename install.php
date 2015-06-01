<?php

/* Prevent Direct Access */
defined('ADAPT_STARTED') or die;

$adapt = $GLOBALS['adapt'];
$sql = $adapt->data_source->sql;

/* Add the new data types */
$data_types = array(
    array(
        'bundle_name' => 'advanced_data_types',
        'name' => 'xml',
        'based_on_data_type' => 'text',
        'validator' => 'xml',
        'formatter' => null,
        'unformatter' => null,
        'datetime_format' => null,
        'max_length' => null,
        'date_created' => null
    ),
    array(
        'bundle_name' => 'advanced_data_types',
        'name' => 'html',
        'based_on_data_type' => 'text',
        'validator' => 'html',
        'formatter' => null,
        'unformatter' => null,
        'datetime_format' => null,
        'max_length' => null,
        'date_created' => null
    ),
    array(
        'bundle_name' => 'advanced_data_types',
        'name' => 'ip4',
        'based_on_data_type' => 'varchar(15)',
        'validator' => 'ip4',
        'formatter' => null,
        'unformatter' => null,
        'datetime_format' => null,
        'max_length' => null,
        'date_created' => null
    ),
    array(
        'bundle_name' => 'advanced_data_types',
        'name' => 'ip6',
        'based_on_data_type' => 'varchar(256)',
        'validator' => 'ip6',
        'formatter' => null,
        'unformatter' => null,
        'datetime_format' => null,
        'max_length' => null,
        'date_created' => null
    ),
    array(
        'bundle_name' => 'advanced_data_types',
        'name' => 'email_address',
        'based_on_data_type' => 'varchar(256)',
        'validator' => 'email_address',
        'formatter' => null,
        'unformatter' => null,
        'datetime_format' => null,
        'max_length' => null,
        'date_created' => null
    ),
    array(
        'bundle_name' => 'advanced_data_types',
        'name' => 'name',
        'based_on_data_type' => 'varchar(64)',
        'validator' => 'name',
        'formatter' => 'name',
        'unformatter' => null,
        'datetime_format' => null,
        'max_length' => null,
        'date_created' => null
    )
);

/* Set the data types */
$adapt->data_source->data_types = array_merge($adapt->data_source->data_types, $data_types);

/* Add the new types to the data_type table */
foreach($data_types as &$data_type){
    $keys = array_keys($data_type);
    foreach($keys as $key){
        if ($key == 'date_created'){
            $data_type['date_created'] = new sql('now()');
        }elseif(is_null($data_type[$key])){
            $data_type[$key] = new sql('null');
        }
    }
}

$sql->insert_into('data_type', array_keys($data_types[0]));
foreach($data_types as $type) $sql->values(array_values($type));
$sql->execute();


?>
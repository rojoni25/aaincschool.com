<?php



function redirect_ssl() {

    $CI =& get_instance();

    $q=$CI->db->query('select setting_value from site_settings where lable_acces_nm="package_amount"');
    $res=$q->result_array();
    $amt=$res[0]['setting_value'];
    if(!defined('CW_MIN')){
        define('CW_MIN',$amt);
    }
    if(!defined('PW_MIN')){
        define('PW_MIN',$amt);
    }

    $class = $CI->router->fetch_class();

    $exclude =  array('client');  // add more controller name to exclude ssl.

    if(!in_array($class,$exclude)) {

        // redirecting to ssl.

        $CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);

        if ($_SERVER['SERVER_PORT'] != 443) redirect($CI->config->config['base_url'].'index.php/'.$CI->uri->uri_string());

    } else {

        // redirecting with no ssl.

        $CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);

        if ($_SERVER['SERVER_PORT'] == 443) redirect($CI->config->config['base_url'].'index.php/'.$CI->uri->uri_string());

    }

}




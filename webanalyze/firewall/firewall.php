<?php
/**
 * Collect all requests module
 * Copyright by SiteGuarding.com
 * Date: 10 Nov 2019
 * ver.: 5.1.3
 */
define( 'SITEGUARDING_FIREWALL_VERSION', '5.1');

define( 'SITEGUARDING_DEBUG', false);
define( 'SITEGUARDING_DEBUG_IP', '1.2.3.4');

error_reporting( 0 );

if( ! ini_get('date.timezone') )
{
    date_default_timezone_set('GMT');
}


if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') $DIRSEP = '\\';
else $DIRSEP = '/';

$file_firewall_class = dirname(__FILE__).$DIRSEP.'firewall.class.php';
$file_firewall_config = dirname(__FILE__).$DIRSEP.'firewall.config.php';
$file_firewall_rules = dirname(__FILE__).$DIRSEP.'rules.txt';

$ip_address = $_SERVER["REMOTE_ADDR"];
if (isset($_SERVER["HTTP_X_REAL_IP"])) $ip_address = $_SERVER["HTTP_X_REAL_IP"];
if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) $ip_address = $_SERVER["HTTP_X_FORWARDED_FOR"];
if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) $ip_address = $_SERVER["HTTP_CF_CONNECTING_IP"];
define( 'SITEGUARDING_THIS_SESSION_IP', $ip_address);

/**
 * Debug some values
 */
if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP)
{
    echo 'Class:'.$file_firewall_class."<br>";
    echo 'Config: '.$file_firewall_config."<br>";
    echo 'Rules: '.$file_firewall_rules."<br>";
    echo '__FILE__: '.__FILE__."<br>";
    echo 'SITEGUARDING_SCAN_PATH: '.SITEGUARDING_SCAN_PATH."<br>";
    echo 'Request: <br><pre>'.print_r($_REQUEST, true).'</pre>'."<br><br>";
    echo 'Server: <br><pre>'.print_r($_SERVER, true).'</pre>'."<br><br>";
}


if (!class_exists('SiteGuarding_Firewall'))
{
	if (file_exists($file_firewall_class)) include_once($file_firewall_class);
	else die('File is not loaded: '.$file_firewall_class);
}


if (file_exists($file_firewall_config)) include_once($file_firewall_config);
else die('File is not loaded: '.$file_firewall_config);


if (!file_exists($file_firewall_rules)) die('File is not loaded: rules.txt');

if (SITEGUARDING_FIREWALL_STATUS === false) return;     // exit if firewall is disabled

$firewall = new SiteGuarding_Firewall();

$firewall->TraceSiteGuardingRequest();


// Some init constants
if (!defined('SITEGUARDING_LOG_FILE_MAX_SIZE')) define( 'SITEGUARDING_LOG_FILE_MAX_SIZE', 3);	// log file in Mb
if (!defined('SITEGUARDING_BLOCK_BASE64_REQUESTS')) define( 'SITEGUARDING_BLOCK_BASE64_REQUESTS', false);	// block any base64 requests
if (!defined('SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES')) define( 'SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES', 0);	// block any long-nospaces requests
if (!defined('SITEGUARDING_BLOCK_EMPTY_FILES')) define( 'SITEGUARDING_BLOCK_EMPTY_FILES', true);	// block access to empty files
if (!defined('SITEGUARDING_PHP_ERROR_CONTROL')) define( 'SITEGUARDING_PHP_ERROR_CONTROL', false);	// control php errors
if (!defined('SITEGUARDING_UNSET_PASSWORD_DATA')) define( 'SITEGUARDING_UNSET_PASSWORD_DATA', false);	// unset passwords
if (!defined('SITEGUARDING_DUPS')) define( 'SITEGUARDING_DUPS', false);	
if (!defined('SITEGUARDING_HTTP_FOR_ALERTS')) define( 'SITEGUARDING_HTTP_FOR_ALERTS', true);	
if (!defined('SITEGUARDING_SAVE_BLOCKED_REQUESTS')) define( 'SITEGUARDING_SAVE_BLOCKED_REQUESTS', true);	
if (!defined('SITEGUARDING_TRACK_IP')) define( 'SITEGUARDING_TRACK_IP', false);	
if (!defined('SITEGUARDING_CHECK_UPLOADED_FILE_EXT')) define( 'SITEGUARDING_CHECK_UPLOADED_FILE_EXT', false);	
if (!defined('SITEGUARDING_BLOCK_UPLOADED_FILE')) define( 'SITEGUARDING_BLOCK_UPLOADED_FILE', false);	
if (!defined('SITEGUARDING_MANAGE_HTTP_X_FORWARDED_FOR')) define( 'SITEGUARDING_MANAGE_HTTP_X_FORWARDED_FOR', false);	
if (!defined('SITEGUARDING_DUPS_LOCATION')) define( 'SITEGUARDING_DUPS_LOCATION', '');	
if (!defined('SITEGUARDING_GEO_CONTROL')) define( 'SITEGUARDING_GEO_CONTROL', false);	
if (!defined('SITEGUARDING_GEO_REDIRECT')) define( 'SITEGUARDING_GEO_REDIRECT', false);	
if (!defined('SITEGUARDING_GEO_BLOCK_LIST')) define( 'SITEGUARDING_GEO_BLOCK_LIST', '');	
if (!defined('SITEGUARDING_GEO_ALLOW_LIST')) define( 'SITEGUARDING_GEO_ALLOW_LIST', '');	
if (!defined('SITEGUARDING_COLLECT_HTTP_USER_AGENT')) define( 'SITEGUARDING_COLLECT_HTTP_USER_AGENT', false);	
if (!defined('SITEGUARDING_FILTER_BOTS')) define( 'SITEGUARDING_FILTER_BOTS', false);	
if (!defined('SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS')) define( 'SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS', false);	
if (!defined('SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE')) define( 'SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE', '');	
if (!defined('SITEGUARDING_LOGS_DISABLE_GZ')) define( 'SITEGUARDING_LOGS_DISABLE_GZ', false);	
if (!defined('SITEGUARDING_ACTIVE_ANTIBOT')) define( 'SITEGUARDING_ACTIVE_ANTIBOT', false);	
if (!defined('SITEGUARDING_ACTIVE_AUTOBLOCK_IP')) define( 'SITEGUARDING_ACTIVE_AUTOBLOCK_IP', false);	
if (!defined('SITEGUARDING_RUN_PLUGIN')) define( 'SITEGUARDING_RUN_PLUGIN', false);	


if (!$firewall->CheckUpdateKey()) 
{
    if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP) echo 'Disabled. Not valid firewall.key.txt';
    return;
}

$firewall->CheckUpdates();


$firewall->this_session_rule = SITEGUARDING_DEFAULT_ACTION;
$firewall->email_for_alerts = SITEGUARDING_EMAIL_FOR_ALERTS;
$firewall->save_empty_requests = SITEGUARDING_SAVE_EMPTY_REQUESTS;
$firewall->single_log_file = SITEGUARDING_SINGLE_LOG_FILE;
$firewall->scan_path = SITEGUARDING_SCAN_PATH;
$firewall->dirsep = SITEGUARDING_DIRSEP;
$firewall->float_file_folder = SITEGUARDING_FLOAT_FILE_FOLDER;
$firewall->log_file_max_size = SITEGUARDING_LOG_FILE_MAX_SIZE;


// PHP errors control
if (SITEGUARDING_PHP_ERROR_CONTROL === true)
{
	register_shutdown_function('A4C2651A109E0_PHP_error_control');
	
	if (!function_exists('A4C2651A109E0_PHP_error_control'))
	{
		function A4C2651A109E0_PHP_error_control()
		{
			$reason = error_get_last();
			
				switch($reason['type']) 
				{ 
					case E_ERROR: // 1
						$reason['type'] = 'E_ERROR'; break;
					case E_WARNING: // 2
						$reason['type'] =  'E_WARNING';	break;
					case E_PARSE: // 4
						$reason['type'] =  'E_PARSE'; break;
					case E_NOTICE: // 8 
						$reason['type'] =  'E_NOTICE'; break;
					case E_CORE_ERROR: // 16
						$reason['type'] =  'E_CORE_ERROR'; break;
					case E_CORE_WARNING: // 32
						$reason['type'] =  'E_CORE_WARNING'; break;
					case E_COMPILE_ERROR: // 64
						$reason['type'] =  'E_COMPILE_ERROR'; break;
					case E_COMPILE_WARNING: // 128
						$reason['type'] =  'E_COMPILE_WARNING'; break;
					case E_USER_ERROR: // 256
						$reason['type'] =  'E_USER_ERROR'; break;
					case E_USER_WARNING: // 512
						$reason['type'] =  'E_USER_WARNING'; break;
					case E_USER_NOTICE: // 1024
						$reason['type'] =  'E_USER_NOTICE'; break;
					case E_STRICT: // 2048
						$reason['type'] =  'E_STRICT'; break;
					case E_RECOVERABLE_ERROR: // 4096
						$reason['type'] =  'E_RECOVERABLE_ERROR'; break;
					case E_DEPRECATED: // 8192
						$reason['type'] =  'E_DEPRECATED'; break;
					case E_USER_DEPRECATED: // 16384
						$reason['type'] =  'E_USER_DEPRECATED';break;
					default:
						$reason['type'] = '';
				} 
			if ($reason['type'] != '')
			{
				$a = date("Y-m-d H:i:s").' '.$reason['type'].': '.$reason['message'].' File: '.$reason['file'].' Line: '.$reason['line']."\n\n";
				$log_file = dirname(__FILE__).'/logs/'.'_php_errors.log';
				$fp = fopen($log_file, 'a');
				fwrite($fp, $a);
				fclose($fp);
			}
		}
	}
}



// Check SiteGuarding FM
if ($firewall->CheckIfOwnTools()) 
{
    $firewall->LogRequest(true);
    return;
}


// Load and parse the rules
if (!$firewall->LoadRules()) die('Rules are not loaded');



// Checking if the file is empty
if (SITEGUARDING_BLOCK_EMPTY_FILES === true && file_exists($_SERVER['SCRIPT_FILENAME']) && filesize($_SERVER['SCRIPT_FILENAME']) == 0)
{
    $firewall->Block_This_Session('Access to empty file '.$_SERVER["SCRIPT_FILENAME"]);   // the process will die
    exit;
}




if ($firewall->CheckIP_in_Alert(SITEGUARDING_THIS_SESSION_IP))
{   // Send alert to admin
    $subject = 'Access from IP '.SITEGUARDING_THIS_SESSION_IP;
    $message = date("Y-m-d H:i:s")."\n".
    	"IP:".SITEGUARDING_THIS_SESSION_IP."\n".
    	"Link:"."http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."\n".
    	"File:".$_SERVER[SCRIPT_FILENAME]."\n".
    	print_r($_REQUEST, true)."\n\n";
    $firewall->SendEmail($subject, $message);
}



// Check if any action for IP is allowed
if ($firewall->CheckIP_in_Allowed(SITEGUARDING_THIS_SESSION_IP)) {$firewall->LogRequest(); return;}


// Run plugins 
$file_firewall_plugin = dirname(__FILE__).$DIRSEP.'firewall.plugin.php';
if (SITEGUARDING_RUN_PLUGIN === true && SITEGUARDING_ACTIVE_ANTIBOT === true && file_exists($file_firewall_plugin))
{
    include_once($file_firewall_plugin);
}


// Check antibot session if enabled
if (SITEGUARDING_ACTIVE_ANTIBOT === true)
{
    $firewall->CheckAntiBot_Session();
}


// GEO control
if (SITEGUARDING_GEO_CONTROL)
{
    if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP) echo 'GEO is enabled'."<br>";
	
    if (file_exists(dirname(__FILE__).$DIRSEP.'firewall.geo.php'))
    {
        if (!class_exists('sg_Geo_IP2Country_alone')) include_once(dirname(__FILE__).$DIRSEP.'firewall.geo.php');
		
        if (class_exists('sg_Geo_IP2Country_alone')) $geo = new sg_Geo_IP2Country_alone;
        else if (class_exists('sg_Geo_IP2Country')) $geo = new sg_Geo_IP2Country;
        
		$country_code = $geo->getCountryByIP(SITEGUARDING_THIS_SESSION_IP);
		
		if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP) echo 'GEO Your country: '.$country_code."<br>";

        if (SITEGUARDING_GEO_ALLOW_LIST != '')
        {
			if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP) echo 'GEO ALLOW_LIST: '.SITEGUARDING_GEO_ALLOW_LIST."<br>";
			
            $country_codes = explode(",", SITEGUARDING_GEO_ALLOW_LIST);

            if (!in_array($country_code, $country_codes))
            {
                $country_name = $geo->getNameByCountryCode($country_code);
                $geo->BlockPage(SITEGUARDING_THIS_SESSION_IP, $country_name);
                $firewall->Block_This_Session('Country is not ALLOWED list ['.$country_code.']', false, false, true);   // the process will die
                exit;
            }
        }
        else if (SITEGUARDING_GEO_BLOCK_LIST != '')
        {
			if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP) echo 'GEO ALLOW_LIST: '.SITEGUARDING_GEO_BLOCK_LIST."<br>";
			
            $country_codes = explode(",", SITEGUARDING_GEO_BLOCK_LIST);
            if (in_array($country_code, $country_codes))
            {
                $country_name = $geo->getNameByCountryCode($country_code);
                $geo->BlockPage(SITEGUARDING_THIS_SESSION_IP, $country_name);
                $firewall->Block_This_Session('Country is in BLOCK list ['.$country_code.']', false, false, true);   // the process will die
                exit;
            }
        }
        
        // GEO Redirect
        if (SITEGUARDING_GEO_REDIRECT)
        {
            $firewall->GEO_Redirect($country_code);
        }
    }
    else {
        if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP)
        {
            echo 'GEO Class is absent'."<br>";
        }
    }
}

// Check if any action for IP is blocked
if ($firewall->CheckIP_in_Blocked(SITEGUARDING_THIS_SESSION_IP))
{
    $firewall->Block_This_Session('Not allowed IP '.SITEGUARDING_THIS_SESSION_IP);   // the process will die
    exit;
}


if (SITEGUARDING_MANAGE_HTTP_X_FORWARDED_FOR === true && isset($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $firewall->Block_This_Session('HTTP_X_FORWARDED is not allowed IP '.SITEGUARDING_THIS_SESSION_IP);   // the process will die
    exit;
}


// Track DDoS
if (SITEGUARDING_TRACK_IP === true)
{
    if ( $firewall->Track_IP_check_url($_SERVER['REQUEST_URI']) )
    {
        if ($firewall->Track_IP_analyze(SITEGUARDING_THIS_SESSION_IP) == 'block')
        {
            $firewall->Ban_IP_in_rules(SITEGUARDING_THIS_SESSION_IP);
            $firewall->Block_This_Session('TRACK_IP limit '.SITEGUARDING_THIS_SESSION_IP.' is banned');   // the process will die
        }
    }
}



// Check Allowed Requests (to specific file)
if (strpos( $_SERVER['SCRIPT_FILENAME'], SITEGUARDING_SCAN_PATH) != 0)
{
	$SCRIPT_FILENAME = substr($_SERVER['SCRIPT_FILENAME'], strpos( $_SERVER['SCRIPT_FILENAME'], SITEGUARDING_SCAN_PATH));
}
else $SCRIPT_FILENAME = $_SERVER['SCRIPT_FILENAME'];
if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP)
{
	echo '$SCRIPT_FILENAME='.$SCRIPT_FILENAME."<br>";
}
$firewall->CopyStrangeFiles($SCRIPT_FILENAME);
if ($firewall->Session_Check_FilesRequests($SCRIPT_FILENAME, $_REQUEST, 'allow') === true) {$firewall->LogRequest(); return;}
if ($firewall->Session_Check_FilesRequests($SCRIPT_FILENAME, $_REQUEST, 'block') === true) 
{
    $firewall->Block_This_Session('Rules for the file with', true);   // the process will die
    exit;
}

// GEO control by file GEO_FILES
if (SITEGUARDING_GEO_CONTROL && isset($country_code))
{
    if ($firewall->CheckGEOFile($SCRIPT_FILENAME, $country_code) == 'block')
    {
        $country_name = $geo->getNameByCountryCode($country_code);
        $geo->BlockPage(SITEGUARDING_THIS_SESSION_IP, $country_name);
        $firewall->Block_This_Session('GEO_FILES Country is not ALLOWED list ['.$country_code.']', false, false, true);   // the process will die
        exit;
    }
}



// Check Allowed Requests (to any file)
if ($firewall->Session_Check_Requests_Allowed($_REQUEST)) {$firewall->LogRequest(); return;}




// Global RULES
$tmp_session_rule = $firewall->Session_Apply_Rules($SCRIPT_FILENAME);
if ($tmp_session_rule != '') $firewall->this_session_rule = $tmp_session_rule;

if ($firewall->this_session_rule == 'block')
{
    $firewall->Block_This_Session('Rules for the file');   // the process will die
    exit;
}


// BLOCK_RULES_IP
$tmp_session_rule = $firewall->Session_Apply_BLOCK_RULES_IP($_SERVER['SCRIPT_FILENAME'], $_SERVER["REMOTE_ADDR"]);
if ($tmp_session_rule != '') $firewall->this_session_rule = $tmp_session_rule;

if ($firewall->this_session_rule == 'block')
{
    $firewall->Block_This_Session('Rules for the file & IP');   // the process will die
    exit;
}



// Alert Requests
$tmp_session_rule = $firewall->Session_Alert_Requests($_REQUEST);
if ($tmp_session_rule == 'alert')
{
	$_FILES_tmp = '';
	if (count($_FILES) > 0)
	{
		$_FILES_tmp = 'UPLOADED FILES: '.print_r($_FILES, true)."\n";
	}
	
    $siteguarding_log_line = "***ALERT_REQUESTS***"."\n".
        date("Y-m-d H:i:s")."\n".
    	"IP:".SITEGUARDING_THIS_SESSION_IP."\n".
    	"Link:"."http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."\n".
    	"File:".$_SERVER['SCRIPT_FILENAME']."\n".$_FILES_tmp.
    	print_r($_REQUEST_tmp, true)."\n\n";

    $firewall->SendAlert_to_SG($siteguarding_log_line);
}


// Check Requests
$tmp_session_rule = $firewall->Session_Check_Requests($_REQUEST);
if ($tmp_session_rule != '') $firewall->this_session_rule = $tmp_session_rule;

if ($firewall->this_session_rule == 'block')
{
    // Autoblock IP
    if (SITEGUARDING_ACTIVE_AUTOBLOCK_IP === true && $_SERVER['SERVER_ADDR'] != SITEGUARDING_THIS_SESSION_IP)
    {
        $status = $firewall->Check_IP_Block_rules($_REQUEST);
        if ($status) $firewall->SaveLogs_anyfile('_blocked_ip.log', SITEGUARDING_THIS_SESSION_IP);
    }
    
    $firewall->Block_This_Session('Request rule => '.$firewall->this_session_reason_to_block, true);   // the process will die
    exit;
}

// Check BLOCK_URLS
$tmp_session_rule = $firewall->Check_URLs($_SERVER['REQUEST_URI']);
if ($tmp_session_rule != '') $firewall->this_session_rule = $tmp_session_rule;

if ($firewall->this_session_rule == 'block')
{
    $firewall->Block_This_Session('Not allowed URL', false, true);   // the process will die and show 404 error
    exit;
}
if ($firewall->this_session_rule == 'block_404')
{
    header("HTTP/1.1 404");
    exit;
}


// Check if uploaded files are allowed
if (SITEGUARDING_BLOCK_UPLOADED_FILE === true && count($_FILES) > 0) 
{
    if ($firewall->CheckUploadedFileTypes() === false)
    {
        $tmp_names = array();
        foreach ($_FILES as $tmp_row)
        {
            $tmp_names[] = $tmp_row['type'];
        }
        $firewall->Block_This_Session('File uploading is not allowed: '.implode("\n", $tmp_names));   // the process will die
    }
}


// Check uploaded file extention
if (SITEGUARDING_CHECK_UPLOADED_FILE_EXT === true && count($_FILES) > 0)
{
	if (SITEGUARDING_DEBUG === true) echo 'Checking Uploaded files'."<br>".print_r($_FILES, true)."<br>";;
	
    if ($firewall->CheckUploadedFileExtension() === false)
    {
        $tmp_names = array();
        foreach ($_FILES as $tmp_row)
        {
            $tmp_names[] = $tmp_row['name'];
        }
        $firewall->Block_This_Session('Wrong uploaded file extension: '.implode("\n", $tmp_names));   // the process will die
        exit;
    }
    
    if ($firewall->BlockUploadedFileHex() === true)
    {
        $tmp_names = array();
        foreach ($_FILES as $tmp_row)
        {
            $tmp_names[] = $tmp_row['name'];
        }
        $firewall->Block_This_Session('Not allowed hex in uploaded file: '.implode("\n", $tmp_names));   // the process will die
        exit;
    }
    
    if ($firewall->BlockUploadedFileHex_by_extension() === true)
    {
        $tmp_names = array();
        foreach ($_FILES as $tmp_row)
        {
            $tmp_names[] = $tmp_row['name'];
        }
        $firewall->Block_This_Session('Not allowed hex with extension in uploaded file: '.implode("\n", $tmp_names));   // the process will die
        exit;
    }
}


if (SITEGUARDING_FILTER_BOTS === true)
{
    if ($firewall->FilterBots() == 'block')
    {
        $firewall->Block_This_Session('Bot: '.$_SERVER['HTTP_USER_AGENT']);   // the process will die
        exit;
    }
}


if (SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS === true && stripos($_SERVER['HTTP_USER_AGENT'], 'bot') !== false)
{
    if (SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE == '' || 
        (SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE != '' && date("Y-m-d") <= SITEGUARDING_SHOW_SPECIAL_HTML_FOR_BOTS_TILL_DATE)
    )
    {
        $html_file = dirname(__FILE__).$DIRSEP.'firewall.bots.html';
        if (file_exists($html_file)) die($firewall->Read_File($html_file));
        else die('firewall.bots.html is absent');
    }
}



// Rewrite requests
if ($firewall->Session_Rewrite_Requests());



// Log the request (the request passed all the rules)
$firewall->LogRequest();


if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP)
{
    echo 'Finished'."<br>";
}



// Run plugins 
$file_firewall_plugin = dirname(__FILE__).$DIRSEP.'firewall.plugin.php';
if (SITEGUARDING_RUN_PLUGIN === true && SITEGUARDING_ACTIVE_ANTIBOT === false && file_exists($file_firewall_plugin))
{
    include_once($file_firewall_plugin);
}


unset($firewall);
if (isset($geo)) unset($geo);
?>
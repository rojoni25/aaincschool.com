<?php
// for ver 3.8
define("DONT_CHANGE_PHP_VALUES", 0);     // 0 - allows to change init php values , 1 - disable to change init php values 
define("SCAN_METHOD", "new");            // old - glob, new (by default) - opendir
define("ENABLE_COMMON_FILTER", 1);
define("DISABLE_MD5", 0);	// 0 - collect MD5, 1 - MD5 dont collect
define("SAVE_DEBUG", 0);		// 0 - disable debug, 1 - enable debug
$CONFIG_EXCLUDE_FOLDERS = array('/webanalyze/firewall/logs/', '/tmp', '/var/');	// scanner will never visit these folders
define("EXCLUDE_FILE_EXTENSIONS", "*.jpg;*.mp3;*.zip;");	// *.jpg;*.mp3;	separate by ; (and ; in the end) scanned ALL except these file extentions
define("INCLUDE_FILE_EXTENSIONS", "*.php;*.js;*.css;");	// *.php;*.js;	separate by ; (and ; in the end) scanned ONLY included file extentions
define("SCAN_SERVER_PATH", "");// e.g. for yii or similar CMS (!!! / in the end) e.g. /home/testacc/ 
define("WEBSITE_ID", "8104");
define("WEBSITE_KEY", "ef33bfc13b05480090dbe77defb8dea0");
?>

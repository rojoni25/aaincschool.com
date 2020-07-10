<?php
/*
define("SQL_DB_HOST", "");		// localhost
define("SQL_DB_NAME", "");
define("SQL_DB_USER", "");
define("SQL_DB_PASSWORD", "");
*/
define("DEBUG_LOG", false);
define("MAX_FILE_SIZE", 20971520);	// in bytes
define("BACKUP_EXCLUDE_FILE_EXTENSIONS", "*.avi;*.zip;*.tar;*.gz;*.bak;error_log;");	// *.jpg;*.mp3;	separate by ; (and ; in the end) 
$BACKUP_EXCLUDE_FOLDERS =  array('/webanalyze/', '/tmp/', '/cache/', '/wp-content/cache/', '/backups/', '/var/cache/', '/var/session/', '/var/tmp/');
define("BACKUP_SERVER_PATH", '');	// e.g. for yii or similar CMS (!!! / in the end) e.g. /home/testacc/ 
?>
<?php
/*
 * Example of plugin file
 * RunPlugins() - must be to execute plugins
 */

function RunPlugins()
{
	// Execute what you need
	UpdateFirewallKey();
    
	$v = ini_get('auto_prepend_file');
	if (stripos($v, 'firewall.php') === false)
	{
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { /* */ }
		else UpdateFirewallInjection();
	}
    
    QuickBlacklist();

}

function UpdateFirewallKey()
{
	$file = dirname(__FILE__).DIRSEP."firewall".DIRSEP."firewall.php";
	if (file_exists($file))
	{
		$file = dirname(__FILE__).DIRSEP."firewall".DIRSEP."firewall.key.txt";
		$fp = fopen($file, 'w');
		fwrite($fp, 'NO_KEY');
		fclose($fp);
	}
}

function UpdateFirewallInjection()
{
    $currentDir = SCAN_PATH.DIRSEP;
    
    if (file_exists($currentDir.'webanalyze/firewall/firewall.php'))
    {
        // check for .user.ini
        $filename = $currentDir.'.user.ini';
        if (!file_exists($filename))
        {
            $contents = 'auto_prepend_file = "'.$currentDir.'webanalyze/firewall/firewall.php"';
            
            $handle = fopen($filename, 'w');
            $status = fwrite($handle, $contents);
            fclose($handle);
        }
        
        
        $integration_code = '<?php /* Siteguarding Block 44B280167949-START */include_once("'.$currentDir.'webanalyze/firewall/firewall.php");/* Siteguarding Block 44B280167949-END */?>';
        
        $list_of_files = array(
            'index.php',
            'wp-config.php',
            'wp-login.php',
            
            'configuration.php'
        ); 
        
        
        // Update firewall config
        $filename = $currentDir.'webanalyze/firewall/firewall.config.php';
        if (file_exists($filename))
        {
            $handle = fopen($filename, "r");
            $contents = fread($handle, filesize($filename));
            fclose($handle);
            
            $contents = str_replace("{REPLACE_WITH_SCAN_PATH}", $currentDir, $contents);
            
            $handle = fopen($filename, 'w');
            $status = fwrite($handle, $contents);
            fclose($handle);
        }
        
        
        foreach ($list_of_files as $file)
        {
            if (file_exists($currentDir.$file))
            {
                // Insert code
                $filename = $currentDir.$file;
                $handle = fopen($filename, "r");
                $contents = fread($handle, filesize($filename));
                fclose($handle);
                
               
                if (stripos($contents, '44B280167949-START') !== false)
                {
                    // Skip double code injection
                    continue;
                }
                
                $handle = fopen($filename, 'w');
                if ($handle === false) 
                {
                    // 2nd try , change file permssion to 644
                    $status = chmod($filename, 0644);
                    
                    $handle = fopen($filename, 'w');
                    if ($handle === false) continue;
                }
                
                
                $contents = $integration_code.$contents;
                
                $status = fwrite($handle, $contents);
                fclose($handle);
                
            }

        }
    }
}

function GetDomain()
{
	global $_SERVER;
	
	$domain = $_SERVER['SERVER_NAME'];
    //$domain = str_replace("www.", "", $domain);
    
	return "http://".$domain;	
}

function QuickBlacklist()
{
    $data = array(
        'W_ID' => WEBSITE_ID,
        'W_KEY_5' => md5(WEBSITE_KEY),
        'MCAF' => '',
        'NORT' => ''
    );
    
    $domain = GetDomain();
    $domain = PrepareDomain($domain);
    
	$link = "http://www.siteadvisor.com/sites/".$domain;
    $content =  SGFUNC_GetRemote_file_content($link);
    if (strlen($content) > 200)
    {
    	if (strpos($content, 'siteYellow') || strpos($content, 'siteRed'))
        {
    		$data['MCAF'] = 'BL';
    	} 
        else $data['MCAF'] = 'OK';
    }

    
    $link = "https://safeweb.norton.com/report/show?url=".$domain;
    $content =  SGFUNC_GetRemote_file_content($link);
    if (strlen($content) > 200)
    {
    	if (strpos($content, $domain) !== false)
        {
    		if (!strpos($content, 'SAFE') && !strpos($content, 'UNTESTED'))
            {
    			$data['NORT'] = 'BL';
    		}
            else $data['NORT'] = 'OK';
    	}
    }
    
    $data = base64_encode(json_encode($data));
    $link = MAIN_WEBSITE_NOSSL."?option=com_securapp&task=UpdateBL&data=".$data;
    $content =  SGFUNC_GetRemote_file_content($link);
}


?>
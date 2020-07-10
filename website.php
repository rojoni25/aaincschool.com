<?php
/**
 * Antivirus scanner installer by SiteGuarding.com
 * Do not remove or modify this file
 * for more information please go to https://www.siteguarding.com/en/contacts
 */
if ($_GET['action'] == 'd3ab83ae11555a38ab04f51d1bb5811b')
{
    define('MAIN_SERVER_URL', 'https://www.siteguarding.com/_get_file.php?file=');
    define('SETUP_CONNECT_TIMEOUT', 60);
    
    $session_key = $_GET['session_key'];
    $access_key = $_GET['access_key'];
    
    $script_path = dirname(__FILE__)."/";
    
   
    // Create folder
    $folder = 'webanalyze';
    if (file_exists($script_path.$folder)) PrintLog('Folder already exists '.$script_path.$folder);
    else {
        $status = mkdir($script_path.$folder);
        if ($status === false) PrintLog('Cant create folder '.$script_path.$folder, true);
        else PrintLog('Folder created '.$script_path.$folder);
    } 
    
    // Create files
    $files_list_install = array(
        'webanalyze/index.html',
        'webanalyze/antivirus.php',
        'webanalyze/antivirus_config.php'
    );
    
    foreach ($files_list_install as $file)
    {
        $file_remote = basename($file);
    
        $status = CreateRemote_file_contents(MAIN_SERVER_URL.'installer&filename='.$file_remote.'&session_key='.$session_key.'&time='.time(), $script_path.$file);
        if ($status === false) 
        {
            $status = CreateRemote_file_contents_save(MAIN_SERVER_URL.'installer&filename='.$file_remote.'&session_key='.$session_key.'&time='.time(), $script_path.$file);
            if ($status === false) 
            {
                PrintLog('Cant create file '.$script_path.$file, true);
            }
            else PrintLog('File created '.$script_path.$file);
        }
        else PrintLog('File created '.$script_path.$file);
    
        
    	// Flush output
    	ob_flush();
    	flush();
    }
    

    $filename = $script_path.'/webanalyze/antivirus_config.php';
    if (file_exists($filename))
    {
        $handle = fopen($filename, "r");
        $contents = fread($handle, filesize($filename));
        fclose($handle);
        
        $contents = str_replace("{ACCESS_KEY}", $access_key, $contents);
        
        $handle = fopen($filename, 'w');
        fwrite($handle, $contents);
        fclose($handle);
    }
}
else die('a5a3bfe4ba57c24f9cc9b7d0036c37ca');



function PrintLog($txt, $error_type = false)
{
    if ($error_type) echo "<p>!!! ".$txt."</p>";
    else echo "<p>".$txt."</p>";
}


function Read_File($path, $file)
{
    $contents = '';
    
    $filename = $path.'/'.$file;
    if (file_exists($filename))
    {
        $fp = fopen($filename, "r");
        $contents = fread($fp, filesize($filename));
        fclose($fp); 
        
        $contents .= "\n\n";       
    }
    
    return $contents;
}

function CreateFile($path, $file, $content)
{
    $fp = fopen($path.'/'.$file, 'w');
    fwrite($fp, $content);
    fclose($fp);
}



function CreateRemote_file_contents_save($url, $dst)
{
    $content = GetRemote_file_contents($url);
    
    if ($content === false) return false;
    
    $fp = fopen($dst, 'w');
    if ($fp === false) return false;
    $a = fwrite($fp, $content);
    if ($a === false) return false;
    fclose($fp);
    
    return true;
}


function GetRemote_file_contents($url, $parse = false)
{
    if (extension_loaded('curl')) 
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:38.0) Gecko/20100101 Firefox/38.0");
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3600000);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10 sec
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 10000); // 10 sec
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $output = trim(curl_exec($ch));
        curl_close($ch);
        
        if ($output === false)  return false;
        
        if ($parse === true) $output = (array)json_decode($output, true);
        
        return $output;
    }
    else return false;
}



function CreateRemote_file_contents($url, $dst)
{
    if (extension_loaded('curl')) 
    {
        $dst = fopen($dst, 'w');
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url );
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:38.0) Gecko/20100101 Firefox/38.0");
        curl_setopt($ch, CURLOPT_TIMEOUT, 3600);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, 3600000);
        curl_setopt($ch, CURLOPT_FILE, $dst);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10 sec
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 10000); // 10 sec
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        
        $a = curl_exec($ch);
        if ($a === false)  return false;
        
        $info = curl_getinfo($ch);
        
        curl_close($ch);
        fflush($dst);
        fclose($dst);
        
        return $info['size_download'];
    }
    else return false;
        
}

?>
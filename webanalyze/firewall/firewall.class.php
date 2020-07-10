<?php
/**
 * Class Firewall (ver.: 5.1.4)
 */
class SiteGuarding_Firewall
{
    var $rules = array();

    var $scan_path = '';
    var $save_empty_requests = false;
    var $single_log_file = false;
    var $dirsep = '/';
    var $email_for_alerts = '';
    var $this_session_rule = false;
    var $this_session_reason_to_block = '';
    var $float_file_folder = false;
	
	var $log_file_max_size = 3;	// in Mb
	var $log_file_max_size_for_http_alert = 25000;	// in Kb
    
    public static $ssl_public_key = '-----BEGIN PUBLIC KEY-----
MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAMp2KcGO+q4x1fQzkeU+Sxf2VZENAKgO
Yaegs4K9owbW1se2LK0FrLcsRU1SfmOOSNU2XKtcsxccR/3N/3cRr0UCAwEAAQ==
-----END PUBLIC KEY-----';

    public static $SG_URL = 'https://www.siteguarding.com/index.php';
    
    public static $SG_IPs = array(
        '185.72.157.170',
        '185.72.157.169',
        '185.72.157.171',
        '185.72.157.172',
        '185.72.157.173',
    );


	public function LoadRules()
	{
        $rules = array(
            'ALLOW_ALL_IP' => array(),
            'BLOCK_ALL_IP' => array(),
            'ALERT_IP' => array(),
            'BLOCK_RULES_IP' => array(),
            'RULES' => array(
                'ALLOW' => array(),
                'BLOCK' => array()
            ),
            'BLOCK_RULES' => array(
                'ALLOW' => array(),
                'BLOCK' => array()
            ),
            'GEO_FILES' => array(
                'ALLOW' => array(),
                'BLOCK' => array()
            ),
            'GEO_REDIRECT' => array(),
            'BLOCK_URLS' => array(),
            'ALLOW_REQUESTS' => array(),
            'ALERT_REQUESTS' => array(),
            'BLOCK_REQUESTS' => array(),
            'BLOCK_IP_REQUESTS' => array(),
            'FILES_REQUESTS' => array(),
            'REWRITE_REQUESTS' => array(),
            'TRACK_IP' => array(),
            'EXCLUDE_REMOTE_ALERT_FILES' => array(),
            'BLOCK_FILE_HEX' => array(),
            'BLOCK_FILE_HEX_BY_EXTENSION' => array(),
            'FILE_EXTENSIONS' => array(),
            'ALLOWED_FILE_TYPES' => array(),
            'BOTS_RULES' => array(),
            'ANTIBOT' => array(),
        );
        $this->rules = $rules;

        $rows = file(dirname(__FILE__).$this->dirsep.'rules.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if (count($rows) == 0) return true;


        $section = '';
        foreach ($rows as $row)
        {
            $row = trim($row);
            if ($row == '::ALLOW_ALL_IP::') {$section = 'ALLOW_ALL_IP'; continue;}
            if ($row == '::BLOCK_ALL_IP::') {$section = 'BLOCK_ALL_IP'; continue;}
            if ($row == '::ALERT_IP::') {$section = 'ALERT_IP'; continue;}
            if ($row == '::BLOCK_RULES_IP::') {$section = 'BLOCK_RULES_IP'; continue;}
            if ($row == '::GEO_FILES::') {$section = 'GEO_FILES'; continue;}
            if ($row == '::GEO_REDIRECT::') {$section = 'GEO_REDIRECT'; continue;}
            if ($row == '::RULES::') {$section = 'RULES'; continue;}
            if ($row == '::BLOCK_RULES::') {$section = 'BLOCK_RULES'; continue;}
            if ($row == '::BLOCK_URLS::') {$section = 'BLOCK_URLS'; continue;}
            if ($row == '::TRACK_IP::') {$section = 'TRACK_IP'; continue;}
            if ($row == '::ALLOW_REQUESTS::') {$section = 'ALLOW_REQUESTS'; continue;}
            if ($row == '::ALERT_REQUESTS::') {$section = 'ALERT_REQUESTS'; continue;}
            if ($row == '::BLOCK_REQUESTS::') {$section = 'BLOCK_REQUESTS'; continue;}
            if ($row == '::BLOCK_IP_REQUESTS::') {$section = 'BLOCK_IP_REQUESTS'; continue;}
            if ($row == '::FILES_REQUESTS::') {$section = 'FILES_REQUESTS'; continue;}
            if ($row == '::REWRITE_REQUESTS::') {$section = 'REWRITE_REQUESTS'; continue;}
            if ($row == '::EXCLUDE_REMOTE_ALERT_FILES::') {$section = 'EXCLUDE_REMOTE_ALERT_FILES'; continue;}
            if ($row == '::BLOCK_FILE_HEX::') {$section = 'BLOCK_FILE_HEX'; continue;}
            if ($row == '::BLOCK_FILE_HEX_BY_EXTENSION::') {$section = 'BLOCK_FILE_HEX_BY_EXTENSION'; continue;}
            if ($row == '::FILE_EXTENSIONS::') {$section = 'FILE_EXTENSIONS'; continue;}
            if ($row == '::ALLOWED_FILE_TYPES::') {$section = 'ALLOWED_FILE_TYPES'; continue;}
            if ($row == '::BOTS_RULES::') {$section = 'BOTS_RULES'; continue;}
            if ($row == '::ANTIBOT::') {$section = 'ANTIBOT'; continue;}

			if (strlen($row) == 0) continue;
            if ($row[0] == '#' || $section == '') continue;

            switch ($section)
            {
                case 'BLOCK_URLS':
                    $tmp = explode("|", $row);
                    if (count($tmp) == 1) $rules['BLOCK_URLS'][trim($tmp[0])] = '*';
                    else $rules['BLOCK_URLS'][trim($tmp[0])] = trim($tmp[1]);
                    break;
                    
                case 'TRACK_IP':
                    $rules['TRACK_IP'][] = trim($row);
                    break;
                    
                case 'BLOCK_REQUESTS':
                    $tmp = explode("|", $row);
                    $rule_field = trim($tmp[0]);
                    $rule_value = trim($tmp[1]);
                    $rules['BLOCK_REQUESTS'][$rule_field][] = $rule_value;
                    break;

                case 'BLOCK_IP_REQUESTS':
                    $rules['BLOCK_IP_REQUESTS'][] = trim($row);
                    break;
                    
                case 'ALERT_REQUESTS':
                    $tmp = explode("|", $row);
                    $rule_field = trim($tmp[0]);
                    $rule_value = trim($tmp[1]);
                    $rules['ALERT_REQUESTS'][$rule_field][] = $rule_value;
                    break;
                    
                case 'ALLOW_REQUESTS':
                    $tmp = explode("|", $row);
                    $rule_field = trim($tmp[0]);
                    $rule_value = trim($tmp[1]);
                    $rules['ALLOW_REQUESTS'][$rule_field][] = $rule_value;
                    break;

                case 'ALLOW_ALL_IP':
                case 'BLOCK_ALL_IP':
                case 'ALERT_IP':
                case 'BLOCK_RULES_IP':
                    $rules[$section][] = str_replace(array(".*.*.*", ".*.*", ".*"), ".", trim($row));
                    break;

                case 'RULES':
                case 'BLOCK_RULES':
                    $tmp = explode("|", $row);
                    $rule_kind = strtolower(trim($tmp[0]));
                    $rule_type = strtolower(trim($tmp[1]));
                    $rule_object = str_replace($this->dirsep.$this->dirsep, $this->dirsep, $this->scan_path.trim($tmp[2]));

                    switch ($rule_kind)
                    {
                        case 'allow':
                            $rules[$section]['ALLOW'][] = array('type' => $rule_type, 'object' => $rule_object);
                            break;

                        case 'block':
                            $rules[$section]['BLOCK'][] = array('type' => $rule_type, 'object' => $rule_object);
                            break;
                    }
                    break;
                    
                case 'GEO_FILES':
                    $tmp = explode("|", $row);
                    $rule_kind = strtolower(trim($tmp[0]));
                    $rule_type = strtolower(trim($tmp[1]));
                    $rule_object = str_replace($this->dirsep.$this->dirsep, $this->dirsep, $this->scan_path.trim($tmp[2]));
                    $rule_countries = trim($tmp[3]);

                    switch ($rule_kind)
                    {
                        case 'allow':
                            $rules[$section]['ALLOW'][] = array('type' => $rule_type, 'object' => $rule_object, 'countries' => $rule_countries);
                            break;

                        case 'block':
                            $rules[$section]['BLOCK'][] = array('type' => $rule_type, 'object' => $rule_object, 'countries' => $rule_countries);
                            break;
                    }
                    break;
                    
                case 'GEO_REDIRECT':
                    $tmp = explode("|", $row);
                    $rules[$section][trim($tmp[0])] = trim($tmp[1]);
                    break;
                    
                case 'BOTS_RULES':
                    $tmp = explode("|", $row);
                    $rule_kind = strtolower(trim($tmp[0]));
                    $rule_object = trim($tmp[1]);

                    switch ($rule_kind)
                    {
                        case 'allow':
                            $rules[$section]['ALLOW'][] = $rule_object;
                            break;

                        case 'block':
                            $rules[$section]['BLOCK'][] = $rule_object;
                            break;
                    }
                    break;
                    
                case 'FILES_REQUESTS':
                    $tmp = explode("|", $row);
                    $rule_kind = strtolower(trim($tmp[0]));
                    $rule_object = str_replace($this->dirsep.$this->dirsep, $this->dirsep, $this->scan_path.trim($tmp[1]));
                    $rule_field = trim($tmp[2]);
                    $rule_value = trim($tmp[3]);

                    switch ($rule_kind)
                    {
                        case 'allow':
                            $rules[$section]['ALLOW'][] = array('field' => $rule_field, 'value' => $rule_value, 'object' => $rule_object);
                            break;

                        case 'block':
                            $rules[$section]['BLOCK'][] = array('field' => $rule_field, 'value' => $rule_value, 'object' => $rule_object);
                            break;
                    }
                    break;
                    
                case 'REWRITE_REQUESTS':
                    $rules['REWRITE_REQUESTS'][] = (array)json_decode(trim($row), true);
                    break;
                
                case 'EXCLUDE_REMOTE_ALERT_FILES':
                    $rules['EXCLUDE_REMOTE_ALERT_FILES'][] = trim($row);
                    break;
                    
                case 'BLOCK_FILE_HEX':
                    $rules['BLOCK_FILE_HEX'][] = trim($row);
                    break;
                    
                case 'BLOCK_FILE_HEX_BY_EXTENSION':
                    $tmp = explode("|", $row);
                    $rules['BLOCK_FILE_HEX_BY_EXTENSION'][trim($tmp[0])] = trim($tmp[1]);
                    break;
                    
                case 'FILE_EXTENSIONS':
                    $tmp = explode("|", $row);
                    $rules['FILE_EXTENSIONS'][trim($tmp[0])] = trim($tmp[1]);
                    break;
                    
                case 'ALLOWED_FILE_TYPES':
                    $rules['ALLOWED_FILE_TYPES'][] = trim($row);
                    break;
                    
                case 'ANTIBOT':
                    $tmp = explode("|", $row);
                    $tmp[1] = explode(",", trim($tmp[1]));
                    $rules['ANTIBOT'][trim($tmp[0])] = $tmp[1];
                    break;
                    
                default:
                    continue;
                    break;
            }
        }

        $this->rules = $rules;

        return true;
    }


    public function CopyStrangeFiles($file)
    {
        if (stripos($file, $this->scan_path.'sucuri') !== false)
        {
            copy($file, dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.basename($file).'.'.time().'.bak');
            
            $siteguarding_log_line = "***ALERT_SUCURI_ACTION***"."\n".
                date("Y-m-d H:i:s")."\n".
            	"IP:".SITEGUARDING_THIS_SESSION_IP."\n".
            	"Link:"."http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."\n".
            	"File:".$_SERVER['SCRIPT_FILENAME']."\n".
            	print_r($_REQUEST_tmp, true)."\n\n";
        
            $firewall->SendAlert_to_SG($siteguarding_log_line);
        }
    }
    
    
    
    public function Session_Check_FilesRequests($file, $requests, $type = 'block')
    {
        $type = strtoupper($type);

        if (count($requests) == 0) return '';
        if ( !isset($this->rules['FILES_REQUESTS'][$type]) || count($this->rules['FILES_REQUESTS'][$type]) == 0) return '';
        
        $requests_flat = self::FlatRequestArray($requests);
        
        foreach ($this->rules['FILES_REQUESTS'][$type] as $rule_info)
        {
            $rule_field = $rule_info['field'];
            $rule_value = $rule_info['value'];
            $rule_object = $rule_info['object'];
            
            if ($file == $rule_object)
            {
                if (isset($requests[$rule_field]))
                {
                    if ($rule_value == "*")  return true;
                    if ($rule_value[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_value, 1);
                        if ($tmp_rule_value == $requests[$rule_field]) return true;
                    }
                    else {
                        if (stripos($requests[$rule_field], $rule_value) !== false) return true;
                    }
                }
                else {
                    //foreach ($requests_flat as $req_field => $req_value)
                    foreach ($requests_flat as $requests_flat_array)
                    {
                        $req_field = $requests_flat_array['f'];
                        $req_value = $requests_flat_array['v'];
                        
                        if ($req_field == $rule_field)
                        {
                            if ($rule_value == "*")  return true;
                            if ($rule_value[0] == '=')
                            {
                                $tmp_rule_value = substr($rule_value, 1);
                                if ($tmp_rule_value == $req_value) return true;
                            }
                            else {
                                if (stripos($req_value, $rule_value) !== false) return true;
                            }
                        }
                    }
                }
            }
        }
        
        return '';
    }



    public function Session_Apply_Rules($file)
    {
        $result_final = '';

        if (count($this->rules['RULES']['BLOCK']))
        {
            foreach ($this->rules['RULES']['BLOCK'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];

                if ($this->float_file_folder === true) $pattern = dirname($file).$this->dirsep.$pattern;

                switch ($type)
                {
                    case 'any':
                        if (strpos($pattern, "*") === false) $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        if (strpos($pattern, "*") === false) $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }

                if ($result === true) $result_final = 'block';
                
                if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP) echo 'RULE='.$pattern."<br>".'FILE='.$file."<br>".'RESULT='.$result_final."<br><br>";
            }
        }

        if (count($this->rules['RULES']['ALLOW']))
        {
            foreach ($this->rules['RULES']['ALLOW'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];

                if ($this->float_file_folder === true) $pattern = dirname($file).$this->dirsep.$pattern;

                switch ($type)
                {
                    case 'any':
                        if (strpos($pattern, "*") === false) $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        if (strpos($pattern, "*") === false) $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }

                if ($result === true) $result_final = 'allow';
                
                if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP) echo 'RULE='.$pattern."<br>".'FILE='.$file."<br>".'RESULT='.$result_final."<br><br>";
            }
        }

        return $result_final;
    }



    public function GEO_Redirect($country_code)
    {
        if (count($this->rules['GEO_REDIRECT']))
        {
            foreach ($this->rules['GEO_REDIRECT'] as $country_codes => $redirect_url)
            {
                if (stripos($country_codes, $country_code) !== false)
                {
                    header("HTTP/1.1 301 Moved Permanently"); 
                    header("Location: ".$redirect_url); 
                    exit;
                }
            }
        }
    }


    public function CheckGEOFile($file, $country_code)
    {
        if (count($this->rules['GEO_FILES']['ALLOW']))
        {
            $flag_check_country = false;
            
            foreach ($this->rules['GEO_FILES']['ALLOW'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];
                $countries = $rule_info['countries'];

                switch ($type)
                {
                    case 'any':
                        $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }

                if ($result === true)
                {
                    $flag_check_country = true;
                    if (stripos($countries, $country_code) !== false) return 'allow';
                }
            }
            
            if ($flag_check_country) return 'block';
        }

        if (count($this->rules['GEO_FILES']['BLOCK']))
        {
            $flag_check_country = false;
            
            foreach ($this->rules['GEO_FILES']['BLOCK'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];
                $countries = $rule_info['countries'];

                switch ($type)
                {
                    case 'any':
                        $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }
                
                if ($result === true)
                {
                    $flag_check_country = true;
                    if (stripos($countries, $country_code) !== false) return 'block';
                }
            }
            
            if ($flag_check_country) return 'allow';
        }
        
        return 'allow';
    }






    public function Session_Apply_BLOCK_RULES_IP($file, $ip)
    {
        $result_final = '';

        if (count($this->rules['BLOCK_RULES_IP']) == 0) return $result_final;

        foreach ($this->rules['BLOCK_RULES_IP'] as $rule_ip)
        {
            if (strpos($ip, $rule_ip) === 0) {
                // match
                break;
            }
        }


        if (count($this->rules['BLOCK_RULES']['BLOCK']))
        {
            foreach ($this->rules['BLOCK_RULES']['BLOCK'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];

                switch ($type)
                {
                    case 'any':
                        $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }

                if ($result === true) $result_final = 'block';
            }
        }

        if (count($this->rules['BLOCK_RULES']['ALLOW']))
        {
            foreach ($this->rules['BLOCK_RULES']['ALLOW'] as $rule_info)
            {
                $type = $rule_info['type'];
                $pattern = $rule_info['object'];

                switch ($type)
                {
                    case 'any':
                        $pattern .= '*';
                    default:
                    case 'file':
                        $result = fnmatch($pattern, $file);
                        break;

                    case 'folder':
                        $pattern .= '*';
                        $result = fnmatch($pattern, $file, FNM_PATHNAME);
                        break;
                }

                if ($result === true) $result_final = 'allow';
            }
        }

        return $result_final;
    }


    public function ReplaceLineInRules($str_from, $str_to)
    {
        $rules_file = dirname(__FILE__).$this->dirsep.'rules.txt';

        $handle = fopen($rules_file, "r");
        $contents = fread($handle, filesize($rules_file));
        fclose($handle);
        
        $contents = str_replace($str_from, $str_to, $contents);
        
        $handle = fopen($rules_file, 'w');
        fwrite($handle, $contents);
        fclose($handle);
    }
    
    public function Check_IP_Block_rules($requests)
    {
        $requests_flat = print_r($requests, true);
        $tmp = str_ireplace($this->rules['BLOCK_IP_REQUESTS'], "", $requests_flat, $count);
        if ($count > 0)
        {
            // Block IP
            self::ReplaceLineInRules('::BLOCK_ALL_IP::', '::BLOCK_ALL_IP::'."\n".SITEGUARDING_THIS_SESSION_IP);
            
            return true;
        }
        
        return false;
    }


    public function Session_Check_Requests($requests)
    {
        $result_final = 'allow';

        if (count($requests) == 0) return $result_final;
        
        $requests_flat = self::FlatRequestArray($requests);

        foreach ($requests_flat as $requests_flat_array)
        {
            $req_field = $requests_flat_array['f'];
            $req_value = $requests_flat_array['v'];
			
			if ( SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES > 0 && stripos($req_value, " ") === false && strlen($req_value) >= SITEGUARDING_BLOCK_REQUESTS_NOSPACES_OVER_BYTES )
			{
				$result_final = 'block';
				$this->this_session_reason_to_block = 'long_nospace_request';
				return $result_final;
			}
            
            // Check if possible to decode request
            $tmp = base64_decode($req_value);
            if ($tmp !== false) 
			{
				if (base64_encode($tmp) == $req_value && SITEGUARDING_BLOCK_BASE64_REQUESTS === true)
				{
					$result_final = 'block';
					$this->this_session_reason_to_block = "BLOCK_BASE64_REQUESTS";
					return $result_final;
				}
			}
            
            if (isset($this->rules['BLOCK_REQUESTS'][$req_field]))
            {
                foreach ($this->rules['BLOCK_REQUESTS'][$req_field] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = 'block';
                        $this->this_session_reason_to_block = $req_field.":*";
                        return $result_final;
                    }
                    
                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
						
                        if (stripos(base64_decode($req_value), $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
                    }
                }
            }

            if (isset($this->rules['BLOCK_REQUESTS']['*']))
            {
                foreach ($this->rules['BLOCK_REQUESTS']['*'] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = 'block';
                        $this->this_session_reason_to_block = "*:*";
                        return $result_final;
                    }

                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = $req_field.":".$rule_values;
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = "*:".$rule_values;
                            return $result_final;
                        }
						
                        if (stripos(base64_decode($req_value), $rule_values) !== false)
                        {
                            $result_final = 'block';
                            $this->this_session_reason_to_block = "*:".$rule_values;
                            return $result_final;
                        }
                    }
                }
            }
        }

        return $result_final;
    }






    public function Session_Alert_Requests($requests)
    {
        $result_final = 'ok';

        if (count($requests) == 0) return $result_final;
        
        $requests_flat = self::FlatRequestArray($requests);

        foreach ($requests_flat as $requests_flat_array)
        {
            $req_field = $requests_flat_array['f'];
            $req_value = $requests_flat_array['v'];
			
            
            if (isset($this->rules['ALERT_REQUESTS'][$req_field]))
            {
                foreach ($this->rules['ALERT_REQUESTS'][$req_field] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = 'alert';
                        return $result_final;
                    }
                    
                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
						
                        if (stripos(base64_decode($req_value), $rule_values) !== false)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
                    }
                }
            }

            if (isset($this->rules['ALERT_REQUESTS']['*']))
            {
                foreach ($this->rules['ALERT_REQUESTS']['*'] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = 'alert';
                        return $result_final;
                    }

                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
						
                        if (stripos(base64_decode($req_value), $rule_values) !== false)
                        {
                            $result_final = 'alert';
                            return $result_final;
                        }
                    }
                }
            }
        }

        return $result_final;
    }
    



    


    public function Session_Rewrite_Requests()
    {
        if (count($_REQUEST) == 0) return;
        if (count($this->rules['REWRITE_REQUESTS']) == 0) return;
        
        foreach ($this->rules['REWRITE_REQUESTS'] as $rule_values_arr)
        {
            foreach ($rule_values_arr as $k => $v)
            {
                if (isset($_REQUEST[$k]))
                {
                    if (is_array($v))
                    {
                        foreach ($v as $k2 => $v2)
                        {
                            if (isset($_REQUEST[$k][$k2]))
                            {
                                if ($v2 == 'UNSET') 
                                {
                                    unset($_REQUEST[$k][$k2]);
                                    unset($_POST[$k][$k2]);
                                    unset($_GET[$k][$k2]);
                                }
                                else {
                                    $_REQUEST[$k][$k2] = $v2;
                                    $_POST[$k][$k2] = $v2;
                                    $_GET[$k][$k2] = $v2;
                                }
                            }
                        }
                    }
                    else {
                        if ($v == 'UNSET') 
                        {
                            unset($_REQUEST[$k]);
                            unset($_POST[$k]);
                            unset($_GET[$k]);
                        }
                        else {
                            $_REQUEST[$k] = $v;
                            $_POST[$k] = $v;
                            $_GET[$k] = $v;
                        }
                    }
                }
            }
        }
    }



    public function Session_Check_Requests_Allowed($requests)
    {
        $result_final = false;  // true - will allow this request, false - continue to check other rules

        if (count($requests) == 0) return $result_final;
        if (count($this->rules['ALLOW_REQUESTS']) == 0) return $result_final;
        
        $requests_flat = self::FlatRequestArray($requests);

        foreach ($requests_flat as $requests_flat_array)
        {
            $req_field = $requests_flat_array['f'];
            $req_value = $requests_flat_array['v'];
			
           
            
            if (isset($this->rules['ALLOW_REQUESTS'][$req_field]))
            {
                foreach ($this->rules['ALLOW_REQUESTS'][$req_field] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = true;
                        return $result_final;
                    }
                    
                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = true;
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = true;
                            return $result_final;
                        }
                    }
                }
            }

            if (isset($this->rules['ALLOW_REQUESTS']['*']))
            {
                foreach ($this->rules['ALLOW_REQUESTS']['*'] as $rule_values)
                {
                    if ($rule_values == '*')
                    {
                        $result_final = true;
                        return $result_final;
                    }

                    if ($rule_values[0] == '=')
                    {
                        $tmp_rule_value = substr($rule_values, 1);
                        if ($tmp_rule_value == $req_value)
                        {
                            $result_final = true;
                            return $result_final;
                        }
                    }
                    else {
                        if (stripos($req_value, $rule_values) !== false)
                        {
                            $result_final = true;
                            return $result_final;
                        }
                    }
                }
            }
        }

        return $result_final;
    }
    


    public function FlatRequestArray($requests)
    {
        $a = array();
        
        foreach ($requests as $f => $v)
        {
            if (is_array($v))
            {
                $a[] = array('f' => $f, 'v' => '');
                
                foreach ($v as $f2 => $v2)
                {
                    if (is_array($v2))
                    {
                        $a[] = array('f' => $f2, 'v' => '');
                        
                        foreach ($v2 as $f3 =>$v3)
                        {
                            if (is_array($v3)) $v3 = json_encode($v3);
                            $a[] = array('f' => $f3, 'v' => $v3);
                        }
                    }
                    else $a[] = array('f' => $f2, 'v' => $v2); 
                }
            }
            else {
                $a[] = array('f' => $f, 'v' => $v);
            }
        }    
        
        return $a;
    }




    public function FilterBots()
    {
        $result_final = 'allow';
        
        if (count($this->rules['BOTS_RULES']['ALLOW']) > 0)
        {
            foreach ($this->rules['BOTS_RULES']['ALLOW'] as $rule_bot)
            {
                if (stripos($_SERVER['HTTP_USER_AGENT'], $rule_bot) !== false) return 'allow';
            }
        }
        
        if (count($this->rules['BOTS_RULES']['BLOCK']) > 0)
        {
            foreach ($this->rules['BOTS_RULES']['BLOCK'] as $rule_bot)
            {
                if (stripos($_SERVER['HTTP_USER_AGENT'], $rule_bot) !== false) return 'block';
            }
        }
        
        return $result_final;
    }
    
    
    
    public function Check_URLs($REQUEST_URI)
    {
        $result_final = 'allow';
        
        if (count($this->rules['BLOCK_URLS']) == 0) return $result_final;
        
        foreach ($this->rules['BLOCK_URLS'] as $rule_url => $rule_url_bot)
        {
            if ($rule_url_bot != '*' && stripos($_SERVER['HTTP_USER_AGENT'], $rule_url_bot) === false)
            {
                continue;   // bot is different
            }
            
            $rule_url_clean = str_replace("*", "", $rule_url);
            if ($rule_url[0] == '*')
            {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. *xxx*
                {
                    if (stripos($REQUEST_URI, $rule_url_clean) !== false)
                    {
                        $result_final = 'block';
                        if ($rule_url_bot != '*') $result_final = 'block_404';
                        $this->this_session_reason_to_block = $rule_url;
                        return $result_final;
                    }
                }
                else {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ($tmp_pos !== false && $tmp_pos + strlen($rule_url_clean) == strlen($REQUEST_URI))     // e.g. *xxx
                    {
                        $result_final = 'block';
                        if ($rule_url_bot != '*') $result_final = 'block_404';
                        $this->this_session_reason_to_block = $rule_url;
                        return $result_final;
                    }
                }
            }
            else {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. /xxx*
                {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ( $tmp_pos !== false && $tmp_pos == 0)
                    {
                        $result_final = 'block';
                        if ($rule_url_bot != '*') $result_final = 'block_404';
                        $this->this_session_reason_to_block = $rule_url;
                        return $result_final;
                    }
                }
                else {
                    if ($rule_url == $REQUEST_URI)  // e.g. /xxx/
                    {
                        $result_final = 'block';
                        if ($rule_url_bot != '*') $result_final = 'block_404';
                        $this->this_session_reason_to_block = $rule_url;
                        return $result_final;
                    }
                }
            }
        }
        
        
        return $result_final;
    }


    public function Block_This_Session($reason = '', $save_request = false, $http_404 = false, $hide_die_msg = false)
    {
        $log_txt = 'Blocked '.SITEGUARDING_THIS_SESSION_IP.',File: '.$_SERVER['SCRIPT_FILENAME'];
        if ($reason != '') $log_txt .= ',Reason: '.$reason;
        if ($save_request === true) $log_txt .= ',Request: '.print_r($_REQUEST, true)."\n\n";
        $this->SaveLogs($log_txt);
        if ($http_404 === true && stripos($_SERVER['HTTP_USER_AGENT'], 'Googlebot') !== false)
        {
            header("HTTP/1.1 404");
            exit;
        }
        if ($hide_die_msg === true) die();
        else die('Access is not allowed. Please contact website webmaster or SiteGuarding.com support. Blocked IP address is '.SITEGUARDING_THIS_SESSION_IP);
    }




    public function CheckIP_in_Allowed($ip)
    {
        if (count($this->rules['ALLOW_ALL_IP']) == 0) return false;

        foreach ($this->rules['ALLOW_ALL_IP'] as $rule_ip)
        {
            if (strpos($ip, $rule_ip) === 0) {
                // match
                return true;
            }
        }
    }



    public function CheckIP_in_Blocked($ip)
    {
        if (count($this->rules['BLOCK_ALL_IP']) == 0) return false;

        foreach ($this->rules['BLOCK_ALL_IP'] as $rule_ip)
        {
            if (strpos($ip, $rule_ip) === 0) {
                // match
                return true;
            }
        }
    }



    public function CheckIP_in_Alert($ip)
    {
        if (count($this->rules['ALERT_IP']) == 0) return false;

        foreach ($this->rules['ALERT_IP'] as $rule_ip)
        {
            if (strpos($ip, $rule_ip) === 0) {
                // match
                return true;
            }
        }
    }
    
    
    
    public function CheckUploadedFileTypes()
    {
        foreach ($_FILES as $tmp_row)
        {
            if ( $tmp_row['error'] == 0 && in_array($tmp_row['type'], $this->rules['ALLOWED_FILE_TYPES']) ) continue;
            else return false;
        }
        
        return true;
    }


    
    public function BlockUploadedFileHex()
    {
        $dumps = $this->rules['BLOCK_FILE_HEX'];
        
        foreach ($_FILES as $tmp_row)
        {
            if ( $tmp_row['error'] == 0 )
            {
                foreach ($dumps as $dump)
                {
					if (SITEGUARDING_DEBUG === true) 
					{
						echo 'File: '.$tmp_row['tmp_name']."<br>";
						echo 'HEX: '.$dump."<br>";
					}
                    $pos = self::FindHex_in_file($dump, $tmp_row['tmp_name'], 1);
                    if ($pos === true) return true;
                }
            }
        }
        
        return false;
    }
    
    
    public function BlockUploadedFileHex_by_extension()
    {
        if (SITEGUARDING_DEBUG === true) echo "<br>".'FileHex_by_extension'."<br>";
        $dumps = $this->rules['BLOCK_FILE_HEX_BY_EXTENSION'];
        
        foreach ($_FILES as $tmp_row)
        {
            if ( $tmp_row['error'] == 0)
            {
                foreach ($dumps as $dump_type => $dump_hex_arr)
                {
                    if (stripos($tmp_row['type'], $dump_type) !== false)
                    {
    					if (SITEGUARDING_DEBUG === true) 
    					{
    						echo 'File: '.$tmp_row['tmp_name']."<br>";
    						echo 'HEX arr: '.$dump_hex_arr."<br>";
    					}
                        
                        if ($dump_hex_arr == '*') return true;  // any HEX
                        
                        $dumps_hex = explode(",", $dump_hex_arr);
                        if (count($dumps_hex))
                        {
                            foreach ($dumps_hex as $dump_hex)
                            {
                                $dump_hex = trim($dump_hex);
                                $pos = self::FindHex_in_file($dump_hex, $tmp_row['tmp_name']);
                                if ($pos === true) return true;
                            }
                        }
                    }
                }
            }
        }
        
        return false;
    }
    
    
    public function CheckUploadedFileExtension()
    {
        $dumps = $this->rules['FILE_EXTENSIONS'];

        foreach ($_FILES as $tmp_row)
        {
            if ( $tmp_row['error'] == 0 && isset($dumps[$tmp_row['type']]) )
            {
                $pos = self::FindHex_in_file($dumps[$tmp_row['type']], $tmp_row['tmp_name']);
                if ($pos === false) return false;
            }
        }
        
        return true;
    }
    
    public function FindHex_in_file($searchBytes, $filename, $block = 0) 
    {
        $searchBytes = hex2bin($searchBytes);
        
    	$crossing = 1 - strlen($searchBytes);	
    	$seq = '';	
    	$buflen = 1024;
        if ($block == 1) $buflen = 256;
    
    	$f = fopen($filename, "rb");
    	while(!feof($f)) 
    	{
    		$seq .= fread($f, $buflen);

    		if(strpos($seq, $searchBytes) === false) 
    		{
    			$seq = substr($seq, $crossing);
    		}
    		else
    		{
    			return true;
    		}
            
            if ($block > 0) break;
    	}
    	unset($seq);
    	
    	return false;
    }


    public function SSL_encrypt($data)
    {
        if (function_exists('openssl_public_encrypt'))
        {
        	openssl_public_encrypt($data, $result, self::$ssl_public_key);
        	$result = base64_encode($result);
        	if ($result) return $result;
        	return false;
        }
        else return false;
    	
    }

	public function LogRequest($short = false)
	{
		$_REQUEST_tmp = $_REQUEST;
		
        if (!$this->save_empty_requests && count($_REQUEST_tmp) == 0) return;
		
		if (count($_REQUEST_tmp) > 0)
		{
            if (SITEGUARDING_UNSET_PASSWORD_DATA)
            {
    			if (isset($_REQUEST_tmp['cc'])) unset($_REQUEST_tmp['cc']);
    			if (isset($_REQUEST_tmp['cc_num'])) unset($_REQUEST_tmp['cc_num']);
    			if (isset($_REQUEST_tmp['cvv'])) unset($_REQUEST_tmp['cvv']);
    			if (isset($_REQUEST_tmp['username'])) unset($_REQUEST_tmp['username']);
    			if (isset($_REQUEST_tmp['user'])) unset($_REQUEST_tmp['user']);
    			if (isset($_REQUEST_tmp['account'])) unset($_REQUEST_tmp['account']);
    			if (isset($_REQUEST_tmp['log'])) unset($_REQUEST_tmp['log']);
    			if (isset($_REQUEST_tmp['pwd'])) unset($_REQUEST_tmp['pwd']);
    			if (isset($_REQUEST_tmp['pass'])) unset($_REQUEST_tmp['pass']);
    			if (isset($_REQUEST_tmp['passwd'])) unset($_REQUEST_tmp['passwd']);
    			if (isset($_REQUEST_tmp['password'])) unset($_REQUEST_tmp['password']);
				if (isset($_REQUEST_tmp['pass1'])) unset($_REQUEST_tmp['pass1']);
				if (isset($_REQUEST_tmp['pass2'])) unset($_REQUEST_tmp['pass2']);
				if (isset($_REQUEST_tmp['pass1-text'])) unset($_REQUEST_tmp['pass1-text']);
                
				if (isset($_REQUEST_tmp['payment'])) unset($_REQUEST_tmp['payment']);
				if (isset($_REQUEST_tmp['billing'])) unset($_REQUEST_tmp['billing']);
				if (isset($_REQUEST_tmp['cc_type'])) unset($_REQUEST_tmp['cc_type']);
				if (isset($_REQUEST_tmp['cc_number'])) unset($_REQUEST_tmp['cc_number']);
				if (isset($_REQUEST_tmp['cc_exp_month'])) unset($_REQUEST_tmp['cc_exp_month']);
				if (isset($_REQUEST_tmp['cc_exp_year'])) unset($_REQUEST_tmp['cc_exp_year']);
                
				if (isset($_REQUEST_tmp['login']['username'])) unset($_REQUEST_tmp['login']['username']);
				if (isset($_REQUEST_tmp['login']['password'])) unset($_REQUEST_tmp['login']['password']);
            }
            else {
    			if (isset($_REQUEST_tmp['cc'])) $_REQUEST_tmp['cc'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['cc']);
    			if (isset($_REQUEST_tmp['cc_num'])) $_REQUEST_tmp['cc_num'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['cc_num']);
    			if (isset($_REQUEST_tmp['cvv'])) $_REQUEST_tmp['cvv'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['cvv']);
    			if (isset($_REQUEST_tmp['username'])) $_REQUEST_tmp['username'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['username']);
    			if (isset($_REQUEST_tmp['user'])) $_REQUEST_tmp['user'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['user']);
    			if (isset($_REQUEST_tmp['account'])) $_REQUEST_tmp['account'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['account']);
    			if (isset($_REQUEST_tmp['log'])) $_REQUEST_tmp['log'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['log']);
    			if (isset($_REQUEST_tmp['pwd'])) $_REQUEST_tmp['pwd'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['pwd']);
    			if (isset($_REQUEST_tmp['pass'])) $_REQUEST_tmp['pass'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['pass']);
    			if (isset($_REQUEST_tmp['passwd'])) $_REQUEST_tmp['passwd'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['passwd']);
    			if (isset($_REQUEST_tmp['password'])) $_REQUEST_tmp['password'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['password']);
				if (isset($_REQUEST_tmp['pass1'])) $_REQUEST_tmp['pass1'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['pass1']);
				if (isset($_REQUEST_tmp['pass2'])) $_REQUEST_tmp['pass2'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['pass2']);
				if (isset($_REQUEST_tmp['pass1-text'])) $_REQUEST_tmp['pass1-text'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['pass1-text']);
                
				if (isset($_REQUEST_tmp['payment'])) $_REQUEST_tmp['payment'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['payment']);
				if (isset($_REQUEST_tmp['billing'])) $_REQUEST_tmp['billing'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['billing']);
				if (isset($_REQUEST_tmp['cc_type'])) $_REQUEST_tmp['cc_type'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['cc_type']);
				if (isset($_REQUEST_tmp['cc_number'])) $_REQUEST_tmp['cc_number'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['cc_number']);
				if (isset($_REQUEST_tmp['cc_exp_month'])) $_REQUEST_tmp['cc_exp_month'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['cc_exp_month']);
				if (isset($_REQUEST_tmp['cc_exp_year'])) $_REQUEST_tmp['cc_exp_year'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['cc_exp_year']);
                
				if (isset($_REQUEST_tmp['login']['username'])) $_REQUEST_tmp['login']['username'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['login']['username']);
				if (isset($_REQUEST_tmp['login']['password'])) $_REQUEST_tmp['login']['password'] = 'PGP:'.self::SSL_encrypt($_REQUEST_tmp['login']['password']);
            }
		}

        if ($this->single_log_file) 
        {
            if (SITEGUARDING_LOGS_DISABLE_GZ) $log_file = '_logs.php';
            else $log_file = '_logs.gzs';
        }
        else {
            if (SITEGUARDING_LOGS_DISABLE_GZ) $log_file = basename($_SERVER['SCRIPT_FILENAME'])."_".md5($_SERVER['SCRIPT_FILENAME']).".log.php";
        	else $log_file = basename($_SERVER['SCRIPT_FILENAME'])."_".md5($_SERVER['SCRIPT_FILENAME']).".log.gzs";
        }
        $log_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.$log_file;
        $Send_alert_to_SG = false;
        if (!file_exists($log_file)) 
		{
			$log_file_new = true;
			$log_filesize = 0;
            // Check if we need to send the alert to SG
            if (SITEGUARDING_HTTP_FOR_ALERTS)
            {
                if (!in_array(str_replace($_SERVER['DOCUMENT_ROOT'], "", $_SERVER['SCRIPT_FILENAME']), $this->rules['EXCLUDE_REMOTE_ALERT_FILES'])) $Send_alert_to_SG = true;
            }
		}
        else {
			$log_file_new = false;
			$log_filesize = filesize($log_file);
            
            if (SITEGUARDING_HTTP_FOR_ALERTS && $log_filesize < $this->log_file_max_size_for_http_alert && !in_array(str_replace(SITEGUARDING_SCAN_PATH, "/", $_SERVER['SCRIPT_FILENAME']), $this->rules['EXCLUDE_REMOTE_ALERT_FILES'])) $Send_alert_to_SG = true;
		}
		
       
    	if (file_exists($log_file) && filesize($log_file) > $this->log_file_max_size * 1024 * 1024)
    	{
    	    // Trunc log file
    	    $log_file_tmp = $log_file.".tmp";
            
            // Plain text
            $fp1 = fopen($log_file, "rb");
            $fp2 = fopen($log_file_tmp, "wb");
            fwrite($fp2, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
            
            $pos = $log_filesize * 0.7;     // 30%
            fseek($fp1, $pos);
            
            while (!feof($fp1)) {
                $buffer = fread($fp1, 4096 * 32);
                fwrite($fp2, $buffer);
            }
            
            fclose($fp1);
            fclose($fp2);
            
            rename($log_file_tmp, $log_file);
    	} 
		
        


		
        $fp = fopen($log_file, "a");
        
		$_FILES_tmp = '';
		if (count($_FILES) > 0)
		{
			$_FILES_tmp = 'UPLOADED FILES: '.print_r($_FILES, true)."\n";
		}
		
        $_REQUEST_tmp = print_r($_REQUEST_tmp, true);
        
        if ($short) $_REQUEST_tmp = $_FILES_tmp = '';
        
        if (SITEGUARDING_COLLECT_HTTP_USER_AGENT) $txt_HTTP_USER_AGENT = 'Agent:'.$_SERVER["HTTP_USER_AGENT"]."\n";
        else $txt_HTTP_USER_AGENT = '';
        
            
        $siteguarding_log_line = date("Y-m-d H:i:s")."\n".
        	"IP:".SITEGUARDING_THIS_SESSION_IP."\n".$txt_HTTP_USER_AGENT.
        	"Link:"."http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"."\n".
        	"File:".$_SERVER['SCRIPT_FILENAME']."\n".$_FILES_tmp.
        	$_REQUEST_tmp;
            "\n\n"."-=^=-"."\n\n";

        

        if ($log_file_new) fwrite($fp, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
        if (SITEGUARDING_LOGS_DISABLE_GZ) fwrite($fp, $siteguarding_log_line."\n\n"."-=^=-"."\n\n");
        else fwrite($fp, self::Text_EncodeZip($siteguarding_log_line)."\n\n"."-=^=-"."\n\n");
        fclose($fp);   


        
        if ($Send_alert_to_SG)
        {
            // Send alert to SG
            self::SendAlert_to_SG($siteguarding_log_line);
        }
        
        if (SITEGUARDING_DUPS)
        {
            $log_file = basename($_SERVER['SCRIPT_FILENAME'])."_".md5($_SERVER['SCRIPT_FILENAME']).".log.php";
            if (SITEGUARDING_DUPS_LOCATION != '')
            {
                if (!file_exists(SITEGUARDING_DUPS_LOCATION)) mkdir(SITEGUARDING_DUPS_LOCATION);
                $log_file = SITEGUARDING_DUPS_LOCATION.$this->dirsep.$log_file;
            }
            else {
                if (file_exists(SITEGUARDING_SCAN_PATH.'wp-config.php'))
                {
                    $tmp_folder = SITEGUARDING_SCAN_PATH.'wp-admin'.$this->dirsep.'logs';
                    if (!file_exists($tmp_folder)) mkdir($tmp_folder);
                    $log_file = $tmp_folder.$this->dirsep.$log_file;
                }
                else
                {
                    $tmp_folder = SITEGUARDING_SCAN_PATH.'administrator'.$this->dirsep.'logs';
                    if (!file_exists($tmp_folder)) mkdir($tmp_folder);
                    $log_file = $tmp_folder.$this->dirsep.$log_file;
                }
            }
            
            if (!file_exists($log_file)) 
    		{
    			$log_file_new = true;
    			$log_filesize = 0;
    		}
            else {
    			$log_file_new = false;
    			$log_filesize = filesize($log_file);
    		}
    		
           
        	if (file_exists($log_file) && filesize($log_file) > $this->log_file_max_size * 1024 * 1024)
        	{
        	    // Trunc log file
                $log_file_tmp = $log_file.".tmp";
            
                $fp1 = fopen($log_file, "rb");
                $fp2 = fopen($log_file_tmp, "wb");
                fwrite($fp2, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
                
                $pos = $log_filesize * 0.7;     // 30%
                fseek($fp1, $pos);
                
                while (!feof($fp1)) {
                    $buffer = fread($fp1, 4096 * 32);
                    fwrite($fp2, $buffer);
                }
                
                fclose($fp1);
                fclose($fp2);
                
                rename($log_file_tmp, $log_file);
        	} 
    		

            $fp = fopen($log_file, "a");
            if ($log_file_new) fwrite($fp, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
            fwrite($fp, $siteguarding_log_line);
            fclose($fp);
        }
    }


    public function Text_EncodeZip($txt)
    {
        return gzdeflate($txt);
    }
    
    public function SendAlert_to_SG($txt)
    {
        $http_class_file = dirname(__FILE__).$this->dirsep.'firewall.http.class.php';
        if (file_exists($http_class_file)) 
        {
            include_once($http_class_file);
            
            $domain = "http://".$_SERVER['HTTP_HOST'];
    	    $host_info = parse_url($domain);
    	    if ($host_info == NULL) return false;
    	    $domain = $host_info['host'];
    	    if ($domain[0] == "w" && $domain[1] == "w" && $domain[2] == "w" && $domain[3] == ".") $domain = str_replace("www.", "", $domain);
            
            $post_data = array(
        		'task' => 'API_firewall_alert',
        		'option' => 'com_securapp',
                'domain' => $domain,
                'cms' => self::DetectCMS(),
                'file' => str_replace(SITEGUARDING_SCAN_PATH, "/", $_SERVER['SCRIPT_FILENAME']),
                'req' => $txt
            );

            if (class_exists('EasyRequest_sg'))
            {
                $client = EasyRequest_sg::create('POST', self::$SG_URL, array(
                    'form_params' => $post_data
                ));
            }
            else {
                $client = EasyRequest::create('POST', self::$SG_URL, array(
                    'form_params' => $post_data
                ));
            }

            $client->send();
        }
    }
    
    
    public function TraceSiteGuardingRequest()
    {
        if (isset($_REQUEST['siteguarding_action']) && trim($_REQUEST['siteguarding_action']) != '')
        {
            // Check IP address
            if (!in_array(SITEGUARDING_THIS_SESSION_IP, self::$SG_IPs)) 
            {
                // Check IP of SG server
                if ( SITEGUARDING_THIS_SESSION_IP != gethostbyname('www.siteguarding.com') ) return;
            }
            
            switch (trim($_REQUEST['siteguarding_action']))
            {
                case 'get_blocked_file':
                
                    $log_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'_blocked.log.gzs';
                    
                    $handle = fopen($log_file, "r");
                    $contents = fread($handle, filesize($log_file));
                    fclose($handle);
                    
                    $filename = basename($log_file);
                    
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/octet-stream');
                	header('Content-disposition: attachment; filename="'.$filename.'"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($zip_filename));
                    ob_clean();
                    flush();
                
                	echo $contents;
                	exit;
                    
                    break;


                case 'check_version':
                
                	die(json_encode(array('version' => SITEGUARDING_FIREWALL_VERSION)));
                    break;
            }
        }
        
        if (isset($_GET['sg_firewall_status']))
        {
            $session_key = trim($_GET['sg_firewall_status']);
            if ($session_key == '') return;
            
            $url = str_replace('index.php', '_get_file.php', self::$SG_URL);
            $url = $url.'?file=installer&filename=tunnel2.php&session_key='.$session_key.'&time='.time();
            
            $http_class_file = dirname(__FILE__).$this->dirsep.'firewall.http.class.php';
            if (file_exists($http_class_file)) 
            {
                include_once($http_class_file);
                
                if (class_exists('EasyRequest_sg'))
                {
                    $client = EasyRequest_sg::create('GET', $url);
                }
                else {
                    $client = EasyRequest::create('GET', $url);;
                }
 
                $client->send();
        		$content = $client->getResponseBody();
                
                if (strlen($content) > 1000)
                {
                    $file = dirname(dirname(__FILE__)).$this->dirsep.'tunnel2.php';
                    self::Save_File($file, $content);
                    if (file_exists($file)) die('OK: '.$file);
                    else die('ERR: '.$file);
                }
                else die('Respond: '.$content);
            }
            die('Absent '.$http_class_file);
        }
    }



    public function DetectCMS()
    {
        if (file_exists(SITEGUARDING_SCAN_PATH.'wp-config.php')) return 1;  // WordPress
        if (file_exists(SITEGUARDING_SCAN_PATH.'configuration.php')) return 2;  // Joomla
        if (file_exists(SITEGUARDING_SCAN_PATH.'app/etc/local.xml')) return 3;  // Magento
        return 0;   // other
    }
    
    
    public function CheckIfOwnTools()
    {
        $d = dirname(dirname(__FILE__));
        $f = substr($_SERVER['SCRIPT_FILENAME'], strpos($_SERVER['SCRIPT_FILENAME'], $d) + strlen($d));
        if (
            $f == '/tunnel2.php' ||
            $f == '/tunnel.php' ||
            $f == '/antivirus.php' ||
            $f == '/backup.php' ||
            $f == '/collectdata.php'
        ) return true;
        else return false;
    }

    public function SaveLogs_anyfile($filename, $txt)
    {
        if (SITEGUARDING_LOGS_DISABLE_GZ) $a = date("Y-m-d H:i:s").",".$txt."\n\n"."-=^=-"."\n\n";
        else $a = self::Text_EncodeZip(date("Y-m-d H:i:s").",".$txt)."\n\n"."-=^=-"."\n\n"; 
       
        if (SITEGUARDING_LOGS_DISABLE_GZ) $log_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.$filename;
    	else $log_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.$filename.'.gzs';
        
        if (!file_exists($log_file)) 
		{
			$log_file_new = true;
			$log_filesize = 0;
		}
        else {
			$log_file_new = false;
			$log_filesize = filesize($log_file);
		}

        // Reduce size of log file
    	if ($log_filesize > $this->log_file_max_size * 1024 * 1024)
    	{
    	    // Trunc log file
    	    $log_file_tmp = $log_file.".tmp";
            
            // Plain text
            $fp1 = fopen($log_file, "rb");
            $fp2 = fopen($log_file_tmp, "wb");
            fwrite($fp2, '<?php exit; ?>'."\n".$_SERVER['SCRIPT_FILENAME']."\n\n"."-=^=-"."\n\n");
            
            $pos = $log_filesize * 0.7;     // 30%
            fseek($fp1, $pos);
            
            while (!feof($fp1)) {
                $buffer = fread($fp1, 4096 * 32);
                fwrite($fp2, $buffer);
            }
            
            fclose($fp1);
            fclose($fp2);
            
            rename($log_file_tmp, $log_file);
    	} 
        
        $fp = fopen($log_file, 'a');
        fwrite($fp, $a);
        fclose($fp);
    }


	public function SaveLogs($txt)
	{
        if (SITEGUARDING_SAVE_BLOCKED_REQUESTS !== true) return;
        
        $this->SaveLogs_anyfile('_blocked.log', $txt);
    }

    
	public function SaveDebug($txt)
	{
        $a = date("Y-m-d H:i:s")." ".$txt."\n";
       
    	$log_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'_debug.log';
        
        $fp = fopen($log_file, 'a');
        fwrite($fp, $a);
        fclose($fp);
    }


	public function SendEmail($subject, $message)
	{
        $to = $this->email_for_alerts;
        if ($to == '') return;

        $headers = 'From: '. $to . "\r\n";

        mail($to, $subject, $message, $headers);
    }
    
    
    public function CheckUpdates()
    {
        // Update check
        $update_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.update.txt';
        if (file_exists($update_file))
        {
            $time_diff = time() - filemtime($update_file);
            if ($time_diff > 1 * 24 * 60 * 60)  // 1 day
            {
                // Get md5
                $update_logs = '';
                $http_class_file = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.http.class.php';
                if (file_exists($http_class_file)) 
                {
                    include_once($http_class_file);
                    
                    $sg_get_url = str_replace('index.php', '_get_file.php', self::$SG_URL);
                    $url = $sg_get_url.'?file=firewall_md5&time='.time();
                    
                    if (class_exists('EasyRequest_sg'))
                    {
                        $client = EasyRequest_sg::create('GET', $url);
                    }
                    else {
                        $client = EasyRequest::create('GET', $url);
                    }
            
                    $client->send();
            		$content = $client->getResponseBody();
                    
                    $md5_files = (array)json_decode($content, true);
                    if (isset($md5_files['update_key']))
                    {
                        $session_key = $md5_files['update_key'];
                        unset($md5_files['update_key']);
                        if (is_array($md5_files) && count($md5_files) > 0)
                        {
                            foreach ($md5_files as $filename => $file_md5)
                            {
                                $current_file = dirname(__FILE__).SITEGUARDING_DIRSEP.$filename;
                                if (file_exists($current_file)) $current_file_md5 = md5_file($current_file);
                                else $current_file_md5 = 'absent';
                                
                                $update_logs .= "\n".$filename;
                                
                                if ($current_file_md5 == $file_md5) continue;
                                
                                // Download update
                                $url = $sg_get_url.'?file=installer&filename='.$filename.'&session_key='.$session_key.'&time='.time();
                                
                                if (class_exists('EasyRequest_sg'))
                                {
                                    $client = EasyRequest_sg::create('GET', $url);
                                }
                                else {
                                    $client = EasyRequest::create('GET', $url);
                                }
            
                                $client->send();
                        		$content = $client->getResponseBody();
                                
                                if (md5($content) == $file_md5)
                                {
                                    if ($filename == 'rules.txt') continue;
                                    
                                    if ($filename == 'rules.dat')
                                    {
                                        self::Save_File($current_file, $content);   // Save content of rules.dat
                                        
                                        // Get rules.txt
                                        $url = $sg_get_url.'?file=installer&filename=rules.txt&session_key='.$session_key.'&time='.time();
                                        
                                        if (class_exists('EasyRequest_sg'))
                                        {
                                            $client = EasyRequest_sg::create('GET', $url);
                                        }
                                        else {
                                            $client = EasyRequest::create('GET', $url);
                                        }
                                        
                                        $client->send();
                                		$content = $client->getResponseBody();
                                        
                                        // Parse rules.txt
                                        $content = self::MergeRules($content);
                                    }
                                    self::Save_File($current_file, $content);
                                    
                                    $update_logs .= " - updated";
                                }
                                else $update_logs .= " - wrong remote md5. skip";
                            }
    
                        }
                    }
                    
                }
                unlink($update_file);
                self::Save_File($update_file, 'updated: '.date("Y-m-d H:i:s").$update_logs);
            }
        }
        else self::Save_File($update_file, 'updated: '.date("Y-m-d H:i:s"));
    }
    
    public function CheckUpdateKey()
    {
        // Validation
        if (defined('SITEGUARDING_LIC_KEY') && SITEGUARDING_LIC_KEY != '')
        {
            $lickey = hexdec(SITEGUARDING_LIC_KEY); 
            $current = date("YmdHis");
            if ($current <= $lickey) return true;
        }


        $file_firewall_lickey = dirname(__FILE__).SITEGUARDING_DIRSEP.'firewall.key.txt';
        
        if (file_exists($file_firewall_lickey))
        {
            $time_future_stamp = time() - 30 * 24 * 60 * 60;
            if (filemtime($file_firewall_lickey) >= $time_future_stamp) return true;
        }
        
        return false;
    }
    
    
    public function MergeRules($new_rules)
    {
        $new_rules = $new_rules."\n\n";
        $backup_rules = self::Read_File(dirname(__FILE__).SITEGUARDING_DIRSEP.'rules.txt')."\n\n";
        
        $new_rules_arr = self::ParseRules($new_rules);
        $backup_rules_arr = self::ParseRules($backup_rules);
        
        foreach ($backup_rules_arr as $section => $rules_in_section)
        {
            if (count($rules_in_section))
            {
                foreach ($rules_in_section as $i => $rule_row)
                {
                    if (in_array($rule_row, $new_rules_arr[$section])) unset($backup_rules_arr[$section][$i]);
                }
            }
            if (count($backup_rules_arr[$section]) == 0) unset($backup_rules_arr[$section]);
        }
        
        if (count($backup_rules_arr) > 0)
        {
            foreach ($backup_rules_arr as $section => $rules_in_section)
            {
                $new_rules = str_replace($section, $section."\n".implode("\n", $rules_in_section), $new_rules);
            }
            //return $new_rules;
        }
        
        return $new_rules;
    }

    
    public function ParseRules($content)
    {
        $backup_rules_arr = explode("\n", $content);
        
        $b = array();
        $section = "";
        foreach ($backup_rules_arr as $row)
        {
            $row = trim($row);
            if ($row[0] == "#" || $row == "") continue;
            
            $row_s = substr($row, 0, 2);
            $row_e = substr($row, -2);
            if ($row_s == "::" && $row_e == "::") 
            {
                $section = $row;
                continue;
            }
            
            if ($section != "") $b[$section][] = $row;
        }  
        
        return $b; 
    }
    
    
    public function Read_File($file)
    {
        $contents = '';
        
        if (file_exists($file))
        {
            $fp = fopen($file, "r");
            $contents = fread($fp, filesize($file));
            fclose($fp); 
            }
        
        return $contents;
    }
    
    public function Save_File($file, $content, $append_flag = false)
    {
        if ($append_flag == true) $fp = fopen($file, 'a');
        else $fp = fopen($file, 'w');
        if ($fp === false) return false;
        
        $a = fwrite($fp, $content);
        if ($a === false) return false;
        
        fclose($fp);
        
        return true;
    }

    
    public function Ban_IP_in_rules($ip_address)
    {
        $rule_file = dirname(__FILE__).$this->dirsep.'rules.txt';
        
        $rule_txt = self::Read_File($rule_file);
        $rule_txt = str_replace('::BLOCK_ALL_IP::', '::BLOCK_ALL_IP::'."\n".$ip_address, $rule_txt);
        self::Save_File($rule_file, $rule_txt);
    }
    
    public function Track_IP_analyze($ip_address)
    {
        $log_file = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'ip';
        if (!file_exists($log_file))
        {
            // Create folder
            mkdir($log_file);
            $content = "<Limit GET POST>"."\n"."order deny,allow"."\n"."deny from all"."\n"."</Limit>";
            self::Save_File($log_file.$this->dirsep.'.htaccess', $content);
        }
        $log_file .= $this->dirsep.$ip_address.".txt";
        
        // sample time() = 1509038657
        if (filesize($log_file) > SITEGUARDING_TRACK_IP_AMOUNT * 11)
        {
            $log_file_data = self::Read_File($log_file);
            $log_file_data = explode("\n", $log_file_data);
            
            if (count($log_file_data))
            {
                $min_time = time() - SITEGUARDING_TRACK_IP_PERIOD * 60;
                foreach ($log_file_data as $k => $row_time)
                {
                    if (intval($row_time) < $min_time) unset($log_file_data[$k]);
                }
                self::Save_File($log_file, implode("\n", $log_file_data));
                
                if (count($log_file_data) >= SITEGUARDING_TRACK_IP_AMOUNT) return 'block';
            }
        }
        
        self::Save_File($log_file, time()."\n", true);
    }
    
    public function Track_IP_check_url($REQUEST_URI)
    {
        $result_final = false;  // No need to check
        
        if (count($this->rules['TRACK_IP']) == 0) return $result_final;
        
        foreach ($this->rules['TRACK_IP'] as $rule_url)
        {
            $rule_url_clean = str_replace("*", "", $rule_url);
            if ($rule_url[0] == '*')
            {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. *xxx*
                {
                    if (stripos($REQUEST_URI, $rule_url_clean) !== false)
                    {
                        $result_final = true;   // need to check this URL
                        return $result_final;
                    }
                }
                else {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ($tmp_pos !== false && $tmp_pos + strlen($rule_url_clean) == strlen($REQUEST_URI))     // e.g. *xxx
                    {
                        $result_final = true;   // need to check this URL
                        return $result_final;
                    }
                }
            }
            else {
                if ($rule_url[strlen($rule_url)-1] == '*')  // e.g. /xxx*
                {
                    $tmp_pos = stripos($REQUEST_URI, $rule_url_clean);
                    if ( $tmp_pos !== false && $tmp_pos == 0)
                    {
                        $result_final = true;   // need to check this URL
                        return $result_final;
                    }
                }
                else {
                    if ($rule_url == $REQUEST_URI)  // e.g. /xxx/
                    {
                        $result_final = true;   // need to check this URL
                        return $result_final;
                    }
                }
            }
        }
        
        
        return $result_final;
    }
    
    
    public function CheckAntiBot_Session()
    {
        $antibot_class_file = dirname(__FILE__).$this->dirsep.'firewall.antibot.class.php';
        if (class_exists('SgAntiBot') === false)
        {
            if (file_exists($http_class_file) === false) 
            {
                include_once($antibot_class_file);
            }
            else die('File is absent: '.$antibot_class_file);
        }

        if (SITEGUARDING_DEBUG === true && SITEGUARDING_THIS_SESSION_IP == SITEGUARDING_DEBUG_IP) echo 'ANTIBOT RULE=<pre>'.print_r($this->rules['ANTIBOT'], true)."</pre><br>";
        
        $sgab = new SgAntiBot($this->rules['ANTIBOT']);
        $result = $sgab->analyze(); 
        
        if ($result === false) self::SaveAntiBotLog('blocked');
        else if ($sgab->isWhiteBot()) self::SaveAntiBotLog('allowed');
        
        return $result;
    }
    
    public function SaveAntiBotLog($session_type = 'blocked')   // $session_type = blocked | allowed
    {
        $log_folder = dirname(__FILE__).$this->dirsep.'logs'.$this->dirsep.'antibot'.$this->dirsep;
        if (!file_exists($log_folder)) mkdir($log_folder);
        
        $log_file = $log_folder.'day_'.date("d").'.log';
        
        if (file_exists($log_file))
        {
            if (date("m") != date("m", filectime($log_file))) unlink($log_file);
        }
        
        
        $log_line = array(
            'date' => date("Y-m-d H:i:s"),
            'ip' => SITEGUARDING_THIS_SESSION_IP,
            'agent' => $_SERVER["HTTP_USER_AGENT"],
            'url' => $_SERVER[REQUEST_URI],
            'type' => $session_type[0],
        );
        
        $log_line = json_encode($log_line)."\n";
        
        $fp = fopen($log_file, "a");
        fwrite($fp, $log_line);
        fclose($fp);
    }

}

?>
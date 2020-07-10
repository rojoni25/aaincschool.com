<?php
// 33F190D04D71-0B067FFC03A6-1810FA8DBECA
// Manual installation of antivirus website protection

/**
 * Website: http://www.siteguarding.com/
 * Email: support@siteguarding.com
 *
 * @author John Coggins
 * @version 1.3
 * @date 2 Jun 2017
 * @package SiteGuarding Antivirus Installer
 */


 
define('MAIN_SERVER_URL', 'http://www.siteguarding.com/_get_file.php?file=');
define('MAIN_SERVER_URL_HTTPS', 'https://www.siteguarding.com/_get_file.php?file=');

error_reporting( 0 );

// Init

$script_path = dirname(__FILE__);

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') 
{	// Windows
	$DIRSEP = '\\';
}
else {
	// Unix
	$DIRSEP = '/';
}



$result = array();
$result['status'] = 'ok';


// Checks server settings before installation 

// Check if dir is writable
if (!is_writable($script_path))
{
    $result['status'] = 'error'; 
    $result['errors'][] = 'Folder is not writeable';
}


	
// Check CURL
if ( !function_exists('curl_init') ) 
{
    $result['status'] = 'error'; 
    $result['errors'][] = 'CURL is not installed on your server. Please contact your hoster support.';
}
       
	    
if ($result['status'] == 'error')
{
	echo json_encode($result);
	exit;
}     
        


// Download and create the files

$access_key = trim($_GET['access_key']);

// Create index.html
CreateFile($script_path, 'index.html', '<html><body bgcolor="#FFFFFF"></body></html>');


// Create antivirus_config.php
$file_content = '<?php'."\n".
	'define("ACCESS_KEY", "'.$access_key.'");'."\n".
    '?>'."\n";
CreateFile($script_path, 'antivirus_config.php', $file_content);


// Remove .htaccess 
if (file_exists($script_path.$DIRSEP.'.htaccess')) unlink($script_path.$DIRSEP.'.htaccess');


// Create antivirus.php
$url = MAIN_SERVER_URL.'antivirus&time='.time();
$url_https = MAIN_SERVER_URL_HTTPS.'antivirus&time='.time();
$dst = $script_path.'/antivirus.php';
$status = CreateRemote_file_contents($url, $dst);
if ($status === false) $status = CreateRemote_file_contents($url_https, $dst);
if ($status === false) $status = CreateRemote_file_contents_HTTPClient($url, $dst);
if ($status === false) $status = CreateRemote_file_contents_HTTPClient($url_https, $dst);


// Delete this setup.php
unlink(__FILE__);


$result['status'] = 'ok';   // With any result it will be OK
$result['errors'][] = ''; 

echo json_encode($result);
exit;




/**
 * Functions
 */

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
        
        if ($info['size_download'] == 0) return false;
        
        return $info['size_download'];
    }
    else return false;
}



function CreateRemote_file_contents_HTTPClient($url, $dst)
{
    if (class_exists('EasyRequest')) 
    {
        $client = EasyRequest::create($url);
        $client->send();
        $content = $client->getResponseBody();
        
        if ($content === false || trim($content) == '') return false;
        
        $fp = fopen($dst, 'w');
        if ($fp === false) return false;
        $a = fwrite($fp, $content);
        if ($a === false) return false;
        fclose($fp);
        
        return true;
    }
    else return false;
}




class EasyRequest { const BOUNDARY_PLACEHOLDER = '##BOUNDARY##'; protected $options = array( 'handler' => null, 'method' => 'GET', 'url' => '', 'nobody' => false, 'follow_redirects' => 1, 'protocol_version' => '1.1', 'timeout' => 30, 'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.9; rv:38.0) Gecko/20100101 Firefox/38.0', 'auth' => null, 'proxy' => null, 'proxy_userpwd' => null, 'proxy_type' => 'http', 'headers' => array(), 'cookies' => array(), 'json' => false, 'body' => '', 'query' => array(), 'form_params' => array(), 'multipart' => array(), 'curl' => array(), ); public $request; public $response; protected $redirects = array( 'count' => 0, 'urls' => array(), 'cookies' => array(), 'requests' => array(), ); protected $debugInfo = array( 'time_start' => null, 'time_process' => null, 'handler' => null, 'errors' => array(), ); private $builder = array( 'headers' => array(), 'query' => array(), 'form_params' => array(), ); private function __construct() { } public function setOptions($key, $value = null) { if (is_array($key)) { foreach ($key as $k => $v) { $this->setOptions($k, $v); } } elseif (!array_key_exists($key, $this->options)) { throw new InvalidArgumentException(sprintf('Option "%s" is invalid.', $key)); } else { $this->options[$key] = $value; } return $this; } public function getOptions($key = null) { if ($key === null) { return $this->options; } elseif (!array_key_exists($key, $this->options)) { throw new InvalidArgumentException(sprintf('Option "%s" is invalid.', $key)); } return $this->options[$key]; } public static function create($url, $method = 'GET', $options = array()) { if (strpos($method, '://')) { $temp = $url; $url = $method; $method = $temp; } $object = new self; $params = array( 'form_params' => 'withFormParam', 'query' => 'withQuery' ); foreach ($params as $key => $setter) { if (isset($options[$key])) { $object->$setter($object->getParamsAsString($options[$key])); unset($options[$key]); } } if (!empty($options['headers'])) { foreach ($options['headers'] as $name => $values) { if (is_int($name)) { list($name, $value) = explode(':', $values, 2); $object->withHeader($name, $value); } else { $object->withHeader($name, $values); } } } if (!empty($options['cookies']) && is_string($options['cookies'])) { $object->withStringCookies($options['cookies']); unset($options['cookies']); } return $object->setOptions(array('method' => strtoupper($method), 'url' => $url) + $options); } public static function __callStatic($method, $arguments) { static $methods = array( 'OPTIONS' => 1, 'GET' => 1, 'HEAD' => 1, 'POST' => 1, 'PUT' => 1, 'DELETE' => 1, 'TRACE' => 1, 'CONNECT' => 1 ); if (!empty($methods[strtoupper($method)])) { return self::create($method, $arguments[0], isset($arguments[1]) ? $arguments[1] : array())->send(); } throw new Exception(sprintf('Method "%s" is not defined.', $method)); } public function send() { list($options, $request) = $this->prepareRequest(); if (empty($request['uri'])) { throw new Exception('Request URI cannot be empty.'); } $this->options = $options; $this->request = $request; $this->response = null; $handler = $this->getHandler(); $sendMethod = sprintf('sendWith%s', ucfirst($handler)); $this->debugInfo['handler'] = $handler; $this->debugInfo['time_start'] = microtime(true); $info = $this->$sendMethod($this->request); $this->debugInfo['time_process'] = microtime(true) - $this->debugInfo['time_start']; if ($info !== false) { $this->response = array( 'header' => $info[0], 'body' => $info[1] ); $this->followRedirects(); } return $this; } protected function followRedirects() { $client = clone $this; while (($this->options['follow_redirects'] === true || $this->options['follow_redirects'] > $this->redirects['count']) && $nextUrl = $client->getResponseHeaderLine('Location') ) { $nextUrl = $this->getAbsoluteUrl($nextUrl, $client->options['url']); if ($this->redirects['count'] === 0) { $this->redirects['urls'][] = $client->options['url']; $this->redirects['requests'][] = $client; $this->redirects['cookies'] = array_values($client->options['cookies']); $this->collectResponseCookies($this->redirects['cookies'], $client->getResponseArrayCookies()); } $reuseOptions = array( 'nobody', 'protocol_version', 'timeout', 'user_agent', 'auth', 'headers', 'proxy', 'proxy_userpwd', 'proxy_type', 'query' ); $options = array('cookies' => $this->redirects['cookies']); foreach ($reuseOptions as $key) { $options[$key] = $this->options[$key]; } $client = self::create('GET', $nextUrl, $options)->send(); $this->request = $client->request; $this->response = $client->response; $this->redirects['count']++; $this->redirects['urls'][] = $client->options['url']; $this->redirects['requests'][] = $client; $this->collectResponseCookies($this->redirects['cookies'], $client->getResponseArrayCookies()); } } private function collectResponseCookies(&$collection, $cookies) { if (!$cookies) { return; } foreach ($collection as $oldKey => $oldValue) { foreach ($cookies as $newKey => $newValue) { if ($oldValue['Name'] === $newValue['Name'] && $oldValue['Path'] === $newValue['Path'] && $oldValue['Domain'] === $newValue['Domain'] && $oldValue['Secure'] === $newValue['Secure'] && $oldValue['HttpOnly'] === $newValue['HttpOnly'] ) { $collection[$oldKey] = $newValue; unset($cookies[$newKey]); } } } $collection = array_merge($collection, $cookies); } public function getCurrentUrl() { return $this->getRedirectedCount() ? end($this->redirects['urls']) : $this->options['url']; } public function getAllResponseCookies() { return $this->getRedirectedCount() ? $this->getRedirectedCookies() : $this->getResponseArrayCookies(); } public function getRedirectedCount() { return $this->redirects['count']; } public function getRedirectedUrls() { return $this->redirects['urls']; } public function getRedirectedCookies() { return $this->redirects['cookies']; } public function getRedirectedRequests() { return $this->redirects['requests']; } public function getDebugInfo($key = null) { if ($key !== null) { return $this->debugInfo[$key]; } return $this->debugInfo; } public function getRequest($key = null) { if ($key !== null) { return $this->request[$key]; } return $this->request; } public function getResponse($key = null) { if ($key !== null) { return $this->response[$key]; } return $this->response; } public function __toString() { return !$this->response ? '' : $this->getResponseBody(); } public function getResponseBody() { return !$this->response ? false : $this->response['body']; } public function getResponseHeaders() { return !$this->response ? false : $this->getHeadersAsLines($this->response['header']['headers']); } public function getResponseHeader($name) { return !$this->response ? false : $this->getHeaderAsLines($this->response['header']['headers'], $name); } public function getResponseHeaderLine($line) { return !$this->response ? false : $this->getHeaderLine($this->response['header']['headers'], $line); } public function getResponseArrayCookies() { if (!$this->response) { return false; } $cookies = array(); $cookieLines = $this->getHeaderAsLines($this->response['header']['headers'], 'Set-Cookie'); foreach ($cookieLines as $cookie) { $cookies[] = $this->parseStringCookie($cookie); } return $cookies; } public function getResponseCookies() { if (!$this->response) { return false; } $cookies = ''; $cookieLines = $this->getHeaderAsLines($this->response['header']['headers'], 'Set-Cookie'); foreach ($cookieLines as $cookie) { $cookies .= $this->getCookieAsString($this->parseStringCookie($cookie), false); } return trim($cookies); } public function getResponseStatus() { return !$this->response ? false : $this->response['header']['status']; } public function getResponseReason() { return !$this->response ? false : $this->response['header']['reason']; } public function getResponseProtocolVersion() { return !$this->response ? false : $this->response['header']['protocol_version']; } protected function sendWithSocket(array $request) { static $ports = array( 'https' => 443, 'http' => 80, '' => 80); static $errorHandler = null; $uri = $request['uriInfo']; $host = ($uri['scheme'] == 'https' ? 'ssl://' : '').$uri['host']; $port = $uri['port'] ? $uri['port'] : $ports[$uri['scheme']]; $path = $uri['path'].($uri['query'] ? '?'.$uri['query'] : ''); $headers = $request['headers']; if ($this->options['proxy']) { list($host, $port) = explode(':', $this->options['proxy']); $path = $request['uri']; if ($this->options['proxy_userpwd']) { $headers[] = 'Proxy-Authorization: Basic '.base64_encode($this->options['proxy_userpwd']); } } $headers[] = 'Connection: close'; $message = sprintf("%s %s HTTP/%s\r\n", $request['method'], $path, $request['protocol_version']); $message .= sprintf("Host: %s\r\n", $uri['host']); $message .= implode("\r\n", $headers)."\r\n"; $message .= "\r\n"; $message .= $request['body']; $message .= "\r\n\r\n"; $errorHandler === null && $errorHandler = create_function('', ''); $handler = set_error_handler($errorHandler); $stream = fsockopen($host, $port, $errno, $errstr, $this->options['timeout']); $handler ? set_error_handler($handler) : restore_error_handler(); if (!$stream) { if ($errstr) { $this->debugInfo['errors'][] = sprintf('ERROR: %d - %s.', $errno, $errstr); } else { $this->debugInfo['errors'][] = sprintf('ERROR: Cannot connect to "%s:%s"', $host, $port); } return false; } fwrite($stream, $message); $headers = $body = ''; do { $headers .= fgets($stream, 128); } while (strpos($headers, "\r\n\r\n") === false); $headers = $this->parseResponseHeaders($headers); if (!$this->options['nobody']) { while (!feof($stream)) { $body .= fgets($stream); } fclose($stream); if ($this->getHeaderLine($headers['headers'], 'Transfer-Encoding') == 'chunked') { $len = strlen($body); $outData = ''; $pos = 0; while ($pos < $len) { $rawnum = substr($body, $pos, strpos(substr($body, $pos), "\r\n") + 2); $num = hexdec(trim($rawnum)); $pos += strlen($rawnum); $chunk = substr($body, $pos, $num); $outData .= $chunk; $pos += strlen($chunk); } $body = $outData; } } return array($headers, $body); } protected function sendWithCurl(array $request) { $curlOptions = array( CURLOPT_CUSTOMREQUEST => $request['method'], CURLOPT_URL => $request['uri'], CURLOPT_HEADER => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false, CURLOPT_ENCODING => 'gzip, deflate', CURLOPT_NOBODY => $this->options['nobody'], CURLOPT_TIMEOUT => $this->options['timeout'], CURLOPT_HTTPHEADER => $request['headers'], ); if ($request['protocol_version'] == '1.0') { $curlOptions[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_0; } else { $curlOptions[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1; } if ($body = $request['body']) { $curlOptions[CURLOPT_POSTFIELDS] = $body; } if ($this->options['proxy']) { $curlOptions[CURLOPT_PROXY] = $this->options['proxy']; static $proxyTypeOptions = array( 'http' => CURLPROXY_HTTP, 'sock5' => CURLPROXY_SOCKS5 ); $curlOptions[CURLOPT_PROXYTYPE] = $proxyTypeOptions[$this->options['proxy_type']]; if ($this->options['proxy_userpwd']) { $curlOptions[CURLOPT_PROXYUSERPWD] = $this->options['proxy_userpwd']; } } $curlOptions += $this->options['curl']; $ch = curl_init(); curl_setopt_array($ch, $curlOptions); $response = curl_exec($ch); if ($response === false) { $this->debugInfo['errors'][] = sprintf('ERROR: %d - %s.', curl_errno($ch), curl_error($ch)); return false; } $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE); curl_close($ch); $headers = (string) substr($response, 0, $headerSize); $body = (string) substr($response, $headerSize); $headers = $this->parseResponseHeaders($headers); return array($headers, $body); } protected function parseResponseHeaders($headers) { $lines = array_filter(explode("\r\n", $headers)); preg_match('#^HTTP/([\d\.]+)\s(\d+)\s(.*?)$#i', array_shift($lines), $match); $out = array( 'protocol_version' => $match[1], 'status' => (int) $match[2], 'reason' => $match[3], 'headers' => array(), ); $this->addHeaderToArray($out['headers'], $lines, null); return $out; } public function prepareRequest() { $clone = clone $this; $uri = $clone->parseUri($clone->options['url']); if ($clone->options['query']) { $uri['query'] = trim($uri['query'].'&'.$clone->getParamsAsString($clone->options['query']), '&'); } $request = array( 'protocol_version' => $clone->options['protocol_version'], 'method' => strtoupper($clone->options['method']), 'uri' => $clone->getUriAsString($uri), 'uriInfo' => $uri, ); $clone->options['url'] = $request['uri']; if ($clone->options['json']) { !$clone->hasHeader('Content-Type') && $clone->withHeader('Content-Type', 'application/json'); $clone->options['body'] = $clone->options['json']; } $body = $params = $boundary = ''; if ($clone->options['form_params']) { $params = $clone->getParamsAsString($clone->options['form_params']); } if ($clone->options['multipart']) { $boundary = uniqid(); !$clone->hasHeader('Content-Type') && $clone->withHeader('Content-Type', 'multipart/form-data; boundary='.$boundary); if (preg_match_all('#([^=&]+)=([^&]*)#i', $params, $matches, PREG_SET_ORDER)) { foreach ($matches as $match) { $clone->withMultipart(urldecode($match[1]), urldecode($match[2])); } } $body .= $clone->getMultipartAsString($boundary, $clone->options['multipart']); } elseif ($params) { !$clone->hasHeader('Content-Type') && $clone->withHeader('Content-Type', 'application/x-www-form-urlencoded'); $body .= $params; } if ($clone->options['body']) { $body .= $clone->getBodyAsString($clone->options['body']); } if ($body) { if ($request['method'] == 'GET' || $request['method'] == 'HEAD') { $request['method'] = 'POST'; } } $clone->options['auth'] && $clone->withHeader('Authorization', 'Basic '.base64_encode($clone->options['auth'])); $cookies = ''; if ($clone->hasHeader('Cookie')) { foreach ($clone->getHeaderAsLines($clone->builder['headers'], 'Cookie') as $value) { $clone->withStringCookies($value); } } foreach ($clone->options['cookies'] as $cookie) { if ($clone->isCookieMatchesDomain($cookie, $uri['host']) && $clone->isCookieMatchesPath($cookie, $uri['path']) ) { $cookies .= $clone->getCookieAsString($cookie, false); } } $cookies && $clone->withHeader('Cookie', trim($cookies), false); $body && $clone->withHeader('Content-Length', strlen($body), false); $clone->withHeader('User-Agent', $clone->options['user_agent'], false); !$clone->hasHeader('Expect') && $body && $clone->withHeader('Expect', ''); $headers = $clone->getHeadersAsLines($clone->builder['headers']); if ($boundary) { foreach ($headers as &$line) { $line = strtr($line, array(self::BOUNDARY_PLACEHOLDER => $boundary)); } $body = strtr($body, array(self::BOUNDARY_PLACEHOLDER => $boundary)); } $request += array( 'headers' => $headers, 'body' => $body ); return array($clone->options, $request); } public function withMethod($method) { return $this->setOptions('method', $method); } public function withUserAgent($userAgent) { return $this->setOptions('user_agent', $userAgent); } public function withAuth($auth) { if ($auth === null || preg_match('#[\w-_]+(?::[\w-_]+)?#', $auth)) { return $this->setOptions('auth', $auth); } throw new InvalidArgumentException('Auth must be one of: string with format "user:pass" or "null".'); } public function withProxy($proxy, $userPwd = null, $type = 'http') { if ($proxy === null || preg_match('#^\d+\.\d+\.\d+\.\d+:\d+$#', $proxy)) { return $this ->setOptions('proxy', $proxy) ->setOptions('proxy_userpwd', $userPwd) ->setOptions('proxy_type', $type); } throw new InvalidArgumentException('Proxy must be one of: string with format "ip:port" or "null".'); } public function withHttpProxy($proxy, $userPwd = null) { return $this->withProxy($proxy, $userPwd, 'http'); } public function withSock5Proxy($proxy, $userPwd = null) { return $this->withProxy($proxy, $userPwd, 'sock5'); } public function withBody($body) { $this->options['json'] = false; return $this->setOptions('body', $body); } public function withJson($json) { if (is_string($json)) { $json = json_decode($json, true); if ($json === null) { throw new InvalidArgumentException('Json value must be an array or json string.'); } } $this->options['body'] = $this->options['json'] = json_encode($json); return $this; } public function withNobody($nobody) { return $this->setOptions('nobody', (bool) $nobody); } public function withFollowRedirects($maxRedirect) { if ($maxRedirect === true || is_numeric($maxRedirect) && 0 <= $maxRedirect = intval($maxRedirect)) { return $this->setOptions('follow_redirects', $maxRedirect); } throw new InvalidArgumentException('Max redirect must be a digit number or "true".'); } public function withTimeout($timeout) { if (is_numeric($timeout) && 0 <= $timeout = intval($timeout)) { $this->setOptions('timeout', (int) $timeout); return $this; } throw new InvalidArgumentException('Timeout must be be a digit number.'); } public function withProtocolVersion($version) { static $validProtocolVersions = array( '1.0' => true, '1.1' => true, '2.0' => true, ); if (empty($validProtocolVersions[$version])) { throw new Exception('Protocol version given is invalid.'); } return $this->setOptions('protocol_version', $version); } public function withHeader($name, $values = null, $append = true) { $this->addHeaderToArray($this->builder['headers'], $name, $values, $append); return $this->setOptions('headers', $this->getHeadersAsLines($this->builder['headers'])); } public function withoutHeader($name) { $this->removeHeaderFromArray($this->builder['headers'], $name); return $this; } public function hasHeader($name) { return $this->headerHasKey($this->builder['headers'], $name); } public function withStringCookies($cookies, $path = '/', $secure = false, $httpOnly = false) { $append = array( 'Path' => $path, 'Secure' => $secure, 'HttpOnly' => $httpOnly ); foreach ($this->parseStringCookies($cookies) as $c) { $this->options['cookies'][$c['Name']] = $c + $append; } return $this; } public function withCookie($name, $value = null, $path = '/', $secure = false, $httpOnly = false) { $append = array( 'Path' => $path, 'Secure' => $secure, 'HttpOnly' => $httpOnly ); if (is_array($name)) { if ($this->isCookieData($name)) { $this->options['cookies'][$name] = $name + $append; } else { foreach ($name as $k => $v) { $this->withCookie($k, $v); } } } elseif (is_string($name) && $value === null) { $c = $this->parseStringCookie($name); $this->options['cookies'][$c['Name']] = $c; } elseif (is_array($value) && $this->isCookieData($value)) { $this->options['cookies'][$value['Name']] = $value + $append; } else { $this->options['cookies'][$name] = array('Name' => $name, 'Value' => $value) + $append; } return $this; } public function withoutCookie($name) { unset($this->options['cookies'][$name]); return $this; } public function withFormFile($name, $filePath, $filename = null, $headers = array()) { $headers = array('Content-Transfer-Encoding' => 'binary') + $headers; if ($type = $this->getFileType($filePath)) { $headers['Content-Type'] = $type; } return $this->withMultipart($name, fopen($filePath, 'r'), $filename ? $filename : basename($filePath), $headers); } public function withMultipart($name, $contents, $filename = null, $headers = array()) { $this->options['multipart'][$name] = array( 'name' => $name, 'contents' => $contents, 'filename' => $filename, 'headers' => $headers ); return $this; } public function withoutMultipart($name) { unset($this->options['multipart'][$name]); return $this; } public function withQuery($name, $value = null, $append = true) { $this->addParamToArray($this->builder['query'], $name, $value, $append); $options = $this->getParamsAsArray($this->builder['query']); return $this->setOptions('query', $options); } public function withoutQuery($name) { $this->removeParamFromArray($this->builder['query'], $name); $options = $this->getParamsAsArray($this->builder['query']); return $this->setOptions('query', $options); } public function withFormParam($name, $value = null, $append = true) { $this->addParamToArray($this->builder['form_params'], $name, $value, $append); $options = $this->getParamsAsArray($this->builder['form_params']); return $this->setOptions('form_params', $options); } public function withoutFormParam($name) { $this->removeParamFromArray($this->builder['form_params'], $name); $options = $this->getParamsAsArray($this->builder['form_params']); return $this->setOptions('form_params', $options); } protected function addParamToArray(&$builder, $name, $value = null, $append = true) { if ($value !== null) { if (!$append || !isset($builder[$name])) { $builder[$name] = array(); } $builder[$name] = array_merge($builder[$name], (array) $value); } else { if (is_array($name)) { foreach ($name as $key => $value) { if (!is_int($key)) { $this->addParamToArray($builder, $key, $value, $append); } else { $this->addParamToArray($builder, $value, null, $append); } } } elseif (is_string($name)) { $name = str_replace('+', '%2B', preg_replace_callback( '#&[a-z]+;#', create_function('$match', 'return rawurlencode($match[0]);'), $name)); $this->addParamToArray($builder, $this->parseStringParams($name), null, $append); } } } protected function removeParamFromArray(&$builder, $name) { unset($builder[$name]); } protected function addHeaderToArray(&$builder, $name, $values, $append = true) { if (is_array($name)) { foreach ($name as $key => $value) { if (is_int($key)) { list($key, $value) = array_map('trim', explode(':', $value, 2)); } $this->addHeaderToArray($builder, $key, $value, $append); } return; } $normalizedKey = $this->normalizeHeaderKey($name); if (!$append || !isset($builder[$normalizedKey])) { $builder[$normalizedKey] = array(); } foreach ((array) $values as $value) { if (!is_string($value) && !is_numeric($value)) { throw new InvalidArgumentException('Header value must be a string or array of string.'); } $builder[$normalizedKey][] = array( 'key' => $name, 'value' => trim($value) ); } } protected function removeHeaderFromArray(&$builder, $name) { unset($builder[$this->normalizeHeaderKey($name)]); } protected function headerHasKey($builder, $name) { return array_key_exists($this->normalizeHeaderKey($name), $builder); } protected function getHeadersAsLines(array $builder) { $out = array(); foreach ($builder as $values) { foreach ($values as $value) { $out[] = sprintf('%s: %s', $value['key'], $value['value']); } } return $out; } protected function getHeaderAsLines(array $builder, $name) { $normallizedKey = $this->normalizeHeaderKey($name); $out = array(); if (isset($builder[$normallizedKey])) { foreach ($builder[$normallizedKey] as $value) { $out[] = $value['value']; } } return $out; } protected function normalizeHeaderKey($key) { return strtr(strtolower($key), '_', '-'); } protected function getHeaderLine($builder, $name) { $normallizedKey = $this->normalizeHeaderKey($name); $out = ''; if (isset($builder[$normallizedKey])) { foreach ($builder[$normallizedKey] as $value) { $out .= ($out ? ',' : '').$value['value']; } } return $out; } protected function getParamsAsArray(array $dataBuilder) { $params = array(); foreach ($dataBuilder as $key => $param) { if (count($param) == 1) { $params[$key] = $param[0]; } else { $params[$key] = $param; } } return $params; } protected function getParamsAsString(array $params) { if (PHP_VERSION_ID >= 50400) { return http_build_query($params, null, '&', PHP_QUERY_RFC3986); } else { return preg_replace_callback('#([^=&]+)=([^&]*)#i', create_function('$match', 'return $match[1]."=".rawurlencode(urldecode($match[2]));' ), http_build_query($params)); } } protected function parseStringParams($queryString, &$array = array()) { if (empty($queryString)) { return array(); } $array = array(); foreach (explode('&', $queryString) as $query) { list($key, $value) = explode('=', $query, 2) + array('', ''); $key = urldecode($key); if (preg_match_all('#\[([^\]]+)?\]#i', $key, $matches)) { $key = str_replace($matches[0], '', $key); if (!isset($array[$key])) { $array[$key] = array(); } $children = & $array[$key]; $deth = array(); foreach ($matches[1] as $sub) { $sub = $sub !== '' ? $sub : count($children); if (!array_key_exists($sub, $children)) { $children[$sub] = array(); } $children = & $children[$sub]; } $children = urldecode($value); } else { $array[$key] = urldecode($value); } } return $array; } protected function getCookieDefaults() { static $defauls = array( 'Name' => null, 'Value' => null, 'Domain' => null, 'Path' => '/', 'Max-Age' => null, 'Expires' => null, 'Secure' => false, 'Discard' => false, 'HttpOnly' => false ); return $defauls; } public function parseStringCookies($values) { $array = array(); if (preg_match_all('#(?:^|;)\s*([^=]+)=([^;]+)\s*?#', $values, $matches, PREG_SET_ORDER)) { foreach ($matches as $match) { list(, $name, $value) = $match; if ( !strcasecmp($name, 'Expires') && strtotime($value) || !strcasecmp($name, 'Path') && urldecode($value) == $value || preg_match('#Domain|Max-Age|Secure|Discard|HttpOnly#i', $value) ) { continue; } $array[] = array('Name' => $name, 'Value' => $value) + $this->getCookieDefaults(); } } return $array; } protected function parseStringCookie($value) { $data = $this->getCookieDefaults(); if (is_string($value) && preg_match_all('#([^=;\s]+)(?:=([^;]+))?;?\s*?#', $value, $matches)) { $data['Name'] = array_shift($matches[1]); $data['Value'] = array_shift($matches[2]); if ($matches[1] && $matches[2]) { foreach ($this->getCookieDefaults() as $key => $value) { foreach ($matches[1] as $index => $val) { if (!strcasecmp($key, $val)) { if (in_array($key, array('Secure', 'Discard', 'HttpOnly'))) { $data[$key] = true; } else { $data[$key] = $matches[2][$index]; } } } } } } return $data; } protected function isCookieData(array $data) { return !empty($data['Name']) && isset($data['Value']); } protected function isCookieMatchesPath(array $cookie, $path) { return empty($cookie['Path']) || strpos($path, $cookie['Path']) === 0; } protected function isCookieMatchesDomain(array $cookie, $domain) { $cookieDomain = isset($cookie['Domain']) ? ltrim($cookie['Domain'], '.') : null; if (!$cookieDomain || !strcasecmp($domain, $cookieDomain)) { return true; } if (filter_var($domain, FILTER_VALIDATE_IP)) { return false; } return (bool) preg_match('/\.'.preg_quote($cookieDomain).'$/i', $domain); } protected function getCookieAsString(array $cookie, $fully = false) { $str = $cookie['Name'].'='.$cookie['Value'].'; '; if (!$fully) { return $str; } $cookie += $this->getCookieDefaults(); foreach ($cookie as $key => $value) { if ($key != 'Name' && $key != 'Value' && $value !== null && $value !== false) { if ($key == 'Expires') { $str .= 'Expires='.gmdate('D, d M Y H:i:s \G\M\T', $value).'; '; } else { $str .= ($value === true ? $key : "{$key}={$value}").'; '; } } } return rtrim($str, '; '); } protected function getMultipartHeaders($boundary, array $headers) { $header = ''; foreach ($headers as $name => $value) { $header .= sprintf("%s: %s\r\n", $name, $value); } return "--{$boundary}\r\n".$header."\r\n"; } protected function getMultipartAsString($boundary, $parts) { $out = ''; foreach ($parts as $field) { $field += array('filename' => null, 'headers' => array()); $headers = $field['headers']; $headers['Content-Disposition'] = 'form-data; name="'.$field['name'].'"' .($field['filename'] ? '; filename="'.$field['filename'].'"' : ''); $out .= $this->getMultipartHeaders($boundary, $headers); $out .= $this->getBodyAsString($field['contents']); $out .= "\r\n"; } $out .= "--{$boundary}--\r\n"; return $out; } protected function getBodyAsString($body, $close = true) { $out = ''; if (is_resource($body)) { $out = stream_get_contents($body); $close && fclose($body); } else { $out = $body; } return $out; } protected function getFileType($filePath) { $filename = realpath($filePath); $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); if (preg_match('/^(?:jpe?g|png|[gt]if|bmp|swf)$/', $extension)) { $file = getimagesize($filename); if (isset($file['mime'])) { return $file['mime']; } } if (class_exists('finfo', false)) { if ($info = new finfo(defined('FILEINFO_MIME_TYPE') ? FILEINFO_MIME_TYPE : FILEINFO_MIME)) { return $info->file($filename); } } if (ini_get('mime_magic.magicfile') && function_exists('mime_content_type')) { return mime_content_type($filename); } } protected function getAbsoluteUrl($relative, $base) { $base = preg_replace('#(\?|\#).*?$#', '', $base); if (parse_url($relative, PHP_URL_SCHEME) != '') { return $relative; } if ($relative[0] == '#' || $relative[0] == '?') { return $base.$relative; } extract(parse_url($base)); $path = preg_replace('#/[^/]*$#', '', $path); $relative[0] == '/' && $path = ''; $absolute = $host.$path.'/'.$relative; $patterns = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#'); for ($count = 1; $count > 0; $absolute = preg_replace($patterns, '/', $absolute, -1, $count)); return $scheme.'://'.$absolute; } protected function parseUri($uri) { $parts = parse_url($uri); $scheme = isset($parts['scheme']) ? $parts['scheme'] : ''; $user = isset($parts['user']) ? $parts['user'] : ''; $pass = isset($parts['pass']) ? $parts['pass'] : ''; $host = isset($parts['host']) ? $parts['host'] : ''; $port = isset($parts['port']) ? $parts['port'] : null; $path = isset($parts['path']) ? $parts['path'] : '/'; $query = isset($parts['query']) ? $parts['query'] : ''; $fragment = isset($parts['fragment']) ? $parts['fragment'] : ''; return compact('scheme', 'user', 'pass', 'host', 'port', 'path', 'query', 'fragment'); } protected function getUriAsString(array $uri) { extract($uri); $userInfo = $user.($pass ? ':'.$pass : ''); $authority = ($userInfo ? $userInfo.'@' : '').$host.($port !== null ? ':'.$port : ''); if ($authority && substr($path, 0, 1) === '/') { $path = '/'.ltrim($path, '/'); } if (!$authority && substr($path, 0, 2) === '//') { $path = '/'.ltrim($path, '/'); } return ($scheme ? $scheme.':' : '') .($authority ? '//'.$authority : '') .$path .($query ? '?'.$query : '') .($fragment ? '#'.$fragment : ''); } protected function getHandler() { static $available; if ($available === null) { $available = array( 'socket' => function_exists('fsockopen') && function_exists('ini_get') && ini_get('allow_url_fopen'), 'curl' => function_exists('curl_init'), ); } if ($this->options['handler'] !== null) { if (empty($available[$this->options['handler']])) { throw new Exception(sprintf('Handler "%s" is not available.')); } return $this->options['handler']; } if ($available['curl']) { return 'curl'; } if ($available['socket'] && $this->options['proxy_type'] != 'sock5') { return 'socket'; } throw new Exception('Have no available handler based on your request options/ PHP config.'); } }
?>
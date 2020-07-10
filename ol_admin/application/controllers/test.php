<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {
	function index(){
		// file_put_contents('test.txt', date('Y-m-d H:i:s'));

		echo date_default_timezone_get();
		

		// file_put_contents("myText.txt", $content."\n", FILE_APPEND);
	}

	function test_cron(){
		$cron = file_get_contents('cron.txt');
		file_put_contents('cron.txt', $cron."\n\n".date('Y-m-d H:i:s'));
	}
}
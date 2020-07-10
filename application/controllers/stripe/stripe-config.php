<?php 
//====================================================
//    This File Contains Configuration of stripe 
//====================================================
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_live_QtiNjuGYnnV5WaUoHkJDlMzb000QW6Ogzh",
  "publishable_key" => "pk_live_XSAogm2PZC5ds4ybggnnzvcp00WUpgl0zm",
  
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>
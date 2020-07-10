<?php
require_once('stripe-config.php');
require_once ("vendor/autoload.php");
  \Stripe\Stripe::setApiKey($stripe['secret_key']);
if(isset($_POST['stripeToken'])){
  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
    $amount=6500;
  $plan = \Stripe\Plan::create(array(
      "product" => [
          "name" => "Social Media Marketing"
            ],
      "nickname" => "Social Media Marketing Ads",
      "interval" => "month",
      "interval_count" => "1",
      "currency" => "usd",
      "amount" => $amount,
  ));

  $customer = \Stripe\Customer::create([
      'email' => $email,
      'source'  => $token,
  ]);

   $subscription = \Stripe\Subscription::create(array(
      "customer" => $customer->id,
      "items" => array(
          array(
              "plan" => $plan->id,
          ),
      ),
  ));
   if($subscription->status=="active"){
       header("location: thank-you.php");
   }else{
        echo "Payment Failed";
   }
}
?>
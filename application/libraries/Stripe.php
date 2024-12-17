<?php

// namespace application/libraries;
if(!defined('BASEPATH'))  exit('no direct script access allowed');
include("./vendor/stripe/stripe-php/init.php");

class Stripe
{
    public $ci;
    public function __construct(){

        $this->ci = &get_instance();
        $this->ci->config->load('stripe');

        \Stripe\Stripe::setApiKey($this->ci->config->item('stripe_api_key'));


        
    }
    public function checkout($data){
        $message="test messgae";
        try{
        //     $mycard = array('number' => $data['number'],
        //     'exp_month' => $data['exp_month'],
        //     'exp_year' => $data['exp_year'],
        //     'cvc'=> $data['cvc']
        // );
            // $token = \Stripe\Token::create(array(
            //     'card'=>$mycard
            // ));
            $charge = \Stripe\Charge::create([
                'amount' => $data['amount'] , // Convert amount to cents
                'currency' => 'usd',
                'source' => $data['token'], // Use the token's ID here
                'description' => 'Test Charge'
            ]);
            $message = $charge->status;
        }catch(Exeception $e){
            $message = $e->getMessage();
        }
        return $message;
    }

}
<?php

// namespace application\controllers; 
// use Application/libraries/Stripegateway;
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//  include("./vendor/stripe/stripe-php/init.php");

class StripeCheckout extends CI_Controller{
    // public $data = array(
    //     'msg'=>'test msg'
    // );

    public $ci;
    public function __construct(){
        parent::__construct();
        $this->load->library('Stripe');
        

    }
    public function index(){
        $data['msg'] = '';
        $this->load->view('StripePayment',$data);
    }
    
    public function Checkout(){
    

            $data = array(
                // 'number'=>$this->input->post('number'),
                // 'exp_month'=>$this->input->post('month'),
                // 'exp_year'=>$this->input->post('year'),
                'amount'=>100,
                'token'=>$this->input->post('stripeToken')
            );
            $data['msg'] = $this->stripe->checkout($data);

            if(!empty($data)){

                $this->load->view('StripePayment',$data);
            }else{
                print 'empty';
            }
            // print_r($data);
            // exit;
            
    }

}
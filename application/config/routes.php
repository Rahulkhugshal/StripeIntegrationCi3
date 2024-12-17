<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'StripeCheckout';
$route['default_method']='index';
$route['Checkout']="StripeCheckout/Checkout";
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

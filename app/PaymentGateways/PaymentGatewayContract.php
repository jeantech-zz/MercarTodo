<?php

namespace App\PaymentGateways;

interface PaymentGatewayContract
{
    public function createSession();
    
    public function getSession();

}
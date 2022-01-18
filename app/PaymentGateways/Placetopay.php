<?php

namespace App\PaymentGateways;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Placetopay implements PaymentGatewayContract
{
    /**
     * @string
     */

    private $returnUrl;
    private $ipAddress;
    private $userAgent;
    private $url;
    private $currency;
    private $description;
    private $loginPlacetoPay;
    private $descriptionPlacetoPay;

    public function __construct()
    {
        $this->returnUrl = config('app.urlReturntPlacetoPay');
        $this->ipAddress = config('app.ipAddressPlacetoPay');
        $this->userAgent = config('app.userAgentPlacetoPay');
        $this->url = config('app.urlPlacetoPay');
        $this->currency = config('app.currency');
        $this->loginPlacetoPay = config('app.loginPlacetoPay');
        $this->descriptionPlacetoPay = config('app.descriptionPlacetoPay');
    }

    public function createSession ()
    {
        $request = $this->makeRequest();

        $response = Http::post($this->url, $request);

        dd($request, $response->body());
    }

    public function getSession()
    {
        
    }

    private function makeRequest(): array
    {
        $auth = $this->makeAuth();
        $payment = $this->makePayment();
        $extraAttributes = $this->extraAttributes();

        return [
            "auth" => $auth,
            "payment" =>  $payment,
        ] +  $extraAttributes;
    }
    
    private function makeAuth(): array
    {
        $nonce = Str::random();
        $seed = Carbon::now(new DateTimeZone('America/Bogota'))->toIso8601String();

        $trankey = base64_encode(sha1($nonce . $seed . '024h1IlD', true));

        return [
            'login' => $this->loginPlacetoPay,
            'tranKey' => $trankey,
            'nonce' => base64_encode($nonce),
            'seed' => $seed,
        ];
    }

    private function makePayment(): array
    {

        return [
                'reference' =>  '5976030f5575d',
                'description' =>  $this->descriptionPlacetoPay,
                'amount' =>   [ 
                    'currency' => $this->currency,
                    'total' =>  50000
                ],
                'allowPartial' => false
            ];
    }

    private function extraAttributes(): array
    {
        //array $data
        $urlReturn = $this->returnUrl . '/'.$data['id'];
        return [
            'expiration' => Carbon::now(new DateTimeZone('America/Bogota'))->addHour()->toIso8601String(),  
            'returnUrl' => $this->returnUrl,
            'ipAddress' =>  $this->ipAddress,
            'userAgent' => $this->userAgent
        ];
    }
}
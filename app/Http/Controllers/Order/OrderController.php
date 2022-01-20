<?php

namespace App\Http\Controllers\Order;

use App\Actions\Order\UpdateOrderActions;
use App\Actions\Request\StoreRequestActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexRequest;
use App\Models\Order;
use App\ViewModels\Orders\OrderIndexViewModel;
use App\ViewModels\Orders\OrderShowPayViewModel;
use App\Actions\Order\DeleteOrderActions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\Order\UpdateRequest;
use App\PaymentGateways\PaymentGatewayContract;


class OrderController extends Controller
{
     /**
     * @string
     */

    private $returnUrl;
    private $description;
    private $url;
    private $statusOrderPayRejected;
    private $statusOrderPaySuccess;
    private $statusOrderInprocessPay;

    public function __construct()
    {
        $this->returnUrl = config('app.urlReturntPlacetoPay');
        $this->descriptionPlacetoPay = config('app.descriptionPlacetoPay');
        $this->url = config('app.url');
        $this->statusOrderPayRejected = config('app.statusOrderPayRejected');
        $this->statusOrderInprocessPay = config('app.statusOrderInprocessPay');
    }
      /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(IndexRequest $request, OrderIndexViewModel $viewModel): View
    {
        $orders = Order::filter($request->input('filters', []))->paginate();
        $viewModel->collection($orders);

        return view('orders.index', $viewModel->toArray());
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order = DeleteOrderActions::execute($order);
   
        return redirect()->route('orders.index')->with('success', 'Order Delete successfully.');
    
    }

    public function storePay(PaymentGatewayContract $paymentGeteway)
    {
        $response = $paymentGeteway->createSession();
        // response()->json($paymentGeteway->createSession());
      $processUrl=  $response['processUrl'];
      //  dd($response, $processUrl);
        return redirect()->away($processUrl);
    }

    public function orderPay(Order $order, UpdateRequest $request, PaymentGatewayContract $paymentGeteway)
    {        
        $arrayPay = $this->makePay( $request->validated());
        $response = $paymentGeteway->createSession($arrayPay);

        $status = $this->statusOrderInprocessPay;
        $dataOrder = $request->validated();
        $dataOrder['status'] = $status;
        $result = $this->updateOrder($order, $dataOrder);
        
        $dataRequest = [
            "order" => $request->validated(),
            "responsePay" =>$response
        ];
        $this->createRequestOrderPay($dataRequest);
 
        if ($response['status']['status'] == 'OK'){
            return redirect()->away($response['processUrl']);
           
            $orderUpdate = UpdateOrderActions::execute($order, $request->validated());
        }else{
            $message = $response['status']['message'];
            return redirect()->route('orders.showPay', $order)->with('success', 'Order Delete successfully.');
        }

    }

    public function showPay(Order $order,  OrderShowPayViewModel $viewModel)
    {
        //dd( $order);
        return view('layouts.edit', $viewModel->model($order));
        //return view('layouts.create', $viewModel);
    }

    private function makePay (array $data): array
    {
        return  [
            'reference' => $data['id'],
            'total' => $data['total'],
            'returnUrl' =>  $this->url.$this->returnUrl.'/'.$data['id'], 
            'description' => $this->descriptionPlacetoPay .' '.$data['id'], 
            'currency' => $data['currency'] 
        ];
    }

    private function updateOrder (Order $order, array $data): bool
    {
        $orderUpdate = UpdateOrderActions::execute($order, $data);
        return $orderUpdate;
    }
    
    private function createRequestOrderPay (array $data)                        
    {
      
        $processUrl = null;
       if(isset($data['responsePay']['processUrl'])) {
           $processUrl = $data['responsePay']['processUrl'];
       }

        $dataRequest = [
            'order_id' =>  $data['order']['id'],
            'reference' =>  $data['order']['id'],
            'description' => $this->url.$this->returnUrl.'/'.$data['order']['id'],
            'returnUrl' => $this->descriptionPlacetoPay .' '.$data['order']['id'],
            'response' =>  json_encode($data['responsePay']) ,
            'processUrl' => $processUrl,
        ];
        $createRequest = StoreRequestActions::execute($dataRequest);

        return $createRequest;
    }
    

}

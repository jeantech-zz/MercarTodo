<?php

namespace App\Http\Controllers\Order;

use App\Actions\Order\DeleteOrderActions;
use App\Actions\Request\StoreRequestActions;
use App\Actions\Order\UpdateOrderActions;
use App\Http\Requests\Order\UpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexRequest;
use App\Models\Order;
use App\PaymentGateways\PaymentGatewayContract;
use App\Repositories\Orders\ColeccionsOrdersRepositories;
use App\ViewModels\Orders\OrderIndexViewModel;
use App\ViewModels\Orders\OrderShowPayViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;



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
    private ColeccionsOrdersRepositories $coleccionOrders;

    public function __construct()
    {
        $this->returnUrl = config('app.urlReturntPlacetoPay');
        $this->descriptionPlacetoPay = config('app.descriptionPlacetoPay');
        $this->url = config('app.url');
        $this->statusOrderPayRejected = config('app.statusOrderPayRejected');
        $this->statusOrderInprocessPay = config('app.statusOrderInprocessPay');

        $this->coleccionOrders = new ColeccionsOrdersRepositories;
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


    public function orderPay(Order $order, UpdateRequest $request, PaymentGatewayContract $paymentGeteway): RedirectResponse
    {        
        $orderRequest =$this->coleccionOrders->requestOrder($order->id);

        if($orderRequest==null || $orderRequest->requestId==null   ){
            return $this->proccessPay($order, $request, $paymentGeteway);
        }
    }

    public function proccessPay(Order $order, UpdateRequest $request, PaymentGatewayContract $paymentGeteway): RedirectResponse
    {
        $arrayPay = $this->makePay($request->validated());
        $response = $paymentGeteway->createSession($arrayPay);
        
        $dataRequest = [
            "order" => $request->validated(),
            "responsePay" =>$response
        ];
        $this->createRequestOrderPay($dataRequest);
 
        if ($response['status']['status'] == 'OK'){

            $status = $this->statusOrderInprocessPay;
            $dataOrder = $request->validated();
            $dataOrder['status'] = $status;
            $result = $this->updateOrder($order, $dataOrder);

            return redirect()->away($response['processUrl']);
                       
        }else{
            $status = $this->statusOrderPayRejected;
    
            $dataOrder = $request->validated();
            $dataOrder['status'] = $status;
            $result = $this->updateOrder($order, $dataOrder);
            
            $message = $response['status']['message'];
            return redirect()->route('orders.showPay', $order)->with('success', 'Order Reject successfully.');
        }
    }

    public function showPay(Order $order,  OrderShowPayViewModel $viewModel): View
    {
        return view('layouts.showClient', $viewModel->model($order));
    }

    private function makePay (array $data): array
    {
        return  [
            'reference' => $data['id'],
            'total' => $data['total'],
            'returnUrl' => $this->returnUrl.'/'.$data['id'], 
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
        $requestId = null;
       if(isset($data['responsePay']['processUrl'])) {
           $processUrl = $data['responsePay']['processUrl'];
           $requestId = $data['responsePay']['requestId'];
       }

        $dataRequest = [
            'order_id' =>  $data['order']['id'],
            'reference' =>  $data['order']['id'],
            'description' => $this->returnUrl.'/'.$data['order']['id'],
            'returnUrl' => $this->descriptionPlacetoPay .' '.$data['order']['id'],
            'response' =>  json_encode($data['responsePay']) ,
            'processUrl' => $processUrl,
            'requestId' => $requestId,
        ];
        $createRequest = StoreRequestActions::execute($dataRequest);

        return $createRequest;
    }
    

}

<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\IndexRequest;
use App\Models\Order;
use App\ViewModels\Orders\OrderIndexViewModel;
use App\Actions\Order\DeleteOrderActions;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
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
}

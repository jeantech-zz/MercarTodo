<?php

namespace App\Http\Controllers\OrderProduct;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderProduct\IndexRequest;
use App\Models\OrderProduct;
use App\ViewModels\OrderProducts\OrderIndexViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class OrderProductController extends Controller
{
          /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(IndexRequest $request, OrderIndexViewModel $viewModel): View
    {
        $orderProducts = OrderProduct::filter($request->input('filters', []))->paginate();
        $viewModel->collection($orderProducts);

        return view('OrderProducts.index', $viewModel->toArray());
    }

    public function destroy(OrderProduct $orderProduct): RedirectResponse
    {
       // dd($orderProduct);
        $orderProduct->delete();
        return redirect()->route('orderProducts.index')->with('success', 'Product Orders Delete successfully.');
    
    }
}

<?php

namespace App\Http\Controllers\OrderProduct;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderProduct\IndexRequest;
use App\Models\OrderProduct;
use App\ViewModels\OrderProducts\OrderIndexViewModel;
use Illuminate\Http\Request;
use Illuminate\View\View;


class OrderProductController extends Controller
{
          /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(IndexRequest $request, OrderIndexViewModel $viewModel): View
    {
        $orders = OrderProduct::filter($request->input('filters', []))->paginate();
        $viewModel->collection($orders);

        return view('OrderProducts.index', $viewModel->toArray());
    }
}

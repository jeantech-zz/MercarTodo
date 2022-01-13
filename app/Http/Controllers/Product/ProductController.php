<?php

namespace App\Http\Controllers\Product;

use App\Actions\Product\CreateActions;
use App\Actions\Product\UpdateActions;
use App\Actions\Product\DeleteActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\IndexRequest;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use App\ViewModels\Products\ProductCreateViewModel;
use App\ViewModels\Products\ProductEditViewModel;
use App\ViewModels\Products\ProductIndexViewModel;
use App\ViewModels\Products\ProductIndexClientViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private GameRepositories $gameRepositories;
     /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(IndexRequest $request, ProductIndexViewModel $viewModel): View
    {
        $products = Product::filter($request->input('filters', []))->paginate();
        $viewModel->collection($products);

        return view('products.index', $viewModel->toArray());
    }

     /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function indexClient (IndexRequest $request, ProductIndexClientViewModel $viewModel): View
    {
        $products = Product::filter($request->input('filters', []))->paginate();
        $viewModel->collection($products);

        return view('products.indexClient', $viewModel->toArray());
    }


    public function create(ProductCreateViewModel $viewModel): View
    {
        return view('layouts.create', $viewModel);
    }


    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(CreateRequest $request): RedirectResponse
    {
  
        $urlProduct = config('app.urlProduct');

        if(is_object($request->file('image'))) {
            $imagen = $request->file('image')->store($urlProduct);
            $url = Storage::url($imagen);
        }else{
            $url = $request->image;
        }

        $product = CreateActions::execute($request->validated(),  $url );

      return redirect()->route('products.index')->with('success', 'Product created successfully.');
        
    }

    public function edit(Product $product, ProductEditViewModel $viewModel): View
    {
        return view('layouts.edit', $viewModel->model($product));
    }

    public function update (UpdateRequest $request): RedirectResponse
    {
        //dd($request);
        $urlProduct = config('app.urlProduct');

        if(is_object($request->file('image'))) {
            $imagen = $request->file('image')->store($urlProduct);
            $url = Storage::url($imagen);
        }else{
            $url = $request->image;
        }


        $product = UpdateActions::execute($request->validated(),  $url );
        return redirect()->route('products.index')->with('success', 'Product Update successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $product = DeleteActions::execute($id);
        return redirect()->route('products.index')->with('success', 'Product Delete successfully.');
    
    }
}

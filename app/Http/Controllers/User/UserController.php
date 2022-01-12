<?php

namespace App\Http\Controllers\User;

use App\Actions\User\CreateActions;
use App\Actions\User\UpdateActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\IndexRequest;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use App\ViewModels\Users\UserIndexViewModel;
use App\ViewModels\Users\UserCreateViewModel;
use App\ViewModels\Users\UserEditViewModel;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class UserController extends Controller
{
    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(IndexRequest $request, UserIndexViewModel $viewModel): View
    {
        $users = User::filter($request->input('filters', []))->paginate();
        $viewModel->collection($users);

        return view('users.index', $viewModel->toArray());
    }

    public function create(UserCreateViewModel $viewModel): View
    {
        return view('layouts.create', $viewModel);
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(CreateRequest $request): RedirectResponse
    {
       // dd($request);
        $user = CreateActions::execute($request->validated());
        event(new Registered($user));

      return redirect()->route('users.index')->with('success', 'User created successfully.');
        
    }

    public function edit(User $user, UserEditViewModel $viewModel): View
    {
        return view('layouts.edit', $viewModel->model($user));
    }

    public function update(UpdateRequest $request): RedirectResponse
    {
        $user = UpdateActions::execute($request->validated());
        return redirect()->route('users.index')->with('success', 'User Update successfully.');
    }

    public function disable(int $id): RedirectResponse
    {
        $user = DisableActions::execute($id);

        return redirect()->route('user.index')->with('success', 'User disable successfully.');
    }


}

@extends('layouts.app')
@extends('layouts.client')
@section('content')

<table class="table is-narrow is-hoverable is-fullwidth">
    <caption class="is-hidden">{{ $texts['title'] }}</caption>
    <thead>
        <tr>
            @foreach($headers as $header)
                <th scope="col">{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tfoot>
    <tr>
        @foreach($headers as $header)
            <th scope="col">{{ $header }}</th>
        @endforeach
    </tr>
    </tfoot>
    <tbody>
    @foreach($products as $product)
        <tr>
            <td>{{ $product->code }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td><img src="{{ $product->image }}" width="60" height="60" /></td>
            <td> 
                <botton-component>
                    @csrf
                    <button v-on:click="$emit('botton-item', { route: '{{ route('products.addProductOrder', $product) }}' })" class="button is-primary is-fullwidth">  
                        @lang('products.buttons.agregar') </button>  
                </component-component> 
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $products->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection

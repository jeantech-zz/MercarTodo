@extends('layouts.app')
@extends('layouts.admin')
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

            <td class="has-text-centered">
               <a href="{{ route('products.edit', ['product' => $product]) }}">
                        <b-icon size="is-small" type="is-info" icon="pencil"/>
                </a>
                <botton-component>
                    @csrf
                    @method('DELETE')
                    <button v-on:click="$emit('botton-item', { route: '{{ route('products.destroy', $product ) }}' })" class="button is-danger"> @lang('products.buttons.delete') </button>  
                </botton-component> 
               
                <botton-component>
                    @csrf
                    @method('PUT')
                    <button v-on:click="$emit('botton-item', { route: '{{ route('products.disable', $product ) }}' })" class="button is-success"> @lang('products.buttons.disable') </button>  
                </botton-component> 

               
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $products->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection

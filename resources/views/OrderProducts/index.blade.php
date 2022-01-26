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
    @foreach($orderProducts as $orderProduct)
        <tr>
            <td><img src="{{ $orderProduct->products_image  }}" width="60" height="60" /></td>
            <td>{{ $orderProduct->products_name }}</td>
            <td>{{ $orderProduct->quantity }}</td>
            <td>{{ $orderProduct->amount }}</td>
            <td>{{ $orderProduct->order_id }}</td>              
            <td>
                <botton-component>
                    @csrf
                    <button v-on:click="$emit('botton-item', { route: '{{ route('orderProducts.addProductOrder', $orderProduct) }}' })" class="button is-primary is-fullwidth">  
                        @lang('orderProducts.buttons.agregar') </button>  
                </component-component>  
            </td>
            <td>
                <botton-component>
                    @csrf
                    @method('DELETE')
                    <button v-on:click="$emit('botton-item', { route: '{{ route('orderProducts.destroy', $orderProduct ) }}' })" class="button is-danger"> @lang('orderProducts.buttons.delete') </button>  
                </botton-component>   
            </td>
              
        </tr>
    @endforeach
    </tbody>
</table>

{{ $orderProducts->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection

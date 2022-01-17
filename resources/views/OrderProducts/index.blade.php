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
            <td>{{ $orderProduct->product_id }}</td>
            <td>{{ $orderProduct->quantity }}</td>
            <td>{{ $orderProduct->amount }}</td>
            <td>{{ $orderProduct->order_id }}</td>
            <td class="has-text-centered">
               <a href="">
                        <b-icon size="is-small" type="is-info" icon="pencil"/>
                </a>    
                <form action="{{ route('orderProducts.addProductOrder', $orderProduct) }}" method="post">
                    @csrf
                    <button class="button is-primary is-fullwidth" type="submit" ><em class="fas fa-save mr-2"></em>
                            @lang('orderProducts.buttons.agregar')
                    </button>
                </from>
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

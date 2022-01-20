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
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->user_id }}</td>
            <td>{{ $order->customer_name }}</td>
            <td>{{ $order->customer_email }}</td>
            <td>{{ $order->customer_mobile }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->currency }}</td>
            <td>{{ $order->status }}</td>
            <td class="has-text-centered">
               <a href="{{ route('orderProducts.index') }}">
                        <b-icon size="is-small" type="is-info" icon="pencil"/>
                </a>
                <botton-component>
                    @csrf
                    @method('DELETE')
                    <button v-on:click="$emit('botton-item', { route: '{{ route('orders.destroy', $order ) }}' })" class="button is-danger"> @lang('orders.buttons.delete') </button>  
                </botton-component> 
                <form action="{{ route('orders.showPay', $order) }}" method="post">
                    @csrf
                    @method('GET')
                    <button class="button is-primary is-fullwidth" type="submit" ><em class="fas fa-save mr-2"></em>
                            @lang('orders.buttons.pay')
                    </button>
                </from>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $orders->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection

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
    @foreach($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone_number }}</td>
            <td>{{ $user->address }}</td>
            <td class="has-text-centered">
                <a href="{{ route('users.edit', ['user' => $user]) }}">
                        <b-icon size="is-small" type="is-info" icon="pencil"/>
                    </a>

                <botton-component>
                    @csrf
                    @method('PUT')
                    <button v-on:click="$emit('botton-item', { route: '{{ route('users.disable', $user ) }}' })" class="button is-success"> @lang('users.buttons.disable') </button>  
                </botton-component> 

                     
                </from>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->appends(request()->only('filters'))->render('partials.pagination.paginator') }}
@endsection

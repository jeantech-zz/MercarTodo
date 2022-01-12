@php /** @var \App\Inputs\Input[] $fields */ @endphp
@extends('layouts.app')
@extends('layouts.admin')
@section('content')
    <template>
        <section>
            <form id="submit" method="POST" action="{{ $action }}"  enctype="multipart/form-data">
                @csrf
                @foreach($fields as $field)
                    {{ $field->render($model) }}
                @endforeach
            </form>
        </section>
    </template>
@endsection

@extends('beautymail::templates.sunny')

@section('content')

    @include ('beautymail::templates.sunny.heading' , [
        'heading' => $subject,
        'level' => 'h1',
    ])

    @include('beautymail::templates.sunny.contentStart')

    <h3><strong>{{ \App\Http\Controllers\SystemController::pass_greetings_to_user() }} {{ $name }}!</strong></h3>
    <br>
    <p>{!! $body !!}</p>

    @include('beautymail::templates.sunny.contentEnd')

    @if($show_btn)
        @include('beautymail::templates.sunny.button', [
                'title' => $btn_name,
                'link' => $url
        ])
    @endif

@stop

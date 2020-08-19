@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <chat-component chat="{{ $chat->id }}" user="{{ Auth::user()->id }}"></chat-component>
            </div>
        </div>
    </div>
@endsection

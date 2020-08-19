@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="list-group">
                    @forelse($notifications as $notification)
                        <div class="list-group-item text-center">
                            <a href="{{ $notification->data['link'] }}">{{ $notification->data['message'] }}</a>
                        </div>
                    @empty
                        <div class="list-group-item list-group-item-action">
                            <h4 class="text-center">@lang('strings.no_data')</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

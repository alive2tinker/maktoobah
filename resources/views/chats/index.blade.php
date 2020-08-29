@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="list-group">
                    @forelse($chats as $chat)
                        <a href="{{ route('chats.show', $chat->id) }}" class="list-group-item list-group-item-action border-0 shadow">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $chat->otherEnd()->name }}</h5>
                                <small class="text-muted">{{ $chat->messages->last() != null ? $chat->messages->last()->created_at->diffForHumans() : '' }}</small>
                            </div>
                            <p class="mb-1">{{ $chat->messages->last() != null ? $chat->messages->last()->text : ""}}</p>
                        </a>
                    @empty
                        <div class="list-group item">
                            <h4 class="text-center">@lang('strings.no_data')</h4>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection

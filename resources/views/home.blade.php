@extends('layouts.app')
@section('title', trans('strings.home'))
@section('content')
<div class="container">
    <div class="row">
        <div class="d-none d-lg-block col-md-2"></div>
        <div class="col-md-8">
            <form action="{{ route('search') }}" method="get">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="@lang('strings.search_keywords')" name="keywords" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">@lang('strings.search')</button>
                    </div>
                </div>
            </form>
            <div class="list-group">
                @forelse($users as $user)
                    <div class="list-group-item list-group-item-action border-0 shadow">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></h5>
                            <small>{{ $user->updated_at->diffForHumans() }}</small>
                        </div>
                        <p class="mb-1">{{ Str::limit($user->details, $limit=150, $end="...")}}</p>
                        <small>
                            <ul class="list-unstyled d-flex">
                                <li><favorite-button user="{{ $user->id }}"></favorite-button></li>
                                <li>
                                    <button class="btn btn-link"
                                            data-toggle="modal"
                                            data-target="#new-chat-with-{{$user->id}}">@lang('strings.send_a_message')</button>
                                </li>
                            </ul>
                        </small>
                    </div>
                    <div class="modal" tabindex="-1" role="dialog" id="new-chat-with-{{ $user->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">@lang('strings.new_chat')</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('chats.store', $user->id) }}" method="post" id="message-form-{{$user->id}}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="message-text">@lang('strings.message_text')</label>
                                            <textarea name="message_text" id="" cols="30" rows="10" class="form-control"></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('strings.close')</button>
                                    <button type="button" data-id="{{ $user->id }}" class="btn btn-primary message-form-submit">@lang('strings.send')</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="list-group-item list-group-item-action">
                        <h4 class="text-center">@lang('strings.no_data')</h4>
                    </div>
                @endforelse
            </div>
            <div class="d-flex justify-content-center my-4">
                {{ $users->links() }}
            </div>
        </div>
        <div class="d-none d-lg-block col-md-2"></div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#countries-list").change(function(e){
                var countryID = e.target.value;
                $.get('/api/cities?country='+countryID, function(data){
                    $("#cities-list").empty();
                    $("#cities-list").append('<option value="">@lang('strings.choose')</option>');
                    $.each(data, function(index, cityObj){
                        $("#cities-list").append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
                    });
                })
            });
            $(".message-form-submit").click(function(){
                var formID = "#message-form-"+$(this).attr('data-id')
                $(formID).submit();
            })

        });
    </script>
@endsection

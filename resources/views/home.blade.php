@extends('layouts.app')
@section('title', trans('strings.home'))
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 d-none d-lg-block">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">@lang('strings.search')</h3>
                    <form action="{{ route('search') }}" method="get">
                        @csrf
                        <div class="form-group">
                            <label for="countries-list">@lang('strings.country')</label>
                            <select id="countries-list" class="form-control">
                                <option value="">@lang('strings.choose')</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{  $country->name() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cities-list">@lang('strings.city')</label>
                            <select name="city_id" id="cities-list" class="form-control">
                                <option value="">@lang('strings.select_countries_first')</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="formControlRange">@lang('strings.age')</label>
                            </div>
                            <div class="col-md-6">
                                <label for="age-from">@lang('strings.from')</label>
                                <input type="number" name="age_from" class="form-control" value="{{ old('age_from') }}" id="age-from">
                            </div>
                            <div class="col-md-6">
                                <label for="age-to">@lang('strings.to')</label>
                                <input type="number" name="age_to" class="form-control" value="{{ old('age_to') }}" id="age-to">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tribal-status">@lang('strings.tribal')?</label>
                            <select name="tribal" id="tribal-status" class="form-control">
                                <option value="">@lang('strings.choose')</option>
                                <option value="0">@lang('strings.not_tribal')</option>
                                <option value="1">@lang('strings.tribal')</option>
                            </select>
                        </div>
                        <div class="form-row justify-content-center">
                            <div class="col-md-5"><button type="submit" class="btn btn-primary btn-block">@lang('strings.do_search')</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="list-group">
                @forelse($users as $user)
                    <div class="list-group-item list-group-item-action">
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

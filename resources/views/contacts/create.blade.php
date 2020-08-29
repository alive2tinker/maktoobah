@extends('layouts.app')
@section('title', trans('strings.contact_us'))
@section('content')
<div class="container my-4">
    <h1 class="display-4">@lang('strings.contact_us')</h1>
    <div class="card shadow my-4 border-0">
        <div class="card-body">
            <form action="{{ route('contacts.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">@lang('strings.name')</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">@lang('strings.email')</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="form-group">
                    <label for="type">@lang('strings.inquiry_type')</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">@lang('strings.choose')</option>
                        <option value="inquiry">@lang('strings.inquiry')</option>
                        <option value="complaint">@lang('strings.complaint')</option>
                        <option value="suggestion">@lang('strings.suggestion')</option>
                        <option value="other">@lang('strings.other')</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">@lang('strings.message')</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">@lang('strings.submit')</button>
            </form>
        </div>
    </div>
</div>
@endsection

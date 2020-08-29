@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="display-4">@lang('strings.payment_confirmation_form')</h1>
    <form action="{{ route('payment.store') }}" method="post">
        @csrf
        <div class="form-row">
            <div class="col-md-4 form-group">
                <label for="payment-person">@lang('strings.name')</label>
                <input type="text"
                       class="form-control"
                       id="payment-person"
                       name="name"
                       value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 form-group">
                <label for="payment-amount">@lang('strings.payment_amount')</label>
                <input type="number"
                       class="form-control"
                       id="payment-amount"
                       name="amount"
                       value="{{ old('amount') }}">
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-4 form-group">
                <label for="payment-bank">@lang('strings.payment_bank')</label>
                <select name="bank" id="payment-bank" class="form-control">
                    <option value="">@lang('strings.choose')</option>
                    <option @if(old('bank') === "rajhi") selected @endif value="rajhi">@lang('strings.alrajhi_bank')</option>
                    <option @if(old('bank') === "jazira") selected @endif value="jazira">@lang('strings.aljazira_bank')</option>
                    <option @if(old('bank') === "ahli") selected @endif value="ahli">@lang('strings.alahli_bank')</option>
                    <option @if(old('bank') === "saib") selected @endif value="saib">@lang('strings.SAIB_bank')</option>
                </select>
            </div>
            <div class="col-md-4 form-group">
                <label for="payment-date">@lang('strings.date')</label>
                <select name="date" id="payment-date" class="form-control">
                    <option value="">@lang('strings.choose')</option>
                    <option @if(old('date') === "today") selected @endif value="today">@lang('strings.today')</option>
                    <option @if(old('date') === "yesterday") selected @endif value="yesterday">@lang('strings.yesterday')</option>
                    <option @if(old('date') === "two_three_days_ago") selected @endif value="two_three_days_ago">@lang('strings.two_three_days_ago')</option>
                    <option @if(old('date') === "aweek_ago") selected @endif value="aweek_ago">@lang('strings.aweek_ago')</option>
                    <option @if(old('date') === "a_amonth_ago") selected @endif value="a_amonth_ago">@lang('strings.a_amonth_ago')</option>
                    <option @if(old('date') === "other") selected @endif value="other">@lang('strings.other')</option>
                </select>
            </div>
        </div>
        <div class="form-group"><label for="payment-details">@lang('strings.payment_details')</label><textarea
                name="details"
                id="payment-details"
                cols="30"
                rows="10"
                class="form-control">{{ old('details') }}</textarea></div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">@lang('strings.submit')</button>
        </div>
    </form>
</div>
@endsection

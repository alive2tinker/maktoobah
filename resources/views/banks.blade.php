@extends('layouts.app')
@section('title', trans('strings.banks_list'))
@section('content')
    <div class="container">
        <h1 class="display-4 mb-4">@lang('strings.banks_list')</h1>
        <div class="list-group mt-5">
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h3 class="mb-1">@lang('strings.alrajhi_bank')</h3>
                </div>
                <p class="mb-1">@lang('strings.iban'): <b>SA5780000282608010603206</b></p>
            </div>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h3 class="mb-1">@lang('strings.aljazira_bank')</h3>
                </div>
                <p class="mb-1">@lang('strings.iban'): <b>SA1760100003880042642001</b></p>
            </div>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h3 class="mb-1">@lang('strings.alinma_bank')</h3>
                </div>
                <p class="mb-1">@lang('strings.iban'): @lang('strings.coming_soon')</p>
            </div>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h3 class="mb-1">@lang('strings.alahli_bank')</h3>
                </div>
                <p class="mb-1">@lang('strings.iban'): <b>SA59 1000 0026 0000 0030 4709</b></p>
            </div>
            <div class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h3 class="mb-1">@lang('strings.SAIB_bank')</h3>
                </div>
                <p class="mb-1">@lang('strings.iban'): <b>SA8065000005555597482001</b></p>
            </div>
        </div>
        <div class="row justify-content-center mt-3">
            <div class="col-md-8"><a href="{{ route('payment.create') }}" class="btn btn-primary btn-block">@lang('strings.payment_confiration')</a></div>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('title', $user->name)
@section('content')

    <div class="container">
        <div class="d-flex justify-content-center">
            <div class="owner">
                <div class="avatar">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTgsaRe2zqH_BBicvUorUseeTaE4kxPL2FmOQ&usqp=CAU" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                </div>
                <div class="name my-5">
                    <h4 class="title">{{ $user->name }}
                        <br />
                    </h4>
                </div>
            </div>
        </div>
        <div class="card shadow border-0">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 ml-auto mr-auto text-center">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                <i class="fa fa-smoking ml-2"></i>@lang('strings.smoker'):
                                {{ $user->smoking === 1 ? trans('strings.yes') : trans('strings.no') }}
                            </li>
                            <li>
                                <i class="fa fa-users ml-2"></i>@lang('strings.polgamy_friendly')
                                {{ $user->polgamy_friendly === 1 ? trans('strings.yes') : trans('strings.no') }}
                            </li>
                            <li>
                                <i class="fa fa-users ml-2"></i>@lang('strings.misyar_friendly')
                                {{ $user->misyar_friendly === 1 ? trans('strings.yes') : trans('strings.no') }}
                            </li>
                        </ul>
                        <p>{{ $user->details }}</p>
                    </div>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-center" colspan="4">@lang('strings.basic_information')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>@lang('strings.location')</th>
                        <th>@lang('strings.nationality')</th>
                    </tr>
                    <tr>
                        <td>{{ $user->city->name() . "، "  . $user->city->country->name()}}</td>
                        <td>{{ $user->nationality }}</td>
                    </tr>
                    <tr>
                        <th>@lang('strings.age')</th>
                        <th>@lang('strings.tribal')</th>
                    </tr>
                    <tr>
                        <td>{{ $user->age() }}</td>
                        <td>{{ $user->tribal === 1 ? trans('strings.yes') : trans('strings.no') }}</td>
                    </tr>
                    </tbody>
                    <thead>
                    <tr>
                        <th colspan="4" class="text-center">@lang('strings.personal_information')</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>@lang('strings.gender')</th>
                        <th>@lang('strings.marital_status')</th>
                    </tr>
                    <tr>
                        <td>@lang('strings.' . $user->gender)</td>
                        <td>@lang('strings.' . $user->marital_status)</td>
                    </tr>
                    <tr>
                        <th>@lang('strings.education')</th>
                        <th>@lang('strings.job')</th>
                    </tr>
                    <tr>
                        <td>@lang('strings.' . $user->education)</td>
                        <td>{{ $user->job }}</td>
                    </tr>
                    <tr>
                        <th>@lang('strings.height')</th>
                        <th>@lang('strings.weight')</th>
                    </tr>
                    <tr>
                        <td>{{ $user->height }}</td>
                        <td>{{ $user->weight }}</td>
                    </tr>
                    <tr>
                        <th>@lang('strings.skin_color')</th>
                        <th>@lang('strings.eye_color')</th>
                    </tr>
                    <tr>
                        <td>{{ $user->skin_color }}</td>
                        <td>{{ $user->eye_color }}</td>
                    </tr>
                    <tr>
                        <th>@lang('strings.hair_type')</th>
                        <th>@lang('strings.hair_color')</th>
                    </tr>
                    <tr>
                        <td>{{ $user->hair_type }}</td>
                        <td>{{ $user->hair_color }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

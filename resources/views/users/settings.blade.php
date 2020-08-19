@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card no-transition">
            <div class="card-body">
                <h1 class="display-4">@lang('strings.settings')</h1>
                <h3 class="card-title">@lang('strings.your_data')</h3>
                <form class="mt-3" action="{{ route('users.update_personal') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-3 form-group"><label for="user-email">@lang('strings.email')</label><input
                                type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}" id="user-email"></div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="user-password">@lang('strings.password')</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-password-confirmation">@lang('strings.password_confirmation')</label>
                            <input type="password" name="password_confirmation" class="form-control"></div>
                    </div>
                    <div class="form-group row mt-4">
                        <div class="col-md-4">
                            <label for="countries-list">@lang('strings.country')</label>
                            <select id="countries-list" class="form-control">
                                <option value="">@lang('strings.choose')</option>
                                @foreach ($countries as $country)
                                    <option @if(Auth::user()->city->country->id === $country->id) selected @endif value="{{ $country->id }}">{{  $country->name() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cities-list">@lang('strings.city')</label>
                            <select name="city_id" id="cities-list" class="form-control">
                                <option value="">@lang('strings.select_countries_first')</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="nationality">@lang('strings.nationality')</label>
                            <input  type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', Auth::user()->nationality) }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="user-gender">@lang('strings.gender')</label>
                            <select name="gender" class="form-control" id="user-gender">
                                <option value="">@lang('strings.choose')</option>
                                <option @if(Auth::user()->gender === 'male') selected @endif value="male">@lang('strings.male')</option>
                                <option @if(Auth::user()->gender === 'female') selected @endif  value="female">@lang('strings.female')</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-marital-status">@lang('strings.marital_status')</label>
                            <select name="marital_status" class="form-control" id="user-marital-status">
                                <option value="">@lang('strings.choose')</option>
                                <option @if(Auth::user()->marital_status === 'single') selected @endif vaule="single">@lang('strings.single')</option>
                                <option @if(Auth::user()->marital_status === 'married') selected @endif value="married">@lang('strings.married')</option>
                                <option @if(Auth::user()->marital_status === 'divorced') selected @endif value="divorced">@lang('strings.divorced')</option>
                                <option @if(Auth::user()->marital_status === 'widowed') selected @endif value="widowed">@lang('strings.widowed')</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-education">@lang('strings.education')</label>
                            <select name="education" class="form-control" id="user-education">
                                <option value="">@lang('strings.choose')</option>
                                <option @if(Auth::user()->education === 'middle_school') selected @endif value="middle_school">@lang('strings.middle_school')</option>
                                <option @if(Auth::user()->education === 'high school') selected @endif value="high school">@lang('strings.high_school')</option>
                                <option @if(Auth::user()->education === 'bachelors') selected @endif value="bachelors">@lang('strings.bachelors')</option>
                                <option @if(Auth::user()->education === 'masters') selected @endif value="masters">@lang('strings.masters')</option>
                                <option @if(Auth::user()->education === 'doctorate') selected @endif value="doctorate">@lang('strings.doctorate')</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-job">@lang('strings.job')</label>
                            <input  name="job" id="user-job" class="form-control" value="{{ old('job', Auth::user()->job) }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="tribal-status">@lang('strings.tribal')?</label>
                            <select name="tribal" id="tribal-status" class="form-control">
                                <option @if(Auth::user()->tribal === 0) selected @endif value="0">@lang('strings.not_tribal')</option>
                                <option @if(Auth::user()->education === 1) selected @endif value="1">@lang('strings.tribal')</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-dob">@lang('strings.date_of_birth')</label>
                            <input required  type="date" name="dob" id="user-dob" value="{{ old('dob', Auth::user()->dob) }}" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-height">@lang('strings.height')</label>
                            <input  type="text" name="height" value="{{ old('height', Auth::user()->height) }}" id="user-height" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-weight">@lang('strings.weight')</label>
                            <input  type="text" name="weight" value="{{ old('weight', Auth::user()->weight) }}" id="user-weight" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="user-skin-color">@lang('strings.skin_color')</label>
                            <input  id="user-skin-color" name="skin_color" value="{{ old('skin_color', Auth::user()->skin_color) }}" type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-hair-color">@lang('strings.hair_color')</label>
                            <input  type="text" id="user-hair-color" name="hair_color" value="{{ old('hair_color', Auth::user()->hair_color) }}" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-eye-color">@lang('strings.eye_color')</label>
                            <input  type="text" name="eye_color" id="user-eye-color" value="{{ old('eye_color', Auth::user()->eye_color) }}" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-hair-type">@lang('strings.hair_type')</label>
                            <input  type="text" id="user-hair-type" name="hair_type" value="{{ old('hair_type', Auth::user()->hair_type) }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label for="user-smoking-status">@lang('strings.smoker')?</label><br>
                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input  class="form-check-input" type="radio" name="smoker" id="user-smoking-status" value="1" @if(Auth::user()->smoker) checked @endif>
                                    @lang('strings.yes')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>

                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input  class="form-check-input" type="radio" name="smoker" id="user-smoking-status" value="0" @if(!Auth::user()->smoker) checked @endif>
                                    @lang('strings.no')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="user-polygamy-status">@lang('strings.polgamy_friendly')?</label><br>
                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input  class="form-check-input" type="radio" name="polygamy_friendly" id="user-polygamy" value="1" @if(Auth::user()->polygamy_friendly) checked @endif>
                                    @lang('strings.yes')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>

                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input  class="form-check-input" type="radio" name="polygamy_friendly" id="user-polygamy" value="0" @if(!Auth::user()->polygamy_friendly) checked @endif>
                                    @lang('strings.no')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="user-misyar-status">@lang('strings.misyar_friendly')?</label><br>
                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input  class="form-check-input" type="radio" name="misyar_friendly" id="user-misyar" value="1" @if(Auth::user()->misyar_friendly) checked @endif>
                                    @lang('strings.yes')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>

                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input  class="form-check-input" type="radio" name="misyar_friendly" id="user-misyar" value="0" @if(!Auth::user()->misyar_friendly) checked @endif>
                                    @lang('strings.no')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-md-5"><button type="submit" class="btn btn-primary btn-block">@lang('strings.update')</button></div>
                    </div>
                </form>
                <hr>
                <h4 class="card-title">@lang('strings.deactivate_account')</h4>
                <section class="my-3" id="deactivate-account">
                    <p>أنت على وشكل بدء عملية تعطيل حسابك على مخطوبة. اسمك المعروض واسم المستخدم@ وملفك الشخصي العام لن يصبح بالإمكان عرضهم بعد ذلك على makhtoobah.com أو تطبيق مخطوبة لنظام التشغيل iOS أو تطبيق مخطوبة لنظام التشغيل Android.</p>
                    <a href="{{ route('users.deactivate', Auth::user()->id) }}" class="btn btn-outline-danger">@lang('strings.deactivate_account')</a>
                </section>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function(){
            $("#countries-list option").each(function() {
                if($(this).is(':selected')){
                    getCities($(this).val());
                }
            });
            $("#countries-list").change(function(e){
                getCities(e.target.value);
            });

            function getCities(id)
            {
                $.get('/api/cities?country='+id, function(data){
                    $("#cities-list").empty();
                    $("#cities-list").append('<option value="">@lang('strings.choose')</option>');
                    $.each(data, function(index, cityObj){
                        $("#cities-list").append('<option value="'+cityObj.id+'">'+cityObj.name+'</option>');
                    });
                }).done(function(){
                    var userCity = {{ Auth::check() ? Auth::user()->city->id : null }}
                    if(userCity){
                        $("#cities-list").val(userCity);
                    }
                });
            }
        });
    </script>
@endsection

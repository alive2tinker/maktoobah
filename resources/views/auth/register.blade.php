@extends('layouts.app')
@section('title', 'تسجيل جديد')
@section('content')
    <div class="container">
        <div class="card shadow border-0">
            <div class="card-body">
                <h1 class="card-title">@lang('strings.register')</h1>
                <form class="mt-3" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group row @error('name') has-danger @enderror">
                        <div class="col-md-6">
                            <label for="user-full-name">
                                @lang('strings.name'): @error('name') <p class="text-danger">{{ $message }}</p>@enderror</label>
                            <input required  type="text"
                                   class="form-control @error('name') form-control-danger @enderror"
                                   id="user-full-name"
                                   aria-describedby="fullname-help"
                                   placeholder="@lang('strings.name_placeholder')"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autocomplete="name"
                                   autofocus>
                            <small id="fullname-help" class="form-text text-muted">@lang('strings.fullname_help')</small>
                        </div>
                    </div>
                    <div class="form-group row @error('email') has-danger @enderror">
                        <div class="col-md-6">
                            <label for="user-email">
                                @lang('strings.email'): @error('email') <p class="text-danger">{{ $message }}</p>@enderror</label>
                            <input required  type="email"
                                   class="form-control @error('email') form-control-danger @enderror"
                                   id="user-email"
                                   placeholder="@lang('strings.email_placeholder')"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="email"
                                   autofocus>
                        </div>
                    </div>
                    <div class="form-group row @error('password') has-danger @enderror">
                        <div class="col-md-6">
                            <label for="user-password">
                                @lang('strings.password'): @error('password') <p class="text-danger">{{ $message }}</p>@enderror</label>
                            <input required  id="user-password"
                                   type="password"
                                   class="form-control @error('password') form-control-danger @enderror"
                                   name="password"
                                   required
                                   autocomplete="new-password">
                        </div>
                        <div class="col-md-6">
                            <label for="user-password-confirmation">
                                @lang('strings.password_confirmation'):</label>
                            <input required  id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <hr>
                    <h3 class="card-title">@lang('strings.personal_information')</h3>
                    <div class="form-group row mt-4">
                        <div class="col-md-4">
                            <label for="countries-list">@lang('strings.country')</label>
                            <select id="countries-list" class="form-control">
                                <option value="">@lang('strings.choose')</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{  $country->name() }}</option>
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
                            <input required  type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="user-gender">@lang('strings.gender')</label>
                            <select name="gender" class="form-control" id="user-gender">
                                <option value="">@lang('strings.choose')</option>
                                <option value="male">@lang('strings.male')</option>
                                <option value="female">@lang('strings.female')</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-marital-status">@lang('strings.marital_status')</label>
                            <select name="marital_status" class="form-control" id="user-marital-status">
                                <option value="">@lang('strings.choose')</option>
                                <option value="single">@lang('strings.single')</option>
                                <option value="married">@lang('strings.married')</option>
                                <option value="divorced">@lang('strings.divorced')</option>
                                <option value="widowed">@lang('strings.widowed')</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-education">@lang('strings.education')</label>
                            <select name="education" class="form-control" id="user-education">
                                <option value="">@lang('strings.choose')</option>
                                <option value="middle_school">@lang('strings.middle_school')</option>
                                <option value="high_school">@lang('strings.high_school')</option>
                                <option value="bachelors">@lang('strings.bachelors')</option>
                                <option value="masters">@lang('strings.masters')</option>
                                <option value="doctorate">@lang('strings.doctorate')</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-job">@lang('strings.job')</label>
                            <input required  name="job" id="user-job" class="form-control" value="{{ old('job') }}">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="tribal-status">@lang('strings.tribal')?</label>
                            <select name="tribal" id="tribal-status" class="form-control">
                                <option value="0">@lang('strings.not_tribal')</option>
                                <option value="1">@lang('strings.tribal')</option>
                            </select>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-dob">@lang('strings.date_of_birth')</label>
                            <input required  type="date" name="dob" id="user-dob" value="{{ old('dob') }}" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-height">@lang('strings.height')</label>
                            <input required  type="text" name="height" id="user-height" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-weight">@lang('strings.weight')</label>
                            <input required  type="text" name="weight" id="user-weight" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 form-group">
                            <label for="user-skin-color">@lang('strings.skin_color')</label>
                            <input required  id="user-skin-color" name="skin_color" value="{{ old('skin_color') }}" type="text" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-hair-color">@lang('strings.hair_color')</label>
                            <input required  type="text" id="user-hair-color" name="hair_color" value="{{ old('hair_color') }}" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-eye-color">@lang('strings.eye_color')</label>
                            <input required  type="text" name="eye_color" id="user-eye-color" value="{{ old('eye_color') }}" class="form-control">
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="user-hair-type">@lang('strings.hair_type')</label>
                            <input required  type="text" id="user-hair-type" name="hair_type" value="{{ old('hair_type') }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label for="user-smoking-status">@lang('strings.smoker')?</label><br>
                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input required  class="form-check-input" type="radio" name="smoker" id="user-smoking-status" value="1">
                                    @lang('strings.yes')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>

                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input required  class="form-check-input" type="radio" name="smoker" id="user-smoking-status" value="0" checked>
                                    @lang('strings.no')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="user-polygamy-status">@lang('strings.polgamy_friendly')?</label><br>
                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input required  class="form-check-input" type="radio" name="polygamy_friendly" id="user-polygamy" value="1">
                                    @lang('strings.yes')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>

                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input required  class="form-check-input" type="radio" name="polygamy_friendly" id="user-polygamy" value="0" checked>
                                    @lang('strings.no')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="user-misyar-status">@lang('strings.misyar_friendly')?</label><br>
                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input required  class="form-check-input" type="radio" name="misyar_friendly" id="user-misyar" value="1">
                                    @lang('strings.yes')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>

                            <div class="form-check-radio form-check-inline mt-2">
                                <label class="form-check-label">
                                    <input required  class="form-check-input" type="radio" name="misyar_friendly" id="user-misyar" value="0" checked>
                                    @lang('strings.no')
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="user-details">@lang('strings.your_details')</label>
                        <textarea name="details" id="user-details" placeholder="@lang('strings.user_details_help')" cols="30" rows="10" class="form-control">
                            {{ old('details') }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="t&c-card">@lang('strings.t&c')</label>
                        <div class="card" id="t&c-card">
                            <div class="card-body">

                                قال الله تعالى" وَأَوْفُواْ بِعَهْدِ اللهِ إِذَا عَاهَدتُّمْ وَلاَ تَنقُضُواْ الأَيْمَانَ بَعْدَ تَوْكِيدِهَا وَقَدْ جَعَلْتُمُ اللهَ عَلَيْكُمْ كَفِيلاً " صدق الله العظيم
                                عند إستخدامك للموقع فانت تتعهد بالآتي:

                                تتعهد بعدم كتابة بيانات أو مراسلات غير جادة أو لا تتعلق بالزواج على نهج اهل السنة والجماعة.
                                تتعهد بعدم استخدام الموقع للإساءة للموقع أو لأحد من أعضائه.
                                تتعهد بعدم كتابة بيانات أو مراسلة يوحي بانتقاص للآخرين بأي شكل . إذا كنت ترى أن صاحب الطلب غير مناسب لك يمكنك تجاهل المراسلة دون تجريح او انتقاص.
                                يحصل الموقع على اتعاب من اي عضو يتزوج عن طريق الموقع، وهي أمانه في ذمته. مقدارها الف ريال سعودي فقط ، ويعتبر هذا الشرط اتفاقاً ملزماً .
                                تتعهد بعدم التسجيل بأكثر من عضوية تابعة لك في الموقع.
                            </div>
                        </div>
                    </div>
                    <div class="form-row justify-content-center">
                        <div class="col-md-5"><button type="submit" class="btn btn-primary btn-block">@lang('strings.register')</button></div>
                    </div>
                </form>
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
        });
    </script>

@endsection

@php use App\Enums\FamilyManagementEnum;use App\Enums\RelationshipFamily; @endphp
@extends('layouts.admin')

@section('main-content')

    <div class="container">
        <input type="hidden" value="{{ $id }}" class="form-control" id="id" name="id">

        <div class="row">
            <div class="col-sm-6">
                <label for="name">{{ __('home.Name') }}</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $member->name ?? '' }}">
            </div>
            <div class="col-sm-6">
                <label for="date_of_birth">{{ __('home.Date of birth') }}</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                       value="{{ $member->date_of_birth ?? '' }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="number_phone">{{ __('home.PhoneNumber') }}</label>
                <input type="number" class="form-control" id="number_phone" name="number_phone"
                       value="{{ $member->number_phone ?? '' }}">
            </div>
            <div class="col-sm-6">
                <label for="email">{{ __('home.Email') }}</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $member->email ?? '' }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="sex">{{ __('home.Sexs') }}</label>
                <select class="custom-select form-control" id="sex" name="sex">
                    <option value="{{ FamilyManagementEnum::NAM }}">{{ __('home.Nam') }}</option>
                    <option value="{{ FamilyManagementEnum::NU }}">{{ __('home.Nu') }}</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label for="relationship">{{ __('home.quan he voi chu ho') }}</label>
                <select class="custom-select form-control" id="relationship" name="relationship">
                    @foreach(RelationshipFamily::asArray() as $key => $value)
                        <option
                            {{ $value == $member->relationship ? 'selected' : '' }} value="{{ $value }}">{{ $key }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="province_id">{{ __('home.Province') }}</label>
                <select class="custom-select form-control" id="province_id" name="province_id"
                        onchange="callGetAllDistricts(this.value)">
                </select>
            </div>
            <div class="col-sm-6">
                <label for="district_id">{{ __('home.District') }}</label>
                <select class="custom-select form-control" id="district_id" name="district_id"
                        onchange="callGetAllCommunes(this.value)">
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="ward_id">{{ __('home.Ward') }}</label>
                <select class="custom-select form-control" id="ward_id" name="ward_id">
                </select>
            </div>
            <div class="col-sm-6">
                <label for="detail_address">{{ __('home.Addresses') }}</label>
                <input type="text" class="form-control" id="detail_address" name="detail_address"
                       value="{{ $member->detail_address ?? '' }}">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <label for="avatar">{{ __('home.avatar') }}</label>
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-4">
                <button class="btn btn-primary" type="button" onclick="submitForm()">{{ __('home.Sửa') }}</button>
            </div>
        </div>
    </div>

    <script>

        disableAfterThisDay();

        function disableAfterThisDay() {
            // Get the current date in the format YYYY-MM-DD
            const currentDate = new Date().toISOString().split('T')[0];

            // Set the max attribute of the date input field
            document.getElementById('date_of_birth').max = currentDate;

        }

        function submitForm() {
            let formData = new FormData();
            let isValid = true;
            let arrInput = ['name', 'date_of_birth',
                'number_phone', 'email', 'sex',
                'relationship', 'province_id', 'district_id',
                'ward_id', 'detail_address'];
            isValid = appendDataForm(arrInput, formData, isValid);

            if (!isValid) {
                return;
            }

            let url = `{{route('api.backend.family-management.update', ['id' => ':id'])}}`;
            url = url.replace(':id', $('#id').val());

            formData.append('_token', '{{ csrf_token() }}');
            // push file avatar to form data
            let file = $('#avatar')[0].files[0];
            if (file) {
                formData.append('avatar', file);
            }

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${token}`
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    window.location.href = `{{route('api.backend.family-management.index')}}`;
                },
                error: function (error) {
                    console.log(error)
                    if (error.responseJSON.errors) {
                        let errors = error.responseJSON.errors;
                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                let value = errors[key];
                                alert(value[0]);
                                break;
                            }
                        }
                    } else {
                        alert(error.responseJSON.message);
                    }
                }
            });
        }

        callGetAllProvince();

        async function callGetAllProvince() {
            $.ajax({
                url: `{{ route('restapi.get.provinces') }}`,
                method: 'GET',
                success: function (response) {
                    showAllProvince(response);
                },
                error: function (exception) {
                    console.log(exception);
                }
            });
        }

        async function callGetAllDistricts(code) {
            let url = `{{ route('restapi.get.districts', ['code' => ':code']) }}`;
            url = url.replace(':code', code);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    showAllDistricts(response);
                },
                error: function (exception) {
                    console.log(exception);
                }
            });
        }

        async function callGetAllCommunes(code) {
            let url = `{{ route('restapi.get.communes', ['code' => ':code']) }}`;
            url = url.replace(':code', code);
            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    showAllCommunes(response);
                },
                error: function (exception) {
                    console.log(exception);
                }
            });
        }

        function showAllProvince(res) {
            let html = ``;
            let provinceCode = '{{ $member->province_id ?? '' }}';
            let selected = '';
            for (let i = 0; i < res.length; i++) {
                let data = res[i];
                let code = data.code;
                selected = provinceCode === code ? 'selected' : '';

                html = html + `<option ${selected} class="province province-item" data-code="${code}" value="${data.code}">${data.name}</option>`;
            }
            $('#province_id').empty().append(html);

            callGetAllDistricts($('#province_id').find(':selected').val());
        }

        function showAllDistricts(res) {
            let html = ``;
            let provinceCode = '{{ $member->district_id ?? '' }}';
            let selected = '';
            for (let i = 0; i < res.length; i++) {
                let data = res[i];
                let code = data.code;
                selected = provinceCode === code ? 'selected' : '';

                html = html + `<option ${selected} class="district district-item" value="${data.code}">${data.name}</option>`;
            }
            $('#district_id').empty().append(html);
            callGetAllCommunes($('#district_id').find(':selected').val());
        }

        function showAllCommunes(res) {
            let html = ``;
            let provinceCode = '{{ $member->ward_id ?? '' }}';
            let selected = '';
            for (let i = 0; i < res.length; i++) {
                let data = res[i];
                let code = data.code;
                selected = provinceCode === code ? 'selected' : '';

                html = html + `<option ${selected} value="${data.code}">${data.name}</option>`;
            }
            $('#ward_id').empty().append(html);
        }
    </script>
@endsection

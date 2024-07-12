@extends('layouts.admin')
@section('title')
    Detail User
@endsection
@section('main-content')
    <div class="">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800"> Detail User </h1>
        <div class="container-fluid">
            <form action="{{ route('api.admin.users.update', $user->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label class="form-control-label" for="username">{{ __('home.Username') }}
                            <span class="small text-danger">*</span>
                        </label>
                        <input type="text" id="username" class="form-control" name="username" placeholder="Username"
                               required value="{{ $user->username }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="form-control-label" for="name">{{ __('home.Name') }}
                            <span class="small text-danger">*</span>
                        </label>
                        <input type="text" id="name" class="form-control" name="name" placeholder="Name" required
                               value="{{ $user->name }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="form-control-label" for="last_name">{{ __('home.Last name') }}</label>
                        <input type="text" id="last_name" class="form-control" name="last_name"
                               placeholder="Last name" required value="{{ $user->last_name }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="email">{{ __('home.Email address') }}
                            <span class="small text-danger">*</span>
                        </label>
                        <input type="email" id="email" class="form-control" name="email"
                               placeholder="example@example.com" required value="{{ $user->email }}">
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="phone">{{ __('home.PhoneNumber') }}
                            <span class="small text-danger">*</span>
                        </label>
                        <input type="number" id="phone" class="form-control" name="phone" placeholder="Phone"
                               value="{{ $user->phone }}" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="avt">{{ __('home.Ảnh đại diện') }} </label>
                        <input type="file" class="form-control" id="avt" name="avt" accept="image/*">
                        <img loading="lazy" src="{{ asset($user->avt) }}" alt="Image" style="max-width: 100px">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="form-control-label" for="password">{{ __('home.New password') }}
                            <span class="small text-danger">*</span>
                        </label>
                        <input type="password" id="password" class="form-control" name="password"
                               placeholder="{{ __('home.New password') }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-control-label"
                               for="passwordConfirm">{{ __('home.Confirm Password') }}
                            <span class="small text-danger">*</span>
                        </label>
                        <input type="password" id="passwordConfirm" class="form-control"
                               name="passwordConfirm" placeholder="{{ __('home.Confirm Password') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="province_id">{{ __('home.Tỉnh') }}</label>
                        <select name="province_id" id="province_id" class="form-control form-select"
                                onchange="callGetAllDistricts($('#province_id').find(':selected').data('code'))">
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="district_id">{{ __('home.Quận') }}</label>
                        <select name="district_id" id="district_id" class="form-control form-select"
                                onchange="callGetAllCommunes($('#district_id').find(':selected').data('code'))">
                            <option value="">{{ __('home.Chọn quận') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="commune_id">{{ __('home.Xã') }}</label>
                        <select name="commune_id" id="commune_id" class="form-control form-select">
                            <option value="">{{ __('home.Chọn xã') }}</option>
                        </select>
                    </div>
                </div>
                <div class="row">
{{--                    <div class="form-group col-md-6">--}}
{{--                        <label class="form-control-label" for="address_code">{{ __('home.AddressCode') }}</label>--}}
{{--                        <input type="text" id="address_code" class="form-control" name="address_code"--}}
{{--                               placeholder="ha_noi" value="{{ $user->address_code }}">--}}
{{--                    </div>--}}
                    <div class="form-group col-md-6">
                        <label for="detail_address">{{ __('home.địa chỉ chi tiết việt') }}</label>
                        <input class="form-control" name="detail_address" id="detail_address"
                               value="{{ $user->detail_address }}">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="type">{{ __('home.Type Account') }}</label>
                        <select id="type" name="type" class="form-select form-control">
                            <option value="NORMAL">Choose...</option>
                            <option
                                {{ $user->type == 'BUSINESS' ? 'selected' : '' }} value="BUSINESS">{{ __('home.BUSINESS') }}</option>
                            <option
                                {{ $user->type == 'MEDICAL' ? 'selected' : '' }} value="MEDICAL">{{ __('home.MEDICAL') }}</option>
                            <option
                                {{ $user->type == 'NORMAL' ? 'selected' : '' }} value="NORMAL">{{ __('home.NORMAL') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="member">{{ __('home.Member') }}<span
                                class="small text-danger">*</span></label>
                        <select id="member" name="member" class="form-control form-select">
                            <option
                                {{ $user->member == 'PAITENTS' ? 'selected' : '' }} value="PAITENTS">{{ __('home.PAITENTS') }}</option>
                            <option
                                {{ $user->member == 'NORMAL PEOPLE' ? 'selected' : '' }} value="NORMAL PEOPLE">{{ __('home.NORMAL PEOPLE') }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="form-control-label" for="status">{{ __('home.Status') }}</label>
                        <select id="status" name="status" class="form-control form-select">
                            <option {{ $user->status == 'ACTIVE' ? 'selected' : '' }} value="ACTIVE">
                                ACTIVE
                            </option>
                            <option {{ $user->status == 'INACTIVE' ? 'selected' : '' }} value="INACTIVE">
                                INACTIVE
                            </option>
                            <option {{ $user->status == 'BLOCKED' ? 'selected' : '' }} value="BLOCKED">
                                BLOCKED
                            </option>
                            <option {{ $user->status == 'PENDING' ? 'selected' : '' }} value="PENDING">
                                PENDING
                            </option>
                        </select>
                    </div>
                </div>
                <!-- Normal -->
                <div class="only-normal" id="only_normal">
                </div>

                <div id="two_level">

                </div>

                <!-- Medical -->
                <div class="only-medical" id="only_medical">

                </div>

                <!-- Business -->
                <div class="only-business" id="only_business">

                </div>

                <!-- Button -->
                <div class="pl-md-4 mt-4">
                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" id="btnCreateUser"
                                    class="btn btn-primary">{{ __('home.create') }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        // let accessToken = `Bearer ` + token;
        // let headers = {
        //     "Authorization": accessToken
        // };

        $(document).ready(function () {
            $('#type').on('change', function () {
                renderMember();
            })

            renderMember();
        })

        function renderMember() {
            let value = $('#type').val();
            let html = ``;
            switch (value) {
                case 'BUSINESS':
                    html = `<option {{ $user->member == 'PHARMACEUTICAL COMPANIES' ? 'selected' : '' }} value="{{\App\Enums\Role::PHARMACEUTICAL_COMPANIES}}">Công ty Dược phẩm</option>
                                                <option {{ $user->member == 'HOSPITALS' ? 'selected' : '' }} value="{{\App\Enums\Role::HOSPITALS}}">Bệnh viện</option>
                                                <option {{ $user->member == 'CLINICS' ? 'selected' : '' }} value="{{\App\Enums\Role::CLINICS}}">Phòng khám</option>
                                                <option {{ $user->member == 'PHARMACIES' ? 'selected' : '' }} value="{{\App\Enums\Role::PHARMACIES}}">Hiệu thuốc</option>
                                                <option {{ $user->member == 'SPAS' ? 'selected' : '' }} value="{{\App\Enums\Role::SPAS}}">Spa</option>
                                                <option {{ $user->member == 'OTHERS' ? 'selected' : '' }} value="{{\App\Enums\Role::OTHERS}}">Khác</option>`;
                    clearAppend();
                    showRoleOther();
                    showOnlyBusiness();
                    break;
                case 'MEDICAL':
                    html = `<option {{ $user->member == 'DOCTOR' ? 'selected' : '' }} value="{{\App\Enums\Role::DOCTORS}}">Bác sĩ</option>
                                                <option {{ $user->member == 'PHAMACISTS' ? 'selected' : '' }} value="{{\App\Enums\Role::PHAMACISTS}}">Dược sĩ</option>
                                                <option {{ $user->member == 'THERAPISTS' ? 'selected' : '' }} value="{{\App\Enums\Role::THERAPISTS}}">Bác sĩ trị liệu</option>
                                                <option {{ $user->member == 'ESTHETICIANS' ? 'selected' : '' }} value="{{\App\Enums\Role::ESTHETICIANS}}">Chuyên viên thẩm mỹ</option>
                                                <option {{ $user->member == 'NURSES' ? 'selected' : '' }} value="{{\App\Enums\Role::NURSES}}">Y tá</option>`;
                    clearAppend();
                    showRoleOther();
                    showOnlyMedical();
                    break;
                default:
                    html = `<option {{ $user->member == 'PAITENTS' ? 'selected' : '' }} value="{{\App\Enums\Role::PAITENTS}}">Bệnh nhân</option>
                                                <option {{ $user->member == 'NORMAL PEOPLE' ? 'selected' : '' }} value="{{\App\Enums\Role::NORMAL_PEOPLE}}">Người bình thường</option>`;
                    clearAppend();
                    showOnlyNormal();
                    break;
            }
            $('#member').empty().append(html);
        }
    </script>
    {{-- Append form element follow type account --}}
    <script>
        function showOnlyBusiness() {
            let html = ``;
            $('#only_business').empty().append(html);
        }

        function showOnlyMedical() {
            let html = `<h1>Info doctor</h1>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="specialty">Chuyên khoa</label>
                                <select class="form-select" id="department_id" name="department_id">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }} class="text-shortcut">
                                            {{$department->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="identifier">{{ __('home.Mã định danh trên giấy hành nghề') }}</label>
                                                    <input type="text" class="form-control" id="identifier" name="identifier" value="{{ $user->identifier }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="service">{{ __('home.Dịch vụ cung cấp việt') }}</label>
                                <textarea class="form-control" name="service" id="service">{{ $user->service }}</textarea>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="service_price">{{ __('home.Giá dịch vụ việt') }}</label>
                                <input class="form-control" type="number" name="service_price" id="service_price"
                                       value="{{ $user->service_price }}">
                            </div>
                        </div>
                         @php
                $working1 = $user->time_working_1;
                $arrayWorking1 = explode('-', $working1);

                $working2 = $user->time_working_2;
                $arrayWorking2 = explode('-', $working2);
            @endphp
            @if($working1 && $working2)
            <div class="row">
            <div class="form-group col-md-3">
                <label for="time_working_1_start">{{ __('home.Thời gian làm việc bắt đầu') }}</label>
                                    <input type="time" class="form-control" id="time_working_1_start"
                                           name="time_working_1_start" value="{{ $arrayWorking1[0] ?? '00:00' }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="time_working_1_end">{{ __('home.Thời gian làm việc kết thúc') }}</label>
                                    <input type="time" class="form-control" id="time_working_1_end"
                                           name="time_working_1_end" value="{{ $arrayWorking1[1] ?? '23:59' }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label
                                        for="time_working_2_start">{{ __('home.Addresses') }}{{ __('home.Những này làm việc bắt đầu') }}</label>
                                    <select name="time_working_2_start" id="time_working_2_start" class="form-control">
                                        <option  {{ $arrayWorking2[0] == 'T2' ? 'selected' : '' }} value="T2">{{ __('home.Thứ 2') }}</option>
                                        <option  {{ $arrayWorking2[0] == 'T3' ? 'selected' : '' }} value="T3">{{ __('home.Thứ 3') }}</option>
                                        <option  {{ $arrayWorking2[0] == 'T4' ? 'selected' : '' }} value="T4">{{ __('home.Thứ 4') }}</option>
                                        <option  {{ $arrayWorking2[0] == 'T5' ? 'selected' : '' }} value="T5">{{ __('home.Thứ 5') }}</option>
                                        <option  {{ $arrayWorking2[0] == 'T6' ? 'selected' : '' }} value="T6">{{ __('home.Thứ 6') }}</option>
                                        <option  {{ $arrayWorking2[0] == 'T7' ? 'selected' : '' }} value="T7">{{ __('home.Thứ 7') }}</option>
                                        <option  {{ $arrayWorking2[0] == 'CN' ? 'selected' : '' }} value="CN">{{ __('home.Chủ nhật') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label
                                        for="time_working_2_end">{{ __('home.Những này làm việc kết thúc') }}</label>
                                    <select name="time_working_2_end" id="time_working_2_end"
                                            class="form-control">
                                        <option  {{ $arrayWorking2[1] == 'T2' ? 'selected' : '' }} value="T2">{{ __('home.Thứ 2') }}</option>
                                        <option  {{ $arrayWorking2[1] == 'T3' ? 'selected' : '' }} value="T3">{{ __('home.Thứ 3') }}</option>
                                        <option  {{ $arrayWorking2[1] == 'T4' ? 'selected' : '' }} value="T4">{{ __('home.Thứ 4') }}</option>
                                        <option  {{ $arrayWorking2[1] == 'T5' ? 'selected' : '' }} value="T5">{{ __('home.Thứ 5') }}</option>
                                        <option  {{ $arrayWorking2[1] == 'T6' ? 'selected' : '' }} value="T6">{{ __('home.Thứ 6') }}</option>
                                        <option  {{ $arrayWorking2[1] == 'T7' ? 'selected' : '' }} value="T7">{{ __('home.Thứ 7') }}</option>
                                        <option  {{ $arrayWorking2[1] == 'CN' ? 'selected' : '' }} value="CN">{{ __('home.Chủ nhật') }}</option>
                                    </select>
                                </div>

                                <input type="text" class="form-control d-none" value="{{ $user->time_working_1 }}" id="time_working_1"
                                       name="time_working_1">
                                <input type="text" class="form-control d-none" value="{{ $user->time_working_2 }}" id="time_working_2"
                                       name="time_working_2">
                                <input type="text" class="form-control d-none" id="apply_for" value="{{ $user->apply_for }}" name="apply_for">
                            </div>
                            @else
            <div class="row">
        <div class="form-group col-md-3">
            <label for="time_working_1_start">{{ __('home.Thời gian làm việc bắt đầu') }}</label>
                                    <input type="time" class="form-control" id="time_working_1_start"
                                           name="time_working_1_start" value="00:00">
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="time_working_1_end">{{ __('home.Thời gian làm việc kết thúc') }}</label>
                                    <input type="time" class="form-control" id="time_working_1_end"
                                           name="time_working_1_end" value="23:59">
                                </div>
                                <div class="form-group col-md-3">
                                    <label
                                        for="time_working_2_start">{{ __('home.Addresses') }}{{ __('home.Những này làm việc bắt đầu') }}</label>
                                    <select name="time_working_2_start" id="time_working_2_start" class="form-control">
                                        <option value="T2">{{ __('home.Thứ 2') }}</option>
                                        <option value="T3">{{ __('home.Thứ 3') }}</option>
                                        <option value="T4">{{ __('home.Thứ 4') }}</option>
                                        <option value="T5">{{ __('home.Thứ 5') }}</option>
                                        <option value="T6">{{ __('home.Thứ 6') }}</option>
                                        <option value="T7">{{ __('home.Thứ 7') }}</option>
                                        <option value="CN">{{ __('home.Chủ nhật') }}</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label
                                        for="time_working_2_end">{{ __('home.Những này làm việc kết thúc') }}</label>
                                    <select name="time_working_2_end" id="time_working_2_end"
                                            class="form-control">
                                        <option value="T2">{{ __('home.Thứ 2') }}</option>
                                        <option value="T3">{{ __('home.Thứ 3') }}</option>
                                        <option value="T4">{{ __('home.Thứ 4') }}></option>
                                        <option value="T5">{{ __('home.Thứ 5') }}</option>
                                        <option value="T6">{{ __('home.Thứ 6') }}</option>
                                        <option value="T7">{{ __('home.Thứ 7') }}</option>
                                        <option value="CN">{{ __('home.Chủ nhật') }}</option>
                                    </select>
                                </div>

                                <input type="text" class="form-control d-none" value="{{ $user->time_working_1 }}" id="time_working_1"
                                       name="time_working_1">
                                <input type="text" class="form-control d-none" value="{{ $user->time_working_2 }}" id="time_working_2"
                                       name="time_working_2">
                                <input type="text" class="form-control d-none" id="apply_for" value="{{ $user->apply_for }}" name="apply_for">
                            </div>
                        @endif
            <div class="row">
        <div class="form-group col-md-6">
            <label for="year_of_experience">{{ __('home.Năm kinh nghiệm') }}</label>
                                <input type="number" class="form-control" max="80" id="year_of_experience"
                                       name="year_of_experience" value="{{ $user->year_of_experience }}">
                            </div>
                            <div class="form-element col-md-6">
                <label for="workspace">{{ __('home.Workplace') }}</label>
                <input class="form-control" id="workspace" type="text" name="workspace" value="{{$user->workplace}}">
            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <input name="prescription" {{ $user->prescription == '1' ? 'checked' : '' }}
            type="checkbox" id="prescription" value="1">
        <label for="prescription">{{ __('home.prescription') }}</label>
                            </div>
                            <div class="form-group">
                                <input name="free" type="checkbox"
                                    {{ $user->free == '1' ? 'checked' : '' }}
            id="free" value="1">
        <label for="free">{{ __('home.free') }}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apply_show">{{ __('home.Apply Show') }}</label>
                            <input type="text" class="form-control" id="apply_show" name="apply_show" value="{{$user->apply_for}}" disabled>
                            @php
                $arrayApply = [
                    'name'=> 'Name',
                    'response_rate'=> 'Response Rate',
                    'specialty'=> 'Specialty',
                    'year_of_experience'=> 'Years of experience',
                    'service'=> 'Service',
                    'service_price'=> 'Service Price',
                    'time_working_1'=> 'Time Working',
                    'time_working_2'=> 'Date Working',
                ];
                 $arrayApplyOld = explode(',', $user->apply_for);
            @endphp
            <ul class="list-apply">
@foreach($arrayApply as $key => $value)
            <li class="new-select">
                <input onchange="getInput();" class="apply_item" value="{{$key}}"
                                                    {{ in_array($key, $arrayApplyOld) ? 'checked' : '' }}
            id="apply_item_{{$key}}"
                                                                   name="apply_item"
                                                                   type="checkbox">
                                                        <label for="apply_item_{{$key}}">{{$value}}</label>
                                                    </li>
                            @endforeach
            </ul>
        </div>`;
            $('#only_medical').empty().append(html);

            handleTimeOne();
        }

        function showRoleOther() {
            let html = `<div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="file_upload">{{ __('home.Upload your license') }}</label>
                            <input type="file" name="file_upload" class="form-control" accept="image/*" id="file_upload">
                               <img loading="lazy" src="{{ asset($user->business_license_img ?? $user->medical_license_img) }}" alt="Image" style="max-width: 100px">
                        </div>
                    </div>`;
            $('#two_level').empty().append(html);
        }

        function showOnlyNormal() {
            let html = `<div class="form-group">
                        <label for="medical_history">{{ __('home.Tiền sử bệnh án') }}</label>
                        <textarea id="medical_history" class="form-control" name="medical_history">{{ $user->medical_history }}</textarea>
                    </div>`;
            $('#only_normal').empty().append(html);
        }

        function clearAppend() {
            $('#only_normal').empty();
            $('#two_level').empty();
            $('#only_medical').empty();
            $('#only_business').empty();
        }
    </script>
    {{-- Handle input --}}
    <script>
        let arrayItem = [];
        let arrayNameCategory = [];

        function removeArray(arr) {
            var what, a = arguments, L = a.length, ax;
            while (L > 1 && arr.length) {
                what = a[--L];
                while ((ax = arr.indexOf(what)) !== -1) {
                    arr.splice(ax, 1);
                }
            }
            return arr;
        }

        function getListName(array, items) {
            for (let i = 0; i < items.length; i++) {
                if (items[i].checked) {
                    if (array.length == 0) {
                        array.push(items[i].nextElementSibling.innerText);
                    } else {
                        let name = array.includes(items[i].nextElementSibling.innerText);
                        if (!name) {
                            array.push(items[i].nextElementSibling.innerText);
                        }
                    }
                } else {
                    removeArray(array, items[i].nextElementSibling.innerText)
                }
            }
            return array;
        }

        function checkArray(array, listItems) {
            for (let i = 0; i < listItems.length; i++) {
                if (listItems[i].checked) {
                    if (array.length == 0) {
                        array.push(listItems[i].value);
                    } else {
                        let check = array.includes(listItems[i].value);
                        if (!check) {
                            array.push(listItems[i].value);
                        }
                    }
                } else {
                    removeArray(array, listItems[i].value);
                }
            }
            return array;
        }

        function getInput() {
            let items = document.getElementsByClassName('apply_item');

            arrayItem = checkArray(arrayItem, items);
            arrayNameCategory = getListName(arrayNameCategory, items)

            let listName = arrayNameCategory.toString();

            if (listName) {
                $('#apply_show').val(listName);
            }

            arrayItem.sort();
            let value = arrayItem.toString();
            $('#apply_for').val(value);
        }

        function handleTimeOne() {
            setDataForTime('time_working_1_start', 'time_working_1_end', 'time_working_1');
            setDataForTime('time_working_2_start', 'time_working_2_end', 'time_working_2');

            $('#time_working_1_start').on('change', function () {
                setDataForTime('time_working_1_start', 'time_working_1_end', 'time_working_1')
            })

            $('#time_working_1_end').on('change', function () {
                setDataForTime('time_working_1_start', 'time_working_1_end', 'time_working_1')
            })

            $('#time_working_2_start').on('change', function () {
                setDataForTime('time_working_2_start', 'time_working_2_end', 'time_working_2')
            })

            $('#time_working_2_end').on('change', function () {
                setDataForTime('time_working_2_start', 'time_working_2_end', 'time_working_2')
            })
        }

        function setDataForTime(time_working_start, time_working_end, merge) {
            let value_start = $('#' + time_working_start).val();
            let value_end = $('#' + time_working_end).val();
            let mergeValue = value_start + '-' + value_end;
            $('#' + merge).val(mergeValue);
        }

    </script>
    {{-- Load list address --}}
    <script>
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
            let pro = `{{ $user->province_id }}`;
            let select = '';
            for (let i = 0; i < res.length; i++) {
                let data = res[i];

                if (data.id == pro) {
                    select = 'selected';
                } else {
                    select = '';
                }

                let code = data.code;
                html = html + `<option ${select} class="province province-item" data-id="${data.id}" data-code="${code}" value="${data.id}">${data.name}</option>`;
            }
            $('#province_id').empty().append(html);
            callGetAllDistricts($('#province_id').find(':selected').data('code'));
        }

        function showAllDistricts(res) {
            let html = ``;
            let dis = `{{ $user->district_id }}`;
            let select = '';
            for (let i = 0; i < res.length; i++) {
                let data = res[i];

                if (data.id == dis) {
                    select = 'selected';
                } else {
                    select = '';
                }

                let code = data.code;
                html = html + `<option ${select} class="district district-item" data-id="${data.id}" data-code="${code}" value="${data.id}">${data.name}</option>`;
            }
            $('#district_id').empty().append(html);
            callGetAllCommunes($('#district_id').find(':selected').data('code'));
        }

        function showAllCommunes(res) {
            let html = ``;
            let com = `{{ $user->commune_id }}`;
            let select = '';
            for (let i = 0; i < res.length; i++) {
                let data = res[i];

                if (data.id == com) {
                    select = 'selected';
                } else {
                    select = '';
                }

                html = html + `<option ${select} data-id="${data.id}" value="${data.id}">${data.name}</option>`;
            }
            $('#commune_id').empty().append(html);
        }
    </script>
@endsection

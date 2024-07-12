@php use App\Enums\Role; @endphp
@extends('layouts.admin')
@section('title')
    {{ __('home.create') }}
@endsection
@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('home.create') }}</h1>
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div>
        <form>
            <div>
                <label for="username">{{ __('home.Username') }}</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div>
                <label for="member">{{ __('home.Member') }}</label>
                <select id="member" name="member" class="form-select form-control">
                    @if($role->name == 'PHARMACIES' || $role->name == 'PHARMACEUTICAL COMPANIES')
                    <option value="{{ Role::PHAMACISTS }}">Dược sĩ</option>
                        @else
                        <option value="{{ Role::DOCTORS }}">Bác sĩ</option>
                        <option value="{{ Role::PHAMACISTS }}">Dược sĩ</option>
                        <option value="{{ Role::THERAPISTS }}">Bác sĩ trị liệu</option>
                        <option value="{{ Role::ESTHETICIANS }}">Chuyên viên thẩm mỹ</option>
                        <option value="{{ Role::NURSES }}">Y tá</option>
                    @endif
                </select>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div>
                <label for="phone">{{ __('home.PhoneNumber') }}</label>
                <input type="number" class="form-control" id="phone" name="phone">
            </div>
            <div>
                <label for="password">{{ __('home.Password') }}</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div>
                <label for="password_confirm">{{ __('home.Enter the Password') }}</label>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm">
            </div>
{{--            <div>--}}
{{--                <label for="hospital">{{ __('home.Hospital') }}</label>--}}
{{--                <input type="text" class="form-control" id="hospital" name="hospital">--}}
{{--            </div>--}}
            <div>
                <label for="specialty">Chuyên khoa</label>
{{--                <input type="text" class="form-control" id="specialty" name="specialty">--}}
                <select class="form-select" id="specialty" name="specialty">
                    @foreach($departmentClinic as $departmentClinic)
                        <option value="{{$departmentClinic->name}}"> {{$departmentClinic->name}}</option>
                    @endforeach
                </select>
            </div>
            @if($role->name != 'PHARMACIES' || $role->name != 'PHARMACEUTICAL COMPANIES')
            <div>
                <label for="service">{{ __('home.Service Name') }}</label>
{{--                <input type="text" class="form-control" id="service" name="service">--}}
                <select id="service" name="service" class="form-select form-control">
                    @foreach($serviceClinic as $service)
                    <option value="{{ $service->name }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div>
                <label for="year_of_experience">Kinh nghiệm</label>
                <input type="number" class="form-control" id="year_of_experience" name="year_of_experience">
            </div>
            <div>
                <label for="identifier">Mã định danh</label>
                <input type="text" class="form-control" id="identifier" name="identifier">
            </div>
{{--            @php--}}
{{--                $departments = \App\Models\DoctorDepartment::where('status', \App\Enums\DoctorDepartmentStatus::ACTIVE)->get();--}}
{{--            @endphp--}}
{{--            <div>--}}
{{--                <label for="department_id">{{ __('home.Department') }}</label>--}}
{{--                <select class="form-select" id="department_id" name="department_id">--}}
{{--                    @foreach($departments as $department)--}}
{{--                        <option value="{{$department->id}}"> {{$department->name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--            <div>--}}
{{--                <label for="workplace">{{ __('home.Workplace') }}</label>--}}
{{--                <input type="text" class="form-control" id="workplace" name="workplace">--}}
{{--            </div>--}}
        </form>
        <div hidden>
            <label for="manager_id"></label><input type="text" class="form-control" id="manager_id" name="manager_id"
                                                   value="{{Auth::user()->id}}">
        </div>
    </div>
    <button type="button" class="btn btn-primary up-date-button mt-md-4">{{ __('home.Save') }}</button>
    <script>
        $(document).ready(function () {
            $('.up-date-button').on('click', function () {
                createStaff();
            })
        })

        async function createStaff() {
            const headers = {
                'Authorization': `Bearer ${token}`
            };
            const formData = new FormData();

            const arrField = ['username', 'member', 'email', 'phone', 'specialty', 'year_of_experience',
                'identifier', 'password', 'password_confirm', 'manager_id'];

            let isValid = true
            /* Tạo fn appendDataForm ở admin blade*/
            isValid = appendDataForm(arrField, formData, isValid);


            formData.append('_token', '{{ csrf_token() }}');

            if (isValid) {
                try {
                    await $.ajax({
                        url: `{{route('api.backend.staffs.store')}}`,
                        method: 'POST',
                        headers: headers,
                        contentType: false,
                        cache: false,
                        processData: false,
                        data: formData,
                        success: function () {
                            alert('Create success!');
                            window.location.href = `{{route('homeAdmin.list.staff')}}`;
                        },
                        error: function (exception) {
                            alert(exception.responseText);
                        }
                    });
                } catch (error) {
                    alert('Create error!');
                }
            }
        }
    </script>
@endsection

<?php

namespace App\Http\Controllers;

use App\Enums\ClinicStatus;
use App\Enums\CommonType;
use App\Enums\DepartmentStatus;
use App\Enums\DoctorDepartmentStatus;
use App\Enums\ServiceClinicStatus;
use App\Enums\SymptomStatus;
use App\Enums\TypeUser;
use App\Enums\UserStatus;
use App\Http\Controllers\restapi\MainApi;
use App\Models\Clinic;
use App\Models\Department;
use App\Models\DoctorDepartment;
use App\Models\Nation;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\ServiceClinic;
use App\Models\SocialUser;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use QrCode;

class ProfileController extends Controller
{
    public function index()
    {
        $roles = Role::where('name', '!=', \App\Enums\Role::ADMIN)->get();
        $roleUser = DB::table('role_users')->where('user_id', Auth::user()->id)->first();
        $roleItem = Role::find($roleUser->role_id);
        $isAdmin = (new MainController())->checkAdmin();
        $socialUser = SocialUser::where('user_id', Auth::user()->id)->first();
        $nations = Nation::all();
        $doctor = User::where('id', Auth::user()->id)->first();
        $departments = DoctorDepartment::where('status', DoctorDepartmentStatus::ACTIVE)->get();
        $url = route('web.users.my.bookings.detail', Auth::user()->id);
        $qrCodes = QrCode::size(300)->generate($url);
        $clinic = Clinic::where('user_id', Auth::user()->id)->first();
        $services = ServiceClinic::where('status', ServiceClinicStatus::ACTIVE)->get();
        $symptoms = Symptom::where('status', SymptomStatus::ACTIVE)->get();
        $doctorLists = User::where('member', TypeUser::DOCTORS)->get();
        $listDepartments = Department::where('status', DepartmentStatus::ACTIVE)->get();
        return view('profile', compact(
            'roles',
            'roleItem',
            'isAdmin',
            'socialUser',
            'nations',
            'doctor',
            'departments',
            'qrCodes',
            'clinic',
            'services',
            'symptoms',
            'doctorLists',
            'listDepartments',
        ));
    }

    public function infoUser($userId)
    {
        $user = User::find($userId);
        $roleUser = DB::table('role_users')->where('user_id', $userId)->first();
        $role = Role::find($roleUser->role_id);

        $responseData = [
            'infoUser' => $user,
            'roleUser' => $role,
        ];

        return response()->json($responseData);
    }
    public function infoUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        $roleUser = DB::table('role_users')->where('user_id', $user->id)->first();
        $role = Role::find($roleUser->role_id);

        $responseData = [
            'infoUser' => $user,
            'roleUser' => $role,
        ];

        return response()->json($responseData);
    }

    public function getUsersByRoleId($roleId)
    {
        $roleExists = RoleUser::where('role_id', $roleId)->exists();

        if (!$roleExists) {
            return response()->json(['message' => 'Role not found'], 404);
        }

        $userIds = RoleUser::where('role_id', $roleId)->pluck('user_id');

        if ($userIds->isEmpty()) {
            return response()->json(['message' => 'No users found for the given role_id'], 404);
        }

        $users = User::whereIn('id', $userIds)->get();

        $users->map(function ($user) {
            $user->abouts = str_replace(array("\r", "\n"), '', strip_tags(html_entity_decode($user->abouts)));
            $user->abouts_en = str_replace(array("\r", "\n"), '', strip_tags(html_entity_decode($user->abouts_en)));
            $user->abouts_lao = str_replace(array("\r", "\n"), '', strip_tags(html_entity_decode($user->abouts_lao)));
            return $user;
        });

        return response()->json(['users' => $users]);
    }

    public function update(Request $request)
    {
        $translate = new TranslateController();

        $request->validate([
            'username' => 'required|string',
            'name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',

            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',

//            'address_code' => 'required|string|max:255',

            'current_password' => 'nullable',
            'new_password' => 'nullable|min:6|max:12',
            'password_confirmation' => 'nullable|min:6|max:12|required_with:new_password|same:new_password',
            'zalo_app_id' => 'nullable',
            'zalo_secret_id' => 'nullable'
        ]);

        $zaloAppID = $request->input('zalo_app_id') ?? "";
        $zaloSecretID = $request->input('zalo_secret_id') ?? "";

        $username = $request->input('username');

        $user = User::findOrFail(Auth::user()->id);

        if (is_null($user->password)) {
            $request->validate([
                'new_password' => 'required|min:6|max:12'
            ], [
                'new_password.required' => 'Hãy tạo mật khẩu mới cho lần đầu đăng nhập'
            ]);
        }

        $extendData = $user->extend ?? [];

        if ($username != Auth::user()->username) {
            $oldUser = User::where('username', $username)
                ->where('status', '!=', UserStatus::DELETED)
                ->first();
            if ($oldUser) {
                toast('Tên đăng nhập đã tồn tại!', 'error', 'top-left');
                return back();
            }
        }

        $email = $request->input('email');
        $phone = $request->input('phone');
        if ($email != Auth::user()->email) {
            $oldUser = User::where('email', $email)
                ->where('status', '!=', UserStatus::DELETED)
                ->first();
            if ($oldUser) {
                toast('Email đã tồn tại!', 'error', 'top-left');
                return back();
            }
        }

        if ($phone != Auth::user()->phone) {
            $oldUser = User::where('phone', $phone)
                ->where('status', '!=', UserStatus::DELETED)
                ->first();
            if ($oldUser) {
                toast('Số điện thoại đã tồn tại!', 'error', 'top-left');
                return back();
            }
        }

        $user->username = $username;

        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');

        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
//        $user->address_code = $request->input('address_code');

        //        $user->nation_id = $request->input('nation_id');
        $province = $request->input('province_id');
        $district = $request->input('district_id');
        $commune = $request->input('commune_id');
        if ($district == null) {
            return response('Cần cập nhật địa chỉ thành phố', 400);
        }
        if ($commune == null) {
            return response('Cần cập nhật địa chỉ quận/huyện', 400);
        }
        $province_id = explode('-', $province);
        $district_id = explode('-', $district);
        $commune_id = explode('-', $commune);

        $user->province_id = $province_id[0];

        $user->district_id = $district_id[0];
        $user->commune_id = $commune_id[0];
        $user->workplace = $request->input('workplace') ?? '';
        $user->identifier = $request->input('identifier') ?? '';
        $specialty = $request->input('specialty');

        $user->specialty = $specialty;
        $user->specialty_en = $translate->translateText($specialty, 'en');
        $user->specialty_laos = $translate->translateText($specialty, 'lo');


        $detail_address = $request->input('detail_address');
        $user->detail_address = $detail_address;
        $user->detail_address_en = $translate->translateText($detail_address, 'en');
        $user->detail_address_laos = $translate->translateText($detail_address, 'lo');
        $user->year_of_experience = $request->input('year_of_experience');

        $service = $request->input('service');
        $user->service = $service;
        $user->service_en = $translate->translateText($service, 'en');
        $user->service_laos = $translate->translateText($service, 'lo');

        $service_price = $request->input('service_price');
        $user->service_price = $service_price;
        $user->service_price_en = $translate->translateText($service_price, 'en');
        $user->service_price_laos = $translate->translateText($service_price, 'lo');
        $user->time_working_1 = $request->input('time_working_1');
        $user->time_working_2 = $request->input('time_working_2');
        $user->prescription = $request->has('prescription') ? (int)$request->input('prescription') : 0;
        $user->medical_history = $request->input('medical_history');

        $user->free = $request->has('free') ? (int)$request->input('free') : 0;
        if ($request->hasFile('avt')) {
            $item = $request->file('avt');
            $itemPath = $item->store('license', 'public');
            $img = asset('storage/' . $itemPath);
            $user->avt = $img;
        }
        $user->created_by = $request->input('created_by');
        $user->updated_by = Auth::user()->id;
        $user->department_id = $request->input('department_id');
        $user->apply_for = $request->input('apply_for');

        if (Hash::check($request->input('current_password'), $user->password) || $request->input('current_password') == $user->password) {
            $password = $request->input('new_password');
            $passwordHash = Hash::make($password);
            $user->password = $passwordHash;
        } elseif ($request->input('current_password') == null && $request->input('current_password') !== $user->password){}
        else{
            return redirect()->back()->withInput();
        }

        if ($zaloAppID) {
            $extendData['zalo_app_id'] = $zaloAppID;
        }

        if ($zaloSecretID) {
            $extendData['zalo_secret_id'] = $zaloSecretID;
        }

        if ($zaloAppID || $zaloSecretID) {
            $extendData['isActivated'] = false;
        }
        $user->is_check_medical_history = $request->has('is_check_medical_history');

        if ($user->type == 'BUSINESS') {
            $clinic = Clinic::where('user_id', $user->id)->first();

            $gallery = '';

            if ($request->hasFile('gallery')) {
                $galleryPaths = [];

                // Loop through each uploaded file and store it
                foreach ($request->file('gallery') as $image) {
                    $itemPath = $image->store('gallery', 'public');
                    $galleryPaths[] = asset('storage/' . $itemPath);
                }

                // Convert the array of paths to a comma-separated string
                $gallery = implode(',', $galleryPaths);
            } else if ($clinic) {
                // If no new files are uploaded, use the existing gallery
                $gallery = $clinic->gallery;
            }
            $nation_id = $request->input('nation_id');
            $province_id = $request->input('province_id');
            $district_id = $request->input('district_id');
            $commune_id = $request->input('commune_id');
            $address = [
                'nation_id' => $nation_id,
                'province_id' => $province_id,
                'district_id' => $district_id,
                'commune_id' => $commune_id
            ];
            Clinic::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => $request->input('name'),
                    'address_detail' => $request->input('detail_address'),
                    'experience' => $request->input('experienceHospital'),
                    'introduce' => $request->input('introduce'),
                    'gallery' => $gallery,
                    'email' => $request->input('email'),
                    'time_work' => $request->input('time_work'),
                    'status' => $request->input('status', 'ACTIVE'),
                    'type' =>$request->input('type'),
                    'open_date' => $request->input('open_date'),
                    'close_date' => $request->input('close_date'),
                    'service_id' => $request->input('clinics_service'),
                    'department' => $request->input('departments'),
                    'symptom' => $request->input('symptoms'),
                    'emergency' => $request->has('emergency'),
                    'insurance' => $request->has('insurance'),
                    'parking' => $request->has('parking'),
                    'information' => $request->input('hospital_information'),
                    'facilities' => $request->input('hospital_facilities'),
                    'equipment' => $request->input('hospital_equipment'),
                    'costs' => $request->input('costs'),
                    'representative_doctor' => $request->input('representative_doctor', ''),
                    'address' => $address,
                ]
            );
        }
        $user->extend = $extendData;
        $user->status = ClinicStatus::ACTIVE;
        $user->save();
        session()->forget('show_modal');
        toast('Cập nhật thông tin thành công!', 'success', 'top-left');
        return redirect()->route('profile');
    }

    public function handleForgetPassword(Request $request)
    {
        $type = $request->input('type');
        $value = $request->input('value');

        switch ($type) {
            case CommonType::EMAIL:
                $validator = Validator::make(['email' => $value], [
                    'email' => 'required|email',
                ]);

                if ($validator->fails()) {
                    return response()->json((new MainApi())->returnMessage('Invalid email format.'), 400);
                }

                $user = User::where('email', $value)->first();

                if (!$user) {
                    return response()->json((new MainApi())->returnMessage('Không tìm thấy user'), 400);
                }

                $sendMail = $this->sendOTPEmail($value, $user);

                if (!$sendMail) {
                    return response()->json((new MainApi())->returnMessage('Gửi mã OTP thất bại, thử lại'), 400);
                }

                return response()->json((new MainApi())->returnMessage('Gửi mã OTP thành công'), 200);
                break;
            case CommonType::PHONE:
                $validator = Validator::make(['phone' => $value], [
                    'phone' => 'required|numeric|min:8',
                ]);

                if ($validator->fails()) {
                    return response()->json((new MainApi())->returnMessage('Invalid phone format.'), 400);
                }

                $user = User::where('phone', $value)->first();

                if (!$user) {
                    return response()->json((new MainApi())->returnMessage('Không tìm thấy user'), 400);
                }

                $sendOTP = $this->sendOTPSMS($value, $user);

                if ($sendOTP) {
                    return response()->json((new MainApi())->returnMessage('Gửi mã OTP thành công'), 200);
                } else {
                    return response()->json((new MainApi())->returnMessage('Gửi mã OTP thất bại, thử lại'), 400);
                }
                break;

            default:
                return response()->json((new MainApi())->returnMessage('Lỗi, thử lại'), 400);
        }
    }

    private function sendOTPEmail($value, $user)
    {
        $otp = random_int(100000, 999999);
        $content = "Mã OTP của bạn là: " . $otp;

        // lưu cache otp 5 phút
        $key = 'otp_' . $user->id;
        $expiresAt = now()->addMinutes(5);
        Cache::put($key, $otp, $expiresAt);

        $mailFrom = 'support.il.vietnam@gmail.com';
        $tieuDe = 'Mã OTP';
        $content = 'Mã OTP của bạn là: ' . $otp;

        (new MailController())->sendEmail($value, $mailFrom, $tieuDe, $content);

        return true;
    }

    private function sendOTPSMS($value, $user)
    {
        $sms = new SendSMSController();
        $otp = random_int(100000, 999999);
        $content = "Ma OTP dang ky tai khoan IL VIETNAM cua ban la: " . $otp;

        // lưu cache otp 5 phút
        $key = 'otp_' . $user->id;
        $expiresAt = now()->addMinutes(5);
        Cache::put($key, $otp, $expiresAt);

        return $sms->sendSMS($user->id, $value, $content);
    }

    public function checkValidOTP(Request $request)
    {
        $otp = $request->input('otp');
        $type = $request->input('type');
        $value = $request->input('value');

        $user = null;

        if ($type == CommonType::PHONE) {
            $user = User::where('phone', $value)->first();
        } else {
            if ($type == CommonType::EMAIL) {
                $user = User::where('email', $value)->first();
            }
        }

        if (!$user) {
            return response()->json((new MainApi())->returnMessage('Không tìm thấy user'), 400);
        }

        //check otp với cache

        $key = 'otp_' . $user->id;
        $otpCache = Cache::get($key);

        if (!$otpCache) {
            return response()->json((new MainApi())->returnMessage('OTP hết hạn, thao tác lại'), 400);
        }

        if ($otpCache != $otp) {
            return response()->json((new MainApi())->returnMessage('OTP sai'), 400);
        }
        Cache::forget($key);

        return response()->json((new MainApi())->returnMessage('OTP hợp lệ'), 200);
    }

    public function changePassword(Request $request)
    {
        $type = $request->input('type');
        $value = $request->input('value');
        $password = $request->input('password');
        $rePassword = $request->input('rePassword');

        if ($password != $rePassword) {
            return response()->json((new MainApi())->returnMessage('Mật khẩu không trùng khớp'), 400);
        }

        $user = null;

        if ($type == CommonType::PHONE) {
            $user = User::where('phone', $value)->first();
        } else {
            if ($type == CommonType::EMAIL) {
                $user = User::where('email', $value)->first();
            }
        }

        if (!$user) {
            return response()->json((new MainApi())->returnMessage('Không tìm thấy user'), 400);
        }

        $user->password = Hash::make($password);
        $user->save();

        return response()->json((new MainApi())->returnMessage('Đổi mật khẩu thành công'), 200);
    }


    public function checkOTP(Request $request)
    {
        $type = $request->input('type');
        $value = $request->input('value');
        $otp = $request->input('otp');
        $password = $request->input('password');
        $rePassword = $request->input('rePassword');

        if ($password != $rePassword) {
            return response()->json('Mật khẩu không trùng khớp', 400);
        }

        $user = null;

        if ($type == CommonType::PHONE) {
            $user = User::where('phone', $value)->first();
        } else {
            if ($type == CommonType::EMAIL) {
                $user = User::where('email', $value)->first();
            }
        }

        if (!$user) {
            return response()->json('Không tìm thấy user', 400);
        }

        //check otp với cache

        $key = 'otp_' . $user->id;
        $otpCache = Cache::get($key);

        if (!$otpCache) {
            return response()->json('OTP hết hạn, thao tác lại', 422);
        }

        if ($otpCache != $otp) {
            return response()->json('OTP sai', 422);
        }

        $user->password = Hash::make($password);
        $user->save();
        Cache::forget($key);

        return response()->json('Đổi mật khẩu thành công', 200);
    }

    public function getUsersWithMember(Request $request, $member)
    {
        $name = $request->input('name');

        $users = User::where('member', $member)->where('name', 'LIKE', '%' . $name . '%')->get();

        $data = $users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
            ];
        });

        return response()->json($data);
    }
}

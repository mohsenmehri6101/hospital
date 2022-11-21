<?php

if (!function_exists('GtoJ')) {
    function GtoJ($GDate = null, $Format = "Y/m/d-H:i", $convert = true)
    {
        try {
            if ($GDate == '-0001-11-30 00:00:00' || is_null($GDate)) {
                return '--/--/----';
            }
            $date = new \App\Helper\jDateTime($convert, true, 'Asia/Tehran');
            $time = is_numeric($GDate) ? strtotime(date('Y-m-d H:i:s', $GDate)) : strtotime($GDate);
            return $date->date($Format, $time);
        } catch (\Exception $exception) {
            return $GDate;
        }
    }
}

if (!function_exists('JtoG')) {
    function JtoG($jDate, $delimiter = '/', $to_string = false, $with_time = false, $input_format = 'Y/m/d H:i:s'): array|string
    {
        try {
            $jDate = convert_numbers_persian_to_english($jDate);
            $parseDateTime = \App\Helper\jDateTime::parseFromFormat($input_format, $jDate);
            $r = \App\Helper\jDateTime::toGregorian($parseDateTime['year'], $parseDateTime['month'], $parseDateTime['day']);
            if ($to_string) {
                $year_m_d_str = $r[0] . $delimiter . str_pad($r[1], 2, '0', STR_PAD_LEFT) . $delimiter . str_pad($r[2], 2, '0', STR_PAD_LEFT);
                if ($with_time) {
                    $r = $year_m_d_str . ' ' . $parseDateTime['hour'] . ':' . $parseDateTime['minute'] . ':' . $parseDateTime['second'];
                } else {
                    $r = $year_m_d_str;
                }
            }

            return ($r);
        } catch (\Exception $exception) {
            return $jDate;
        }
    }
}

if (!function_exists('convert_numbers_persian_to_english')) {
    function convert_numbers_persian_to_english($matches): array|string
    {
        $farsi_array = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english_array = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($farsi_array, $english_array, $matches);
    }
}

if (!function_exists('mobile')) {
    function mobile(string $mobile): bool|int
    {
        return (bool)preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $value) || (bool)preg_match('/^(9){1}[0-9]{9}+$/', $value);
        // return preg_match('/(09)[0-9]{9}/', $mobile);
    }
}

if (!function_exists('password')) {
    function password(string $password): bool|int
    {
        return preg_match('/(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/', $password);
    }
}

if (!function_exists('telephone')) {
    function telephone(string $telephone): bool|int
    {
        return preg_match('/(0)[0-9]{9}/', $telephone);
    }
}

if (!function_exists('persianString')) {
    function persianString(string $persianString): bool|int
    {
        return preg_match('/^[پچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژؤآإأء\s0-9]+$/', $persianString);
    }
}

if (!function_exists('format_time')) {
    function format_time(string $time): bool|int
    {
        return true;
        // return preg_match('/^[پچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژؤآإأء\s0-9]+$/', $persianString);
    }
}

if (!function_exists('englishString')) {
    function englishString(string $englishString): bool|int
    {
        return preg_match('/^[ a-zA-Z0-9_.-]*$/', $englishString);
    }
}

if (!function_exists('validateUrl')) {
    function validateUrl(string $validateUrl): bool|int
    {
        return preg_match("/(?i)\b((?:https?://|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/", $validateUrl);
    }
}

if (!function_exists('response')) {
    function response($message = '', $status = 200, $data = [], $errors = []): \Illuminate\Http\JsonResponse
    {
        $response = [];
        $response['message'] = $message;
        $response['errors'] = $errors;
        $response['data'] = $data;
        $response['status'] = $status;

        return response()->json($response, $status);
    }
}

if (!function_exists('set_user_creator')) {
    function set_user_creator()
    {
        return auth()?->user()?->id ?? null;
    }
}

if (!function_exists('login_user_test')) {
    function login_user_test($user = null)
    {
        /** @var \App\Models\User $user_login */
        $user_login = null;
        if ($user instanceof \App\Models\User) {
            $user_login = $user;
        } elseif (is_int($user)) {
            $user_login = \App\Models\User::query()->findOrFail($user);
        } else {
            $user_login = \App\Models\User::query()->firstOrCreate(['username' => 'mohsen6101',
                'mobile' => '09366246101'], [
                'first_name' => 'محسن',
                'last_name' => 'مهری',
                'email' => 'mohsen.mehri6101@gmail.com',
                'password' => \Illuminate\Support\Facades\Hash::make('09366246101'),
                'username' => 'mohsen6101',
                'mobile' => '09366246101',
            ]);
            // get all Permissions
            $permissions = \Spatie\Permission\Models\Permission::query()->get()->pluck('id')?->toArray() ?? [];
            /** @var \Spatie\Permission\Models\Role $role_super_admin */
            $role_super_admin = \Spatie\Permission\Models\Role::query()->where('name', \App\Models\Enums\RoleEnum::super_admin->value)->first();
            $role_super_admin->syncPermissions($permissions);
            $user_login->assignRole($role_super_admin);
            // set all permissions for user
        }
        auth()->setUser($user_login);
    }
}

// responses
if (!function_exists('response_default')) {
    function response_default($data = [], $message = '', $status = 200, $errors = []): \Illuminate\Http\JsonResponse
    {
        if (filled($message) && array_key_exists($message, __('custom.defaults'))) {
            $message = __("custom.defaults.$message");
        }

        $response = [];
        $response['message'] = $message ?? '';
        $response['errors'] = $errors;
        $response['data'] = $data;
        $response['status'] = $status;


        return response()->json($response, $status);
    }
}

if (!function_exists('response_show')) {
    function response_show($data = [], $message = '', $status = 200, $errors = []): \Illuminate\Http\JsonResponse
    {
        $message = filled($message) ? $message : __('custom.defaults.show_success');
        return response_default(data: $data, message: $message, status: $status, errors: $errors);
    }
}


if (!function_exists('response_standard')) {
    function response_standard($data = [], $message = '', $status = 200, $errors = []): \Illuminate\Http\JsonResponse
    {
        $message = filled($message) ? $message : __('custom.defaults.success');
        return response_default(data: $data, message: $message, status: $status, errors: $errors);
    }
}

if (!function_exists('response_catch')) {
    function response_catch($message = '', $status = 500, $data = [], $errors = [], Throwable $exception = null): \Illuminate\Http\JsonResponse
    {
        $message = filled($message) ? $message : __('custom.defaults.failed');
        return response_default(data: $data, message: $message, status: $status, errors: $errors);
    }
}

if (!function_exists('response_failed')) {
    function response_failed($message = '', $status = 500, $data = [], $errors = [], Throwable $exception = null): \Illuminate\Http\JsonResponse
    {
        $message = filled($message) ? $message : __('custom.defaults.failed');
        return response_default(data: $data, message: $message, status: $status, errors: $errors);
    }
}
if (!function_exists('response_not_found')) {
    function response_not_found($message = '', $status = null, $data = [], $errors = [], Throwable $exception = null): \Illuminate\Http\JsonResponse
    {
        $status = $status ?? \Symfony\Component\HttpFoundation\Response::HTTP_NOT_FOUND;
        $message = filled($message) ? $message : __('custom.defaults.not_found');
        return response_default(data: $data, message: $message, status: $status, errors: $errors);
    }
}

if (!function_exists('get_user_loggined')) {
    function get_user_loggined(): ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return auth()->user() ?? null;
    }
}

if (!function_exists('permission_check')) {
    function permission_check(string $permission, \App\Models\User|null $user = null): bool
    {
        /** @var \App\Models\User $user */
        $user = $user ?? auth()->user() ?? null;
        return $user
            && (
                $user->hasPermissionTo($permission)
                ||
                $user->roles()->hasPermissionTo($permission)
            );
    }
}

if (!function_exists('role_check')) {
    function role_check(string $permission, \App\Models\User|null $user = null): bool
    {
        /** @var \App\Models\User $user */
        $user = $user ?? auth()->user() ?? null;
        return $user->roles()->hasPermissionTo($permission);
    }
}

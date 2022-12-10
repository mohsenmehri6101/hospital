<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomFormRequest extends FormRequest
{
    public function __construct(array $query = [], array $request = [], array $attributes = [], array $cookies = [], array $files = [], array $server = [], $content = null)
    {
        $this->set_validator();
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);
    }

    public function set_validator()
    {
        # censorship
        Validator::extend('censorship', function ($attribute, $timeValue, $parameters) {
            // سانسور حرف های رکیک و زشت
            return true;
        }, "قالب :attribute شما نادرست است");
        # likes
        Validator::extend('likes', function ($attribute, $value, $parameters) {
            $table_name = $parameters[0];
            $column_name = $parameters[1];
            return DB::table($table_name)
                    ->where($column_name, 'like', '%' . $value . '%')
                    ->count() > 0;
        }, "مقدار :attribute معتبر نیست");
        # mobile
        Validator::extend('mobile', function ($attribute, $mobileValue, $parameters) {
            return mobile($mobileValue);
        }, "قالب :attribute شما نادرست است");
        # telephone
        Validator::extend('telephone', function ($attribute, $telephoneValue, $parameters) {
            return telephone($telephoneValue);
        }, "قالب :attribute شما نادرست است");
        # persian_string
        Validator::extend('persian_string', function ($attribute, $persianStringValue, $parameters) {
            return persianString($persianStringValue);
        }, "قالب :attribute شما نادرست است");
        # english_string
        Validator::extend('english_string', function ($attribute, $englishStringValue, $parameters) {
            return englishString($englishStringValue);
        }, "قالب :attribute شما نادرست است");
        # validateUrl
        Validator::extend('validateUrl', function ($attribute, $validateUrlValue, $parameters) {
            return validateUrl($validateUrlValue);
        }, "قالب :attribute شما نادرست است");
    }
}

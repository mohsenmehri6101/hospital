<?php

namespace App\Http\Requests\Language;

use App\Http\Requests\CustomFormRequest;

class LanguageStoreRequest extends CustomFormRequest
{
    public function authorize(): bool
    {
        return permission_check(\App\Models\Enums\PermissionEnum::language_store->value);
    }

    public function rules(): array
    {
        return [
            'name_english' => 'required|filled|english_string|unique:languages,name_english',
            'name_persian' => 'required|filled|persian_string',
        ];
    }

    public function attributes(): array
    {
        return [
            'id' => __('custom.languages.id'),
            'name_english' => __('custom.languages.name_english'),
            'name_persian' => __('custom.languages.name_persian'),
        ];
    }
}

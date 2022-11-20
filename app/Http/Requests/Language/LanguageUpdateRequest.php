<?php

namespace App\Http\Requests\Language;

use App\Http\Requests\CustomFormRequest;

class LanguageUpdateRequest extends CustomFormRequest
{
    public function authorize(): bool
    {
        return permission_check(\App\Models\Enums\PermissionEnum::language_update->value);
    }

    public function rules(): array
    {
        return [
            'name_english' => 'nullable|english_string',
            'name_persian' => 'nullable|persian_string',
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

<?php

namespace App\Http\Requests\Language;

use App\Http\Requests\CustomFormRequest;
use App\Models\Enums\PermissionEnum;

class LanguageIndexRequest extends CustomFormRequest
{
    public function authorize(): bool
    {
        return permission_check(PermissionEnum::language_index->value);
    }

    public function rules(): array
    {
        return [
            'id' => 'nullable',
            'name_english' => 'nullable',
            'name_persian' => 'nullable',
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

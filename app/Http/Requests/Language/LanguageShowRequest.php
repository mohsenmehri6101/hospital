<?php

namespace App\Http\Requests\Language;

use App\Http\Requests\CustomFormRequest;

class LanguageShowRequest extends CustomFormRequest
{
    public function authorize(): bool
    {
        return permission_check(\App\Models\Enums\PermissionEnum::language_show->value);
    }

    public function rules(): array
    {
        return [
            '*' => 'required|exists:languages,id',
        ];
    }

    public function attributes()
    {
        return [
            '*' => 'شناسه',
        ];
    }
}

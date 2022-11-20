<?php

namespace App\Models\Enums;

enum PermissionEnum: string
{
    # permission languages
    case language_index = 'language_index';
    case language_store = 'language_store';
    case language_show = 'language_show';
    case language_update = 'language_update';
    case language_destroy = 'language_destroy';
}

<?php

namespace App\Models\Enums;

enum RoleEnum: string
{
    case super_admin = 'super_admin';/* super_admin */
    case admin = 'admin';/* admin */
    case translator = 'translator';/* مترجم */
    case patient = 'patient';/* بیمار */
    case clerk = 'clerk';/* کارمند */
}

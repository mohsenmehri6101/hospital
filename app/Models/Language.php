<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    const ActiveState=1;
    const DisableState=0;

    protected $fillable = ['name_english', 'name_persian'];
}

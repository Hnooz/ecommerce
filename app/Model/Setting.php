<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    protected $table = 'settings';

    protected $fillable = [
        'sitename_en',
        'sitename_ar',
        'logo',
        'icon',
        'email',
        'description',
        'keywords',
        'status',
        'message_mintenance',
        'main_lang',
    ];
}
<?php

namespace Modules\Sms\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmsSablon extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'sms_sablon';

    protected static function newFactory()
    {
        return \Modules\Sms\Database\factories\SmsSablonFactory::new();
    }
}

<?php

namespace Modules\IK\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IzinKurallari extends Model
{
    use HasFactory;

    protected $guarded  = [];
    protected $table    = 'izin_kurallari';

    public $timestamps  = false;

    protected static function newFactory()
    {
        return \Modules\IK\Database\factories\IzinKurallariFactory::new();
    }
}

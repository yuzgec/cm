<?php

namespace Modules\CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IcraMudurlugu extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\CallCenter\Database\factories\IcraMudurluguFactory::new();
    }
}

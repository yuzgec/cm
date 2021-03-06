<?php

namespace Modules\CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SmsSablon extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = $TABLE$;
    
    protected static function newFactory()
    {
        return \Modules\CallCenter\Database\factories\SmsSablonFactory::new();
    }
}

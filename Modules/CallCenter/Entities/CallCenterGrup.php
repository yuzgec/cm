<?php

namespace Modules\CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CallCenterGrup extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'call_center_grup';

    protected static function newFactory()
    {
        return \Modules\CallCenter\Database\factories\CallCenterGrupFactory::new();
    }
}

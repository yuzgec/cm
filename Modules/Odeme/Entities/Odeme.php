<?php

namespace Modules\Odeme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Odeme extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = $TABLE$;
    
    protected static function newFactory()
    {
        return \Modules\Odeme\Database\factories\OdemeFactory::new();
    }
}

<?php

namespace Modules\CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosya extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "dosyalar";

    protected static function newFactory()
    {
        return \Modules\CallCenter\Database\factories\DosyaFactory::new();
    }
}

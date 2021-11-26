<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Puantaj extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "personel_puantaj";

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\PuantajFactory::new();
    }
}

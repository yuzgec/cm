<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonelBilgileri extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'personel_bilgileri';

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\PersonelBilgileriFactory::new();
    }
}

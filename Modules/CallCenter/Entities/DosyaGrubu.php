<?php

namespace Modules\CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DosyaGrubu extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\CallCenter\Database\factories\DosyaGrubuFactory::new();
    }

    public function dosya(){
        return $this->hasMany(Dosya::class, 'grup');
    }
}

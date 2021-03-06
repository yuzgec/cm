<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Puantaj extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "personel_puantaj";
    protected $dates = [
        "mesai_giris","mesai_cikis","gun"
    ];

    public function getUser(){
        return $this->hasOne(Personel::class, 'id', 'user_id');
    }

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\PuantajFactory::new();
    }
}

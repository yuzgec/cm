<?php

namespace Modules\Kullanici\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SicilRemote extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = "personeldb";
    protected $table = "sicil";

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\SicilRemoteFactory::new();
    }
}

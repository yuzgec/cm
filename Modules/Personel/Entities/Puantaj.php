<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Puantaj extends Model
{
    use HasFactory;
    use QueryCacheable;

    protected $guarded = [];
    protected $table = "personel_puantaj";
    protected $cacheFor = 60*60*24;

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\PuantajFactory::new();
    }
}

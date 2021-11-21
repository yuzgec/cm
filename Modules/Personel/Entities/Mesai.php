<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mesai extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'mesai';

    public $timestamps  = false;
        
    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\MesaiFactory::new();
    }
}

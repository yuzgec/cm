<?php

namespace Modules\IK\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Varyant extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'varyant';

    public $timestamps = false;

    protected static function newFactory()
    {
        return \Modules\IK\Database\factories\VaryantFactory::new();
    }
}

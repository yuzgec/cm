<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitoring extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = "personeldb";
    protected $table = "monitoring";

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\MonitoringFactory::new();
    }
}

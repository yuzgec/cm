<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Monitoring extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "monitoring";
    protected $dates = [
        "Eventtime" => "datetime"
    ];

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\MonitoringFactory::new();
    }
}

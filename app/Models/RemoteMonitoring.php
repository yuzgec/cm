<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemoteMonitoring extends Model
{
    use HasFactory;
    protected $connection = "monitoringdb";
    protected $table = "monitoring";
    protected $primaryKey = "ID";
}

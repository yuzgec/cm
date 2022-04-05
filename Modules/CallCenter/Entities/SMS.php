<?php

namespace Modules\CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SMS extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "sms";


}

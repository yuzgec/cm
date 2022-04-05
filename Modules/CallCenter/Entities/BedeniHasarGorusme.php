<?php

namespace Modules\CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BedeniHasarGorusme extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "bedeni_hasar_gorusmes";
    
}

<?php

namespace Modules\Odeme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BinList extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "binlist";
    public $timestamps = false;

}

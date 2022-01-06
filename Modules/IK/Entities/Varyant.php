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

    //Alt Kategori Sayısı
    public function sub(){
        return $this->hasMany(SELF::class, 'parent_id', 'id')->with('sub');
    }

    protected static function newFactory()
    {
        return \Modules\IK\Database\factories\VaryantFactory::new();
    }
}

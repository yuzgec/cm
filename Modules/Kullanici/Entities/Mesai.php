<?php

namespace Modules\Kullanici\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mesai extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'mesai';
    public $timestamps  = false;

    public function mesaiyoneticisi(){
        return $this->hasOne('Modules\Personel\Entities\Personel', 'remote_id', 'mesai_yonetici');
    }

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\MesaiFactory::new();
    }
}

<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Personel extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'personel';


    public function mesai()
    {
        return $this->hasOne('Modules\Personel\Entities\Mesai', 'id', 'mesai_id');
    }
    
    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\PersonelFactory::new();
    }
}

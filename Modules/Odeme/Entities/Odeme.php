<?php

namespace Modules\Odeme\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Odeme extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'odeme';

    protected static function newFactory()
    {
        return \Modules\Odeme\Database\factories\OdemeFactory::new();
    }

    public function getPersonel(){
        return $this->hasOne('Modules\Personel\Entities\Personel', 'id', 'personel_id');
    }
}

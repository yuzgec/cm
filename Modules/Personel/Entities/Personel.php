<?php

namespace Modules\Personel\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Personel extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];
    protected $table = 'personel';


    public function mesai()
    {
        return $this->hasOne('Modules\Personel\Entities\Mesai', 'id', 'mesai_id');
    }
    public function Monitoring(){
        return $this->hasMany(Monitoring::class, 'UserID', 'remote_id');
    }
    public function Puantaj(){
        return $this->belongsTo(Puantaj::class,'user_id', 'id');
    }

    //Personel Bilgilerini Çeker
    public function Bilgiler(){
        return $this->belongsTo(PersonelBilgileri::class, 'id', 'personel_id');
    }

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\PersonelFactory::new();
    }

}

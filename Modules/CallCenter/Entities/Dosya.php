<?php

namespace Modules\CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosya extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "dosyalar";

    protected static function newFactory()
    {
        return \Modules\CallCenter\Database\factories\DosyaFactory::new();
    }

    public function grubu(){
        return $this->belongsTo(DosyaGrubu::class, 'grup');
    }
    public function alacakli(){
        return $this->belongsTo(Alacakli::class);
    }
    public function borclu(){
        return $this->belongsTo(Borclu::class);
    }
    public function durum(){
        return $this->belongsTo(FoyDurumu::class, 'foy_durumu');
    }
}

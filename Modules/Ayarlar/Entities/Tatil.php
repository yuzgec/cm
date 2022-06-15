<?php

namespace Modules\Ayarlar\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tatil extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "tatiller";

    protected $casts = [
        "baslangic" => "date",
        "bitis" => "date"
    ];
    protected $appends = [
        "gun"
    ];

    public function getGunAttribute(){
        return $this->baslangic->diffInDays($this->bitis);
    }
}

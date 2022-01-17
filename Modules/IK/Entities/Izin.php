<?php

namespace Modules\IK\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izin extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "izinler";

    protected $casts = [
        "onaylar" => "json",
        "baslangic" => "datetime",
        "bitis" => "datetime",
        "donus" => "datetime",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getIzinTuruAttribute(){
        switch ($this->tur){
            case 1: return "Yıllık İzin";
        }
    }

}
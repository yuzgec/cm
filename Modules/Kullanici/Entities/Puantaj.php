<?php

namespace Modules\Kullanici\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Rennokki\QueryCache\Traits\QueryCacheable;

class Puantaj extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "personel_puantaj";
    protected $dates = [
        "mesai_giris","mesai_cikis","gun"
    ];

    public function user(){
        return $this->hasOne(User::class, 'id','user_id');
    }
}

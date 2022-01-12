<?php

namespace Modules\Ayarlar\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unvan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "unvanlar";

    public function Yetkili(){
        return $this->belongsTo(User::class, 'yonetici');
    }
    public function Departman(){
        return $this->belongsTo(Departman::class);
    }
}

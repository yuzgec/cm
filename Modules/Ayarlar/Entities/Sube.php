<?php

namespace Modules\Ayarlar\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sube extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "subeler";

    public function Yetkili(){
        return $this->belongsTo(User::class, 'yonetici');
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'model_has_subeler',
            'sube_id',
            'user_id'
        );
    }

}

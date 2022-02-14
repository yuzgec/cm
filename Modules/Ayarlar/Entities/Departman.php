<?php

namespace Modules\Ayarlar\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Departman extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "departmanlar";
    protected $casts = [
        "mesai" => "array"
    ];
    public function Yetkili(){
        return $this->belongsTo(User::class, 'yonetici');
    }
    public function Sube(){
        return $this->belongsTo(Sube::class);
    }
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'model_has_departmanlar',
            'departman_id',
            'user_id'
        );
    }
}

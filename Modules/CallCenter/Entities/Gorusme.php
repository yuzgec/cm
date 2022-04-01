<?php

namespace Modules\CallCenter\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gorusme extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = "gorusmeler";

    public function Personel(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

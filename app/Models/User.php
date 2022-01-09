<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Personel\Entities\Monitoring;
use Modules\Personel\Entities\PersonelBilgileri;
use Modules\Personel\Entities\Puantaj;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'profil_foto',
    ];

    protected $hidden = [ 'password','remember_token', ];
    protected $casts = [ 'email_verified_at' => 'datetime',];

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
        return $this->belongsTo(PersonelBilgileri::class, 'id', 'user_id');
    }
}

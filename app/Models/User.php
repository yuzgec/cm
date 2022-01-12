<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Ayarlar\Entities\Departman;
use Modules\Ayarlar\Entities\Sube;
use Modules\IK\Entities\Izin;
use Modules\Personel\Entities\Mesai;
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
        'last_name',
        'email',
        'telefon',
        'tckn',
        'password',
    ];

    protected $hidden = [ 'password','remember_token', ];
    protected $casts = [ 'email_verified_at' => 'datetime',];

    public function getFullNameAttribute(){
        return $this->name." ".$this->last_name;
    }
    public function mesai(){
        return $this->belongsTo(Mesai::class);
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

    public function departman(): BelongsToMany
    {
        return $this->belongsToMany(
            Departman::class,
            'model_has_departmanlar',
            'user_id',
            'departman_id'
        );
    }
    public function sube(): BelongsToMany
    {
        return $this->belongsToMany(
            Sube::class,
            'model_has_subeler',
            'user_id',
            'sube_id'
        );
    }
    public function getProfilePhotoAttribute(){
        if(!$this->getFirstMediaUrl())
            return mb_substr($this->name,0,1,"UTF-8").mb_substr($this->last_name,0,1,"UTF-8");
    }
    public function getAvatarAttribute(){
        $renk = $this->departman()->first()->renk;
        $styles = "background: " . $renk . " linear-gradient(135deg,hsla(0,0%,20%,.4), ".$renk.");";
        $styles.= "background-image: url(".$this->getFirstMediaUrl().");";
        $styles.= "background-size: cover;";
        $styles.= "border: 2px solid " . $renk.";";
        $tmp = '<span class="avatar me-2 text-white" style="'.$styles.'" title="'.$this->full_name.'">';
        $tmp.= $this->profile_photo;
        $tmp.= '</span>';
        return $tmp;
    }
    public function izinler()
    {
        return $this->hasMany(
            Izin::class,
            'user_id',
            'id'
        );
    }
}

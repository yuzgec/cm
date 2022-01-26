<?php

namespace Modules\Personel\Entities;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PersonelBilgileri extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'personel_bilgileri';
    protected $dates = [];
    protected $casts = [
        "ise_baslama_tarihi" => "date",
        "dogum_tarihi" => "date",
        "sozlesme_bitis_tarihi" => "date",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function getUpcomingBirthDays(){
        $date = Carbon::now();
        return PersonelBilgileri::query()->whereMonth('dogum_tarihi', '>', $date->month)
            ->whereRaw('CONCAT(YEAR(NOW()),"-",MONTH(dogum_tarihi),"-",DAY(dogum_tarihi)) > NOW()')->get();
    }
    public function setIseBaslamaTarihiAttribute($value){
        $this->attributes["ise_baslama_tarihi"] = Carbon::parse($value)->format('Y-m-d');
    }
    public function setSozlesmeBitisTarihiAttribute($value){
        $this->attributes["sozlesme_bitis_tarihi"] = Carbon::parse($value)->format('Y-m-d');
    }
    public function setDogumTarihiAttribute($value){
        $this->attributes["dogum_Tarihi"] = Carbon::parse($value)->format('Y-m-d');
    }
}

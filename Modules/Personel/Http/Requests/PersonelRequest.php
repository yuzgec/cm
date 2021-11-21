<?php

namespace Modules\Personel\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonelRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'adsoyad'               => 'required|min:4|max:75,'.$this->id,
            'foto'                  => 'mimes:jpeg,gif,png,jpg',
            'telefon'               => 'required|numeric|min:10',
            'email'                 => 'required|email',
            'mesai_id'              => 'required',
            
        ];
    }
    
    public function messages()
    {
        return [
            'adsoyad.required'       => 'Personel Adı ve Soyadını giriniz',
            'mesai_id.required'      => 'Personel Grubu Seçilmelidir',
            'adsoyad.max'            => 'Personel Adı en fazla 75 karakter olabilir',
            'adsoyad.min'            => 'Personel Adı en az 4 karakter olabilir',
            'telefon.required'       => 'Telefon Numarası Giriniz',
            'telefon.min'            => 'Telefon Numarası en az 10 karakter olmalıdır',
            'telefon.numeric'        => 'Telefon Numarası sadece rakamlardan oluşmalıdır',
            'email.required'         => 'Personel Email giriniz',
            'email.email'            => 'Email alanına girilen e-posta adresi geçersiz.',
            'foto.mimes'             => 'Personel Fotoğraf dosya biçimi jpeg, gif, png, jpg olmalıdır',
        ];
    }
}

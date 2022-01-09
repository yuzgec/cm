<?php

namespace Modules\Kullanici\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserListRemote extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $connection = "personeldb";
    protected $table = "user_list";

    protected static function newFactory()
    {
        return \Modules\Personel\Database\factories\UserListRemoteFactory::new();
    }
}

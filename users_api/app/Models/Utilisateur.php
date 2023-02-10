<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model
{
    //
    protected $fillable=[
        'photo','first_name', 'last_name','email','password'
    ];
}

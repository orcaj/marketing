<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'ext', 'type', 'client_id'];

    public function getClient()
    {
        return $this->hasOne('App\Models\User', 'id', 'client_id');
    }

    public function getFullNameAttribute()
    {
        return $this->name . "." . $this->ext;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'client_id', 'name', 'ext', 'type'];

    public function getClient()
    {
        return $this->hasOne('App\Models\User', 'id', 'client_id');
    }

    public function getFullNameAttribute()
    {
        return $this->name . "." . $this->ext;
    }
}

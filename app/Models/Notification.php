<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable=['type', 'client_id', 'status','content'];

    public function client(){
        return $this->hasOne('App\Models\User','id', 'client_id');
    }
}

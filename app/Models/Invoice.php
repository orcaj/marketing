<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_id', 'billing_name', 'amount', 'status', 'user_id', 'client_id', 'type'];

    public function getClient()
    {
        return $this->hasOne('App\Models\User', 'id', 'client_id');
    }

    public function getFullNameAttribute()
    {
        return $this->billing_name . "." . $this->type;
    }
}

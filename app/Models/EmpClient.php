<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpClient extends Model
{
    use HasFactory;
    protected $fillable=['emp_id', 'client_id'];
}

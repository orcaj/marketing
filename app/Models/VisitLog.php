<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitLog extends Model
{
    use HasFactory;
    protected $fillable=['ip', 'mac', 'country', 'location', 'code', 'active'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;

    protected $table = 'currency';

    protected $fillable = ['name', 'rate', 'num_code', 'char_code', 'nominal', 'cbr_rate'];
}

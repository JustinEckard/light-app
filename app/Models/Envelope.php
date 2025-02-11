<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envelope extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'budgeted_amount', 'spent_amount']; // Add this line
}

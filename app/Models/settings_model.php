<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class settings_model extends Model
{
    use HasFactory;
    protected $table = "settings";
    protected $primaryKey ="id";
}
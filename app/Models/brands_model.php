<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brands_model extends Model
{
    use HasFactory;
    protected $table = "brands";
    protected $primaryKey ="brand_id";
}

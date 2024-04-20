<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsMedia extends Model
{
    use HasFactory;
	protected $table = 'cs_media';
    protected $primaryKey = 'media_id';
}
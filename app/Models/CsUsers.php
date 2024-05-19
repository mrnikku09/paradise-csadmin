<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CsUsers extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table='cs_users';
    protected $primaryKey='user_id';

}
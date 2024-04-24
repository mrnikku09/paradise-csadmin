<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsOurTeams extends Model
{
    use HasFactory;
    protected $table= 'cs_our_team';
    protected $primaryKey= 'team_id';
}
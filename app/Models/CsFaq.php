<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsFaq extends Model
{
    use HasFactory;
    protected $table= 'cs_faqs';
    protected $primaryKey= 'faq_id';
}
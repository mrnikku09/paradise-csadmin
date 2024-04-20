<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsProductByCategory extends Model
{
    use HasFactory;
    protected $table='cs_product_by_category';
    protected $primaryKey='cpc_id';
}
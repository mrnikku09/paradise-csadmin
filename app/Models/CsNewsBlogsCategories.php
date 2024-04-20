<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class CsNewsBlogsCategories extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table= 'cs_newsblogs_categories';
	protected $primaryKey= 'category_id';

    public function parent()
    {
        return $this->belongsTo('App\Models\CsNewsBlogsCategories', 'category_parent');
    }

    public function children()
    {
        return $this->hasMany('App\Models\CsNewsBlogsCategories', 'category_parent');
    }

    public static function boot()
    {
        parent::boot();
        static::created(function ($events) {
            $events->category_slug = $events->generateSlug($events->category_name);
            $events->save();
        });
    }
    public function generateSlug($name)
    {
        
        if (static::whereCategorySlug($slug = Str::slug($name))->exists()) {
            $max = static::whereCategoryName($name)->latest('category_id')->skip(1)->value('category_slug');
            if (isset($max[-1]) && is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function($mathces) {
                    return $mathces[1] + 1;
                }, $max);
               
            }
             return "{$slug}-1";
        }else{
            return $slug;
        }
        
    } 
    
}
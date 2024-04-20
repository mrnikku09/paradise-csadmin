<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;


class CsNewsBlogs extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'cs_newsblogs';
	protected $primaryKey= 'blog_id';

    public function categories()
    {
        return $this->belongsTo('App\Models\CsNewsBlogsCategories');
    }

    public function category()
    {
        return $this->hasMany('App\Models\CsNewsBlogsCategories','category_id');
    }
    public static function boot()
     {
         parent::boot();
         static::created(function ($blog) {
             $blog->blog_slug = $blog->generateSlug($blog->blog_name);
             $blog->save();
         });
     }
     public function generateSlug($name)
     {
        if (static::whereBlogSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereBlogName($name)->latest('blog_id')->skip(1)->value('blog_slug');
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
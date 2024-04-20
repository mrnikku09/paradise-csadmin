<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class CsNewsBlogsTags extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'cs_newsblogs_tags';
	protected $primaryKey= 'tag_id';

    public static function boot()
    {
        parent::boot();
        static::created(function ($tags) {
            $tags->tag_slug = $tags->generateSlug($tags->tag_name);
            $tags->save();
        });
    }
    public function generateSlug($name)
    {
        
        if (static::whereTagSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereTagName($name)->latest('tag_id')->skip(1)->value('tag_slug');
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
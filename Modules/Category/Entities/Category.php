<?php

namespace Modules\Category\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "category";
  
    protected $guarded = ['id'];

    public function Children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('Children');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $proposedSlug = Str::slug($model->title);

            $existingSlugs = static::where('slug', 'like', $proposedSlug.'%')->count();

            if ($existingSlugs > 0) {
                $model->slug = $proposedSlug . '-' . ($existingSlugs + 1);
            } else {
                $model->slug = $proposedSlug;
            }
        });

        static::updating(function ($model) {
            $proposedSlug = Str::slug($model->title);
            $existingSlugs = static::where('slug', 'like', $proposedSlug.'%')->count();

            // Eğer mevcut bir slug varsa ve bu slug mevcut kaydın slug'ı değilse
            if ($existingSlugs > 0 && $model->slug !== $proposedSlug) {
                $model->slug = $proposedSlug . '-' . ($existingSlugs + 1);
            } else {
                $model->slug = $proposedSlug;
            }
        });

       
    }
}
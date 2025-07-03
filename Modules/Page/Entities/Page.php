<?php

namespace Modules\Page\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "page";

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $proposedSlug = Str::slug($model->title);

            $existingSlugs = static::withTrashed()->where('slug', 'like', $proposedSlug.'%')->count();
            if ($existingSlugs > 0) {
                $model->slug = $proposedSlug . '-' . ($existingSlugs + 1);
            } else {
                $model->slug = $proposedSlug;
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $proposedSlug = Str::slug($model->title);
                $existingSlugs = static::withTrashed()->where('slug', 'like', $proposedSlug.'%')->count();

                if ($existingSlugs > 0) {
                    $model->slug = $proposedSlug . '-' . ($existingSlugs + 1);
                } else {
                    $model->slug = $proposedSlug;
                }
            }
        });
    }

}

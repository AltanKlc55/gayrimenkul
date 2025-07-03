<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Productset extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "products_set";

    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Oluşturulacak olan slug
            $proposedSlug = Str::slug($model->title);

            // Mevcut slugs tablosunda kontrol et
            $existingSlugs = static::where('slug', 'like', $proposedSlug.'%')->where('deleted_at',null)->count();

            // Eğer mevcut bir slug varsa, sonuna sayı ekleyerek benzersiz bir slug oluştur
            if ($existingSlugs > 0) {
                $model->slug = $proposedSlug . '-' . ($existingSlugs + 1);
            } else {
                $model->slug = $proposedSlug;
            }
        });

        static::updating(function ($model) {
            $proposedSlug = Str::slug($model->title);
            $existingSlugs = static::where('slug', 'like', $proposedSlug.'%')->where('deleted_at',null)->count();

            // Eğer mevcut bir slug varsa ve bu slug mevcut kaydın slug'ı değilse
            if ($existingSlugs > 0 && $model->slug !== $proposedSlug) {
                $model->slug = $proposedSlug . '-' . ($existingSlugs + 1);
            } else {
                $model->slug = $proposedSlug;
            }
        });


    }

}
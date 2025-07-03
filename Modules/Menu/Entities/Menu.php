<?php

namespace Modules\Menu\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Menu extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = "menu";

    protected $guarded = ['id'];
    public function Children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('Children');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Oluşturulacak olan slug
            $proposedSlug = Str::slug(get_image_name(json_decode($model->title,true)));

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
            $proposedSlug = Str::slug(get_image_name(json_decode($model->title,true)));
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
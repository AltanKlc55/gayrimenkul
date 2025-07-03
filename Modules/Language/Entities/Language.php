<?php

namespace Modules\Language\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Language extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'language';
    protected $guarded = ['id'];
    protected $fillable = ['name','slug','direction','status','default'];

    protected static function newFactory()
    {
        return \Modules\Language\Database\factories\LanguageFactory::new();
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Oluşturulacak olan slug
            $proposedSlug = Str::slug($model->name);

            // Mevcut slugs tablosunda kontrol et
            $existingSlugs = static::where('slug', 'like', $proposedSlug.'%')->count();

            // Eğer mevcut bir slug varsa, sonuna sayı ekleyerek benzersiz bir slug oluştur
            if ($existingSlugs > 0) {
                $model->slug = $proposedSlug . '-' . ($existingSlugs + 1);
            } else {
                $model->slug = $proposedSlug;
            }
        });

        
    }


}
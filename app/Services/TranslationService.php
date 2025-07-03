<?php

namespace App\Services;

class TranslationService
{
    protected $translations;

    public function __construct()
    {
        $locale = app()->getLocale();
        $filePath = resource_path("lang/$locale.json");

        if (file_exists($filePath)) {
            $this->translations = json_decode(file_get_contents($filePath), true);
        } else {
            $this->translations = [];
        }
    }

    public function __($key)
    {
        return $this->translations[$key] ?? null;
    }
}
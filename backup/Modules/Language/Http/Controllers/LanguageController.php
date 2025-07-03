<?php

namespace Modules\Language\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class LanguageController extends Controller
{

    public function index()
    {
        // Dil dosyalarını tarayarak mevcut dilleri bul
        $languages = [];
        $langPath = resource_path('lang');

        if (File::exists($langPath)) {
            $languageFiles = File::files($langPath);
            foreach ($languageFiles as $file) {
                $language = pathinfo($file->getFilename(), PATHINFO_FILENAME);
                $languages[] = $language;
            }
        }

        print_r($languages);
        return view('language::index', compact('languages'));
    }

    public function showKeys($locale)
    {
        // Seçilen dildeki anahtarları getir
        $path = resource_path("lang/{$locale}.json");

        if (File::exists($path)) {
            $contents = File::get($path);
            $languageKeys = json_decode($contents, true);
            return view('language::keys', compact('locale', 'languageKeys'));
        }

        return redirect()->route('language.showLanguages')->with('error', 'Language file not found.');
    }
    public function createLanguageFile($locale)
    {
        $data = []; // Boş bir JSON dosyası oluşturmak için başlangıç verisi

        $filePath = resource_path("lang/{$locale}.json");

        // JSON dosyasını oluştur
        File::put($filePath, json_encode($data, JSON_PRETTY_PRINT));

        return response()->json(['success' => true, 'message' => 'Language file created.']);
    }

    public function editLanguageFile($locale)
    {
        $filePath = resource_path("lang/{$locale}.json");

        if (File::exists($filePath)) {
            $contents = File::get($filePath);
            $languageKeys = json_decode($contents, true);

            return view('edit-language', compact('locale', 'languageKeys'));
        }

        return response()->json(['error' => 'Language file not found'], 404);
    }

    public function updateLanguageKey(Request $request, $locale, $key)
    {
        $filePath = resource_path("lang/{$locale}.json");

        if (File::exists($filePath)) {
            $contents = File::get($filePath);
            $languageKeys = json_decode($contents, true);

            $languageKeys[$key] = $request->input('value');
            $updatedContents = json_encode($languageKeys, JSON_PRETTY_PRINT);

            File::put($filePath, $updatedContents);

            return response()->json(['success' => true, 'message' => 'Language key updated.']);
        }

        return response()->json(['error' => 'Language file not found'], 404);
    }
}
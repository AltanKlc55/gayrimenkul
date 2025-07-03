<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
class ManageController extends Controller
{
    public function index($any)
    {

        $moduleRouteFile = base_path("Modules/{$any}/Routes/web.php");

        if (file_exists($moduleRouteFile)) {
            Route::prefix("manage/{$any}")->group($moduleRouteFile);
        } else {
            abort(404); // Modül bulunamadığında 404 hatası döndür
        }
    }
}
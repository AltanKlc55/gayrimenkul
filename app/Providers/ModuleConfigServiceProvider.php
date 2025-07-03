<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Facades\Module;

class ModuleConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    function menu_sort(&$nested_array, $key) {
        // Alt dizileri belirtilen anahtara göre sırala
        usort($nested_array, function($a, $b) use ($key) {
            return $a[$key] - $b[$key];
        });
    }
    public function boot()
    {
        $modules = Module::all();

        $moduleConfig = [];

        foreach ($modules as $module) {
            $configFile = module_path($module->getName(), 'Config/config.php');
            if (file_exists($configFile)) {
                $moduleConfig[] = require($configFile);
            }
        }
        config(['module_configs' => $moduleConfig]);

        $menu_Config = [];

        foreach ($moduleConfig as $key => $menu){
               if(isset($menu['menu'])) {
                   if(!isset($menu_Config[$menu['menu']['order']][$menu['menu']['group']]['list'])){
                       $menu_Config[$menu['menu']['order']][$menu['menu']['group']]['list'] = [];
                       $menu_Config[$menu['menu']['order']][$menu['menu']['group']]['title'] = $menu['menu']['title'];
                       $menu_Config[$menu['menu']['order']][$menu['menu']['group']]['icon'] = $menu['menu']['icon'];
                       $menu_Config[$menu['menu']['order']][$menu['menu']['group']]['url'] = $menu['menu']['url'];
                   }
               }
        }
        ksort($menu_Config);
        foreach ($moduleConfig as $key => $menu){
            if(isset($menu['menu'])){
                foreach ($menu['menu']['list'] as $item){
                    array_push($menu_Config[$menu['menu']['order']][$menu['menu']['group']]['list'], $item);
                }
            }
        }
        config(['menu_configs' => $menu_Config]);
    }
}
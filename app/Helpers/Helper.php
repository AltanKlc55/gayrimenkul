<?php
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Modules\Language\Entities\Language;
use Nwidart\Modules\Facades\Module;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

if (!function_exists('is_active')) {

    function is_active($url, $className = 'active')
    {
        return request()->is($url) ? $className : null;
    }
}

//getlanguage({"turkce":"denem","ingilizce":"denem"},"turkce")
if (!function_exists('getlanguage')) {
    function getlanguage($string,$lang)
    {
        $getdata = json_decode($string, true);
        return isset($getdata[$lang]) ? $getdata[$lang] : '';
    }
}
if (!function_exists('get_image_name')) {
    function get_image_name($string)
    {
        $defaultLang = DB::table('language')->where('default',1)->first();
        return $string[$defaultLang->slug];
    }
}
if (!function_exists('is_selected')) {
function is_selected($data1, $data2)
{
    return ($data1 == $data2) ? 'selected' : '';
}
}

if (!function_exists('has_permission')) {
    function has_permission($role,$group, $id)
    {
        $permission = DB::table('permissions')->where(['group' => $group,'group_control' => $id])->first();
        if($permission){
            $has_role = DB::table('role_has_permissions')->where(['role_id' => $role,'permission_id' => $permission->id])->first();
            return (!empty($has_role)) ? true : false;
        } else {
            return  false;
        }

    }
}
if (!function_exists('get_config')) {
    function get_config($config){
        $get_config = DB::table('config')->where('config',$config)->first();
        return isset($get_config->value) ? $get_config->value : '';
    }
}
if (!function_exists('is_developer')) {
    function is_developer(){
        $permissions = DB::table('roles')->where('default',1)->first();
        $user =auth('manager')->user()->authority;
        if($permissions->id == $user){
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('is_permision')) {
    function is_permision($data)
    {
        $permissions = DB::table('permissions')->where('module',$data)->first();
        $user = auth('manager')->user()->authority;

      

        if(!empty($permissions) and auth('manager')->check()){
            $permissions_control = DB::table('role_has_permissions')->where(array('permission_id' => $permissions->id,'role_id' => $user))->first();

            if(!empty($permissions_control)){
                return true;
            } else {
                return  false;
            }
        }



    }
}
if (!function_exists('conf_language')) {
    function conf_language()
    {
        $conf_language = DB::table('language')->where('status',0)->whereNull('deleted_at')->orderBy('default', 'desc')->get()->toArray();
        return $conf_language;
    }
}
if (!function_exists('get_language')) {
function get_language()
{
    if (session()->has('lang')) {
        $get_lang = session()->get('lang');
    } else {

        $defaultLang = DB::table('language')->where('default',1)->first();

        if (!empty($defaultLang)) {
            $get_lang = $defaultLang->slug;
        }
    }
    return $get_lang;
}
}



if (!function_exists('___')) {
    function ___($key, $locale = null)
    {
        $locale = get_language().'_';
        $filePath = resource_path("lang/$locale.json");
        if(file_exists($filePath)){
            $translations = json_decode(file_get_contents($filePath), true);

            if(isset($translations[$key])){
                return $translations[$key];
            } else {

                if (file_exists(resource_path('lang/') . $locale .'.json')){
                    $default_lang_data = file_get_contents(resource_path('lang').'/'.$locale .'.json');
                    $default_lang_data = (array) json_decode($default_lang_data);
                    $default_lang_data[$key] = $key;
                    $default_lang_data = (object) $default_lang_data;
                    $default_lang_data =   json_encode($default_lang_data);
                    file_put_contents(resource_path('lang/') . $locale .'.json', $default_lang_data);
                }

                return  $key;
            }
        } else {
            return  $key;
        }

    }
}
if (!function_exists('___')) {
    function ___($key, $locale = null)
    {
        $locale = get_language().'_';
        $filePath = resource_path("lang/$locale.json");
        if(file_exists($filePath)){
            $translations = json_decode(file_get_contents($filePath), true);

            if(isset($translations[$key])){
                return $translations[$key];
            } else {

                if (file_exists(resource_path('lang/') . $locale .'.json')){
                    $default_lang_data = file_get_contents(resource_path('lang').'/'.$locale .'.json');
                    $default_lang_data = (array) json_decode($default_lang_data);
                    $default_lang_data[$key] = $key;
                    $default_lang_data = (object) $default_lang_data;
                    $default_lang_data =   json_encode($default_lang_data);
                    file_put_contents(resource_path('lang/') . $locale .'.json', $default_lang_data);
                }

                return  $key;
            }
        } else {
            return  $key;
        }

    }
}

if (!function_exists('buildCates')) {

    function buildCates($categories, $parentid = 0)
    {
        $bcates = array();

        foreach ($categories as $categorie) {
            if ($categorie['parent_id'] == $parentid) {
                $children = buildCates($categories, $categorie['id']);
                if ($children) {
                    $categorie['child'] = $children;
                } else {
                    $categorie['child'] = "";
                }
                $bcates[] = $categorie;
            }
        }
        return $bcates;
    }
}
if (!function_exists('drawElements')) {

    function drawElements($items, $categorys, $sub = 0, $subname = "")
    {


        $changedcategorys = json_decode($categorys, true);
        if ($sub == 1) {

            $subtext = $subname . " > ";

        } else {
            $subtext = "";
        }

        foreach ($items as $item) {


            $text = $subtext . ' ' . getlanguage($item['name'],get_language());

            if (isset($changedcategorys)) {
                $query = in_array($item['id'], $changedcategorys);

                if ($query == 1) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
            } else {
                $selected = "";
            }

            if (sizeof($item['children']) > 0) {
                echo '<option value="' . $item['id'] . '" ' . $selected . '>' . $text . '</option>';

                drawElements($item['children'], $categorys, $sub = 1, $subname = $text);
            } else {
                echo '<option  value=' . $item['id'] . ' ' . $selected . '>' . $text . '</option>';
            }


        }
    }
}

if (!function_exists('getRouteList')) {
    function getRouteList()
    {
        return collect(Route::getRoutes())->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
            ];
        });
    }
}

if(!function_exists('floatvalue')){

    function floatvalue($val){
        $val = str_replace(",","",$val);
        $val = preg_replace('/\.(?=.*\.)/', '', $val);
        return floatval($val);
    }
}
if(!function_exists('currency')){
    function currency($price,$decimal = 2,$decimal_sperator = ".",$thousand_seperator = ","){
        return number_format($price, $decimal, $decimal_sperator, $thousand_seperator);
    }
}



if (!function_exists('dataTable')) {
    function dataTable($data, $iDisplayStart, $iDisplayLength, $sSearch, $aColumns)
    {
        $query = DB::table($data['table'])->select($data['select']);
        $query->whereNull($data['table'].'.deleted_at');

        if (isset($data['where'])) {
            $query->where($data['where']);

     
        }

        if (isset($data['join']) and !empty($data['join'])) {
            foreach ($data['join'] as $join) {
                if($join[4] == "Left"){
                    $query->leftJoin($join[0], $join[1],$join[2],$join[3]);

                } else if ($join[4] == "Right"){
                    $query->rightJoin($join[0], $join[1],$join[2],$join[3]);

                } else {
                    $query->join($join[0], $join[1],$join[2],$join[3]);
                }
            }
        }

        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $query->skip($iDisplayStart)->take($iDisplayLength);
        }

//        if ($sSearch) {
//            if(is_array($aColumns)){
//                foreach ($aColumns as $column) {
//                    $query->orWhere($column, 'like', '%' . $sSearch . '%');
//                }
//            }
//        }


        $result = $query->get()->map(function($item) {
            return (array) $item;
        })->all();

        return $result;
    }
}

if (!function_exists('getClientIp')) {
    function getClientIp()
    {
        $request = app('request');
        return $request->ip();
    }
}

if (!function_exists('getQuery')) {
    function getQuery($table, $data,$type = "array")
    {
        $query = DB::table($table);

        if (isset($data['select'])) {
            $query->select($data['select']);
        }
        if (isset($data['where']) and !empty(isset($data['where']))) {
            if(is_array($data['where'])){
                foreach ($data['where'] as $datum){
                    if(isset($datum[2])){
                        $query->where($datum[0],$datum[1],$datum[2]);
                    } else{
                        $query->where($datum[0],$datum[1]);
                    }
                }
            }
        }

        if (isset($data['whereBetween'])) {
            $query->whereBetween($data['whereBetween'][0],[$data['whereBetween'][1],$data['whereBetween'][2]]);
        }
        if (isset($data['sum'])) {
            $query->sum($data['sum']);
        }

        //Sum için kullanılır gelecek değer (SUM(amount) as total)
        if (isset($data['selectRaw'])) {
            if (is_array($data['selectRaw'])){
                foreach ($data['selectRaw'] as $selectraw){
                    $query->selectRaw($selectraw);
                }
            }else{
                $query->selectRaw($data['selectRaw']);
            }
        }

        if (isset($data['groupBy']) and !empty($data['groupBy'])) {
            $query->groupBy($data['groupBy']);
        }

        if (isset($data['whereDate']) and !empty($data['whereDate'])) {
            $query->whereDate($data['whereDate'][0],$data['whereDate'][1]);
        }

        if (isset($data['whereNull'])) {
            if(is_array($data['whereNull'])){
                foreach ($data['whereNull'] as $datum){
                    $query->whereNull($datum);

                }

            } else {
                $query->whereNull($data['whereNull']);

            }
        }

        if (isset($data['whereNotNull'])) {
            $query->whereNotNull($data['whereNotNull']);
        }

        if (isset($data['join']) and !empty($data['join'])) {
            foreach ($data['join'] as $join) {
                if($join[4] == "Left"){
                    $query->leftJoin($join[0], $join[1],$join[2],$join[3]);

                } else if ($join[4] == "Right"){
                    $query->rightJoin($join[0], $join[1],$join[2],$join[3]);

                } else {
                    $query->join($join[0], $join[1],$join[2],$join[3]);
                }
            }
        }

//        print_r($query->toSql());
        // Diğer koşulların eklenmesi...
        if($type == "array"){
            $result = $query->get()->map(function($item) {
                return (array) $item;
            })->all();
        } else {
            $result = $query->first();
        }

        return $result;
    }
}

if (!function_exists('dataTable')) {
    function dataTable($data, $iDisplayStart, $iDisplayLength, $sSearch, $aColumns)
    {
        $query = DB::table($data['table'])->select($data['select']);
        $query->whereNull($data['table'].'.deleted_at');

        if (isset($data['where'])) {
            $query->where($data['where']);

        }
        if (isset($data['whereBetween'])) {
            $query->whereBetween($data['whereBetween'][0],[$data['whereBetween'][1],$data['whereBetween'][2]]);
        }
        if (isset($data['whereNull'])) {
            $query->whereNull($data['whereNull']);
        }

        if (isset($data['whereNotNull'])) {
            $query->whereNotNull($data['whereNotNull']);
        }

        if (isset($data['join']) and !empty($data['join'])) {
            foreach ($data['join'] as $join) {
                if($join[4] == "Left"){
                    $query->leftJoin($join[0], $join[1],$join[2],$join[3]);

                } else if ($join[4] == "Right"){
                    $query->rightJoin($join[0], $join[1],$join[2],$join[3]);

                } else {
                    $query->join($join[0], $join[1],$join[2],$join[3]);
                }
            }
        }

        if (isset($iDisplayStart) && $iDisplayLength != '-1') {
            $query->skip($iDisplayStart)->take($iDisplayLength);
        }

//        if ($sSearch) {
//            if(is_array($aColumns)){
//                foreach ($aColumns as $column) {
//                    $query->orWhere($column, 'like', '%' . $sSearch . '%');
//                }
//            }
//        }


        $result = $query->get()->map(function($item) {
            return (array) $item;
        })->all();

        return $result;
    }



}


if (!function_exists('getSum')) {
    function getSum($table, $where,$sum,$whereBetween = array())
    {
        $query =  DB::table($table);
        if (isset($where)) {
            foreach ($where as $datum){

                $query->where($datum[0],$datum[1]);
            }
        }
        if (!empty($whereBetween)) {

            $query->whereBetween($whereBetween[0],[$whereBetween[1],$whereBetween[2]]);
        }
//        print_r($query->toSql());
        return $query->sum($sum);
    }
}

if (!function_exists('get_exchange')) {
    function get_exchange($data)
    {
        $exchange = DB::table('exchange')->latest()->first();
        if($exchange){
            return $exchange->$data;
        } else {
            return  0;
        }

    }
}
if (!function_exists('get_definitions')) {
    function get_definitions($group)
    {
        $definitions = DB::table('definitions')->where(['config' => $group])->first();
        if($definitions){
            $childs = DB::table('definitions_child')->whereNull('deleted_at')->where(['definitions_id' => $definitions->id]);

            $result = $childs->get()->map(function($item) {
                return (array) $item;
            })->all();

            return $result;
        } else {
            return  array();
        }

    }
}

if (!function_exists('get_definition')) {
    function get_definition($id,$value = "title")
    {
        $result = DB::table('definitions_child')->whereNull('deleted_at')->where(['id' => $id])->first();

        if($result){
            return $result->$value;
        } else{
            return "";
        }

    }
}
if (!function_exists('calculateRate')) {

    function calculateRate(float $amount, string $type, float $rate): float
    {
        if (!in_array($type, [0, 1,2])) {
            throw new InvalidArgumentException('Geçersiz tür: ' . $type);
        }

        if ($rate < 0 || $rate > 100) {
            throw new InvalidArgumentException('Oran 0 ile 100 arasında olmalıdır');
        }

        if ($type == 0) {
            return $amount + ($amount * $rate / 100);
        } else if ($type == 1) { // 'azalt'
            return $amount - ($amount * $rate / 100);
        } else {
            return ($amount * $rate / 100);

        }
    }
}

function remaining_day($date)
{
    $targetDate = Carbon::parse($date);
    $today = Carbon::now();

    return $targetDate->diffInDays($today);
}
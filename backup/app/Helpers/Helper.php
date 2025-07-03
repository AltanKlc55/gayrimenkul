<?php
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

function is_active($url, $className = 'active')
{
    return request()->is($url) ? $className : null;
}

function is_selected($data1, $data2)
{
    return ($data1 == $data2) ? 'selected' : '';
}

function buildCates($categories, $parentid = 0){
    $bcates = array();
    
    foreach ($categories as $categorie){
        if($categorie['parent_id'] == $parentid){
            $children = buildCates($categories, $categorie['id']);
            if($children){
                $categorie['child'] = $children;
            } else {
                $categorie['child'] = "";
            }
            $bcates[] = $categorie;
        }
    }
    return $bcates;
}

function drawElements($items ,$categorys, $sub = 0,$subname = ""){


    $changedcategorys = json_decode($categorys, true);
    if($sub == 1){

        $subtext = $subname." > ";

    } else {
        $subtext = "";
    }

    foreach ($items as $item){


        $text = $subtext.' '.$item['name'];

        if(isset($changedcategorys)){
            $query = in_array($item['id'], $changedcategorys);

            if ($query == 1) {
                $selected = "selected";
            } else {
                $selected = "";
            }
        } else {
            $selected = "";
        }

        if(sizeof($item['children']) > 0){
            echo '<option value="'.$item['id'].'" '.$selected.'>'.$text.'</option>';

            drawElements($item['children'], $categorys, $sub = 1, $subname = $text);
        } else {
            echo '<option  value='.$item['id'].' '.$selected.'>'.$text.'</option>';
        }


    }
}

function CurlSms($number, $message)
{

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.netgsm.com.tr/sms/send/get',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => 'UTF-8',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array('usercode' => '3266060743', 'password' => 'K1.v513F', 'gsmno' => $number, 'message' => $message, 'msgheader' => 'KRACACAYBHC'),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}


//İndiirm hesaplama
function get_percentage($price, $rate, $status)
{
    if ($status == 0) {
        return $price + ($price * $rate / 100);
    } else if ($status == 1) {
        return $price - ($price * $rate / 100);
    } else {
        return $price - ($price - ($price * $rate / 100));
    }
}

function text_split($text, $str = 100)
{
    if (strlen($text) > $str) {
        if (function_exists("mb_substr")) $text = mb_substr($text, 0, $str, "UTF-8") . '..';
        else $text = substr($text, 0, $str) . '..';
    }
    return $text;
}
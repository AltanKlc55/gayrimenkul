<?php

namespace Modules\Pos\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


use Modules\Pos\Entities\CreditCardCommission;
use Modules\Pos\Entities\CreditCard;
use Modules\Pos\Entities\Pos;
use Illuminate\Support\Str;

class CreditCardCommissionController extends Controller
{
    private $model;
    private $table = "creditcard_commission";
    private $page = "pos";
    private $routename= "commission";
    private $title;
    private $multilang = false;
    private $bank;




    public function __construct(Request $request)
    {
        $this->bank = $request->route('id');

        $this->model = CreditCardCommission::class;
        $this->title = ___('Kredi Kart Komisyonları');

        $this->button = array(
            array(
                'title' => 'Yeni Ekle',
                'id' => '',
                'class' =>'',
                'type' => 'link', // button,link
                'icon' => '', // button,link
                'href' => route($this->routename.'.create',($this->bank ? $this->bank : 0)), // link ise gideceği sayfa
                'onclick' =>'',
                'color' =>'primary'
            ),
        );
        $this->control = array(

        );

        $this->repeater  = array(

            array(
                'title' => 'Taksit Sayısı ',
                'name' => 'installment',
                'type' => 'select',
                'child' => 'name',
                'option' => [ ['id' => 1, 'name' => '1'],['id' => 2, 'name' => '2'],['id' => 3, 'name' => '3'],['id' => 4, 'name' => '4'],],
                'class' => 'select2',
                'grid' => 'col-md-3',
                'id' => '',
                'multiple' => false,
                'required' => false,
                'validate' => "",
                'readonly' => false,
                'disabled' => false,
                'format' => 'select'
            ),
            array(
                'title' => 'Komisyon (%)',
                'name' => 'commission',
                'type' => 'text',
                'class' => '',
                'grid' => 'col-md-4',
                //'validate' => 'required|max:255',
                'id' => '',
                'multilang' => false,
                'attribute' => '',
                'required' => false,
                'readonly' => false,
                'disabled' => false,
                'format' => 'text'
            ),

        );

    }



    public function installment()
    {

        $page['title'] = $this->title.' -> Taksitler';
        $page['table'] = route($this->routename.'.show');
        $cards = $this->model::where('card_id', $this->bank)->get()->toArray();
        $page['poss'] = Pos::find($this->bank);
        $page['cards'] = CreditCard::where('pos_id', $this->bank)->get();
        $page['commission'] = CreditCardCommission::get()->toArray();

        $page['button'] = $this->button;
        $page['action'] = route($this->routename.'.store',$this->bank);
        $page['form'] = $this->repeater;

        //foreach ($cards as $cart){
        //    $page['row']['items[0][installment]'] = $cart['installment'];
        //}
        return view($this->page.'::commission',compact('page'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create($id=null)
    {
        $page['title'] = $this->title.' -> Ekle';
        $page['action'] = route($this->routename.'.store',$this->bank);
        $page['multilang'] = $this->multilang;


        $page['form'] = $this->form;

        return view($this->page.'::creditcard.form',compact('page'));

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //echo "<pre>";
     
        if (request()->isMethod('POST')) {

            $data = $request->input('data'); // Formdan gelen verileri alın


            $preparedData = [];
            foreach ($data as $cardId => $installments) {
                foreach ($installments as $installmentNumber => $installmentData) {
                    $preparedData[] = [
                        'card_id' => $installmentData['card_id'],
                        'installment' => $installmentData['installment'],
                        'commission' => $installmentData['commission'],
                        'id' => $installmentData['id'] ?? null, // Eğer id yoksa null ata
                    ];
                }
            }

            foreach ($preparedData as $item) {
                $create = CreditCardCommission::updateOrCreate(
                    ['card_id' => $item['card_id'], 'installment' => $item['installment']],
                    ['commission' => $item['commission']]
                );
            }


            if ($create) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            
            return redirect(route($this->routename.'.installment',$this->bank))->with('message', $message)->with('message_type', $status);

        }

    }



    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {

        $page['title'] = $this->title.' -> Düzenle';
        $page['action'] = route($this->routename.'.update',$id);
        $page['row'] = $this->model::find($id);
        $page['multilang'] = $this->multilang;
        $page['form'] = $this->form;
        return view($this->page.'::creditcard.form',compact('page'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if (request()->isMethod('POST')) {


            // Bu alanda dizi içindeki elemanların validasyon kontrolleri yapoılmakta
            $validate = array();
            foreach ($this->form as $validate_control){
                if(isset($validate_control['validate']) and !empty($validate_control['validate'])){
                    $validate[$validate_control['name']] = $validate_control['validate'];
                }
            }
            if($validate){  $request->validate($validate); }

            $name = Str::slug(request('title'));
            foreach ($this->form as $key => $validate_control){
                switch ($validate_control['format']){
                    case 'text':
                        $data[$validate_control['name']] = request($validate_control['name']);
                        break;
                    case 'json':
                        $data[$validate_control['name']] = json_encode(request($validate_control['name']),true);
                        break;
                    case 'json_none':
                        $data[$validate_control['name']] = json_encode($request->input($validate_control['name']),false);
                        break;
                    case 'none':
                        $data[$validate_control['name']] =  $request->input($validate_control['name']);
                        break;
                    case 'select':
                        $data[$validate_control['name']] = request($validate_control['name']) ? request($validate_control['name']): 0;
                        break;
                    case 'file':
                        if(request()->hasFile($validate_control['name'])){
                            $image = request()->file($validate_control['name']);
                            $imageName = $name.$key.'.'.$image->extension();
                            $image->move(public_path('./'.$validate_control['path']), $imageName);
                            $data[$validate_control['name']] = $imageName;
                        }
                        break;
                }
            }


            $entry = $this->model::where('id', $id)->firstOrFail();


            $update = $entry->update($data);

            if ($update) {
                $status = "success";
                $message = "İşlem Başarıyla Tamamlandı";
            } else {
                $status = "error";
                $message = "İşlem Sırasında Bir Hata Oluştu";
            }
            return redirect(route($this->routename.'.index'))
                ->with('message', $message)
                ->with('message_type', $status);

        }

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $destroy = $this->modeldestroy($id);

        if ($destroy) {
            $status = "success";
            $message = "İşlem Başarıyla Tamamlandı";
        } else {
            $status = "error";
            $message = "İşlem Sırasında Bir Hata Oluştu";
        }

        return redirect(route($this->routename.'.index'))
            ->with('message', $message)
            ->with('message_type', $status);
    }
}
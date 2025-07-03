<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
class DashboardController extends Controller
{
    private $title;
    public function __construct()
    {
        $this->title = ___('Dashboard');

    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page['title'] = "Ana Sayfa";

        $current_count = getQuery('current',array('selectRaw' => 'count(*) as count'),"row");
        $product_count = getQuery('products',array('selectRaw' => 'count(*) as count'),"row");
        $offer_count = getQuery('offers',array('selectRaw' => 'count(*) as count'),"row");
        return view('dashboard::index',compact('current_count','product_count','offer_count','page'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('dashboard::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('dashboard::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('dashboard::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

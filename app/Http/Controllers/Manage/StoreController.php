<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Stores\Store;
use App\Models\Stores\StoresRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Throwable;

class StoreController extends Controller
{
    /**
     * @var $model
     */
    protected $model;

    /**
     * @var $repository
     */
    protected $repository;

    /**
     * Contruct
     * 
     * @param $model
     * @param $repository
     */
    public function __construct(Store $model, StoresRepository $repository)
    {
        $this->model = $model;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->input('query', '');

        $items = $this->model
        ->search($query)
        ->orderBy('created_at', 'desc')
        ->paginate()
        ->withQueryString();

        $data = [
            'items' => $items
        ];

        return Inertia::render('Stores/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Stores/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->model->create($request->only([
                'name',
                'address',
                'fixed_no',
                'mobile_no',
                'fax_no',
                'email',
                'br_no'
            ]));

            $request->session()->flash('flash.banner', 'Success - Store created successfully!');
            $request->session()->flash('flash.bannerStyle', 'success');
        } catch (Throwable $th) {
            $request->session()->flash('flash.banner', 'Failed - Something went wrong while creating store!');
            $request->session()->flash('flash.bannerStyle', 'danger');
        }

        return Redirect::route('manage.stores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}

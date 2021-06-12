<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Stores\Store;
use App\Models\Stores\StoresRepository;
use App\Models\Districts\District;
use App\Models\Areas\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Inertia\Inertia;
use Illuminate\Support\Arr;
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
     * @param   \Illuminate\Http\Response   $request
     * @return  \Inertia\Inertia
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
            'query' => $query,
            'items' => $items
        ];

        return Inertia::render('Stores/Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param   \Illuminate\Http\Response   $request
     * @return  \Inertia\Inertia
     */
    public function create(Request $request)
    {
        $areas = [];

        if ($request->has('district_id')) {
            $districtId = $request->input('district_id');
            $areas = District::find($districtId)->areas()->orderBy('name')->get();
        }

        $data = [
            'districts' => District::orderBy('name')->get(),
            'areas' => $areas
        ];

        return Inertia::render('Stores/Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Support\Facades\Redirect
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();

            $data = $request->only([
                'code',
                'name',
                'description',
                'address',
                'latitude',
                'longitude',
                'fixed_no',
                'mobile_no',
                'fax_no',
                'email',
                'br_no',
                'district_id',
                'area_id',
                'special_notes'
            ]);

            $data['status'] = 0;
            $data['created_by'] = $user->id;

            // Create store
            $store = $this->model->create($data);

            // Attach opening hours
            if ($request->has('opening_hours') && count($request->opening_hours) > 0) {
                foreach ($request->opening_hours as $row) {
                    $insert = collect($row)->only([
                        'day',
                        'open_at',
                        'close_at',
                        'full_day_open',
                        'full_day_close'
                    ])->toArray();

                    $open_at = Carbon::parse($insert['open_at']);
                    $open_time = $open_at->toTimeString();
                    $insert['open_at'] = (!empty($insert['open_at'])) ? $open_time : null;

                    $close_at = Carbon::parse($insert['close_at']);
                    $close_time = $close_at->toTimeString();
                    $insert['close_at'] = (!empty($insert['close_at'])) ? $close_time : null;

                    $store->openingHours()->create($insert);
                }
            }

            $request->session()->flash('flash.banner', 'Success - Store created successfully!');
            $request->session()->flash('flash.bannerStyle', 'success');
        } catch (Throwable $th) {
            $request->session()->flash('flash.banner', $th->getMessage());
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
     * @param  \Illuminate\Http\Request $request
     * @return \Inertia\Inertia
     */
    public function edit(Store $store, Request $request)
    {
        $areas = [];
        $districtId = ($request->has('district_id')) ? $request->input('district_id') : $store->district_id;

        if (!empty($districtId)) {
            $areas = District::find($districtId)->areas()->orderBy('name')->get();
        }

        $data = [
            'store' => $store->load('openingHours'),
            'districts' => District::orderBy('name')->get(),
            'areas' => $areas
        ];

        return Inertia::render('Stores/Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $store
     * @return \Inertia\Inertia
     */
    public function update(Request $request, Store $store)
    {
        try {
            $data = $request->only([
                'code',
                'name',
                'description',
                'address',
                'latitude',
                'longitude',
                'fixed_no',
                'mobile_no',
                'fax_no',
                'email',
                'br_no',
                'district_id',
                'area_id',
                'special_notes'
            ]);

            // Update store
            $store->update($data);

            // Detach existing opening hours
            $store->openingHours()->delete();

            // Attach opening hours
            if ($request->has('opening_hours') && count($request->opening_hours) > 0) {
                foreach ($request->opening_hours as $row) {
                    $insert = collect($row)->only([
                        'day',
                        'open_at',
                        'close_at',
                        'full_day_open',
                        'full_day_close'
                    ])->toArray();

                    $open_at = Carbon::parse($insert['open_at']);
                    $open_time = $open_at->toTimeString();
                    $insert['open_at'] = (!empty($insert['open_at'])) ? $open_time : null;

                    $close_at = Carbon::parse($insert['close_at']);
                    $close_time = $close_at->toTimeString();
                    $insert['close_at'] = (!empty($insert['close_at'])) ? $close_time : null;

                    $store->openingHours()->create($insert);
                }
            }

            $request->session()->flash('flash.banner', 'Success - Store updated successfully!');
            $request->session()->flash('flash.bannerStyle', 'success');
        } catch (Throwable $th) {
            $request->session()->flash('flash.banner', $th->getMessage());
            $request->session()->flash('flash.bannerStyle', 'danger');
        }

        return Redirect::route('manage.stores.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Inertia\Inertia
     */
    public function destroy(Store $store)
    {
        try {
            // Delete store
            $store->delete();

            // Detach existing opening hours
            $store->openingHours()->delete();

            session()->flash('flash.banner', 'Success - Store deleted successfully!');
        } catch (Throwable $th) {
            session()->flash('flash.banner', $th->getMessage());
        }

        return Redirect::route('manage.stores.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('service_providers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceProviderRequest $request)
    {
        DB::transaction(function () use ($request) {
            $serviceProvider = ServiceProvider::query()
            ->create([
                'name' => $request->name,
                'account_id' => $request->account_id,
            ]);

            if($request->service){
                foreach ($request->service as $service) {
                    $serviceProvider->services()
                        ->create(
                            [
                                'name' => $service,
                                'service_provider_id' => $serviceProvider->id,
                                'account_id' => $request->account_id
                            ]);
                }
            }
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceProviderRequest $request, ServiceProvider $serviceProvider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceProvider $serviceProvider)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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
        Log::info('Pushing service provider data to public server');
        //DB::transaction(function () use ($request) {
            $serviceProvider = ServiceProvider::query()
            ->create([
                'name' => $request->name,
                'id' => $request->id,
            ]);

            if($request->services){
                foreach ($request->services as $service) {
                    $serviceProvider->services()
                        ->create(
                            [
                                'name' => $service['name'],
                                'service_provider_id' => $serviceProvider->id
                            ]);
                }
            }
            Http::backOffice()->post('/acknowledge',[
                'status' => 'success',
                'message' => 'Service provider and its services has been created successfully',
                'data' => [
                    'id' => $serviceProvider->id,
                    'name' => $serviceProvider->name,
                    'synced' => $serviceProvider->synced,
                    'services' => $serviceProvider->services,
                ]
            ]);

            return response()->json(['message' => 'Service provider created successfully', 'data' => $serviceProvider], 201);
        //});
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

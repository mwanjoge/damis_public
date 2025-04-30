<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmbassyRequest;
use App\Http\Requests\UpdateEmbassyRequest;
use App\Models\Embassy;
use Illuminate\Support\Facades\Http;

class EmbassyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreEmbassyRequest $request)
    {
        $embassy = new Embassy();
        $embassy->id = $request->id;
        $embassy->name = $request->name;
        $embassy->type = $request->type;
        $embassy->synced = false; // Default value
        $embassy->save();

        Http::backOffice()->post('acknowledge',[
            'status' => 'success',
            'message' => 'Embassy created successfully',
            'data' => [
                'id' => $embassy->id,
                'name' => $embassy->name,
                'type' => $embassy->type,
                'is_active' => $embassy->is_active,
                'synced' => $embassy->synced,
            ]
        ]);

        return response()->json(['message' => 'Embassy created successfully', 'data' => $embassy], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Embassy $embassy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Embassy $embassy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmbassyRequest $request, Embassy $embassy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Embassy $embassy)
    {
        //
    }
}

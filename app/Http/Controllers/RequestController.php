<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
// use App\Models\Request;
use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\Country;
use App\Models\Member;
use App\Services\RequestService;
use Illuminate\Support\Facades\DB;
use App\Models\BillableItem;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = ServiceProvider::with('services')->get();

        $services = Service::query()->get();
        $countries = Country::query()->get();
        $controlNumber = '9999967890';
        $totalAmount = '0';

        return view(
            'request',
            compact('providers', 'services', 'countries', 'controlNumber', 'totalAmount')
        );
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

    public function store(StoreRequestRequest $request, RequestService $requestService)
    {

        $data = $request->all();
        //  dd($data);
        DB::beginTransaction();

        try {
            $embassyId = Country::query()->where('id', $data['country_id'])->value('embassy_id');

            $account = \App\Models\Account::query()->where('embassy_id', $embassyId)->first();
            if (!$account) {
                return redirect()->back()->withInput()->withErrors(['embassy_id' => 'Account not found for the specified embassy.']);
            }

            $price = BillableItem::query()->where('account_id', $account->id)->value('price');
            $member = Member::where('email', $data['email'])->first();

            if (!$member) {
                $member = Member::create([
                    'account_id' => $account->id,
                    'name' => $data['full_name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                ]);
            }

            foreach ($data['documents'] as $serviceId => $doc) {
                $uploadedFile = $request->file("documents.$serviceId.file");
                $path = null;

                if ($uploadedFile && $uploadedFile->isValid()) {
                    $path = $uploadedFile->store("requests/documents", 'public');
                }

                $requestItems[] = [
                    'service_id' => $serviceId,
                    'service_provider_id' => $doc['provider_id'],
                    'certificate_holder_name' => $doc['name'],
                    'certificate_index_number' => $doc['ref'],
                    'price' => $price,
                    'attachment' => $path,
                ];

                $mainRequest = $requestService->createRequest([
                    'account_id' => $account->id,
                    'embassy_id' => $embassyId,
                    'member_id' => $member->id,
                    'service_id' => $serviceId,
                    'country_id' => $data['country_id'],
                    'type' => $data['type'],
                    'service_provider_id' => $doc['provider_id'],
                    'request_items' => $requestItems,
                ]);
            }

            $requestService->addRequestedItems($mainRequest, $requestItems, $account->id);

            DB::commit();

            return redirect()->back()->with('success', 'Request created successfully!')->with([
                'total_amount' => $mainRequest->total_cost,
                'control_number' => $mainRequest->tracking_number,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to create request: ' . $e->getMessage()]);
        }
    }

    public function getRequest(\Illuminate\Http\Request $request)
{
    $tracking = $request->input('trackingNumber');


    $mainRequest = \App\Models\Request::with(['requestItems', 'member'])
    ->where('tracking_number', $tracking)->first();
// dd($mainRequest, $tracking);
    if (!$mainRequest) {
        return redirect()->back()->withErrors(['tracking_number' => 'Request not found.']);
    }

    // Return with data and force open Status tab
    return view('request', [
        'mainRequest' => $mainRequest,
        'defaultStep' => 7, // Open Status tab
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestRequest $request,)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}

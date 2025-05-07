<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceProvider;
use App\Models\Country;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $providers = ServiceProvider::query()->get();
        $services = Service::query()->get();
        $countries = Country::query()->get();
        $controlNumber = '9999967890';
        $totalAmount = '0';

        return view(
            'request',
            compact('providers', 'services', 'countries', 'controlNumber', 'totalAmount')
        );
    }

    public function getServices($providerId)
{
    Log::info('Fetching services for provider: ' . $providerId);
    
    $services = Service::where('service_provider_id', $providerId)->get();

    return response()->json(['services' => $services]);
}

}

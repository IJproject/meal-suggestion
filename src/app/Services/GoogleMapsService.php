<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GoogleMapsService
{
    private $apiKey;

    public function getCoordinatesFromAddress($search)
    {
        $apiKey = config('services.googlemaps.api_key');

        $response = Http::get('https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$search->latitude.','.$search->longitude.'&radius='.$search->selectedRadius.'&type='.$search->selectedType.'&key='.$apiKey);
        $data = $response->json();

        // if (!isset($data['results'][0]['geometry']['location'])) {
        //     // エラーハンドリングをこちらで行うか、nullを返して呼び出し元でハンドリングする
        //     return null;
        // }

        // return $data['results'][0]['geometry']['location'];
        return $data;
    }
}

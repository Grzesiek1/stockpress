<?php

namespace App\Services\OpenMeteo;

use App\Helpers\TimeHelper;
use App\Repositories\Locations;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OpenMeteoService
{
    const BASE_URL = 'https://api.open-meteo.com/v1/forecast';
    public function getTemperatureByCity(string $city): string
    {
        $client = new Client();

        $params = [
            ...Locations::BY_GPS[$city],
            "hourly" => "temperature_2m",
            "timezone" => "Europe/Warsaw",
            "forecast_days" => 1
        ];

        $response = $client->request('GET', OpenMeteoService::BASE_URL, ['query' => $params]);
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['hourly']['temperature_2m'][TimeHelper::currentHour()];
    }

}

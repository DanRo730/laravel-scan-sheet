<?php

namespace App\Services;

use Google_Client;
use Google_Service_Sheets;

class GoogleSheetService
{
    protected $service;

    public function __construct()
    {
        $client = new Google_Client();
        $client->setApplicationName('Laravel Google Sheets');
        $client->setAuthConfig(storage_path('app/google/credentials.json'));
        
        // 👇 Este es el scope correcto para leer y escribir
        $client->setScopes([Google_Service_Sheets::SPREADSHEETS]);

        $this->service = new Google_Service_Sheets($client);
    }

    public function getSheetData($spreadsheetId, $range)
    {
        $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);
        return $response->getValues();
    }

    public function appendRow($spreadsheetId, $range, $values)
    {
        $body = new \Google_Service_Sheets_ValueRange([
            'values' => [$values]
        ]);

        $params = ['valueInputOption' => 'RAW'];

        return $this->service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
    }

    public function updateRow($spreadsheetId, $range, $values)
    {
    $body = new \Google\Service\Sheets\ValueRange([
        'values' => [$values]
    ]);

    $params = ['valueInputOption' => 'USER_ENTERED'];

    return $this->service->spreadsheets_values->update(
        $spreadsheetId,
        $range,
        $body,
        $params
    );
}

}




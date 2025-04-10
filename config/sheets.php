<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Google Sheets API Credentials
    |--------------------------------------------------------------------------
    |
    | Here you may define your Google Sheets API credentials file location.
    | You can generate the JSON file from the Google Developer Console.
    |
    */

   'credentials_json' => env('GOOGLE_SHEETS_CREDENTIALS_JSON', storage_path('app/google/google-sheets-credentials.json')),


    /*
    |--------------------------------------------------------------------------
    | Google Sheets Default Spreadsheet ID
    |--------------------------------------------------------------------------
    |
    | The default spreadsheet ID to be used for reading/writing data.
    |
    */

    'spreadsheet_id' => env('GOOGLE_SHEETS_SPREADSHEET_ID', 'your-default-spreadsheet-id'),

    /*
    |--------------------------------------------------------------------------
    | Google Sheets API Version
    |--------------------------------------------------------------------------
    |
    | Specify the version of the Google Sheets API to use.
    |
    */

    'api_version' => env('GOOGLE_SHEETS_API_VERSION', 'v4'),
];

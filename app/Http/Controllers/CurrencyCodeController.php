<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CurrencyCodeController extends Controller
{
    // Endpoint responses
    public $responseType = [
        'notFound' => 'Cannot open the file or the file path does not exist.',
        'fileNotFound' => 'Cannot open the file.',
        'success' => 'Success'
    ];

    public function getCurrencyCodes() {

        $url = Storage::path('public\csv\Currency Codes.csv'); // Gets the path to the csv file for currency codes.
        
        if (!file_exists($url)) {
            return response()->json(['message' => $this->responseType['notFound']]);
        } else {
            $currencyCodesData = fopen($url, 'r');

            if ($currencyCodesData === false) {
                return response()->json(['message' => $this->responseType['fileNotFound']]);
            } 

            $currCodeData = [];
            while (($row = fgetcsv($currencyCodesData)) !== false) {
                $row = array_map('utf8_encode', $row); // Converts each element of the row to UTF-8

                $currCodeData[] = $row;  
            }
            fclose($currencyCodesData);

            return response()->json([$currCodeData]);


            // foreach ( $currCodeData as $r) {
            //     // Print the array
            //     // print_r($r);
            //     return response()->json(['message' => $r]);
            // }
            // return response()->json(['message' => $responseType['success']]);
            

        }
       
    }

    public function postConversionRates (Request $request) {
        $userRatesInput = $request->all();
        session(['rates' => $userRatesInput]);
        return response()->json(['message' => $this->responseType['success']]);
    }

}

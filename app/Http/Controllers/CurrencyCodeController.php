<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            

        }
       
    }

    public function postConversionRates (Request $request) {
        $userRatesInput = json_decode($request->getContent(), true); // Decode the raw JSON
        $userData = $userRatesInput['data'];
        
        
        $values = [
            'amount' => $userData["amount"],
            'fromCurrency' => $userData['fromCurrency'],
            'toCurrency' => $userData['toCurrency']
        ];
        
        $request->session()->put('values', $values);
        return response()->json([$values]);
    }

    private function sendRates () {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class CurrencyCodeController extends Controller
{
    // Endpoint responses
    public $responseType = [
        'notFound' => 'Cannot open the file or the file path does not exist.',
        'fileNotFound' => 'Cannot open the file.',
        'success' => 'Success',
        'failed' => 'Invalid Inputs'
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
        
        $validator = Validator::make($userRatesInput['data'], [
            'amount' => ['bail', 'required', "regex:/^\d+\.?\d*$/"],
            'fromCurrency' => 'required|string',
            'toCurrency' => 'required|string'
            ]);
        $validated = $validator->validated();
        
        if ($validator->fails()){
            return response()->json(['message'=> 'failed']);
        }
        else {
            session(['validatedData' => $validated]);
            // $this->sendRates($validated);
            return response()->json(['message' => $this->responseType['success']]);

        }
        
        

        // $userData = $userRatesInput['data'];
        
        
        // $values = [
        //     'amount' => $userData["amount"],
        //     'fromCurrency' => $userData['fromCurrency'],
        //     'toCurrency' => $userData['toCurrency']
        // ];
        
        // $request->session()->put('values', $values);
    }
    

    public function sendRates () {
        // $requestedRates
        $url = config('app.exchangerateApiPairConversion') . '/' .config('app.myAPIKey') . '/' . 'pair' . '/EUR/GBP';
        $validatedData = session('validatedData');
        // $exchangeResponse = Http::get($url);
        dd(session('validatedData'));

    }
    

}

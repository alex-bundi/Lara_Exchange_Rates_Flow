<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class CurrencyCodeController extends Controller
{
    // Endpoint responses
    public $responseType = [
        'notFound' => 'Cannot open the file or the file path does not exist.',
        'fileNotFound' => 'Cannot open the file.',
        'success' => 'Success',
        'failed' => 'Invalid Inputs'
    ];
    public $userData;

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
            // Store validated data in session
            Session::put('userData', [
                'amount' => floatval(trim($validated["amount"])),
                'fromCurrency' => trim($validated['fromCurrency']),
                'toCurrency' => trim($validated['toCurrency'])
            ]);
            return response()->json(['message' => $this->responseType['success']]);

        }

    }
    

    public function sendRates () {
        try {
            $userData = Session::get('userData');
            $url = config('app.exchangerateApiPairConversion') . config('app.myAPIKey') . '/' . 'pair' . "/{$userData['fromCurrency']}/{$userData['toCurrency']}" . "/{$userData['amount']}";
            $exchangeResponse = Http::get($url);
            $apiResponse = json_decode($exchangeResponse->body(), true);
            // dd($apiResponse['result']);
            if ($apiResponse['result'] === 'success') {
                $currentRates = [
                    'userAmount' => $userData['amount'],
                    'baseCode' => $apiResponse['base_code'],
                    'targetCode' => $apiResponse['target_code'],
                    'conversionRate' => $apiResponse['conversion_rate'],
                    'conversionResult' => $apiResponse['conversion_result']
                ];
                return $currentRates;
            } else {
                return $apiResponse['result'];
            }
        }
        catch (\Exception $exe){

            if ($exe instanceof \Illuminate\Http\Client\ConnectionException ){
                // dd($exe->getMessage());
                return redirect('/')->withErrors([
                    'error' => 'An error occurred while processing your request. Please try again later.'
                ]);
            } else {
                return $exe->getMessage();
            }      
            
        }
    }
    

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CurrencyCodeController extends Controller
{
    public function getCurrencyCodes() {
        //url('storage/logo/exchange_rate.svg')
        // try {
        //     $currencyCodesData = fopen(url('storage/logo/exchange_rate.svg'), 'r');
        //     echo('$currencyCodesData');
        // }
        // catch (Exception $e) {
        //     return response()->json(['message' => 'unsuccessful']);
        // }
        $responseType = [
            'pathNotFound' => 'Path not found',
            'fileNotFound' => 'Cannot open the file',
            'success' => 'success'
        ];

        $url = Storage::path('public\csv\Currency Codes.csv'); // Gets the path to the csv file for currency codes.
        
        if (!Storage::exists($url)) {
            return response()->json(['message' => $responseType['pathNotFound']]);
        } else {
            $currencyCodesData = fopen($url, 'r');
            if ($currencyCodesData === false) {
                return response()->json(['message' => $responseType['fileNotFound']]);
            } else {
                return response()->json(['message' => $responseType['success']]);

            }
        }


        // $currencyCodesData = fopen($url, 'r');
        // $responseType = [
        //     'fileNotFound' => 'Cannot open the file'
        // ];

        // if ($currencyCodesData === false) {
        //     return response()->json(['message' => $responseType['fileNotFound']]);
        // } else {
        //     while (($row = fgetcsv($currencyCodesData)) !== false) {
        //         $data[] = $row;
        //     }
        //     fclose($currencyCodesData);
        // }
       
    }

    public function test() {
        
    }
}

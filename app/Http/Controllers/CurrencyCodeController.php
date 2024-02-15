<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyCodeController extends Controller
{
    public function getCurrencyCodes() {
        //url('storage/logo/exchange_rate.svg')
        try {
            $currencyCodesData = fopen(url('storage/logo/exchange_rate.svg'), 'r');
            echo('$currencyCodesData');
        }
        catch (Exception $e) {
            if ($e instanceof FatalError) {
                echo('error');
            }
        }
    }

    public function test() {
        
    }
}

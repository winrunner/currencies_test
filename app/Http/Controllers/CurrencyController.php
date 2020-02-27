<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // check token
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        if($token != 'vbPFS4vtU0312NI4PFoQt6MTQiunCpaaqIPbEwui') {
            if($token == '') {
                return abort(401);   
            }
            return abort(403);
        }

        // current date
        $date = date('Y-m-d');

        // convert input date
        if($request->input('date')) {
            $date = date('Y-m-d', strtotime($request->input('date')));
        }

        $currencies = [];
        $currenciesAll = Currency::where('date', $date)->get();

        foreach($currenciesAll as $currency) {
            // exclude dublicates
            if(array_search($currency->name, array_column($currencies, 'name')) === false) {
                $currencies[] = ['name' => $currency->name, 'rate' => $currency->rate, 'date' => $currency->date];
            }
        }

        if(!$currencies) {
            return abort(404);
        }

        return json_encode($currencies);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show($currencyName, Request $request)
    {
        // check token
        $token = $request->header('Authorization');
        $token = str_replace('Bearer ', '', $token);
        if($token != 'vbPFS4vtU0312NI4PFoQt6MTQiunCpaaqIPbEwui') {
            if($token == '') {
                return abort(401);   
            }
            return abort(403);
        }

        // current date
        $date = date('Y-m-d');

        // convert input date
        if($request->input('date')) {
            $date = date('Y-m-d', strtotime($request->input('date')));
        }

        $currencies = [];
        $item = Currency::where('name', $currencyName)->where('date', $date)->orderBy('id', 'desc')->first();

        // if find item
        if($item) {
            $currencies[] = ['name' => $item->name, 'rate' => $item->rate, 'date' => $item->date];
        } else {
            return abort(404);
        }

        return json_encode($currencies);
    }
}
